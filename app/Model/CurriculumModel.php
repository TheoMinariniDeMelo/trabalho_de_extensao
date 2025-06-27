<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Session;

class CurriculumModel extends ModelMain
{
    protected $table = 'curriculum';

    public $validationRules = [
        // "pessoa_fisica_id" => [
        //     "label" => "Pessoa Física",
        //     "rules" => "required|integer"
        // ],
        // "usuario_id" => [
        //     "label" => "Usuário",
        //     "rules" => "required|integer"
        // ],
        "logradouro" => [
            "label" => "Logradouro",
            "rules" => "required|min_length[3]|max_length[60]"
        ],
        "numero" => [
            "label" => "Número",
            "rules" => "required|max_length[4]"
        ],
        "complemento" => [
            "label" => "Complemento",
            "rules" => "permit_empty|max_length[20]"
        ],
        "bairro" => [
            "label" => "Bairro",
            "rules" => "required|min_length[3]|max_length[50]"
        ],
        "cep" => [
            "label" => "CEP",
            "rules" => "required|exact_length[8]|numeric"
        ],
        // "cidade_id" => [
        //     "label" => "Cidade",
        //     "rules" => "required|integer"
        // ],
        "celular" => [
            "label" => "Celular",
            "rules" => "required|exact_length[11]|numeric"
        ],
        "nascimento" => [
            "label" => "Data de Nascimento",
            "rules" => "required|valid_date"
        ],
        "sexo" => [
            "label" => "Sexo",
            "rules" => "required|in_list[M,F]"
        ],
        // "foto" => [
        //     "label" => "Foto",
        //     "rules" => "permit_empty|max_length[255]"
        // ],
        "email" => [
            "label" => "E-mail",
            "rules" => "required|valid_email|max_length[120]"
        ],
        "apresentacaoPessoal" => [
            "label" => "Apresentação Pessoal",
            "rules" => "required"
        ],
        // "statusRegistro" => [
        //     "label" => "Status",
        //     "rules" => "required|in_list[1,2]"
        // ]
    ];


    public function cadastrarCurriculumCompleto($dados)
    {
        $curriculumId = $dados['id'] ?? null;

        if ($curriculumId) {

            $this->db->table('pessoa_fisica');
            $this->db->update([
                "nome"           => Session::get('userNome') ?? null,
                "cpf"            => $dados["cpf"] ?? null,
                "statusRegistro" => 1
            ], ['id' => $dados['pessoa_fisica_id']]);

            $this->db->table('curriculum');
            $update = $this->db->update([
                "logradouro"           => $dados["logradouro"] ?? null,
                "numero"               => $dados["numero"] ?? null,
                "complemento"          => $dados["complemento"] ?? null,
                "bairro"               => $dados["bairro"] ?? null,
                "cep"                  => $dados["cep"] ?? null,
                "cidade_id"            => $dados["cidade_id"] > 0 ? $dados["cidade_id"] : null,
                "celular"              => $dados["celular"] ?? null,
                "email"                => $dados["email"] ?? null,
                "nascimento"           => $dados["nascimento"] ?? null,
                "sexo"                 => $dados["sexo"] ?? null,
                "apresentacaoPessoal"  => $dados["apresentacaoPessoal"] ?? null,
                "foto"                 => $dados["foto"],
            ], ['id' => $curriculumId]);

            // if (!$update) {
            //     return ["erro" => true, "mensagem" => "Erro ao atualizar Currículo"];
            // }

            $this->db->table('curriculum_escolaridade')->where('curriculum_id', $curriculumId)->delete();
            if (!empty($dados['escolaridade'])) {
                foreach ($dados['escolaridade'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    $item['statusRegistro'] = 1;
                    if (!$this->insertEscolaridade($item)) {
                        return ["erro" => true, "mensagem" => "Erro ao atualizar Escolaridade"];
                    }
                }
            }

            $this->db->table('curriculum_experiencia')->where('curriculum_id', $curriculumId)->delete();
            if (!empty($dados['experiencia'])) {
                foreach ($dados['experiencia'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    $item['statusRegistro'] = 1;
                    if (!$this->insertExperiencia($item)) {
                        return ["erro" => true, "mensagem" => "Erro ao atualizar Experiência"];
                    }
                }
            }

            $this->db->table('curriculum_qualificacao')->where('curriculum_id', $curriculumId)->delete();
            if (!empty($dados['qualificacao'])) {
                foreach ($dados['qualificacao'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    if (!$this->insertQualificacao($item)) {
                        return ["erro" => true, "mensagem" => "Erro ao atualizar Qualificação"];
                    }
                }
            }

            return true;
        } else {

            $this->db->table('pessoa_fisica');
            $pessoaId = $this->db->insert([
                "nome"           => Session::get('userNome') ?? null,
                "cpf"            => $dados["cpf"] ?? null,
                "statusRegistro" => 1
            ]);

            if (!$pessoaId) {
                return ["erro" => true, "mensagem" => "Erro ao cadastrar Pessoa Física"];
            }

            $this->db->table('curriculum');
            $curriculumId = $this->db->insert([
                "pessoa_fisica_id"     => $pessoaId,
                "logradouro"           => $dados["logradouro"] ?? null,
                "numero"               => $dados["numero"] ?? null,
                "complemento"          => $dados["complemento"] ?? null,
                "bairro"               => $dados["bairro"] ?? null,
                "cep"                  => $dados["cep"] ?? null,
                "cidade_id"            => $dados["cidade_id"] > 0 ? $dados["cidade_id"] : null,
                "celular"              => $dados["celular"] ?? null,
                "email"                => $dados["email"] ?? null,
                "nascimento"           => $dados["nascimento"] ?? null,
                "sexo"                 => $dados["sexo"] ?? null,
                "apresentacaoPessoal"  => $dados["apresentacaoPessoal"] ?? null,
                "foto"                 => $dados["foto"] ?? null,
                "usuario_id"           => Session::get('userId') ?? null,
                "statusRegistro"       => 1
            ]);

            if (!$curriculumId) {
                $this->db->table('pessoa_fisica')->where('id', $pessoaId)->delete();
                return ["erro" => true, "mensagem" => "Erro ao cadastrar Currículo"];
            }

            if (!empty($dados['escolaridade'])) {
                foreach ($dados['escolaridade'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    $item['statusRegistro'] = 1;
                    if (!$this->insertEscolaridade($item)) {
                        $this->rollbackCurriculum($curriculumId, $pessoaId);
                        return ["erro" => true, "mensagem" => "Erro ao cadastrar Escolaridade"];
                    }
                }
            }

            if (!empty($dados['experiencia'])) {
                foreach ($dados['experiencia'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    $item['statusRegistro'] = 1;
                    if (!$this->insertExperiencia($item)) {
                        $this->rollbackCurriculum($curriculumId, $pessoaId);
                        return ["erro" => true, "mensagem" => "Erro ao cadastrar Experiência"];
                    }
                }
            }

            if (!empty($dados['qualificacao'])) {
                foreach ($dados['qualificacao'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    if (!$this->insertQualificacao($item)) {
                        $this->rollbackCurriculum($curriculumId, $pessoaId);
                        return ["erro" => true, "mensagem" => "Erro ao cadastrar Qualificação"];
                    }
                }
            }

            return $curriculumId;
        }
    }

    public function insertEscolaridade($dados)
    {
        $this->db->table('curriculum_escolaridade');

        $id = $this->db->insert([
            "curriculum_id"   => $dados["curriculum_id"],
            "instituicao"     => $dados["instituicao"],
            "descricao"       => $dados["descricao"],
            "inicioAno"       => $dados["inicioAno"],
            "fimMes"          => $dados["fimMes"],
            "fimAno"          => $dados["fimAno"],
            "cidade_id"       => $dados["cidade_id"] ? $dados["cidade_id"] : null,
            "escolaridade_id" => $dados["escolaridade_id"] ? $dados["escolaridade_id"] : null,
            "statusRegistro"  => $dados["statusRegistro"] ?? 1
        ]);
        // Considera sucesso se o retorno do insert for maior que 0 OU se o insert executou
        return $id > 0 || $id === "0";
    }


    public function insertExperiencia($dados)
    {

        $this->db->table('curriculum_experiencia');

        $id = $this->db->insert([
            "curriculum_id"     => $dados["curriculum_id"],
            "estabelecimento"   => $dados["estabelecimento"],
            "cargo_id"          => $dados["cargo_id"] ? $dados["cargo_id"] : null,
            "cargoDescricao"    => $dados["cargoDescricao"],
            "atividadeExercida" => $dados["atividadeExercida"],
            "inicioAno"         => $dados["inicioAno"],
            "fimMes"            => $dados["fimMes"],
            "fimAno"            => $dados["fimAno"],
            "statusRegistro"  => $dados["statusRegistro"] ?? 1
        ]);

        // Considera sucesso se ID for maior que 0 ou linha afetada
        return $id > 0 || $id === "0";
    }


    public function insertQualificacao($dados)
    {
        $this->db->table('curriculum_qualificacao');

        $id = $this->db->insert([
            "curriculum_id"   => $dados["curriculum_id"],
            "mes"             => $dados["mes"],
            "ano"             => $dados["ano"],
            "cargaHoraria"    => $dados["cargaHoraria"],
            "descricao"       => $dados["descricao"],
            "estabelecimento" => $dados["estabelecimento"]
        ]);

        return $id > 0 || $id === "0";
    }

    public function deleteCurriculum($curriculumId, $pessoaFisicaId)
    {
        $this->db->table('curriculum_escolaridade')->where('curriculum_id', $curriculumId)->delete();
        $this->db->table('curriculum_experiencia')->where('curriculum_id', $curriculumId)->delete();
        $this->db->table('curriculum_qualificacao')->where('curriculum_id', $curriculumId)->delete();

        $curriculumDeleted = $this->db->table('curriculum')->where('id', $curriculumId)->delete();
        $pessoaDeleted = $this->db->table('pessoa_fisica')->where('id', $pessoaFisicaId)->delete();

        return $curriculumDeleted && $pessoaDeleted;
    }



    private function rollbackCurriculum($curriculumId, $pessoaId)
    {
        $this->db->table('curriculum_escolaridade')->where('curriculum_id', $curriculumId)->delete();
        $this->db->table('curriculum_experiencia')->where('curriculum_id', $curriculumId)->delete();
        $this->db->table('curriculum_qualificacao')->where('curriculum_id', $curriculumId)->delete();
        $this->db->table('curriculum')->where('id', $curriculumId)->delete();
        $this->db->table('pessoa_fisica')->where('id', $pessoaId)->delete();
    }

    public function listarComCidadeENome()
    {
        return $this->db->table('curriculum c')
            ->select('c.*, pf.nome, cid.nome as cidade')
            ->join('pessoa_fisica pf', 'pf.id = c.pessoa_fisica_id', 'left')
            ->join('cidade cid', 'cid.id = c.cidade_id', 'left')
            ->findAll();
    }

    public function listaComResumo()
    {
        return $this->db
            ->select('curriculum.*, cidade.nome AS cidade, pessoa_fisica.nome AS pessoa_fisica_nome')
            ->join('cidade', 'cidade.id = curriculum.cidade_id', 'LEFT')
            ->join('pessoa_fisica', 'pessoa_fisica.id = curriculum.pessoa_fisica_id', 'LEFT')
            ->findAll();
    }


    public function verificaCurriculumUsuario($usuarioId)
    {
        return $this->db->table('curriculum')
            ->where('usuario_id', $usuarioId)
            ->where('statusRegistro', 1) // Só ativos, opcional
            ->findAll();
    }

    public function buscarCurriculumCompletoPorUsuario($curriculumId)
    {

        if (Session::get('userNivel') > 20) {

            $curriculum = $this->db->table('curriculum')
                ->where('usuario_id', Session::get('userId'))
                ->findAll();
        } else {

            $curriculum = $this->db->table('curriculum')
                // ->where('id', $usuarioId)
                ->where('id', $curriculumId)
                ->findAll();
        }

        if (!$curriculum) {
            return null; // Não tem currículo
        }

        $curriculumId = $curriculum[0]['id'];

        // Escolaridade
        $curriculum['escolaridade'] = $this->db->table('curriculum_escolaridade ce')
            ->select('ce.*, cid.nome AS cidade, e.descricao AS escolaridade')
            ->join('cidade cid', 'cid.id = ce.cidade_id', 'left')
            ->join('escolaridade e', 'e.id = ce.escolaridade_id', 'left')
            ->where('ce.curriculum_id', $curriculumId)
            ->where('ce.statusRegistro', 1)
            ->findAll();

        // Experiência
        $curriculum['experiencia'] = $this->db->table('curriculum_experiencia ce')
            ->select('ce.*, c.descricao AS cargo')
            ->join('cargo c', 'c.id = ce.cargo_id', 'left')
            ->where('ce.curriculum_id', $curriculumId)
            ->where('ce.statusRegistro', 1)
            ->findAll();

        // Qualificação
        $curriculum['qualificacao'] = $this->db->table('curriculum_qualificacao')
            ->where('curriculum_id', $curriculumId)
            ->where('statusRegistro', 1)
            ->findAll();

        $curriculum['pessoa_fisica'] = $this->db->table('pessoa_fisica')
            ->where('id', $curriculum[0]['pessoa_fisica_id'])
            ->where('statusRegistro', 1)
            ->findAll();

        return $curriculum;
    }
}

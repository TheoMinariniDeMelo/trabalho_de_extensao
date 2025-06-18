<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumModel extends ModelMain
{
    protected $table = 'curriculum';

    // public $validationRules = [
    //     "logradouro" => ["label" => "Logradouro", "rules" => "required"],
    //     "cep" => ["label" => "CEP", "rules" => "required|min:8|max:8"],
    //     "cidade_id" => ["label" => "Cidade", "rules" => "required"],
    //     "celular" => ["label" => "Celular", "rules" => "required"],
    //     "email" => ["label" => "Email", "rules" => "required|email"]
    // ];

    public function insertCurriculum($dados)
    {
        // var_dump($dados);
        // exit;
    
        return $this->insert([
            "pessoa_fisica_id"     => $dados["pessoa_fisica_id"] ?? null,
            "logradouro"           => $dados["logradouro"],
            "numero"               => $dados["numero"],
            "complemento"          => $dados["complemento"],
            "bairro"               => $dados["bairro"],
            "cep"                  => $dados["cep"],
            "cidade_id"            => $dados["cidade_id"] > 0 ? $dados["cidade_id"] : null,
            "celular"              => $dados["celular"],
            "email"                => $dados["email"],
            "nascimento"           => $dados["nascimento"],
            "sexo"                 => $dados["sexo"],
            "apresentacaoPessoal"  => $dados["apresentacaoPessoal"],
            "foto"                 => $dados["foto"] ?? null,
        ]);
    }

    public function insertEscolaridade($dados)
    {
        return $this->db->table('curriculum_escolaridade')->insert([
            "curriculum_id"     => $dados["curriculum_id"],
            "instituicao"       => $dados["instituicao"],
            "descricao"         => $dados["descricao"],
            "inicioAno"         => $dados["inicioAno"],
            "fimMes"            => $dados["fimMes"],
            "fimAno"            => $dados["fimAno"],
            "cidade_id"         => $dados["cidade_id"] > 0 ? $dados["cidade_id"] : null,
            "escolaridade_id"   => $dados["escolaridade_id"] > 0 ? $dados["escolaridade_id"] : null
        ]);
    }

    public function insertExperiencia($dados)
    {
        return $this->db->table('curriculum_experiencia')->insert([
            "curriculum_id"     => $dados["curriculum_id"],
            "estabelecimento"   => $dados["estabelecimento"],
            "cargo_id"          => $dados["cargo_id"] > 0 ? $dados["cargo_id"] : null,
            "cargoDescricao"    => $dados["cargoDescricao"],
            "atividadeExercida" => $dados["atividadeExercida"],
            "inicioAno"         => $dados["inicioAno"],
            "fimMes"            => $dados["fimMes"],
            "fimAno"            => $dados["fimAno"]
        ]);
    }

    public function insertQualificacao($dados)
    {
        return $this->db->table('curriculum_qualificacao')->insert([
            "curriculum_id"   => $dados["curriculum_id"],
            "mes"             => $dados["mes"],
            "ano"             => $dados["ano"],
            "cargaHoraria"    => $dados["cargaHoraria"],
            "descricao"       => $dados["descricao"],
            "estabelecimento" => $dados["estabelecimento"]
        ]);
    }

    public function listarComCidadeENome()
    {
        return $this->db->table('curriculum c')
            ->select('c.*, pf.nome, cid.nome as cidade')
            ->join('pessoa_fisica pf', 'pf.id = c.pessoa_fisica_id')
            ->join('cidade cid', 'cid.id = c.cidade_id', 'left')
            ->findAll();
    }

    public function listaComResumo()
    {
        return $this->db
            ->select('curriculum.id, curriculum.email, curriculum.celular, cidade.nome AS cidade')
            ->join('cidade', 'cidade.id = curriculum.cidade_id', 'LEFT')
            ->findAll();
    }
}

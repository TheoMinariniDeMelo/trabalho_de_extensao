<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Session;

class VagaModel extends ModelMain
{
    protected $table = "vaga";

    public $validationRules = [
        "cargo_id" => [
            "label" => "Cargo",
            "rules" => "permit_empty|integer"
        ],
        "descricao" => [
            "label" => "Descrição",
            "rules" => "permit_empty|max_length[60]"
        ],
        "observacao" => [
            "label" => "Observação",
            "rules" => "permit_empty"
        ],
        "modalidade" => [
            "label" => "Modalidade",
            "rules" => "permit_empty|integer|in_list[1,2,3]"  // 1=Presencial, 2=Remoto, 3=Híbrido (exemplo)
        ],
        "vinculo" => [
            "label" => "Vínculo",
            "rules" => "permit_empty|integer|in_list[1,2,3]"  // 1=CLT, 2=Estágio, 3=Temporário (exemplo)
        ],
        "ofertaPublica" => [
            "label" => "Oferta Pública",
            "rules" => "permit_empty|integer|in_list[0,1]"  // 0 = Não, 1 = Sim
        ],
        "data" => [
            "label" => "Data",
            "rules" => "permit_empty|valid_date"
        ],
        "estabelecimento_id" => [
            "label" => "Estabelecimento",
            "rules" => "permit_empty|integer"
        ],
        "statusVaga" => [
            "label" => "Status da Vaga",
            "rules" => "permit_empty|integer|in_list[1,2]" // 1 = Ativa, 2 = Inativa
        ],
    ];


    public function filtrar(array $filtros): array
    {
        $sql = "SELECT 
                v.*,
                c.descricao AS cargo_descricao,
                estabelecimento.nome AS estabelecimento_nome
            FROM vaga v
            LEFT JOIN cargo c ON c.id = v.cargo_id
            LEFT JOIN estabelecimento ON estabelecimento.id = v.estabelecimento_id
            WHERE 1=1
            AND v.statusVaga = 1";

        $params = [];

        if (!empty($filtros['busca']) && is_string($filtros['busca'])) {
            $sql .= " AND (
                    v.descricao LIKE :busca 
                    OR v.observacao LIKE :busca 
                    OR c.descricao LIKE :busca
                    OR v.modalidade LIKE :busca
                    OR v.vinculo LIKE :busca
                    OR v.data LIKE :busca
                )";
            $params[':busca'] = '%' . $filtros['busca'] . '%';
        }

        if (!empty($filtros['cargo_id']) && is_numeric($filtros['cargo_id'])) {
            $sql .= " AND v.cargo_id = :cargo_id";
            $params[':cargo_id'] = $filtros['cargo_id'];
        }

        if (!empty($filtros['estabelecimento_id']) && is_numeric($filtros['estabelecimento_id'])) {
            $sql .= " AND v.estabelecimento_id = :estabelecimento_id";
            $params[':estabelecimento_id'] = $filtros['estabelecimento_id'];
        }

        if (isset($filtros['ofertaPublica'])) {
            $sql .= " AND v.ofertaPublica = :ofertaPublica";
            $params[':ofertaPublica'] = $filtros['ofertaPublica'] ? 1 : 0;
        }

        $sql .= " ORDER BY v.data DESC";

        file_put_contents('debug_sql.txt', $sql . "\n" . print_r($params, true));

        return $this->query($sql, $params);
    }


    public function infoVaga($id)
    {

        return $this->db
            ->select(
                '
        vaga.*,
        cargo.descricao AS cargo_descricao,
        estabelecimento.nome AS estabelecimento_nome,
        estabelecimento.endereco AS estabelecimento_endereco,
        estabelecimento.email AS estabelecimento_email,
        cidade.nome AS estabelecimento_cidade'
            )
            ->join('cargo', 'cargo.id = vaga.cargo_id', 'left')
            ->join('estabelecimento', 'estabelecimento.id = vaga.estabelecimento_id', 'left')
            ->join('cidade', 'cidade.id = estabelecimento.cidade_id', 'left')
            // ->where('vaga.statusVaga', 1)
            ->where('vaga.id', $id)
            ->findAll();
    }

    public function candidatarVaga($curriculumId, $vagaId)
    {
        return $this->db->table('curriculum_vaga')->insert([
            'curriculum_id'     => $curriculumId,
            'vaga_id'           => $vagaId,
            'data_candidatura'  => date('Y-m-d H:i:s'),
            'status'            => 1, // Pendente
        ]);
    }

    public function verificaCandidatura($curriculumId, $vagaId)
    {
        return $this->db->table('curriculum_vaga')
            ->where('curriculum_id', $curriculumId)
            ->where('vaga_id', $vagaId)
            // ->where('status', 1) // Somente candidaturas ativas/pending, opcional
            ->findAll();
    }

    public function listaCandidaturaUsuario($usuarioId)
    {
        return $this->db->table('curriculum_vaga cv')
            ->select('cv.*, v.descricao AS vaga_descricao, cg.descricao AS cargo_descricao, cv.data_candidatura, cv.status, e.nome AS estabelecimento_nome')
            ->join('curriculum c', 'c.id = cv.curriculum_id', 'left')
            ->join('vaga v', 'v.id = cv.vaga_id', 'left')
            ->join('estabelecimento e', 'e.id = v.estabelecimento_id', 'left')
            ->join('cargo cg', 'cg.id = v.cargo_id', 'left')  // cargo associado à vaga
            ->where('c.usuario_id', $usuarioId)
            ->findAll();
    }

    public function recuperarPorId($id)
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            return $this->db
                ->where('estabelecimento_id', Session::get('userEstabelecimentoId'))
                ->where('id', $id)
                ->first();
        }

        return $this->db
            ->where('id', $id)->first();
    }

    public function listaVagas()
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            return $this->db
                ->select('vaga.*, cargo.descricao AS cargo_descricao, estabelecimento.nome AS estabelecimento_nome')
                ->join('cargo', 'cargo.id = vaga.cargo_id')
                ->join('estabelecimento', 'estabelecimento.id = vaga.estabelecimento_id')
                ->where('vaga.estabelecimento_id', Session::get('userEstabelecimentoId'))
                ->findAll();
        }

        return $this->db
            ->select('vaga.*, cargo.descricao AS cargo_descricao, estabelecimento.nome AS estabelecimento_nome')
            ->join('cargo', 'cargo.id = vaga.cargo_id', 'left')
            ->join('estabelecimento', 'estabelecimento.id = vaga.estabelecimento_id', 'left')
            ->findAll();
    }


    public function visualizarcandidatoVaga(int $vagaId)
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') < 20) {
            return $this->db->table('vaga')
                ->select('
            curriculum_vaga.id, 
            pf.nome AS candidato_nome, 
            pf.cpf, 
            pf.id AS pessoa_fisica_id,
            c.id AS curriculum_id,
            c.email, 
            c.celular, 
            c.usuario_id AS usuario_id,
            curriculum_vaga.data_candidatura, 
            curriculum_vaga.status,
            vaga.descricao AS vaga_descricao,
            vaga.id AS vaga_id,
            vaga.data,
            cg.descricao AS cargo_descricao,
            estabelecimento.nome AS estabelecimento_nome
        ')
                ->join('curriculum_vaga', 'curriculum_vaga.vaga_id = vaga.id')
                ->join('curriculum c', 'c.id = curriculum_vaga.curriculum_id', 'left')
                ->join('pessoa_fisica pf', 'pf.id = c.pessoa_fisica_id', 'left')
                ->join('estabelecimento', 'estabelecimento.id = vaga.estabelecimento_id', 'left')
                ->join('cargo cg', 'cg.id = vaga.cargo_id', 'left')
                ->where('vaga.id', $vagaId)
                ->where('vaga.estabelecimento_id', Session::get('userEstabelecimentoId'))
                ->findAll();
        }
        return $this->db->table('vaga')
            ->select('
            curriculum_vaga.id, 
            pf.nome AS candidato_nome, 
            pf.cpf, 
            pf.id AS pessoa_fisica_id,
            c.id AS curriculum_id,
            c.email, 
            c.celular, 
            c.usuario_id AS usuario_id,
            curriculum_vaga.data_candidatura, 
            curriculum_vaga.status,
            vaga.descricao AS vaga_descricao,
            vaga.id AS vaga_id,
            vaga.data,
            cg.descricao AS cargo_descricao,
            estabelecimento.nome AS estabelecimento_nome
        ')
            ->join('curriculum_vaga', 'curriculum_vaga.vaga_id = vaga.id', 'left')
            ->join('curriculum c', 'c.id = curriculum_vaga.curriculum_id', 'left')
            ->join('pessoa_fisica pf', 'pf.id = c.pessoa_fisica_id', 'left')
            ->join('estabelecimento', 'estabelecimento.id = vaga.estabelecimento_id', 'left')
            ->join('cargo cg', 'cg.id = vaga.cargo_id', 'left')
            ->where('vaga.id', $vagaId)
            ->findAll();
    }

    public function getInfoCandidaturaVaga(int $vagaId)
    {
        return $this->db->table('curriculum_vaga cv')
            ->select('
            cv.id, 
            pf.nome AS candidato_nome, 
            pf.cpf, 
            pf.id AS pessoa_fisica_id,
            c.id AS curriculum_id,
            c.email, 
            c.celular, 
            cv.data_candidatura, 
            cv.status,
            v.descricao AS vaga_descricao,
            cg.descricao AS cargo_descricao,
            estabelecimento.nome AS estabelecimento_nome
        ')
            ->join('curriculum c', 'c.id = cv.curriculum_id', 'left')
            ->join('pessoa_fisica pf', 'pf.id = c.pessoa_fisica_id', 'left')
            ->join('vaga v', 'v.id = cv.vaga_id', 'left')
            ->join('estabelecimento', 'estabelecimento.id = v.estabelecimento_id', 'left')
            ->join('cargo cg', 'cg.id = v.cargo_id', 'left')
            ->where('cv.vaga_id', $vagaId)
            ->findAll();
    }

    public function recuperaInfoCandidatura(int $vagaId, int $usuarioId)
    {

        return $this->db->table('curriculum_vaga cv')
            ->select('
            cv.id AS candidatura_id,
            cv.data_candidatura,
            cv.vaga_id AS vaga_id,
            cv.status,
            cv.observacao,
            c.id AS curriculum_id,
            c.email AS curriculum_email,
            c.celular,
            c.nascimento,
            c.sexo,
            c.apresentacaoPessoal,
            c.usuario_id AS usuario_id,
            pf.nome AS candidato_nome,
            pf.cpf,
            cargo.descricao AS cargo_nome
        ')
            ->join('curriculum c', 'c.id = cv.curriculum_id', 'left')
            ->join('pessoa_fisica pf', 'pf.id = c.pessoa_fisica_id', 'left')
            ->join('vaga', 'vaga.id = cv.vaga_id', 'left')
            ->join('cargo', 'cargo.id = vaga.cargo_id', 'left')
            ->where('cv.vaga_id', $vagaId)
            ->where('c.usuario_id', $usuarioId)
            ->first();
    }

    public function updateCandidatura($vaga_id, $usuarioId, array $dados)
    {
        // Busca o registro da candidatura
        $registro = $this->db->table('curriculum_vaga')
            ->select('id, curriculum_id')
            ->where('vaga_id', $vaga_id)
            ->where('curriculum_id', $usuarioId)
            ->first();

        if (!$registro) {
            return false; // Não encontrou o registro
        }

        // Monta os dados para atualizar
        $dadosAtualizar = [
            'status'      => $dados['status'] ?? 1,
            'observacao'  => $dados['observacao'] ?? null,
        ];

        // Executa o update no padrão que você usa
        $this->db->table('curriculum_vaga');
        $update = $this->db->update($dadosAtualizar, ['id' => $registro['id']]);

        return $update;
    }

    public function recuperaNomeEstabelecimentoParaEnvioEmail()
    {
        return $this->db->table('usuario u')
            ->select('
        u.id AS usuario_id,
        u.nome AS usuario_nome,
        u.email AS usuario_email,
        u.estabelecimento_id,
        e.nome AS estabelecimento_nome,
        e.email AS estabelecimento_email,
        e.endereco,
        c.nome
    ')
            ->join('estabelecimento e', 'e.id = u.estabelecimento_id', 'left')
            ->join('cidade c', 'c.id = e.cidade_id', 'left')
            ->where('u.id', Session::get('userId'))
            ->first();
    }

    public function removerCurriculumVaga($curriculumVagaId)
    {
        if ($this->db->table('curriculum_vaga')->where('id', $curriculumVagaId)->delete()) {
            return true;
        }
        return false;
    }
}

<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Session;

class VagaModel extends ModelMain
{
    protected $table = "vaga";

    // public $validationRules = [
    //     "descricao"  => [
    //         "label" => 'Descrição',
    //         "rules" => 'required|min:3|max:50'
    //     ]
    // ];

    public function filtrar(array $filtros): array
    {
        $sql = "SELECT 
                v.*,
                c.descricao AS cargo_descricao
            FROM vaga v
            LEFT JOIN cargo c ON c.id = v.cargo_id
            WHERE 1=1";

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
            ->select('
        vaga.*,
        cargo.descricao AS cargo_descricao,
        estabelecimento.nome AS estabelecimento_nome,
        estabelecimento.endereco AS estabelecimento_endereco,
        estabelecimento.cidade AS estabelecimento_cidade,
        estabelecimento.email AS estabelecimento_email')
            ->join('cargo', 'cargo.id = vaga.cargo_id', 'left')
            ->join('estabelecimento', 'estabelecimento.id = vaga.estabelecimento_id', 'left')
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
            ->where('status', 1) // Somente candidaturas ativas/pending, opcional
            ->findAll();
    }

    public function listaCandidaturaUsuario($usuarioId)
    {
        return $this->db->table('curriculum_vaga cv')
            ->select('cv.id, v.descricao AS vaga_descricao, cg.descricao AS cargo_descricao, cv.data_candidatura, cv.status')
            ->join('curriculum c', 'c.id = cv.curriculum_id')
            ->join('vaga v', 'v.id = cv.vaga_id')
            ->join('cargo cg', 'cg.id = v.cargo_id')  // cargo associado à vaga
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
                ->select('vaga.*, cargo.descricao AS cargo_descricao')
                ->join('cargo', 'cargo.id = vaga.cargo_id')
                ->where('vaga.estabelecimento_id', Session::get('userEstabelecimentoId'))
                ->findAll();
        }

        return $this->db
            ->findAll();
    }
}

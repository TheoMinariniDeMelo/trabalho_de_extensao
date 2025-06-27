<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Session;

class EstabelecimentoModel extends ModelMain
{
    protected $table = "estabelecimento";

    public $validationRules = [
        "nome" => [
            "label" => "Nome",
            "rules" => "required|min_length[3]|max_length[50]"
        ],
        "endereco" => [
            "label" => "Endereço",
            "rules" => "required|min_length[3]|max_length[200]"
        ],
        "cidade_id" => [
            "label" => "Cidade",
            "rules" => "permit_empty|integer"
        ],
        "latitude" => [
            "label" => "Latitude",
            "rules" => "permit_empty|max_length[12]"
        ],
        "longitude" => [
            "label" => "Longitude",
            "rules" => "permit_empty|max_length[12]"
        ],
        "email" => [
            "label" => "E-mail",
            "rules" => "required|valid_email|max_length[150]"
        ],
        "usuario_id" => [
            "label" => "Usuário",
            "rules" => "permit_empty|integer"
        ],
        "statusRegistro" => [
            "label" => "Status",
            "rules" => "required|in_list[1,2]"
        ]
    ];


    public function getEstabelecimento()
    {
        $builder = $this->db->table('estabelecimento e')
            ->select('e.*, c.nome AS cidade_nome')
            ->join('cidade c', 'c.id = e.cidade_id', 'left');

        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            $builder->where('e.id', Session::get('userEstabelecimentoId'));
        }

        return $builder->findAll();
    }


    public function recuperarPorId($id)
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            return $this->db
                ->where('id', Session::get('userEstabelecimentoId'))
                ->first();
        }

        return $this->db
            ->where('id', $id)->first();
    }
}

<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Session;

class EstabelecimentoModel extends ModelMain
{
    protected $table = "estabelecimento";

    // public $validationRules = [
    //     "descricao"  => [
    //         "label" => 'Descrição',
    //         "rules" => 'required|min:3|max:50'
    //     ]
    // ];

    public function getEstabelecimento()
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            return $this->db
                ->where('id', Session::get('userEstabelecimentoId'))
                ->findAll();
        }

        return $this->db->findAll();
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

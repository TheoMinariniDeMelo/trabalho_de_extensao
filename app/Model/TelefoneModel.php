<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Session;

class TelefoneModel extends ModelMain
{
    protected $table = "telefone";

    // public $validationRules = [
    //     "descricao"  => [
    //         "label" => 'Descrição',
    //         "rules" => 'required|min:3|max:50'
    //     ]
    // ];

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

    public function listaTelefone()
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            return $this->db
                ->where('telefone.estabelecimento_id', Session::get('userEstabelecimentoId'))
                ->findAll();
        }

        return $this->db
            ->findAll();
    }
}

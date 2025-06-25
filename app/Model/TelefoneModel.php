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
        $this->db->select('
        telefone.*,
        estabelecimento.nome AS estabelecimento_nome,
        usuario.nome AS responsavel_nome
    ')
            ->join('estabelecimento', 'estabelecimento.id = telefone.estabelecimento_id', 'left')
            ->join('usuario', 'usuario.id = estabelecimento.usuario_id', 'left');

        // Se for um nível restrito (Empresa)
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            $this->db->where('estabelecimento.id', Session::get('userEstabelecimentoId'));
        }

        return $this->db->findAll();
    }
}

<?php

namespace App\Model;

use Core\Library\ModelMain;

class CategoriaEstabelecimentoModel extends ModelMain
{
    protected $table = "categoria_estabelecimento";

    public $validationRules = [
        // "estabelecimento_id" => [
        //     "label" => "Estabelecimento",
        //     "rules" => "required|integer"
        // ],
        // "categoria_id" => [
        //     "label" => "Categoria",
        //     "rules" => "required|integer"
        // ],
        "statusRegistro" => [
            "label" => "Status",
            "rules" => "required|in_list[1,2]"
        ]
    ];


    public function getLista()
    {
        return $this->db
            ->select('
            categoria_estabelecimento.id AS categoria_estabelecimento_id,
            categoria_estabelecimento.statusRegistro AS categoria_statusRegistro,
            categoria_estabelecimento.estabelecimento_id,
            categoria_estabelecimento.categoria_id,
            categoria.descricao AS categoria_descricao,
            estabelecimento.nome AS estabelecimento_nome
        ')
            ->join('categoria', 'categoria.id = categoria_estabelecimento.categoria_id', 'left')
            ->join('estabelecimento', 'estabelecimento.id = categoria_estabelecimento.estabelecimento_id', 'left')
            ->findAll();
    }
}

<?php

namespace App\Model;

use Core\Library\ModelMain;

class CategoriaModel extends ModelMain
{
    protected $table = "categoria";
    
    public $validationRules = [
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:3|max:50'
        ]
    ];

    public function getLista() 
    {
        return $this->db
        ->select('categoria.*')
        ->findAll();
    }
}
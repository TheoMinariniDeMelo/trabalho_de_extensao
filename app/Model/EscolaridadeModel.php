<?php

namespace App\Model;

use Core\Library\ModelMain;

class EscolaridadeModel extends ModelMain
{
    protected $table = "escolaridade";
    
    public $validationRules = [
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:3|max:50'
        ]
    ];
}
<?php

namespace App\Model;

use Core\Library\ModelMain;

class CargoModel extends ModelMain
{
    protected $table = "cargo";
    
    public $validationRules = [
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:3|max:50'
        ]
    ];
}
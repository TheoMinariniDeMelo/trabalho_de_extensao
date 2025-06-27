<?php

namespace App\Model;

use Core\Library\ModelMain;

class PessoaFisicaModel extends ModelMain
{
    protected $table = "pessoa_fisica";

    public $validationRules = [
        "nome" => [
            "label" => "Nome",
            "rules" => "required|min_length[3]|max_length[150]"
        ],
        "cpf" => [
            "label" => "CPF",
            "rules" => "required|exact_length[11]|numeric"
            // 'is_unique' com exceção do próprio registro para updates
        ],
        "statusRegistro" => [
            "label" => "Status",
            "rules" => "required|in_list[1,2]"
        ],
    ];
}

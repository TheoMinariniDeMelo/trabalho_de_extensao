<?php

namespace App\Model;

use Core\Library\ModelMain;

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
        $sql = "SELECT * FROM vaga WHERE 1=1";
        $params = [];

        if (!empty($filtros['busca']) && is_string($filtros['busca'])) {
            // Usando parâmetro para evitar SQL injection
            $sql .= " AND descricao LIKE :busca";
            $params[':busca'] = '%' . $filtros['busca'] . '%';
        }

        $sql .= " ORDER BY data DESC";

        // Debug da query e parâmetros
        file_put_contents('debug_sql.txt', $sql . "\n" . print_r($params, true));

        // Executa a query com parâmetros
        return $this->query($sql, $params);
    }
}

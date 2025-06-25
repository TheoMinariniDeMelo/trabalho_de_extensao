<?php
// app\controller\Home.php

namespace App\Controller;

use Core\Library\ControllerMain;

class Home extends ControllerMain
{
    public function index()
    {
        $this->loadView("home");
    }

    public function quemSomos($action = null)
    {
        return $this->loadView("quemSomos");
    }

    public function detalhes($action = null, $id = null, ...$params)
    {
        echo "Detalhes: <br />";
        echo "<br />Ação: " . $action;
        echo "<br />ID: " . $id;
        echo "<br />PARÂMETROS: " . implode(", ", $params);
    }
}

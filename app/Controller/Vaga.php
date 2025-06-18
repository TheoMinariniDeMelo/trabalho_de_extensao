<?php

namespace App\Controller;

use App\Model\UfModel;
use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Database;

class Vaga extends ControllerMain
{

    // protected $model;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        // $this->model = ('formHelper');
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("vaga/listaVaga", $this->model->lista());
    }

    public function listarVagas()
    {
        return $this->loadView("vaga/listarVagas");
    }

    public function form($action, $id)
    {
        $UfModel = new UfModel();

        $dados = [
            'data' => $this->model->getById($id),               // Busca Vaga
            'aUf' => $UfModel->lista("sigla")                   // Busca UFs a serem exibidas na combobox
        ];

        return $this->loadView("vaga/formVaga", $dados);
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $post = $this->request->getPost();

        if ($this->model->insert($post)) {
            return Redirect::page($this->controller, ["msgSucesso" => "Registro inserido com sucesso."]);
        } else {
            return Redirect::page($this->controller . "/form/insert/0");
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $post = $this->request->getPost();

        if ($this->model->update($post)) {
            return Redirect::page($this->controller, ["msgSucesso" => "Registro alterado com sucesso."]);
        } else {
            return Redirect::page($this->controller . "/form/update/" . $post['id']);
        }
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        $post = $this->request->getPost();

        if ($this->model->delete($post)) {
            return Redirect::page($this->controller, ["msgSucesso" => "Registro Excluído com sucesso."]);
        } else {
            return Redirect::page($this->controller);
        }
    }

    public function ajaxFiltrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
            exit;
        }

        $busca = isset($_POST['busca']) ? $_POST['busca'] : '';

        $filtros = [];
        if (!empty($busca)) {
            $filtros['busca'] = $busca;
        }

        $vagas = $this->model->filtrar($filtros);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($vagas);
        exit;
    }
}

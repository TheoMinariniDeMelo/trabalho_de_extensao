<?php

namespace App\Controller;

use App\Model\CategoriaEstabelecimentoModel;
use App\Model\CategoriaModel;
use App\Model\EstabelecimentoModel;
use App\Model\UfModel;
use Core\Library\ControllerMain;
use Core\Library\Redirect;

class CategoriaEstabelecimento extends ControllerMain
{

    protected $estabelecimentoModel;
    protected $categoriaModel;
    protected $modela;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');

        $this->estabelecimentoModel = new EstabelecimentoModel();
        $this->categoriaModel       = new CategoriaModel();
        $this->modela               = new CategoriaEstabelecimentoModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("categoriaEstabelecimento/listaCategoriaEstabelecimento", $this->modela->getLista());
    }

    public function form($action, $id)
    {
        $UfModel = new UfModel();

        $dados = [
            'data' => $this->model->getById($id),               // Busca Categoria
            'aCategoria' => $this->categoriaModel->getLista('id'),  
            'aEstabelecimento' => $this->estabelecimentoModel->lista('id'),                 
        ];
        
        return $this->loadView("categoriaEstabelecimento/formCategoriaEstabelecimento", $dados);
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
}
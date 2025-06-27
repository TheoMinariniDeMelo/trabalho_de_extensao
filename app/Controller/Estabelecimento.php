<?php

namespace App\Controller;

use App\Model\CidadeModel;
use App\Model\UsuarioModel;
use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

class Estabelecimento extends ControllerMain
{

    protected $usuarioModel;
    protected $cidadeModel;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');

        $this->usuarioModel = new UsuarioModel;
        $this->cidadeModel  = new CidadeModel;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->validaNivelAcesso();

        return $this->loadView("estabelecimento/listaEstabelecimento", $this->model->getEstabelecimento());
    }

    public function form($action, $id)
    {
        $this->validaNivelAcesso();

        $dados = [
            'data' => $this->model->recuperarPorId($id),                            // Busca Estabelecimento
            'aUsuario' => $this->usuarioModel->getUsuarioEmpresa(),                // Busca UFs a serem exibidas na combobox
            'aCidade' => $this->cidadeModel->lista('id'),                // Busca UFs a serem exibidas na combobox
        ];

        return $this->loadView("estabelecimento/formEstabelecimento", $dados);
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/insert/0");
        } else {
            $post['usuario_id'] = empty($post['usuario_id']) ? null : $post['usuario_id'];
            $post['cidade_id']     = empty($post['cidade_id']) ? null : $post['cidade_id'];

            if ($this->model->insert($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro inserido com sucesso."]);
            } else {
                Session::set('msgError', 'Erro ao inserir registro.');
                return Redirect::page($this->controller . "/form/insert/0");
            }
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

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/update/" . $post['id']);
        } else {
            $post['usuario_id'] = empty($post['usuario_id']) ? null : $post['usuario_id'];

            if ($this->model->update($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro alterado com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form/update/" . $post['id']);
            }
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

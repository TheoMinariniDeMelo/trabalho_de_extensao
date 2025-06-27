<?php

namespace App\Controller;

use App\Model\EstabelecimentoModel;
use App\Model\UfModel;
use App\Model\UsuarioModel;
use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Validator;

class Telefone extends ControllerMain
{
    protected $usuarioModel;
    protected $estabelecimentoModel;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->validaNivelAcesso();

        $this->estabelecimentoModel = new EstabelecimentoModel();
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("telefone/listaTelefone", $this->model->listaTelefone());
    }

    public function form($action, $id)
    {
        $UfModel = new UfModel();

        $dados = [
            'data' => $this->model->recuperarPorId($id),               // Busca dTelfone
            'aEstabelecimento' => $this->estabelecimentoModel->lista('id'),               // Busca dTelfone
            'aUsuario' => $this->usuarioModel->getUsuarioEmpresa(),               // Busca dTelfone
            // 'aUf' => $UfModel->lista("sigla")                   // Busca UFs a serem exibidas na combobox
        ];

        return $this->loadView("telefone/formTelefone", $dados);
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
            $post['estabelecimento_id'] = empty($post['estabelecimento_id']) ? null : $post['estabelecimento_id'];

            if ($this->model->insert($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro inserido com sucesso."]);
            } else {
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
            $post['estabelecimento_id'] = empty($post['estabelecimento_id']) ? null : $post['estabelecimento_id'];

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

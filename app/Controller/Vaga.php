<?php

namespace App\Controller;

use App\Model\CargoModel;
use App\Model\CurriculumModel;
use App\Model\EstabelecimentoModel;
use App\Model\UfModel;
use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Database;
use Core\Library\Session;

class Vaga extends ControllerMain
{

    protected $estabelecimentoModel;
    protected $cargoModel;
    protected $curriculumModel;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');

        $this->cargoModel = new CargoModel();
        $this->estabelecimentoModel = new EstabelecimentoModel();
        $this->curriculumModel = new CurriculumModel();
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

        $dados = [
            'data' => $this->model->getById($id),
            'aCargo' => $this->cargoModel->lista('id'),
            'aEstabelecimento' => $this->estabelecimentoModel->lista('id'),             // Busca Vaga
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

    public function visualizarVaga($id)
    {

        $dados = [
            'data' => $this->model->infoVaga($id),
        ];


        return $this->loadView("vaga/visualizarVaga", $dados);
    }

    public function candidatar($vagaId)
    {
        if (verificaSeUsuarioEstaLogado()) {

            $curriculumId = $this->curriculumModel->verificaCurriculumUsuario(Session::get('userId'));

            if (!$curriculumId) {
                // Redireciona o usuário para cadastrar currículo primeiro
                return Redirect::page('curriculum/cadastrar');
            }

            $jaSeCandidatou = $this->model->verificaCandidatura($curriculumId[0]['id'], $vagaId);

            if ($jaSeCandidatou) {
                Session::set('msgError', 'Já candidatado na vaga!');
                return Redirect::page('vaga/visualizarVaga/' . $vagaId);
            } else {
                // Faz o insert na tabela curriculum_vaga
                $cadidataCidadao = $this->model->candidatarVaga($curriculumId[0]['id'], $vagaId);

                if ($cadidataCidadao) {
                    Session::set('msgSucesso', 'Candidatura realizada com sucesso!');
                    return Redirect::page('vaga/visualizarVaga/' . $vagaId);
                }
                Session::set('msgError', 'Erro ao efetuar candidatura!');
                return Redirect::page('vaga/visualizarVaga/' . $vagaId);
            }
        }

        Session::set('urlDestino', 'vaga/visualizarVaga/' . $vagaId);

        Redirect::page('/login', ["msgError" => "É necessário efetuar o login para candidatar-se!"]);
    }

    public function minhaCandidatura()
    {
        // if (!verificaSeUsuarioEstaLogado()) {
        //     Session::set('url_redirecionamento', 'candidaturas/minhasCandidaturas');
        //     return Redirect::page('auth/login');
        // }

        $usuarioId = Session::get('userId');
        $candidaturas = $this->model->listaCandidaturaUsuario($usuarioId);

        return $this->loadView('vaga/minhaCandidatura', [
            'candidaturas' => $candidaturas
        ]);
    }
}

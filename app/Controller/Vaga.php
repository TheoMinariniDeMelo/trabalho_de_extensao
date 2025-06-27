<?php

namespace App\Controller;

use App\Model\CargoModel;
use App\Model\CidadeModel;
use App\Model\CurriculumModel;
use App\Model\EscolaridadeModel;
use App\Model\EstabelecimentoModel;
use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Email;
use Core\Library\Session;
use Core\Library\Validator;

class Vaga extends ControllerMain
{

    protected $estabelecimentoModel;
    protected $cargoModel;
    protected $curriculumModel;
    protected $cidadeModel;
    protected $escolaridadeModel;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');

        $this->cargoModel = new CargoModel();
        $this->estabelecimentoModel = new EstabelecimentoModel();
        $this->curriculumModel = new CurriculumModel();
        $this->cidadeModel = new CidadeModel();
        $this->escolaridadeModel = new EscolaridadeModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->validaNivelAcesso();
        return $this->loadView("vaga/listaVaga", $this->model->listaVagas());
    }

    public function listarVagas()
    {

        $dados = [
            'aCargo' => $this->cargoModel->lista('id'),
            'aEstabelecimento' => $this->estabelecimentoModel->lista('id'),             // Busca Vaga
        ];

        return $this->loadView("vaga/listarVagas", $dados);
    }

    public function form($action, $id)
    {
        $this->validaNivelAcesso();
        $dados = [
            'data' => $this->model->recuperarPorId($id),
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

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/insert/0");
        } else {
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

    public function ajaxFiltrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
            exit;
        }

        $filtros = [];

        if (!empty($_POST['busca'])) {
            $filtros['busca'] = $_POST['busca'];
        }
        if (!empty($_POST['cargo_id']) && is_numeric($_POST['cargo_id'])) {
            $filtros['cargo_id'] = $_POST['cargo_id'];
        }
        if (!empty($_POST['estabelecimento_id']) && is_numeric($_POST['estabelecimento_id'])) {
            $filtros['estabelecimento_id'] = $_POST['estabelecimento_id'];
        }
        if (isset($_POST['ofertaPublica']) && ($_POST['ofertaPublica'] === '1' || $_POST['ofertaPublica'] === '0')) {
            $filtros['ofertaPublica'] = $_POST['ofertaPublica'] ? 1 : 0;
        }

        $vagas = $this->model->filtrar($filtros);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($vagas);
        exit;
    }


    public function visualizarVaga($id)
    {
        Session::destroy('urlDestino');

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
                Session::set('msgError', 'É necessário cadastrar um curriculum!');
                return Redirect::page('curriculum/meuCurriculo');
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

    public function visualizarcandidatoVaga($vaga_id)
    {
        $this->validaNivelAcesso();
        // if (!verificaSeUsuarioEstaLogado()) {
        //     Session::set('url_redirecionamento', 'candidaturas/minhasCandidaturas');
        //     return Redirect::page('auth/login');
        // }

        // var_dump($vaga_id);
        // exit;

        $dados['candidatos'] = $this->model->visualizarcandidatoVaga($vaga_id);
        $dados['escolaridades'] = $this->escolaridadeModel->lista('id');
        $dados['cargos'] = $this->cargoModel->lista('id');
        $dados['cidades'] = $this->cidadeModel->lista('id');

        // var_dump($vaga_id);
        // exit;

        return $this->loadView('vaga/listaCandidatoVaga', $dados);
    }

    public function formAtualizarCandidatura($vaga_id, $usuarioId)
    {
        $this->validaNivelAcesso();
        $dados['candidatura'] = $this->model->recuperaInfoCandidatura($vaga_id, $usuarioId);

        return $this->loadView('vaga/atualizarCandidatura', $dados);
    }

    public function atualizarCandidatura()
    {
        $this->validaNivelAcesso();
        $post = $this->request->getPost();

        $vaga_id = $post['vaga_id'];
        $usuarioId = $post['usuario_id'];
        $curriculumId = $post['curriculum_id'];

        if ($post) {
            $sucesso = $this->model->updateCandidatura($vaga_id, $curriculumId, $post);

            if ($sucesso) {
                Session::set('msgSucesso', 'Candidatura atualizada com sucesso!');
            } else {
                Session::set('msgError', 'Erro: é necessário alterar os dados!');
            }

            return Redirect::page('Vaga/formAtualizarCandidatura/' . $vaga_id . '/' . $usuarioId);
        }
    }

    public function convidarEntrevista($vaga_id, $usuarioId)
    {
        $this->validaNivelAcesso();
        $dados['candidatura'] = $this->model->recuperaInfoCandidatura($vaga_id, $usuarioId);

        return $this->loadView("vaga/formConviteEntrevista", $dados);
    }

    public function enviarConviteEntrevista()
    {
        $this->validaNivelAcesso();
        $this->loadHelper("emailHelper");
        $post       = $this->request->getPost();

        $vaga_id = $post['vaga_id'];
        $usuario_id = $post['usuario_id'];

        $assunto    = $post['assunto'];
        $corpo    = $post['mensagem'];
        $destinatario    = $post['email'];

        $estabelecimento_nome = $this->model->recuperaNomeEstabelecimentoParaEnvioEmail();

        $lRetMail = Email::enviaEmail(
            $_ENV['MAIL.USER'],                             /* Email do Remetente*/
            $estabelecimento_nome['estabelecimento_nome'],  /* Nome do Remetente */
            $assunto,                                       /* Assunto do e-mail */
            $corpo,                                         /* Corpo do E-mail */
            $destinatario                                   /* Destinatário do E-mail */
        );

        if ($lRetMail) {

            Session::set('msgSucesso', 'Convite enviado com sucesso!');
            return Redirect::page('Vaga/convidarEntrevista/' . $vaga_id . '/' . $usuario_id);
        } else {
            return Redirect::page("login/esqueciASenha", ["inputs" => $post]);
        }
    }

    public function removerCandidatura($curriculumVagaId)
    {
        $curriculumVagaRemovido = $this->model->removerCurriculumVaga($curriculumVagaId);

        if ($curriculumVagaRemovido) {
            Session::set('msgSucesso', 'Candidatura Removida com sucesso!');
            return Redirect::page('Vaga/minhaCandidatura');
        } else {
            Session::set('msgError', 'Erro ao remover candidatura!');
            return Redirect::page('Vaga/minhaCandidatura');
        }
    }

    public function filtrarCandidatoAvancado()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
            exit;
        }

        $filtros = [
            'cargo_id'         => $_POST['cargo_id'] ?? null,
            'escolaridade_id'  => $_POST['escolaridade_id'] ?? null,
            'tempo_experiencia' => $_POST['tempo_experiencia'] ?? null,
            // 'modalidade'       => $_POST['modalidade'] ?? null,
            // 'vinculo'          => $_POST['vinculo'] ?? null,
            'cidade_id'        => $_POST['cidade_id'] ?? null,
        ];

        $candidatos = $this->model->filtrarCandidato($filtros);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($candidatos);
        exit;
    }
}

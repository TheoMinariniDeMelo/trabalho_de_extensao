<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

use App\Model\CargoModel;
use App\Model\CidadeModel;
use App\Model\EscolaridadeModel;

class Curriculum extends ControllerMain
{
    protected $files;
    protected $cidadeModel;
    protected $escolaridadeModel;
    protected $cargoModel;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper'); // helper com formTitulo, etc.
        $this->files = new Files();
        $this->cidadeModel = new CidadeModel();
        $this->escolaridadeModel = new EscolaridadeModel();
        $this->cargoModel = new CargoModel();
        $this->loadModel('CurriculumModel');
    }

    public function index()
    {
        $this->validaNivelAcesso();
        $curriculos = $this->model->listaComResumo();

        return $this->loadView('curriculum/listaCurriculum', [
            'lista' => $curriculos
        ]);
    }

    public function form($action, $id = null)
    {
        // $this->validaNivelAcesso();

        $dados = [
            'data' => $this->model->buscarCurriculumCompletoPorUsuario($id),
            'aCidade' => $this->cidadeModel->listaCidade(),
            'aEscolaridade' => $this->escolaridadeModel->lista(),
            'aCargo' => $this->cargoModel->lista(),
        ];

        return $this->loadView('curriculum/formCurriculum', $dados);
    }

    public function insert()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/insert/0");
        } else {
            // Upload da foto
            if (!empty($_FILES['foto']['name'])) {
                $upload = $this->files->upload($_FILES, 'curriculum');
                if (!is_bool($upload)) {
                    $post['foto'] = $upload[0];
                } else {
                    Session::set('inputs', $post);
                    return Redirect::page($this->controller . '/form', ['msgError' => 'Erro no upload da imagem']);
                }
            }

                // // Validação
                // $validador = Validator::make($post, $this->model->validationRules);
                // if ($validador) {
                //     Session::set('inputs', $post);
                //     Session::set('erros', $validador); // array de erros
                //     return Redirect::page($this->controller . '/form');
                // }
            ;


            // Inserção
            try {

                $retorno = $this->model->cadastrarCurriculumCompleto($post);

                if (is_array($retorno) && $retorno['erro']) {
                    Session::set('msgError', $retorno['mensagem']);
                    return Redirect::page($this->controller . "/form/insert/0");
                } else {
                    if (Session::get('userNivel') > 20) {
                        Session::set('msgSucesso', 'Currículo cadastrado com sucesso!');
                        return Redirect::page("vaga/listarVagas");
                    }
                    Session::set('msgSucesso', 'Currículo cadastrado com sucesso!');
                    return Redirect::page("curriculum");
                }
            } catch (\Exception $e) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller . '/form', ['msgError' => 'Erro ao salvar currículo.']);
            }
        }
    }

    public function update()
    {
        $post = $this->request->getPost();
        // var_dump($post['foto'], $post['nomeImagem']);
        // exit;
        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/update/" . $post['id']);
        } else {
            $fotoNomeImagem = !empty($post['foto']) ? $post['foto'] : $post['nomeImagem'];

            $post['foto'] = $fotoNomeImagem;

            // Upload da foto
            if (!empty($_FILES['foto']['name'])) {
                $upload = $this->files->upload($_FILES, 'curriculum');
                if (!is_bool($upload)) {
                    $post['foto'] = $upload[0];
                } else {
                    Session::set('inputs', $post);
                    return Redirect::page($this->controller . "/form/update/" . $post['id'], ['msgError' => 'Erro no upload da imagem']);
                }
            }


            // Validação (se quiser reativar)
            // $validador = Validator::make($post, $this->model->validationRules);
            // if ($validador) {
            //     Session::set('inputs', $post);
            //     Session::set('erros', $validador);
            //     return Redirect::page($this->controller . "/form/$id");
            // }

            // var_dump($post);
            // exit;

            try {

                $retorno = $this->model->cadastrarCurriculumCompleto($post);

                if (is_array($retorno) && $retorno['erro']) {
                    Session::set('msgError', $retorno['mensagem']);
                    return Redirect::page($this->controller . "/form/update/" . $post['id']);
                } else {
                    Session::set('msgSucesso', 'Currículo atualizado com sucesso!');
                    if (Session::get('userNivel') > 20) {
                        return Redirect::page("vaga/listarVagas");
                    }
                    return Redirect::page("curriculum");
                }
            } catch (\Exception $e) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller . "/form/update/" . $post['id'], ['msgError' => 'Erro ao atualizar currículo.']);
            }
        }
    }

    public function delete()
    {

        $post = $this->request->getPost();

        $currilumId = $post['id'];
        $pessoaFisicaId = $post['pessoa_fisica_id'];

        $retorno = $this->model->deleteCurriculum($currilumId, $pessoaFisicaId);

        if (is_array($retorno) && $retorno['erro']) {
            Session::set('msgError', $retorno['mensagem']);
            return Redirect::page($this->controller . "/form/delete/" . $post['id']);
        } else {
            Session::set('msgSucesso', 'Currículo deletado com sucesso!');
            if (Session::get('userNivel') > 20) {
                return Redirect::page("vaga/listarVagas");
            }
            return Redirect::page("curriculum");
        }
    }


    public function meuCurriculo()
    {

        $curriculo = $this->model->buscarCurriculumCompletoPorUsuario(Session::get('userId'));

        // var_dump(Session::get('userId'));
        // exit;
        $dados = [
            'data' => $curriculo,
            'aCidade' => $this->cidadeModel->listaCidade(),
            'aEscolaridade' => $this->escolaridadeModel->lista(),
            'aCargo' => $this->cargoModel->lista(),
        ];


        if ($curriculo) {
            return Redirect::page($this->controller . "/form/update/" . $curriculo[0]['id'], $dados);
        }
        return Redirect::page($this->controller . "/form/insert/0", $dados);
    }
}

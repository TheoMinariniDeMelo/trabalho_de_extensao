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
        $curriculos = $this->model->listaComResumo();

        return $this->loadView('curriculum/listaCurriculum', [
            'dados' => [
                'lista' => $curriculos
            ]
        ]);
    }

    public function form($id = null)
    {
        return $this->loadView('curriculum/formCurriculum', [
            'aCidade' => $this->cidadeModel->listaCidade(),
            'aEscolaridade' => $this->escolaridadeModel->lista(),
            'aCargo' => $this->cargoModel->lista(),
        ]);
    }

    public function insert()
    {
        $post = $this->request->getPost();

        // var_dump($post);
        // exit;

     

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

        //         var_dump($post);
        // exit('opa');

        // Inserção
        try {
            $curriculumId = $this->model->insertCurriculum($post);

            // var_dump($curriculumId);
            // exit;
            

            // Escolaridade
            if (!empty($post['escolaridade'])) {
                foreach ($post['escolaridade'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    $this->model->insertEscolaridade($item);
                }
            }

            // Experiência
            if (!empty($post['experiencia'])) {
                foreach ($post['experiencia'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    $this->model->insertExperiencia($item);
                }
            }

            // Qualificação
            if (!empty($post['qualificacao'])) {
                foreach ($post['qualificacao'] as $item) {
                    $item['curriculum_id'] = $curriculumId;
                    $this->model->insertQualificacao($item);
                }
            }

            return Redirect::page($this->controller, ['msgSucesso' => 'Currículo cadastrado com sucesso!']);

        } catch (\Exception $e) {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . '/form', ['msgError' => 'Erro ao salvar currículo.']);
        }
    }
}
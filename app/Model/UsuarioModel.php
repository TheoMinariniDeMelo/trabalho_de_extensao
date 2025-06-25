<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Redirect;
use Core\Library\Session;

class UsuarioModel extends ModelMain
{
    protected $table = "usuario";

    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:60'
        ],
        "email"  => [
            "label" => 'Email',
            "rules" => 'required|min:5|max:150'
        ],
        "nivel"  => [
            "label" => 'Nível',
            "rules" => 'required|int'
        ],
        "statusRegistro"  => [
            "label" => 'Status',
            "rules" => 'required|int'
        ],
    ];

    /**
     * getUserEmail
     *
     * @param string $email 
     * @return array
     */
    public function getUserEmail($email)
    {
        return $this->db->where("email", $email)->first();
    }

    /**
     * criaSuperUser
     *
     * @return void
     */
    public function criaSuperUser()
    {

        $qtd = $this->db->countAll($this->table);

        if ($qtd == 0) {

            // criando o super usuário
            $rsUsuario = $this->insert(
                [
                    "nome" => "administrador",
                    "email" => "administrador@gmail.com",
                    "senha" => password_hash("admin", PASSWORD_DEFAULT),
                    "nivel" => 1,
                    "statusRegistro" => 1
                ]
            );

            if ($rsUsuario) {
                return Redirect::page("/login", ['msgSucesso' => "Super usuário criado com sucesso!"]);
            } else {
                return false;
            }
        }

        return true;
    }

    public function getUsuarioEmpresa()
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            return $this->db
                ->table('usuario u')
                ->select('u.*, e.nome AS estabelecimento_nome, e.id AS estabelecimento_id')
                ->join('estabelecimento e', 'e.id = u.estabelecimento_id')
                ->where('u.estabelecimento_id', Session::get('userEstabelecimentoId'))
                ->findAll();
        }

        return $this->db->table('usuario u')
            ->select('u.*, e.nome AS estabelecimento_nome, e.id AS estabelecimento_id')
            ->join('estabelecimento e', 'e.id = u.estabelecimento_id', 'left')
            ->findAll();
    }


    public function recuperarPorId($id)
    {
        if (Session::get('userNivel') > 10 && Session::get('userNivel') <= 20) {
            return $this->db
                ->where('estabelecimento_id', Session::get('userEstabelecimentoId'))
                ->where('id', $id)
                ->first();
        }

        return $this->db
            ->where('id', $id)->first();
    }
}

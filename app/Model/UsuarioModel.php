<?php

namespace App\Model;

use Core\Library\ModelMain;
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
        "senha"  => [
            "label" => 'Senha',
            "rules" => 'required|min:4|max:255'
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
            // var_dump($this->validationRules);
            // var_dump($rsUsuario);
            // var_dump($qtd);
            // exit('opa');
            if ($rsUsuario == true) {
                Session::set('msgSuccess', "Super usuário criado com sucesso.");
                return true;
            } else {
                Session::set('msgError', "Falha na inclusão do super usuário, não é possivel prosseguir.");
                return false;
            }
        }

        return true;
    }
}

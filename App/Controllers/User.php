<?php

namespace App\Controllers;

use \OC\Controller\Action;
use \OC\Di\Container;
use \OC\Error\Messages;

//Cuida do user
class User extends Action {

    public function read() {

        $add = Container::getClass('user');
        $url = Container::getClass('url');

        $this->view->url = $url->getUrl();
        $this->view->id = $url->getId();
        
        $this->view->read = $add->read();
        $this->session('read', 'admin');
    }
    
    public function form() {

        $classUser = Container::getClass('user');
        $url = Container::getClass('url');

        $this->view->url = $url->getUrl();
        $this->view->id = $url->getId();
                
        $where = ['id' => $url->getId()];
        $this->view->up = $classUser->find($where);

        $this->session('form', 'admin');
    }    

    public function insert() {

        //Instancia class de mensagem
        $msg = new Messages();

        //instancia a class user do model que trabalha com o banco
        $add = Container::getClass('user');
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        //recupera as dados do form para enviar para a model e colocar no banco
        switch ($action) {
            case 'usersadd':
                $nome = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
                $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
                $senha = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
                $dataCad = filter_input(INPUT_POST, 'dateCad', FILTER_SANITIZE_STRING);

                $dados = [
                    'adm_name' => $nome,
                    'adm_mail' => $email,
                    'adm_login' => $login,
                    'adm_pass' => md5(strrev($senha)),
                    'adm_dateCad' => $dataCad
                ];

                $existe = [
                    'adm_mail' => $email,
                    'adm_login' => $login,
                ];

                //Verifica se foi gravado no banco
                if (isset($action) && $action == 'usersadd') {
                    if ($add->existe($existe, 'OR') === true) {
                        $msg->add('i', 'Login e/ou E-mail já existe!', '/admin/user');
                    } else {
                        if ($add->addUsers($dados) === true) {
                            $msg->add('s', 'Usuário cadastrado com sucesso!', '/admin/user');
                        } else {
                            $msg->add('d', 'Ops.. Algum erro interno impediu o delete do usuário!', '/admin/user');
                        }
                    }
                }
                break;
            default:
                break;
        }
    }

    public function delete() {

        $msg = new Messages();
        $url = Container::getClass('url');
        $add = Container::getClass('user');
        $id = $url->getId();

        if ($add->delete($id) == true) {
            $msg->add('s', 'Usuário deletado com sucesso!', '/admin/user');
        } else {
            $msg->add('d', 'Ops.. Algum erro ocorreu, Usuário não foi excluido!', '/admin/user');
        }
    }

    public function edit() {
        $msg = new Messages();
        $up = Container::getClass('user');
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'edit':
                $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                $nome = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
                $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);

                $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
                $passDb = filter_input(INPUT_POST, 'passDb', FILTER_SANITIZE_STRING);

                (empty($pass)) ? $senha = $passDb : $senha = \md5(\strrev($pass));

                $dataCad = filter_input(INPUT_POST, 'dateCad', FILTER_SANITIZE_STRING);

                $dados = [
                    'id' => $id,
                    'adm_name' => $nome,
                    'adm_mail' => $email,
                    'adm_login' => $login,
                    'adm_pass' => $senha,
                    'adm_dateCad' => $dataCad
                ];
                
                //Verifica se foi gravado no banco
                if (isset($action) && $action == 'edit') {
                    if ($up->update($dados, 'id', $id) === true) {
                        $msg->add('s', 'Usuário editado com sucesso!', '/admin/user');
                    } else {
                        $msg->add('d', 'Ops.. Algum erro interno impediu o usuário de ser editado!', '/admin/user/'.$id);
                    }
                }

                break;

            default:
                break;
        }
    }

}

<?php

namespace App\Controllers;

use OC\Controller\Action;
use \OC\Di\Container;
use \OC\Error\Messages;

//Class para login
class Login extends Action {
    
    //efetua Login
    public function login() {
        
        //Instancia class de mensagem
        $msg = new Messages();        
        
        $classLogin = Container::getClass('Login');

        $action = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

        if (isset($action) && $action == 'logar') {
            if (empty($login) && empty($pass)) {
                $msg->add('w', 'Login e Senha estão em branco!');
            } elseif (empty($login)) {
                $msg->add('w', 'Login está em branco!');
            } elseif (empty($pass)) {
                $msg->add('w', 'Não é permitido Senha em branco!');
            } else {
                if ($classLogin->logar($login, md5(strrev($pass))) == true) {
                    $users = $_SESSION['user'];
                    header('Location: /admin/');
                } else {
                    $msg->add('d', 'Login e/ou Senha incorretos!');
                }
            }
        }
        $this->render('login', 'admin' ,$layout = false);
    }

    //Faz logout
    public function logout() {
        if (isset($_SESSION['user'])) {
            session_destroy();
            header('Location: /admin/login');
        }
    }
}

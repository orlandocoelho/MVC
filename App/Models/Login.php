<?php

namespace App\Models;
use OC\Db\servicesDB;

class Login extends servicesDB {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "adm_users";
    }
    
    public function logar($login, $pass)
    {
        if(!empty($login) && !empty($pass)){
            $where = ['adm_login' => $login, 'adm_pass' => $pass];
            $logado = ['adm_login' => $login];
            if(isset($where) &&  $this->find($where, 'and') == true){
                $_SESSION['user'] = $this->find($logado);
                return true;
            }else{
                return false;
            }
        }
    }
}

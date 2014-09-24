<?php

namespace App\Models;

use OC\Db\servicesDB;

class User extends servicesDB {

    public function __construct() {
        parent::__construct();
        $this->tabela = "adm_users";
    }

    public function addUsers($array = array()) {
        if (isset($array) && !empty($array)) {
            if (parent::insert($array) === true) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function delete($id) {
        if (parent::delete($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($array = array(), $campoDb, $val) {
        if (parent::update($array, $campoDb, $val)) {
            return true;
        } else {
            return false;
        }
    }

    public function existe($existe = array(), $cond = NULL) {
        if (parent::find($existe, $cond, $fetch = FALSE) === true) {
            return true;
        }  else {
            return false;
        }
    }

}

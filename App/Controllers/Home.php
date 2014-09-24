<?php

/**
 * Description of Index
 *
 * @author Orlando
 */

namespace App\Controllers;

use OC\Controller\Action;

class Home extends Action {

    public function home() {
        $this->session('home', 'admin');
    }
}

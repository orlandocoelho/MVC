<?php

namespace App\Models;
use OC\Db\servicesDB;
use \OC\Di\Container;
class Menu extends servicesDB
{
    
    public function __construct($tb) {
        parent::__construct();
             
        $this->tabela = $tb;
    }
    
}

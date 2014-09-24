<?php

namespace App\Models;
use OC\Db\servicesDB;
use \OC\Di\Container;
class Article extends servicesDB
{
    public function __construct($tb) {
        parent::__construct();
         
        $this->tabela = $tb;
    }
}

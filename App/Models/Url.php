<?php

namespace App\Models;

class Url
{

    public function getUrl()
    {
        return \parse_url($_SERVER['REQUEST_URI'], \PHP_URL_PATH);
    }
    
    public function getId()
    {
        $url = $this->getUrl();
        $id = preg_replace("/[^0-9]/","", $url);
        return $id;
    }
    
    public function getServer($local = "/")
    {
        $site = $_SERVER['SERVER_NAME'];
        echo 'http://'.$site.':8080'.$local;
    }
}

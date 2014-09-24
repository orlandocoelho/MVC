<?php
/**
 * Description of Bootstrap
 *
 * @author Orlando
 */

namespace OC\Init;

abstract class Bootstrap
{
    private $routes;
    
    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();
    
    protected function run($url)
    {
        array_walk($this->routes, function($route) use ($url){
            if($url == $route['route']){
               $class = "App\\Controllers\\".ucfirst($route['controller']);
               $controller = new $class;
               $controller->$route['action']();
            }
        });
    }
    
    protected function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }
    
    protected function getUrl()
    {   
        return \parse_url($_SERVER['REQUEST_URI'], \PHP_URL_PATH);
    }
    
    public function getId()
    {
        $url = $this->getUrl();
        $id = preg_replace("/[^0-9]/","", $url);
        return $id;
    }
    
}

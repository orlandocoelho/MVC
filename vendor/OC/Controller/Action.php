<?php
/**
 * Description of Action
 *
 * @author admin
 */

namespace OC\Controller;

class Action
{
    protected $view;
    protected $action;
    
    public function __construct() {
        $this->view = new \stdClass();
    }
    
    protected function getUrl()
    {   
        return \parse_url($_SERVER['REQUEST_URI'], \PHP_URL_PATH);
    }
    
    public function render($action, $template, $layout = true)
    {
        $this->action = $action;
        if($layout === true && \file_exists("../../App/views/{$template}/html.phtml")){
            $users = $_SESSION['user'];
            include_once "../../App/views/{$template}/html.phtml";
        }else{
            $this->content($template);
        }
    }
    
    public function content($template)
    {
        $atual = get_class($this);
        $singleClassName = strtolower(str_replace("App\\Controllers\\", "", $atual));
        include_once "../../App/views/".$template.'/'.$singleClassName.'/'.$this->action.'.phtml';
    }
    
    public function renderSite($action, $template, $layout = true)
    {
        $this->action = $action;
        if($layout === true && \file_exists("../App/views/{$template}/html.phtml")){
            include_once "../App/views/{$template}/html.phtml";
        }else{
            $this->contentSite($template);
        }
    }
    
    public function contentSite($template)
    {
        $atual = get_class($this);
        $singleClassName = strtolower(str_replace("App\\Controllers\\", "", $atual));
        include_once "../App/views/".$template.'/'.$singleClassName.'/'.$this->action.'.phtml';
    }
    
    public function session($action, $template, $layout = true)
    {
        if(isset($_SESSION['user'])){
            $this->render($action, $template, $layout);
        }else{
            header('Location: /admin/login');
        }
    }
    
}

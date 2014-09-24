<?php

/**
 * Description of Init
 *
 * @author Orlando
 */

namespace App;

use \OC\Init\Bootstrap;

class Init extends Bootstrap
{

    protected function initRoutes()
    {
        
        $arrayId = explode("/", $this->getUrl());
        
        /*
         * ARRAY LINK PARTE DA ADMINISTRAÇÃO
         */
        $ar['home'] = ['route' => '/admin/', 'controller' => 'home', 'action' => 'home'];
        
        $ar['login'] = ['route' => '/admin/login', 'controller' => 'login', 'action' => 'login'];
        $ar['logout'] = ['route' => '/admin/logout', 'controller' => 'login', 'action' => 'logout'];
        
        $ar['userRead'] = ['route' => '/admin/user', 'controller' => 'user', 'action' => 'read'];
        $ar['userForm'] = ['route' => '/admin/user/form', 'controller' => 'user', 'action' => 'form'];
        $ar['userAdd'] = ['route' => '/admin/user/add', 'controller' => 'user', 'action' => 'insert'];
        $ar['userUpdate'] = ['route' => '/admin/user/update/'.$this->getId(), 'controller' => 'user', 'action' => 'form'];
        $ar['userUp'] = ['route' => '/admin/user/up', 'controller' => 'user', 'action' => 'edit'];
        $ar['userDelete'] = ['route' => '/admin/user/delete/'.$this->getId(), 'controller' => 'user', 'action' => 'delete'];
    
        $ar['catMenuRead'] = ['route' => '/admin/menu/category', 'controller' => 'menu', 'action' => 'readCat'];
        $ar['catMenuForm'] = ['route' => '/admin/menu/category/form', 'controller' => 'menu', 'action' => 'formCat'];
        $ar['catMenuaddCat'] = ['route' => '/admin/menu/category/add', 'controller' => 'menu', 'action' => 'addCat'];
        $ar['catMenuDel'] = ['route' => '/admin/menu/category/delete/'.$this->getId(), 'controller' => 'menu', 'action' => 'deleteCat'];
        $ar['publicCatMenu'] = ['route' => '/admin/menu/category/publicCatMenu/'.$this->getId(), 'controller' => 'menu', 'action' => 'publicCatMenu'];
        $ar['despublicCatMenu'] = ['route' => '/admin/menu/category/despublicCatMenu/'.$this->getId(), 'controller' => 'menu', 'action' => 'despublicCatMenu'];  
        $ar['catMenuUpdate'] = ['route' => '/admin/menu/category/update/'.$this->getId(), 'controller' => 'menu', 'action' => 'formCat'];
        $ar['catMenuUp'] = ['route' => '/admin/menu/category/up', 'controller' => 'menu', 'action' => 'updateCat'];
        
        $ar['menuRead'] = ['route' => '/admin/menu/'.$this->getId(), 'controller' => 'menu', 'action' => 'read'];
        $ar['menuForm'] = ['route' => '/admin/menu/form/'.$this->getId(), 'controller' => 'menu', 'action' => 'formMenu'];
        $ar['menuAdd'] = ['route' => '/admin/menu/add', 'controller' => 'menu', 'action' => 'addMenu'];
        $ar['menuDel'] = ['route' => '/admin/menu/'.@$arrayId[3].'/delete/'.@$arrayId[5], 'controller' => 'menu', 'action' => 'delete'];
        $ar['menuUpdate'] = ['route' => '/admin/menu/update/'.$this->getId(), 'controller' => 'menu', 'action' => 'formMenu'];
        $ar['menuUp'] = ['route' => '/admin/menu/up', 'controller' => 'menu', 'action' => 'upMenu'];
        $ar['publicMenu'] = ['route' => '/admin/menu/'.@$arrayId[3].'/publicMenu/'.@$arrayId[5], 'controller' => 'menu', 'action' => 'publicMenu'];
        $ar['despublicMenu'] = ['route' => '/admin/menu/'.@$arrayId[3].'/despublicMenu/'.@$arrayId[5], 'controller' => 'menu', 'action' => 'despublicMenu'];
                        
        $ar['imgRead'] = ['route' => '/admin/conteudo/image', 'controller' => 'image', 'action' => 'read'];
        $ar['imgAdd'] = ['route' => '/admin/conteudo/image/add', 'controller' => 'image', 'action' => 'add'];
        $ar['imgDel'] = ['route' => '/admin/conteudo/image/delete/'.$this->getId(), 'controller' => 'image', 'action' => 'delete'];
        
        $ar['contcat'] = ['route' => '/admin/conteudo/category', 'controller' => 'article', 'action' => 'category'];
        $ar['formcat'] = ['route' => '/admin/conteudo/category/form', 'controller' => 'article', 'action' => 'formCategory'];
        $ar['addcat'] = ['route' => '/admin/conteudo/category/add', 'controller' => 'article', 'action' => 'addCategory']; 
        $ar['upcat'] = ['route' => '/admin/conteudo/category/update/'.$this->getId(), 'controller' => 'article', 'action' => 'formCategory'];
        $ar['formupcat'] = ['route' => '/admin/conteudo/category/up', 'controller' => 'article', 'action' => 'updateCategory'];  
        $ar['delcat'] = ['route' => '/admin/conteudo/category/delete/'.$this->getId(), 'controller' => 'article', 'action' => 'deleteCategory'];  
        //Lista artigos cadastrados em uma categoria apartir da pagina category
        $ar['readArtCat'] = ['route' => '/admin/conteudo/category/'.$this->getId().'/article', 'controller' => 'article', 'action' => 'article'];  
        $ar['formArtCat'] = ['route' => '/admin/conteudo/category/'.$this->getId().'/article/form', 'controller' => 'article', 'action' => 'formArticle'];
        
        $ar['readArt'] = ['route' => '/admin/conteudo/article', 'controller' => 'article', 'action' => 'article'];  
        $ar['formArt'] = ['route' => '/admin/conteudo/article/form', 'controller' => 'article', 'action' => 'formArticle'];  
        $ar['addArt'] = ['route' => '/admin/conteudo/article/add', 'controller' => 'article', 'action' => 'addArticle'];
        $ar['selectImagArt'] = ['route' => '/admin/conteudo/article/selectimg', 'controller' => 'article', 'action' => 'selectimg'];
        $ar['listImagArt'] = ['route' => '/admin/conteudo/article/listimg', 'controller' => 'article', 'action' => 'listimg'];
        $ar['publicArt'] = ['route' => '/admin/conteudo/article/publicArt/'.$this->getId(), 'controller' => 'article', 'action' => 'publicArt'];
        $ar['despublicArt'] = ['route' => '/admin/conteudo/article/despublicArt/'.$this->getId(), 'controller' => 'article', 'action' => 'despublicArt'];
        $ar['delArt'] = ['route' => '/admin/conteudo/article/delete/'.$this->getId(), 'controller' => 'article', 'action' => 'delArt'];
        $ar['upArt'] = ['route' => '/admin/conteudo/article/update/'.$this->getId(), 'controller' => 'article', 'action' => 'formArticle'];
        $ar['formupArt'] = ['route' => '/admin/conteudo/article/up', 'controller' => 'article', 'action' => 'upArt'];  
        $ar['veImageArt'] = ['route' => '/admin/conteudo/article/veImage', 'controller' => 'article', 'action' => 'veImage'];
        $ar['veTextArt'] = ['route' => '/admin/conteudo/article/veText', 'controller' => 'article', 'action' => 'veText'];
                
        /*
         * ARRAY LINK PARTE DO SITE
         */
        
        $ar['inicio'] = ['route' => '/', 'controller' => 'inicio', 'action' => 'home']; //Pagina inicial do site (HOME)
        
        $this->setRoutes($ar);
    }

    public static function getDb()
    {
        try {
            $db = new \PDO("mysql:host=localhost;dbname=admin", "root", "root");
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}

<?php

namespace App\Controllers;

use OC\Controller\Action;
use \OC\Di\Container;
use \OC\Error\Messages;

class Article extends Action {

    public function category() {
        $classCat = new \App\Models\Article('adm_categoryArticle');
        $url = Container::getClass('url');

        $this->view->url = $url->getUrl();
        $this->view->id = $url->getId();

        $this->view->readCategory = $classCat->read();
        $this->session('readCategory', 'admin');
    }

    public function formCategory() {
        $classCat = new \App\Models\Article('adm_categoryArticle');
        $url = Container::getClass('url');

        $this->view->id = $url->getId();
        $this->view->url = $url->getUrl();

        $where = ['id' => $url->getId()];
        $this->view->findCategory = $classCat->find($where);

        $this->session('formCategory', 'admin');
    }

    public function addCategory() {
        $url = Container::getClass('url');

        $this->view->id = $url->getId();
        $this->view->url = $url->getUrl();

        $classCat = new \App\Models\Article('adm_categoryArticle');

        $msg = new Messages();
        $name = filter_input(INPUT_POST, 'nameCat', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'descCat', FILTER_SANITIZE_STRING);
        $menuCat = filter_input(INPUT_POST, 'menuCat', FILTER_SANITIZE_STRING);
        $publicCat = filter_input(INPUT_POST, 'publicCat', FILTER_SANITIZE_NUMBER_INT);

        $array = [
            'adm_name' => $name,
            'adm_description' => $description,
            'adm_public' => $publicCat,
            'adm_menu' => $menuCat
        ];

        if ($classCat->insert($array) === true) {
            $msg->add('s', 'Categoria criada com sucesso!', '/admin/conteudo/category');
        } else {
            $msg->add('d', 'Ops.. Alguem erro impediu o cadastro!', '/admin/conteudo/category');
        }
    }

    public function updateCategory() {
        $classCat = new \App\Models\Article('adm_categoryArticle');

        $msg = new Messages();

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, 'nameCat', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'descCat', FILTER_SANITIZE_STRING);
        $menuCat = filter_input(INPUT_POST, 'menuCat', FILTER_SANITIZE_STRING);
        $publicCat = filter_input(INPUT_POST, 'publicCat', FILTER_SANITIZE_NUMBER_INT);



        switch ($action) {
            case 'up':
                $array = [
                    'adm_name' => $name,
                    'adm_description' => $description,
                    'adm_public' => $publicCat,
                    'adm_menu' => $menuCat
                ];
                if ($classCat->update($array, 'id', $id) === true) {
                    $msg->add('s', 'Categoria alterado com sucesso!', '/admin/conteudo/category');
                } else {
                    $msg->add('d', 'Opss.. Algum erro ocorreu não foi possivel efetuar a alteração!', '/admin/conteudo/category/' . $id);
                }

                break;

            default:
                break;
        }
    }

    public function deleteCategory() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $classCat = new \App\Models\Article('adm_categoryArticle');
        $id = $url->getId();

        if ($classCat->delete($id) == true) {
            $msg->add('s', 'Categoria deletado com sucesso!', '/admin/conteudo/category');
        } else {
            $msg->add('d', 'Ops.. Algum erro ocorreu, Item não foi excluido!', '/admin/conteudo/category');
        }
    }

    /*
     * 
     * ARTIGOS
     * TODA LOGICA DE ARTIGOS
     * 
     */

    public function article() {
        $classArt = new \App\Models\Article('adm_article');
        $url = Container::getClass('url');

        $this->view->url = $url->getUrl();
        $this->view->id = $url->getId();
        $this->view->readArticle = $classArt->read();

        //Pego o nome da categoria para colocar no header       
        $classCat = new \App\Models\Article('adm_categoryArticle');

        $where = ['id' => $url->getId()];
        $this->view->findCategory = $classCat->find($where);

        $this->view->readCategory = $classCat->read();
        $this->session('readArticle', 'admin');
    }

    public function formArticle() {
        $classCat = new \App\Models\Article('adm_categoryArticle');
        $classArt = new \App\Models\Article('adm_article');
        $classImg = new \App\Models\Article('adm_image');
        $url = Container::getClass('url');

        $this->view->id = $url->getId();
        $this->view->url = $url->getUrl();

        $where = ['id' => $url->getId()];
        $this->view->findArt = $classArt->find($where);
        $this->view->readCat = $classCat->read();
        $this->view->readImage = $classImg->read();

        $this->session('formArticle', 'admin');
    }

    public function selectimg() {
        $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
        @$nameImg = $_POST['nameImg'];

        switch ($acao) {
            case 'selectimg':

                @$cont = count($nameImg);
                echo "<span class='badge'>{$cont}</span> Imagens Selecionadas";
                if (@$nameImg != NULL){
                    foreach ($nameImg as $v) {
                        echo "<input type='hidden' name='nameImg[]' value='{$v}'/>";
                    }
                }
                break;
            default:
                break;
        }
    }

    public function addArticle() {
        $msg = new Messages();

        $classArt = new \App\Models\Article('adm_article');
        $nameArt = filter_input(INPUT_POST, 'nameArt', FILTER_SANITIZE_STRING);
        $positionArt = filter_input(INPUT_POST, 'positionArt', FILTER_SANITIZE_STRING);
        $publicArt = filter_input(INPUT_POST, 'publicArt', FILTER_SANITIZE_STRING);
        $catArt = filter_input(INPUT_POST, 'catArt', FILTER_SANITIZE_STRING);
        $nameImg = $_POST['nameImg'];
        $titleArt = filter_input(INPUT_POST, 'titleArt', FILTER_SANITIZE_STRING);
        $textArt = filter_input(INPUT_POST, 'textArt');

        $array = [
            'adm_name' => $nameArt,
            'adm_position' => $positionArt,
            'adm_public' => $publicArt,
            'adm_category' => $catArt,
            'adm_images' => implode(', ', $nameImg),
            'adm_title' => $titleArt,
            'adm_text' => $textArt
        ];

        if (empty($array['adm_name'])) {
            $msg->add('w', 'Nome do artigo é obrigatorio!', '/admin/conteudo/article/form');
        } elseif (empty($array['adm_position'])) {
            $msg->add('w', 'De uma posição para o artigo!', '/admin/conteudo/article/form');
        } elseif ($classArt->insert($array) === true) {
            $msg->add('s', 'Artigo criado com sucesso!', '/admin/conteudo/article');
        } else {
            $msg->add('d', 'Ops.. Alguem erro impediu o cadastro!', '/admin/conteudo/article/form');
        }
    }

    public function publicArt() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $id = $url->getId();

        $classart = new \App\Models\Article('adm_article');
        $array = [
            'adm_public' => '1',
        ];

        if ($classart->update($array, 'id', $id)) {
            $msg->add('s', 'Artigo publicado com sucesso.', '/admin/conteudo/article');
        } else {
            $msg->add('d', 'Ops.. ALgum erro interno ocorreu.', '/admin/conteudo/article');
        }
    }

    public function despublicArt() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $id = $url->getId();

        $classart = new \App\Models\Article('adm_article');
        $array = [
            'adm_public' => '0',
        ];

        if ($classart->update($array, 'id', $id)) {
            $msg->add('s', 'Artigo despublicado com sucesso.', '/admin/conteudo/article');
        } else {
            $msg->add('d', 'Ops.. ALgum erro interno ocorreu.', '/admin/conteudo/article');
        }
    }

    public function delArt() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $classArt = new \App\Models\Article('adm_article');
        $id = $url->getId();

        if ($classArt->delete($id) == true) {
            $msg->add('s', 'Artigo deletado com sucesso!', '/admin/conteudo/article');
        } else {
            $msg->add('d', 'Ops.. Algum erro ocorreu, Item não foi excluido!', '/admin/conteudo/article');
        }
    }

    public function upArt() {
        $msg = new Messages();

        $classArt = new \App\Models\Article('adm_article');
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nameArt = filter_input(INPUT_POST, 'nameArt', FILTER_SANITIZE_STRING);
        $positionArt = filter_input(INPUT_POST, 'positionArt', FILTER_SANITIZE_STRING);
        $publicArt = filter_input(INPUT_POST, 'publicArt', FILTER_SANITIZE_STRING);
        $catArt = filter_input(INPUT_POST, 'catArt', FILTER_SANITIZE_STRING);
        $nameImg = $_POST['nameImg'];
        $titleArt = filter_input(INPUT_POST, 'titleArt', FILTER_SANITIZE_STRING);
        $textArt = filter_input(INPUT_POST, 'textArt');

        switch ($action) {
            case 'up':
                $array = [
                    'adm_name' => $nameArt,
                    'adm_position' => $positionArt,
                    'adm_public' => $publicArt,
                    'adm_category' => $catArt,
                    'adm_images' => implode(', ', $nameImg),
                    'adm_title' => $titleArt,
                    'adm_text' => $textArt
                ];

                if ($classArt->update($array, 'id', $id) === true) {
                    $msg->add('s', 'Artigo alterado com sucesso!', '/admin/conteudo/article');
                } else {
                    $msg->add('d', 'Opss.. Algum erro ocorreu não foi possivel efetuar a alteração!', '/admin/conteudo/article/' . $id);
                }

                break;

            default:
                break;
        }
    }

    public function veImage() {
        $classArt = new \App\Models\Article('adm_article');

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $array = [
            'id' => $id
        ];

        $this->view->findImg = $classArt->find($array);
        $explod = explode(", ", $this->view->findImg['adm_images']);

        foreach ($explod as $img) {
            echo "<div class='col-lg-2'>";
            echo "<div class='thumbnail thumb-height'>";
            echo "<img src='../thumbnail.php?thumb={$img}' alt='thumb' />";
            echo "</div>";
            echo "</div>";
        }
    }

    public function veText() {
        $classArt = new \App\Models\Article('adm_article');

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $array = [
            'id' => $id
        ];

        $this->view->findText = $classArt->find($array);

        echo "<p>";
        echo $this->view->findText['adm_text'];
        echo "</p>";
    }

}

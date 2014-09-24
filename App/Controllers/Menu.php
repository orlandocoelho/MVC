<?php

namespace App\Controllers;

use \OC\Controller\Action;
use \OC\Di\Container;
use \OC\Error\Messages;

class Menu extends Action {

    public function readCat() {
        $classCatMenu = new \App\Models\Menu('adm_categoryMenu');
        $classMenu = new \App\Models\Menu('adm_menu');

        $url = Container::getClass('url');
        $this->view->id = $url->getId();
        $this->view->url = $url->getUrl();
        $this->view->readMenuCat = $classCatMenu->read();
        $this->view->readMenu = $classMenu->read();

        $this->session('readCat', 'admin');
    }

    public function formCat() {
        $url = Container::getClass('url');

        $where = ['id' => $url->getId()];
        $classCatMenu = new \App\Models\Menu('adm_categoryMenu');
        $this->view->catup = $classCatMenu->find($where);
        $this->view->id = $url->getId();
        $this->view->url = $url->getUrl();
        $this->session('formCat', 'admin');
    }

    public function addCat() {
        $msg = new Messages();

        $classMenuCat = new \App\Models\Menu('adm_categoryMenu');

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
        $posicion = filter_input(INPUT_POST, 'posicion', FILTER_SANITIZE_STRING);
        $public = filter_input(INPUT_POST, 'public', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'add':

                $menuCat = [
                    'adm_name' => $name,
                    'adm_description' => $desc,
                    'adm_posicion' => $posicion,
                    'adm_public' => $public
                ];

                if ($classMenuCat->insert($menuCat) === true) {
                    $msg->add('s', 'Categoria criada com sucesso!', '/admin/menu/category');
                } else {
                    $msg->add('d', 'Opss.. Algum erro ocorreu não foi possivel efetuar o cadastro!', '/admin/menu/category/form');
                }

                break;
        }
    }

    public function updateCat() {
        $msg = new Messages();

        $classMenuCat = new \App\Models\Menu('adm_categoryMenu');

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
        $posicion = filter_input(INPUT_POST, 'posicion', FILTER_SANITIZE_STRING);
        $public = filter_input(INPUT_POST, 'public', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'up':
                $menuCat = [
                    'adm_name' => $name,
                    'adm_description' => $desc,
                    'adm_posicion' => $posicion,
                    'adm_public' => $public
                ];

                if ($classMenuCat->update($menuCat, 'id', $id) === true) {
                    $msg->add('s', 'Categoria alterado com sucesso!', '/admin/menu/category');
                } else {
                    $msg->add('d', 'Opss.. Algum erro ocorreu não foi possivel efetuar a alteração!', '/admin/menu/category/update/' . $id);
                }
                break;
        }
    }

    public function deleteCat() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $classMenuCat = new \App\Models\Menu('adm_categoryMenu');
        $id = $url->getId();
        $getUrl = $url->getUrl();
        $classMenu = new \App\Models\Menu('adm_menu');

        $readMenu = $classMenu->read();

        foreach ($readMenu as $menu) {
            if ($id == $menu['adm_cat'] && $getUrl != "/admin/menu/category/delete/$id/yes") {
                $msg->add('d', "Categoria não pode ser deletada pois existe <strong>ITEM DE MENU</strong> vinculado a ela - <a href='/admin/menu/$id'>Deletar Itens</a>", '/admin/menu/category');
            }
        }

        if ($classMenuCat->delete($id) == true) {
            $msg->add('s', 'Categoria deletada com sucesso!', '/admin/menu/category');
        } else {
            $msg->add('d', 'Ops.. Algum erro ocorreu, categoria não pode ser excluida!', '/admin/menu/category');
        }
    }

    public function publicCatMenu() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $id = $url->getId();

        $classCatMenu = new \App\Models\Article('adm_categoryMenu');
        $array = [
            'adm_public' => '1',
        ];

        if ($classCatMenu->update($array, 'id', $id)) {
            $msg->add('s', 'Categoria publicada com sucesso.', '/admin/menu/category');
        } else {
            $msg->add('d', 'Ops.. Algum erro interno ocorreu.', '/admin/menu/category');
        }
    }

    public function despublicCatMenu() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $id = $url->getId();

        $classCatMenu = new \App\Models\Article('adm_categoryMenu');
        $array = [
            'adm_public' => '0',
        ];

        if ($classCatMenu->update($array, 'id', $id)) {
            $msg->add('s', 'Categoria despublicada com sucesso.', '/admin/menu/category');
        } else {
            $msg->add('d', 'Ops.. Algum erro interno ocorreu.', '/admin/menu/category');
        }
    }

    /*
     * MENU
     */

    public function read() {
        $classMenu = new \App\Models\Menu('adm_menu');
        $url = Container::getClass('url');

        $this->view->url = $url->getUrl();
        $this->view->id = $url->getId();
        $this->view->readMenu = $classMenu->read();
        $this->session('read', 'admin');
    }

    public function formMenu() {
        $url = Container::getClass('url');

        $where = ['id' => $url->getId()];
        $classMenu = new \App\Models\Menu('adm_menu');

        $this->view->menuUp = $classMenu->find($where);

        $this->view->id = $url->getId();
        $this->view->url = $url->getUrl();
        $this->view->read = $classMenu->read();



        $this->session('formMenu', 'admin');
    }

    public function addMenu() {
        $msg = new Messages();

        $classMenu = new \App\Models\Menu('adm_menu');

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
        $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
        $public = filter_input(INPUT_POST, 'public', FILTER_SANITIZE_NUMBER_INT);
        $pai = filter_input(INPUT_POST, 'pai', FILTER_SANITIZE_STRING);
        $filiacao = filter_input(INPUT_POST, 'filiacao', FILTER_SANITIZE_STRING);
        $cat = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'add':

                $menu = [
                    'adm_item' => $item,
                    'adm_link' => strtolower($link),
                    'adm_desc' => $desc,
                    'adm_public' => $public,
                    'adm_pai' => $pai,
                    'adm_family' => $filiacao,
                    'adm_cat' => $cat
                ];

                $read = $classMenu->read();

                foreach ($read as $value) {
                    if ($value['adm_item'] == $item) {
                        $msg->add('w', 'Este item já existe no banco de dados!', '/admin/menu/update/' . $id);
                    }
                }

                if ($classMenu->insert($menu) === true) {
                    $msg->add('s', 'Item cadastrado com sucesso!', '/admin/menu/' . $cat);
                } else {
                    $msg->add('d', 'Opss.. Algum erro ocorreu não foi possivel efetuar o cadastro!', '/admin/menu/' . $cat);
                }

                break;
            default:
                break;
        }
    }

    public function upMenu() {
        $msg = new Messages();

        $classMenu = new \App\Models\Menu('adm_menu');

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
        $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
        $public = filter_input(INPUT_POST, 'public', FILTER_SANITIZE_NUMBER_INT);
        $pai = filter_input(INPUT_POST, 'pai', FILTER_SANITIZE_STRING);
        $filiacao = filter_input(INPUT_POST, 'filiacao', FILTER_SANITIZE_STRING);
        $cat = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'up':

                $menu = [
                    'adm_item' => $item,
                    'adm_link' => strtolower($link),
                    'adm_desc' => $desc,
                    'adm_public' => $public,
                    'adm_pai' => $pai,
                    'adm_family' => $filiacao,
                    'adm_cat' => $cat
                ];

                $read = $classMenu->read();

                foreach ($read as $value) {
                    if ($value['adm_item'] == $item && $value['id'] != $id) {
                        $msg->add('w', 'Este item já existe no banco de dados!', '/admin/menu/update/' . $id);
                    } elseif ($pai == "no") {
                        if ($value['adm_family'] == $item) {
                            $msg->add('d', 'Este item é pai e tem itens vinculado a ele você não pode tirar ele de pai!', '/admin/menu/update/' . $id);
                        }
                    }
                }

                if ($filiacao == $item) {
                    $msg->add('d', 'Você não pode colocar o item igual à filiação!', '/admin/menu/update/' . $id);
                }

                if ($classMenu->update($menu, 'id', $id) === true) {
                  $msg->add('s', 'Item do menu alterado com sucesso!', '/admin/menu/'.$cat);
                  } else {
                  $msg->add('d', 'Opss.. Algum erro ocorreu não foi possivel efetuar a alteração!', '/admin/menu/'.$cat);
                  }
                break;
            default:
                break;
        }
    }

    public function delete() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $del = new \App\Models\Menu('adm_menu');
        $arrayId = explode("/", $this->getUrl());

        if ($del->delete($arrayId[5]) == true) {
            $msg->add('s', 'Item do menu deletado com sucesso!', '/admin/menu/' . $arrayId[3]);
        } else {
            $msg->add('d', 'Ops.. Algum erro ocorreu, Item não foi excluido!', '/admin/menu/' . $arrayId[3]);
        }
    }

    public function publicMenu() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $arrayId = explode("/", $this->getUrl());

        $classMenu = new \App\Models\Article('adm_menu');
        $array = [
            'adm_public' => '1',
        ];

        if ($classMenu->update($array, 'id', $arrayId[5])) {
            $msg->add('s', 'Item publicado com sucesso.', '/admin/menu/' . $arrayId[3]);
        } else {
            $msg->add('d', 'Ops.. Algum erro interno ocorreu.', '/admin/menu/' . $arrayId[3]);
        }
    }

    public function despublicMenu() {
        $msg = new Messages();
        $url = Container::getClass('url');
        $arrayId = explode("/", $this->getUrl());

        $classMenu = new \App\Models\Article('adm_menu');
        $array = [
            'adm_public' => '0',
        ];

        if ($classMenu->update($array, 'id', $arrayId[5])) {
            $msg->add('s', 'Item despublicado com sucesso.', '/admin/menu/' . $arrayId[3]);
        } else {
            $msg->add('d', 'Ops.. Algum erro interno ocorreu.', '/admin/menu/' . $arrayId[3]);
        }
    }

}

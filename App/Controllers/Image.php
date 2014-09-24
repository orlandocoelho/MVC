<?php

namespace App\Controllers;
use \OC\Controller\Action;
use \OC\Di\Container;
use \OC\Error\Messages;

class Image extends Action
{
    public function read()
    {
        $classImage = Container::getClass('image');
        $url = Container::getClass('url');
        
        $this->view->url = $url->getUrl();
        $this->view->readImage = $classImage->read();        
        $this->session('read', 'admin');
    }
    
    public function add()
    {
                
        $msg = new Messages();
        $classImage = Container::getClass('Image');
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'add':
                if ((isset($action))) {
                    

                    $insertFile = $classImage->insertFile();

                    
                    if ($insertFile === "empty") {
                        $msg->add('d', 'Ops.. Selecione uma imagem por favor.', '/admin/conteudo/image');
                    } elseif ($insertFile === "ultrapassa") {
                        $msg->add('d', 'Ops.. Limite maximo para envio é de 20MB, contando todos os arquivos juntos.', '/admin/conteudo/image');
                    } elseif ($insertFile === "suportada") {
                        $msg->add('d', 'Ops.. Apenas imagens gif, jpeg e png são permitidas.', '/admin/conteudo/image');
                    }elseif ($insertFile === "succesTotal") {
                        $msg->add('s', 'Upload efetuado com sucesso.', '/admin/conteudo/image');
                    }elseif ($insertFile === "errorTotal") {
                        $msg->add('d', 'Ops.. Algum erro interno não permitiu o envio.', '/admin/conteudo/image');
                    }
                }
                break;

            default:
                break;
        }
    }
    
    public function delete()
    {
        $msg = new Messages();
        $url = Container::getClass('url');
        $del = Container::getClass('image');
        $id = $url->getId();

        if ($del->delete($id) == true) {
            $msg->add('s', 'Imagem deletado com sucesso!', '/admin/conteudo/image');
        } else {
            $msg->add('d', 'Ops.. Algum erro ocorreu, imagem não foi excluido!', '/admin/conteudo/image');
        }
    }
    
}

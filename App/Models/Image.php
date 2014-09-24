<?php

namespace App\Models;

use OC\Db\servicesDB;

class Image extends servicesDB
{

    public function __construct() {
        parent::__construct();
        $this->tabela = "adm_image";        
    }
    
    public function insertFile()
    {
        $file = $_FILES['image'];
        $numFile = count(array_filter($file['name']));
               
        $folder = 'images/save';
        
        $permite = array('image/jpeg', 'image/png', 'image/gif');
        $maxSize = 1024 * 1024 * 5;
       
        if($numFile <= 0){
            return 'empty';
        }else{
            for($i = 0; $i < $numFile; $i++){
                $name = $file['name'][$i];
                $type = $file['type'][$i];
                $size = $file['size'][$i];
                $tmp = $file['tmp_name'][$i];

                $extensao = @end(explode('.', $name));
                $nameNew = rand().".$extensao";
                           
                if(!in_array($type, $permite)){
                    return 'suportada';                   
                }else if($size > $maxSize){
                    return 'ultrapassa';
                }else{
                    $move = move_uploaded_file($tmp, $folder."/".$nameNew);
                    $array = ['adm_img' => $nameNew];
                    $insert = $this->insert($array);                   
                }
                
            }
            if($move == true && $insert == true){
                return 'succesTotal';
            }else{
                return 'errorTotal';
            }
        }
    }
}

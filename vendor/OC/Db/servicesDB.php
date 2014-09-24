<?php

namespace OC\Db;

abstract class servicesDB {

    private $db;
    protected $tabela = "";

    public function __construct() {
        $this->db = \App\Init::getDb();
    }

    /*
     * METODO DE LISTAR DO DB
     */

    public function read() {
        $query = "Select * from $this->tabela";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function lastId(){
        return $this->db->lastInsertId();
    }
    
    /*
     * INSERT INTO NORMAL APENAS GENERICO
     */

    public function insert($array = array()) {
        $query = "Insert into {$this->tabela} (";
        for ($i = 0; $i < count($array); $i++) {
            $query .= key($array);
            if ($i < (count($array) - 1)) {
                $query .= ", ";
            } else {
                $query .= ") ";
            }//fim if
            next($array);
        }//fim for
        reset($array);
        $query .= "values (";
        for ($i = 0; $i < count($array); $i++) {
            $query .= ":".key($array);
            if ($i < (count($array) - 1)) {
                $query .= ", ";
            } else {
                $query .= "); ";
            }//fim if
            next($array);
        }//fim form
        if($this->stmt($query, $array) === true){
            return true;
        }else{
            return false;
        }
    }

    /*
     * METODO DE UPDATE DO DB
     */

    public function update($array = array(), $campoDb, $val) {
        $query = "Update {$this->tabela} set ";
        for ($i = 0; $i < count($array); $i++) {
            $query .= key($array) . "=:" . key($array);
            
            if ($i < (count($array) - 1)) {
                $query .= ", ";
            } else {
                $query .= " ";
            }//fim if
            next($array);
        }//fim for

        $query .= "where {$campoDb} =";
        $query .= is_numeric($val) ? $val : "{$campoDb}";

        return $this->stmt($query, $array);

        
        }

    /*
     * METODO FIND VERIFICA APENAS O REGISTRO DESEJADO
     */

    public function find($where, $cond = NULL, $fetch = TRUE) {
        $query = "Select * from {$this->tabela} where ";
        for ($i = 0; $i < count($where); $i++) {

            //Cria a key e o value com stmt sendo que é o mesmo valor os dois.
            //Ex.: Select * from adm_users where adm_login= :adm_login and adm_pass= :adm_pass

            $query .= key($where) . " = :" . key($where);

            if ($i < (count($where) - 1)) {
                $query .= " {$cond} ";
            } else {
                $query .= "";
            }//fim if            

            next($where);
        }

        $stmt = $this->db->prepare($query);
        foreach ($where as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        

        $stmt->execute();

            if ($stmt->rowCount() == 1) {
                if($fetch == true){
                    return $stmt->fetch(\PDO::FETCH_ASSOC);
                }else{
                    return true;
                }
            } else {
                return false;
            }
        
    }

    /*
     * METODO DELETE DO DB
     */

    public function delete($id) {
        $query = "Delete from {$this->tabela} where id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * STMT, BINDVALUES
     */

    public function stmt($query, $array = array()) {
        $stmt = $this->db->prepare($query);
        foreach ($array as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}

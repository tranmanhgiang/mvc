<?php 
namespace AHT\Core;
use AHT\Core\ResourceModelInterface;
use AHT\Config\db as Database;

class ResourceModel implements ResourceModelInterface
{
    public $tablename;
    public $id;
    public $model;

    function _init($tablename, $id, $model) {
        $this->tablename = $tablename;
        $this->id = $id;
        $this->model = $model;
    }

    function save($model) {
        $model->getProperties();
        $arrKey = [];
        $arrVal = [];
        $arrUpdate = [];
        
        foreach($model as $key => $value) {
            if($key != 'id') {
                array_push($arrKey, $key);
            }
            if($value != '') {
                $arrVal[$key] = $value;
            }
            $arrUpdate[$key] = $key;
        }
        $str = implode(", ", $arrKey);
        $strPlaceholder = implode(", :" , $arrKey);

        $a = [];
        foreach($arrUpdate as $key => $value) {
            if($key != "id" && $key != "created_at") {
                array_push($a, $key . ' = :' . $value);
            }
        }
        $update_field =  implode(", ", $a);

        if($model->getId() === null) {
            
            $sql = "INSERT INTO $this->tablename ($str) VALUES (" . ":" . "$strPlaceholder)";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute($arrVal);

        } else {
            $sql = "UPDATE $this->tablename SET $update_field WHERE id = :id";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute($arrVal);
        }
        
    }

    function delete($model) {
        $sql = "DELETE FROM $this->tablename WHERE id = $this->id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    function getAll() {
        $sql = "SELECT * FROM $this->tablename";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
        print_r($req->fetchAll());
    }

}
?>
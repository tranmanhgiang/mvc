<?php
namespace AHT\Models;

use AHT\Core\Model;

class Task extends Model
{
    public $title;
    public $description;
    public $created_at;
    public $updated_at;
    public $id = null;

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setCreated($created)
    {
        $this->created_at = $created;
    }

    public function getCreated()
    {
        return $this->created_at;
    }
    
    public function setUpdated($update)
    {
        $this->updated_at = $update;
    }

    public function getUpdated()
    {
        return $this->updated_at;
    }
    // getProperties()
}
?>
<?php 
namespace AHT\Models;
use AHT\Core\ResourceModel;

class TaskResourceModel extends ResourceModel
{
    function __construct($tablename, $id, $model) {
        parent::_init($tablename, $id, $model);
    }
}

?>
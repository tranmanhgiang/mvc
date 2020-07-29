<?php 
namespace AHT\Models;

use AHT\Config\db as Database;
use AHT\Models\TaskResourceModel;
use AHT\Models\Task;

class TaskRepository 
{
    public function create($model)
    {
        $taskresourcemodel = new TaskResourceModel("tasks", null, $model);
        if($taskresourcemodel->save($model)) {
            return true;
        } else {
            return false;
        }
    }

    public function showTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function showAllTasks()
    {
        $taskresourcemodel = new TaskResourceModel("tasks", null, null);
        return $taskresourcemodel->getAll();
    }

    public function edit($model)
    {
        $taskresourcemodel = new TaskResourceModel("tasks", null, $model);
        if($taskresourcemodel->save($model)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($model)
    {
        $taskresourcemodel = new TaskResourceModel("tasks", $model->getId(), $model);
        if($taskresourcemodel->delete($model)) {
            return true;
        } else {
            return false;
        }
    }

  
}

?>
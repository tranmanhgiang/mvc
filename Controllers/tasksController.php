<?php

use AHT\Core\Controller;
use AHT\Models\TaskRepository;
use AHT\Models\Task;

class tasksController extends Controller
{
    function index()
    {
        // require(ROOT . 'Models/Task.php');
        $tasks = new TaskRepository();
        
        $d['tasks'] = $tasks->showAllTasks();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            // require(ROOT . 'Models/Task.php');
            $task = new TaskRepository();
            $model = new Task();
            $model->setTitle($_POST["title"]);
            $model->setDescription($_POST["description"]);
            $model->setCreated(date('Y-m-d H:i:s'));
            $model->setUpdated(date('Y-m-d H:i:s'));
            
            if ($task->create($model))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        // require(ROOT . 'Models/Task.php');
        $task = new TaskRepository();

        $d["task"] = $task->showTask($id);

        if (isset($_POST["title"]))
        {
            $model = new Task();
            $model->setId($id);
            $model->setTitle($_POST["title"]);
            $model->setDescription($_POST["description"]);
            $model->setUpdated(date('Y-m-d H:i:s'));

            if ($task->edit($model))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        // require(ROOT . 'Models/Task.php');
        $task = new TaskRepository();
        $model = new Task();
        $model->setId($id);
        if ($task->delete($model))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }

}
?>
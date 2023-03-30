<?php
session_start();
require '../models/User.php';
require '../dbconfig.php';
class TaskController
{
    private $userModel;
    public function __construct( User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function addTask()
    {
        $task = $this->userModel->createTask($_POST['task_name'], $_POST['task_description'], $_POST['date'], $_POST['priority'], $_SESSION['user']['user_id']);
        if ($task) {
            header("Location: /src/views/Dashboard.php");
        } else {
            header("Location: /src/views/AddTask.php/?error=1");
        }
    }
    public function deleteTask()
    {
        $task = $this->userModel->deleteTask($_POST['id']);
        if ($task) {
            header("Location: /src/views/Dashboard.php");
        } else {
            header("Location: /src/views/Dashboard.php/?error=1");
        }
    }
    public function getTasks()
    {
        $tasks = $this->userModel->getTasks($_SESSION['user']['id']);
        if ($tasks) {
            return $tasks;
        } else {
            return null;
        }
    }
    public function editTask()
    {
        $task = $this->userModel->editTask($_POST['id'], $_POST['title'], $_POST['description'], $_POST['date'], $_POST['priority']);
        if ($task) {
            header("Location: /src/views/Dashboard.php");
        } else {
            header("Location: /src/views/Dashboard.php/?error=1");
        }
    }
    public function completeTask()
    {
        $task = $this->userModel->completeTask($_GET['task_complete']);
        if ($task) {
            header("Location: /src/views/Dashboard.php");
        } else {
            header("Location: /src/views/Dashboard.php/?error=1");
        }
    }

}	
$user= new User($conn);
$taskController = new TaskController($user);
if(isset($_POST['task_description']))
{
    $taskController->addTask();
}
else
{
    if(isset($_GET["task_delete"]))
    {
        $taskController->deleteTask();
    }
    else
    {
        if(isset($_GET["task_complete"]))
        {
            $taskController->completeTask();
            header("Location: /src/views/Dashboard.php");
        }
    }
}


?>
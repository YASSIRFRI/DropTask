<?php
session_start();
require '../models/User.php';
require '../dbconfig.php';
class TaskController
{
    public $userModel;
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
        $task = $this->userModel->deleteTask($_GET['task_delete']);
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
        $this->userModel->editTask($_POST['id'], $_POST['title'], $_POST['description'], $_POST['date'], $_POST['priority']);
    }
    public function completeTask()
    {
         $this->userModel->completeTask($_GET['task_complete']);
    }

}	
$user= new User($conn);

$taskController = new TaskController($user);
if(isset($_POST['task_description']))
{
    $taskController->addTask();
    $_SESSION["user"]["tasks"]=$taskController->userModel->getTasks($_SESSION["user"]["user_id"]);
}
else
{
    if(isset($_GET["task_delete"]))
    {
        $taskController->deleteTask();
    $_SESSION["user"]["tasks"]=$taskController->userModel->getTasks($_SESSION["user"]["user_id"]);
    header("Location: /src/views/Dashboard.php");
    }
    else
    {
        if(isset($_GET["task_complete"]))
        {
            $taskController->completeTask();
            $_SESSION["user"]["tasks"]=$taskController->userModel->getTasks($_SESSION["user"]["user_id"]);
            header("Location: /src/views/Dashboard.php");
        }
    }
}


?>
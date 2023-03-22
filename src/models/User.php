<?php
 class User {

    private $connection;
    public function __construct($conn)
    {
        $this->connection=$conn;
    }
    public function login($email, $password) {
        $query = $this->connection->prepare("SELECT * FROM User WHERE email = :email AND password = :password");
        $query->execute([
            "username" => $email,
            "password" => $password
        ]);
        return $query->fetch();
    }
    public function register($email, $username,$password) {
        $query = $this->connection->prepare("INSERT INTO User (email,username, password) VALUES (:email,:username, :password)");
        $query->execute([
            "email" => $email,
            "username" => $username,
            "password" => $password
        ]);
    }
    public function createTask($task_name,$task_description,$due_date,$state)
    {
        $query = $this->connection->prepare("INSERT INTO Task (task_id,task_name, task_description, due_date, state) VALUES (:task_id,:task_name, :task_description, :due_date, :state)");
        $task_id=rand();
        $query->execute([
            "task_id"=>$task_id,
            "task_name" => $task_name,
            "task_description" => $task_description,
            "due_date" => $due_date,
            "state" => $state
        ]);
        $query= $this->connection->prepare("INSERT INTO User_Task VALUES (:user_id,:task_id)");
        $query->execute([
            "user_id"=>$_SESSION["user_id"],
            "task_id"=>$task_id
        ]);
    }
    public function createReminder($task_name,$reminder_name, $reminder_date)
    {
        $query = $this->connection->prepare("INSERT INTO Task_Reminder (reminder_name, reminder_date) VALUES (:reminder_name, :reminder_date)");
        $query->execute([
            "reminder_name" => $reminder_name,
            "reminder_date" => $reminder_date
        ]);
    }
    public function getCompletedTasks($user_id)
    {
        $query=$this->connection->prepare("SELECT task_name, task_description FROM 
        User_Task JOIN Task WHERE user_id=:user_id and Task.status=completed");
        $query->execute([
            "user_id"=>$user_id
        ]);
        $query->fetchAll();
    }

    public function completeTaks($task_name)
    {
        $query=$this->connection->prepare("UPDATE Tasks SET status=completed WHERE task_name=:task_name");
        try{
            $query->execute([
                "task_name"=>$task_name
            ]);
        }
        catch(PDOException $e)
        {
            echo "Can Not update Task ";
        }
    }
    public function getTasks($user_id)
    {
        $query = $this->connection->prepare("SELECT * FROM User_Task WHERE user_id = :user_id");
        $query->execute([
            "user_id" => $user_id
        ]);
        return $query->fetchAll();
    }
    public function deleteTask($id)
    {
        $query = $this->connection->prepare("DELETE FROM User_Task WHERE user_id = :id");
        $query->execute([
            "id" => $id
        ]);
    }
    }
?>
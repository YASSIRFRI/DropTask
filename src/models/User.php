<?php
 class User {
    private $connection;
    public function __construct($conn)
    {
        $this->connection=$conn;
    }
    public function login($email, $password) {
        $query = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute([
            "email" => $email,
        ]);
        $user = $query->fetch();
        if ($user && password_verify($password, $user["password"])) {
            $user["tasks"]=$this->getTasks($user["user_id"]);
            $user["completed_tasks"]=$this->getCompletedTasks($user["user_id"]);
            $user["reminders"]=$this->getReminders($user["user_id"]);
            $_SESSION["user"]=$user;
        }
        else {
            return false;
        }
    }
    public function register($email, $username,$password) {
        $query = $this->connection->prepare("INSERT INTO User (email,username, password) VALUES (:email,:username, :password)");
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $query->execute([
            "email" => $email,
            "username" => $username,
            "password" => $password_hashed
        ]);
        return $this->login($email, $password);
    }
    public function createTask($task_name,$task_description,$due_date,$priority)
    {
        $query = $this->connection->prepare("INSERT INTO Task (task_id,task_name, task_description, due_date,priority,status) VALUES (:task_id,:task_name, :task_description, :due_date, :priority, :status)");
        $task_id=rand();
        try
        {
            $query->execute([
                "task_id"=>$task_id,
                "task_name" => $task_name,
                "task_description" => $task_description,
                "due_date" => $due_date,
                "priority" => $priority,
                "status" => "in progress"
            ]);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
        try
        {
            $query= $this->connection->prepare("INSERT INTO User_Task VALUES (:user_id,:task_id)");
            $query->execute([
                "user_id"=>$_SESSION["user"]["user_id"],
                "task_id"=>$task_id
            ]);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;

    }
    public function editTask($id, $task_name,$task_description,$due_date,$status)
    {
        $query = $this->connection->prepare("UPDATE Task SET task_name = :task_name, task_description = :task_description, due_date = :due_date, status = :status WHERE id = :id");
        $query->execute([
            "id" => $id,
            "task_name" => $task_name,
            "task_description" => $task_description,
            "due_date" => $due_date,
            "status" => $status
        ]);
    }
  
    public function getCompletedTasks($user_id)
    {
        $query=$this->connection->prepare("SELECT Task.task_id ,task_name, task_description, due_date FROM 
        User_Task JOIN Task  WHERE user_id=:user_id and Task.status='completed'");
        $query->execute([
            "user_id"=>$user_id
        ]);
        return $query->fetchAll();
    }
    public function completeTask($task_id)
    {
        $query=$this->connection->prepare("UPDATE Tasks SET status='completed' WHERE task_id=:task_id");
        try{
            $query->execute([
                "task_id"=>$task_id
            ]);
        }
        catch(PDOException $e)
        {
            echo "Can Not update Task ";
        }
    }
    public function getTasks($user_id)
    {
        $query = $this->connection->prepare("SELECT Task.task_id, task_name, task_description, due_date FROM 
        User_Task JOIN Task WHERE user_id=:user_id and Task.status='in progress'");
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
    public function createReminder($task_id,$reminder_date)
    {
        $query = $this->connection->prepare("INSERT INTO Task_Reminder (task_id,reminder_date_time) VALUES (:task_id,:reminder_date_time)");
        $query->execute([
            "task_id" => $task_id,
            "reminder_date_time" => $reminder_date
        ]);
    }
    public function deleteReminder($task_id)
    {
        $query = $this->connection->prepare("DELETE FROM Task_Reminder WHERE task_id = :task_id");
        $query->execute([
            "task_id" => $task_id
        ]);
    }
    public function getReminders($user_id)
    {
        $query = $this->connection->prepare("SELECT Task.task_id, task_name, reminder_date FROM 
        User_Task JOIN Task JOIN Task_Reminder WHERE user_id=:user_id and Task.status='in progress' and Task.task_id=Task_Reminder.task_id");
        $query->execute([
            "user_id" => $user_id
        ]);
        return $query->fetchAll();
    }
}
?>












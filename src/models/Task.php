<?php



class Task 
{
    private $connection;
    public function __construct($conn)
    {
        $this->connection=$conn;
    }
    public function createTask($task_name,$task_description,$due_date,$state)
    {
        $query = $this->connection->prepare("INSERT INTO Task (task_name, task_description, due_date, state) VALUES (:task_name, :task_description, :due_date, :state)");
        $query->execute([
            "task_name" => $task_name,
            "task_description" => $task_description,
            "due_date" => $due_date,
            "state" => $state
        ]);
    }
    public function deleteTask($task_id)
    {
        $query = $this->connection->prepare("DELETE FROM Task WHERE id = :id");
        $query->execute([
            "id" => $task_id
        ]);
    }
    public function updateTask($id, $task_name,$task_description,$due_date,$priority)
    {
        $query = $this->connection->prepare("UPDATE Task SET task_name = :task_name, task_description = :task_description, due_date = :due_date, priority= :priority WHERE id = :id");
        $query->execute([
            "id" => $id,
            "task_name" => $task_name,
            "task_description" => $task_description,
            "due_date" => $due_date,
            "state" => $priority
        ]);
    }
    public function completeTask($task_id)
    {
        $query = $this->connection->prepare("UPDATE Task SET state = :state WHERE task_id = :id");
        $query->execute([
            "id" => $task_id,
            "state" => "completed"
        ]);
    }
}








?>
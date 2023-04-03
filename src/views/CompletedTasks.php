<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Completed Tasks</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Task Name</th>
                <th scope="col">Task Description</th>
                <th scope="col">Task Status</th>
                <th scope="col">Task Date</th>
                <th scope="col">Task Time</th>
                <th scope="col">Task Priority</th>
                <th scope="col">Task Category</th>
                <th scope="col">Task Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($_SESSION["user"]["completed_tasks"] as $task){
                    echo '
                    <tr>
                        <td>'.$task["task_name"].'</td>
                        <td>'.$task["task_description"].'</td>
                        <td>'.$task["status"].'</td>
                        <td>'.$task["due_date"].'</td>
                        <td>'.$task["priority"].'</td>
                        <td>
                            <a href="/edit-task/'.$task["task_id"].'" class="btn btn-primary">Edit</a>
                            <a href="/delete-task/'.$task["task_id"].'" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    ';
            }
            ?>
        </tbody>
    </table>
    
</body>
</html>


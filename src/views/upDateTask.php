<!DOCTYPE html>
<html>
<head>
	<title>Add Task</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>Update Task</h2>
		<form action="../controllers/TaskController.php" method="POST">
            <input type="hidden" value="<?php
            isset($_GET['id']) ? $_GET['task_id'] : '';
            ?>">
			<div class="form-group">
				<label for="name">Task Name:</label>
				<input type="text" class="form-control" id="name" name="task_name" required>
			</div>
			<div class="form-group">
				<label for="description">Task Description:</label>
				<textarea class="form-control" id="description" name="task_description" rows="5" required></textarea>
			</div>
            <div class="form-group">
                <label for="date">New Due Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="Urgent">Urgent</option>
                </select>
            </div>
			<button type="submit" class="btn btn-primary">Update Task</button>
		</form>
	</div>
</body>
</html>
<?php

?>
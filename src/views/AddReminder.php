
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
		<h2>Add Reminder</h2>
		<form action="../controllers/ReminderController.php" method="POST">
			<div class="form-group">
				<label for="name">Reminder Name:</label>
				<input type="text" class="form-control" id="name" name="task_name" required>
			</div>
			<div class="form-group">
				<label for="description">Reminder Description:</label>
				<textarea class="form-control" id="description" name="task_description" rows="5" required></textarea>
			</div>
            <div class="form-group">
                <label for="date">Date:</label>
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

			<button type="submit" class="btn btn-primary">Add Reminder</button>
		</form>
	</div>

</body>
</html>

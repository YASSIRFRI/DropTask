
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
    <?php
    echo $_GET["task_id"];
    ?>
		<h2>Add Reminder</h2>
		<form action="../controllers/ReminderController.php" method="POST">
			<input type="hidden" <?php echo "value=".$_GET["task_id"]?> name="task_id">
			<div class="form-group">
				<label for="name">Reminder Name:</label>
				<input type="text" class="form-control" id="name" name="task_name" required>
			</div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control"  name="reminder_date_time" required>
            </div>
            </div>
			<button type="submit" class="btn btn-primary">Add Reminder</button>
		</form>
	</div>

</body>
</html>

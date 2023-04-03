<?php
require('dbconfig.php');


function getReminders($conn)
{
    $query = $conn->prepare("SELECT email,reminder_date_time,task_name,task_description FROM Task_Reminder 
    JOIN Task ON Task_Reminder.task_id = Task.task_id
    JOIN User_Task ON Task_Reminder.task_id = User_Task.task_id JOIN
    User ON User_task.user_id = User.user_id");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");
function emailReminders($conn)
{
    $reminders = getReminders($conn);
    var_dump($reminders);
    foreach($reminders as $reminder)
    {
        $email = $reminder['email'];
        $reminder_date_time = $reminder['reminder_date_time'];
        $current_date_time = date("Y-m-d H:i:s");
        if($reminder_date_time)
        {
            $to = $email;
            $subject = "Task Reminder";


            $txt = "";
            $headers = "From:droptask23@gmail.com" . "\r\n" ;
            $txt = "Task Name: " . $reminder['task_name'] . "\r\n";
            $txt .= "Task Description: " . $reminder['task_description'] . "\r\n";
            $txt .= "Reminder Date Time: " . $reminder['reminder_date_time'] . "\r\n";
            mail($to,$subject,$txt,$headers);
            echo "Email Sent";
        }
    }

}

emailReminders($conn);



?>
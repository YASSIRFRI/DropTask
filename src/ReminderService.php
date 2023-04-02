<?php
require('dbconfig.php');

function getReminders($conn)
{
    $query = $conn->prepare("SELECT email,reminder_date_time,task_name,task_description FROM Task_Reminder JOIN task ON Task_Reminder.task_id = Task.taks_id JOIN
    user ON Task.user_id = user.user_id");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function emailReminders($conn)
{
    $reminders = getReminders($conn);
    foreach($reminders as $reminder)
    {
        $email = $reminder['email'];
        $reminder_date_time = $reminder['reminder_date_time'];
        $current_date_time = date("Y-m-d H:i:s");
        if($reminder_date_time <= $current_date_time)
        {
            $to = $email;
            $subject = "Task Reminder";


            $txt = "";
            $headers = "From:droptask23@gmail.com" . "\r\n" .
            "CC:".$reminder['email'];
            $txt = "Task Name: " . $reminder['task_name'] . "\r\n";
            $txt .= "Task Description: " . $reminder['task_description'] . "\r\n";
            $txt .= "Reminder Date Time: " . $reminder['reminder_date_time'] . "\r\n";
            mail($to,$subject,$txt,$headers);
        }
    }

}

emailReminders($conn);



?>
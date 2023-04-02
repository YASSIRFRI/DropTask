<?php
require('../dbconfig.php');
require('../models/User.php');
class ReminderController{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function addReminder()
    {
        $reminder = $this->userModel->createReminder( $_POST['task_id'],$_POST['reminder_date_time']);
        if ($reminder) {
            header("Location: /src/views/Dashboard.php");
        } else {
            header("Location: /src/views/AddReminder.php/?error=1");
        }
    }
    public function deleteReminder()
    {
        $reminder = $this->userModel->deleteReminder($_POST['id']);
        if ($reminder) {
            header("Location: /src/views/Dashboard.php");
        } else {
            header("Location: /src/views/Dashboard.php/?error=1");
        }
    }
    public function getReminders()
    {
        $reminders = $this->userModel->getReminders($_SESSION['user']['id']);
        if ($reminders) {
            return $reminders;
        } else {
            return null;
        }
    }

}
$user= new User($conn);
$reminderController = new ReminderController($user);
if(isset($_POST['reminder_date_time']))
{
    $reminderController->addReminder();
}

?>
<?php
session_start();
require '../models/User.php';
require '../dbconfig.php';
class LoginController
{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function login()
    {
        try
        {
            $user=$this->userModel->login($_POST['email'], $_POST['password']);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        if (isset($_SESSION["user"])) {
            header("location: ../views/Dashboard.php");
        } else {
            echo "Wrong username or password";
        }
    }

}


$user= new User($conn);
$loginController = new LoginController($user);
if(isset($_POST['email']))
{
    $loginController->login();
}









?>
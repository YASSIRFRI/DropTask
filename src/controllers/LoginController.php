<?php


require 'src/models/User.php';
require 'src/dbconfig.php';
class LoginController
{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function login()
    {
        $user = $this->userModel->login($_POST['email'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: /');
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
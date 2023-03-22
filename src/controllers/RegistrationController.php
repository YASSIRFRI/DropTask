<?php



require 'src/models/User.php';
require 'src/dbconfig.php';

class RegistrationController
{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function register()
    {
        $user = $this->userModel->register($_POST['email'], $_POST['username'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
        } else {
            echo "Wrong username or password";
        }
    }
}


$user= new User($conn);
$regController = new RegistrationController($user);
if(isset($_POST['email']))
{
    $regController->register();
}






?>

<?php
if(!isset($_SESSION['user_id']))
{
    header('Location: /src/views/Login.php');
}
else
{
    require 'src/models/User.php';
    require 'src/controllers/LoginController.php';
    require '/src/dbconfig.php';
    $userModel = new User($conn);
    $loginController = new LoginController($userModel);
    try{
        $loginController->login();
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }


}










?>
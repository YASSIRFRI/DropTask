<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <div class="wrapper bg-white">
    <div class="h2 text-center">To do list</div>
    <div class="h4 text-center">By Yassir Fri & Ayman Youss</div>
    <div class="h4 text-muted text-center pt-2">Enter your registering details</div>
    <form class="pt-3">
        <div class="form-group py-2">
            <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text" placeholder="Username" required class=""> </div>
        </div>
        <div class="form-group py-2">
            <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text" placeholder="Email Address" required class=""> </div>
        </div>
        <div class="form-group py-1 pb-2">
            <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="text" placeholder="Enter your Password" required class=""> <button class="btn bg-white text-muted"> <span class="far fa-eye-slash"></span> </button> </div>
        </div>
        <div class="d-flex align-items-start">
            <div class="remember"> <label class="option text-muted"> Remember me <input type="radio" name="radio"> <span class="checkmark"></span> </label> </div>
            <div class="ml-auto"> <a href="#" id="forgot">Forgot Password?</a> </div>
        </div> <button class="btn btn-block text-center my-3">Log in</button>
        <div class="text-center pt-3 text-muted">Not a member? <a href="registerform.php">Sign up</a></div>
    </form>
</div>
  </body>
</html>
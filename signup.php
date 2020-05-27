<!--Sign Up/Register-->
<?php
    include("signup-server.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register for an account - Project 440</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    
    <body>
        <div class= "container" align="center"?>
            <form action="" method="post">
                <div class="box">
                    <h1>Register</h1>
                    
                    <!--User Input-->
                    <div class="textbox"><input type="text" name="username" placeholder="Username"></div>
                    <div class="textbox"><input type="text" name="firstname" placeHolder="First name"></div>
                    <div class="textbox"><input type="text" name="lastname" placeHolder="Last name"></div>
                    <div class="textbox"><input type="text" name="email"placeholder="Email"></div>
                    <div class="textbox"><input type="password" name="password1" placeholder="Password"></div>
                    <div class="textbox"><input type="password" name="password2" placeholder="Confirm Password"></div>
                    
                    <!--Display errors here-->
                    <?php include('errors.php');?>
                    
                    <!--Submit button-->
                    <div class="button"><input type="submit" name="register"
                    placeholder="Submit"></div>
                </div>
                
                <!--Link to Login Page-->
                <div class="other-page"><p>Already a member? <a href="login.php">Log In</a></p></div>
            </form>
        </div>   
    </body>
</html>
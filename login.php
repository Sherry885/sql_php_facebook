<!--Login-->
<?php
    include("login-server.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login - Project 440</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    
    <body>
        <div class= "container" align="center">
            <form action="" method="post">
                <div class="box">
                    <h1>Login</h1>
                    
                    <!--User Input-->
                    <div class="textbox"><input type="text" name="username" placeholder="Username" /></div>
                    <div class="textbox"><input type="password" name="password" placeholder="Password"/></div>
                    
                    <!--Return error msg if username or password is wrong-->
                    <?php echo $error; ?>
                    <div class="button"><input type="submit" value="Submit" id="submit"/></div>
                </div>
                
                <!--Link to Registration Page-->
                <div class="other-page"><p>Not a member yet? <a href="signup.php">Sign Up</a></p></div>
            </form>
        </div>
    </body>
</html>
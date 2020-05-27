<!--login-server.php will query the specified localhost database to log in-->
<?php
    include("config.php");

    //Global variables
    $errors = array();

    //If the login button is clicked
    ini_set("display_errors", 0);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = mysqli_real_escape_string($db, $_POST['username']);
        $globalvariabletest = mysqli_real_escape_string($db, $_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        
        $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($db, $sql);
        
        //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //$active = $row['active'];
        
        //Result should turn back a successful query for 1 user
        $count = mysqli_num_rows($result);
        
        //Check if username and password match database values.
        //If all values are correct, bring to welcome page;
        //if not, show error msg
        if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            header("location: welcome.php?index=0&clicked=0");
        }
        else{
            $error= '<p style="color:red">Your Login Name or Password is invalid!</p>';
            
            // show default color:
            // $error = "Your Login Name or Password is invalid!";
        }
    }


?>
<!--signup-server.php will query the specified localhost database with information to sign up-->

<?php
    include("config.php");

    //Global variables
    $uname = "";
    $eml = "";
    $pword1 = "";
    $pword2 = "";
    $fname = "";
    $lname = "";
    $errors = array();

    //If the register button is clicked
    ini_set("display_errors", 0);
    if (isset($_POST['register'])) {
        $uname = strip_tags($POST_['username']);
        $eml = strip_tags($POST_['email']);

        $uname = stripslashes($uname);
        $eml = stripslashes($eml);
        
        $uname = mysqli_real_escape_string($db, $_POST['username']);
        $eml = mysqli_real_escape_string($db, $_POST['email']);

        $pword1 = mysqli_real_escape_string($db, $_POST['password1']);
        $pword2 = mysqli_real_escape_string($db, $_POST['password2']);
        $fname = mysqli_real_escape_string($db, $_POST['firstname']);
        $lname = mysqli_real_escape_string($db, $_POST['lastname']);
        
        //unique name & unique email    
        $sql_fetch_username = "SELECT username FROM users WHERE username = '$uname'";
        $sql_fetch_email = "SELECT email FROM users WHERE email = '$eml'";

        $query_username = mysqli_query($db,$sql_fetch_username);
        $query_email = mysqli_query($db,$sql_fetch_email);

        if(mysqli_num_rows($query_username)){
            array_push($errors, "Username already exist!");
            return;
        }else if(mysqli_num_rows($query_email)){
            array_push($errors, "Email already exist!");
            return;
        }

        if(empty($uname)) {
            array_push($errors, "Username required");
        }
        if(empty($fname)){
            array_push($errors, "First name required");
        }
        if(empty($lname)){
            array_push($errors, "Last name required");
        }        
        if(empty($eml)) {
            array_push($errors, "Email required");
        }        
        if(empty($pword1)) {
            array_push($errors, "Password required");
        }
        if ($pword1 != $pword2) {
            array_push($errors, "Passwords do not match");
        }
        
       
       

        if (count($errors)==0) {
            
            //Encrypt password
            //$pword = md5($pword1);
            
            //Query
            $sql = "INSERT INTO `users` (`username`, `password`, `firstname`,`lastname`,`email`) VALUES ('$uname', '$pword1', '$fname','$lname','$eml')";

            //Call Query
            mysqli_query($db, $sql);
        }
    }
?>
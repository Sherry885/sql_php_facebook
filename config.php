<!--Configuration file that connects to our localhost database-->
<?php
    session_start();

    //Define variables
    define('DB_SERVER', 'localhost:3306');
    define('DB_USERNAME', 'John');
    define('DB_PASSWORD', 'pass1234');
    define('DB_DATABASE', 'john');

    $globalvariabletest = "";


    //Connection stored in link
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


    //Test connection
    if($db==false){
        die("error: could not connect". mysqli_connect_error());
    }
?>
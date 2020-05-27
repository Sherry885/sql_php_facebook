<!--initialize.php file to generate the database from given university.sql file-->
<?php
include('config.php');
    //If the event "Generate Database" button was selected
    if (isset($_POST['button'])) {   
        //Define variables
    //     define('S', 'localhost:3306');
    //     define('U', 'John');
    //     define('P', 'pass1234');
    //     define('D', 'john');
    //     $globalvariabletest = "";
    //     //Connection stored in link
    //     $db = mysqli_connect(S, U, P, D);
    //     //Test connection
    //     if($db==false){
    //         die("error: could not connect". mysqli_connect_error());
    // }

        //Global variable
        $sqlFileToExecute = 'university.sql';
        // $sqlFileToExecute = 'john.sql';
   
        //Read the SQL file in current directory, store in pointer
        $f = fopen($sqlFileToExecute,"r+");
        
        $sqlFile = fread($f, filesize($sqlFileToExecute));
        $sqlArray = explode(';', $sqlFile);
        
        foreach ($sqlArray as $stmt) {
            if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='*/') {
                $result = mysqli_query($db, $stmt);
                if (!$result) {
                    $sqlErrorCode = mysqli_errno($db);
                    $sqlErrorText = mysqli_error($db);
                    $sqlStmt = $stmt;
                    break;
                }
            }
        }

/* Error Messages
if ($sqlErrorCode == 0) {
  echo "Script is executed succesfully!";
} else {
  echo "An error occured during installation!<br/>";
  echo "Error code: $sqlErrorCode<br/>";
  echo "Error text: $sqlErrorText<br/>";
  echo "Statement:<br/> $sqlStmt<br/>";
}*/
    }
?>
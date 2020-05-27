<!--Include initialize.php to connect and query the localhost database-->
<?php
    include("initialize.php");
    include("site-info-server.php");
?>

<!--Welcome & Generate Database page-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        
        <!---Links--->
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!---<script type="text/javascript" src="script.js" defer></script>--->
    </head>
    
    <body>
        
        <header>
        <div class="overlay">
        <h1>Site Information page for <?php echo $_SESSION['login_user'] ?></h1>
        </div>
        </header>
        
        <section>
            
            <nav>
            
            <ul>
                <li><a href="welcome.php?index=0&clicked=0">Welcome</a></li>
                  <li><a class="active" href="siteinfo.php">Site Info</a></li>
                  <li><a href="#contact">Contact</a></li>
                  <li><a href="#about">About</a></li>
            </ul>
            </nav> 
            <!--- 2. At least 2 --->
            <div>
                <h3 style='text-align: center;'>2. Users who have posted at least two blogs</h3>
                <h4 style='text-align: center;'>One has a tag of “X,” and another has a tag of “Y”.</h4>
                <p style='text-align: center;'>(In other words, there are at least two blogs that don't share the same tags)</p><br>
                <?php
                $length = count($atLeastTwo);
                if ($length > 0) {
                    for($x=0; $x < $length; $x++) {
                        echo($atLeastTwo[$x]);
                    }
                }
            ?>
            </div>

             <!--- 3. Only Positive --->
            <div>
            <h3 style='text-align: center;'>3. All the blogs of user X</h3>
            <h4 style='text-align: center;'>Such that all the comments are positive for these blogs.</h4>
            <p style='text-align: center;'>(In other words, type a user and we will display only their blogs with only positive comments)</p><br>
            <form action="siteinfo.php" method="post">
            Enter user:<input type="text" name="enterX" value=""/>
            <input type="submit" value=">>" name="Search"/>
            </form><br>
                
            <?php
                $length = count($onlyPositive);
                if ($length > 0) {
                    for($x=0; $x < $length; $x++) {
                        echo($onlyPositive[$x]);
                    }
                }
            ?>
            </div>

            
            <!--- 4. Most Number of Blogs on date --->
            <div>
            <h3 style='text-align: center;'>4. List the users who posted the most number of blogs</h3>
            <h4 style='text-align: center;'>On 05/08/2020; if there is a tie:</h4>
            <p style='text-align: center;'>List all the users who have a tie.</p><br>
            </div>
            
            <?php
                $length = count($topUsers);
                if ($length > 0) {
                    for($x=0; $x < $length; $x++) {
                        echo($topUsers[$x]);
                    }
                }
            ?>
            
            
            <!--- 5.Users Followed By X and Y --->
            <div>
            <h3 style='text-align: center;'>5. List the users who are followed by both X and Y.</h3>
            <h4 style='text-align: center;'>Usernames X and Y are inputs from you, the user</h4>
            <p style='text-align: center;'>Please input two users below!</p><br>    
            <form action="siteinfo.php" method="post">
            Enter user 1:<input type="text" name="user1" value=""/>
            Enter user 2:<input type="text" name="user1" value=""/>
            <input type="submit" value=">>" name="Search"/>
            </form><br>
            </div>

            <!--- 6. Never Posted a Blog --->
            <div>
            <h3 style='text-align: center;'>6. Display all users</h3>
            <h4 style='text-align: center;'>Who never posted a blog</h4>
            <p style='text-align: center;'>Users below:</p><br>    
            <?php
                $length = count($neverPosted);
                if ($length > 0) {
                    for($x=0; $x < $length; $x++) {
                        echo($neverPosted[$x]);
                    }
                }
            ?>
            </div>

            <!--- 7. Never Commented on a Blog --->
            <div>
            <h3 style='text-align: center;'>7. Display all users</h3>
            <h4 style='text-align: center;'>Who have never commented on a blog</h4>
            <p style='text-align: center;'>Users below:</p><br>    
            <?php
                $length = count($neverCommented);
                if ($length > 0) {
                    for($x=0; $x < $length; $x++) {
                        echo($neverCommented[$x]);
                    }
                }
            ?>
            </div>

            <!--- 8. Comments were negative --->
            <div>
            <h3 style='text-align: center;'>8. Display all users</h3>
            <h4 style='text-align: center;'>Who have posted comments but they are all negative</h4>
            <p style='text-align: center;'>Users below:</p><br>    
            <?php
                $length = count($negativeUsers);
                if ($length > 0) {
                    for($x=0; $x < $length; $x++) {
                        echo($negativeUsers[$x]);
                    }
                }
            ?>
            </div>

            <!--- 9. Never Received Negative Comments on a Blog --->
            <div>
            <h3 style='text-align: center;'>9. Display all users</h3>
            <h4 style='text-align: center;'>Who have never received a negative comment on their blog</h4>
            <p style='text-align: center;'>Users below:</p><br>      
            <?php
                $length = count($neverReceived);
                if ($length > 0) {
                    for($x=0; $x < $length; $x++) {
                        echo($neverReceived[$x]);
                    }
                }
            ?>
            </div>

            <!--- 10. List Pairs (A,B) --->
            <div>
            <h3 style='text-align: center;'>10. List a user pair (A, B) such that:</h3>
            <h4 style='text-align: center;'>They always gave each other positive comments</h4>
            <p style='text-align: center;'>Never negative comments.</p><br>    
            <?php
                $length = count($Pairs);
                if ($length > 0) {
                    echo("<p style='text-align: center;'>User Pair: </p>");
                    for($x=0; $x < $length; $x++) {
                        echo($Pairs[$x]);  
                    }
                }
            ?>
            </div>
        </section>
    </body>
</html>
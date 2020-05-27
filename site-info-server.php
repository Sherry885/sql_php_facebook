<!--site-info-server.php will query the specified localhost database with information about users on the site-->

<?php
    include("config.php");

///////////////////
    //Part 3 Number 2//
    ///////////////////
    $users = [];
    $users2 = [];
    $sql_u = "SELECT `postuser`
            FROM `blogs`
            GROUP BY `postuser`
            HAVING COUNT(`postuser`) > 1;";
    //call on database
    $user_result = mysqli_query($db, $sql_u);
    //store the results in an array
    //need to iterate through each row in the object (assign to "row")
    while($row = $user_result->fetch_array()){
        //push to array for later - the correct row index
        array_push($users, $row['postuser']);
    }
    /*
    $users = {abanana darwindarvin himhima etc...}
                i
    */
    //now we have the users
    //loop through for each users
    for ($i = 0; $i < mysqli_num_rows($user_result); $i++) {
        //gets their own blogs array
        $blogs = [];
        //call the query for each user
        //get all their blogs so that we can compare them with each other
        $sql_b = "SELECT `blogid` FROM `blogs` WHERE `postuser`= '$users[$i]'";
        $blogs_result = mysqli_query($db, $sql_b);
        //store the results in an array
        while($row = $blogs_result->fetch_array()){
            //push to array for later - the correct row index
            array_push($blogs, $row['blogid']);
        }
                    /*
            $blogs = {1 8..}
            */
        // now that we have the blogs for each user,
        // check in blogtags to see if their respective 
        // tags are the same or not
        $b_ids = [];
        $b_tags = [];
        for ($j = 0; $j < count($blogs); $j++) {
            $sql_t = "SELECT * FROM `blogtags` WHERE `blogid`= '$blogs[$j]'";
            $tags_result = mysqli_query($db, $sql_t);            
            //store the results in an array
            while($row = $tags_result->fetch_assoc()){
                //push to array for later - the correct row index
                //hashmap, check if exists!
                array_push($b_tags, $row['tag']); 
                array_push($b_ids, $row['blogid']);
                /*
                tags = {paintings, watercolor}
                bid = {1,1}
                */
            }
             for ($x = 0; $x < count($b_ids)/2; $x++) {
                 if(count($b_ids)==1) {
                 }else {
                    $a = $x + 1;
                    if (($b_ids[$x] != $b_ids[$a]) and ($b_tags[$x] != $b_tags[$a])) {
                        if(in_array($users[$i], $users2, true)){
                        } else{
                        array_push($users2, $users[$i]);
                        //echo("User is good");
                        }
                    }
                 }
             }
        }
    }
    //Display in HTML
    $atLeastTwo = [];
    for ($x = 0; $x < count($users2); $x++) {
    $html = "<p style='text-align: center;'>$users2[$x]</p>";
        array_push($atLeastTwo, $html);
    }

//////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////
    //Part 3 Number 3//
    ///////////////////

    $blogids = [];
    $users = [];
    $subjects = [];
    $userX = [];

    //If the Search button is clicked
    if (isset($_POST['Search'])) {
  
        $userX = $_POST['enterX'];
    
        $sql_p = "SELECT `blogid` FROM `comments` WHERE `sentiment` = 'positive'";
        $result_bids = mysqli_query($db, $sql_p);

        while($row = $result_bids->fetch_array()){
            array_push($blogids, $row['blogid']);
        }

        for ($x = 0; $x < count($blogids); $x++) {

            //for each blog id, get the name of the user and push to array
            $sql_b = "SELECT `postuser`, `subject` FROM `blogs` WHERE `blogid` = '$blogids[$x]'";
            $result_positive = mysqli_query($db, $sql_b);
            while($row = $result_positive->fetch_array()){
                //push to array for later - the correct row index

                array_push($users, $row['postuser']);
                array_push($subjects, $row['subject']);
            }
        }    
    }

    //Display in HTML
    $onlyPositive = [];
    $duplicates = [];

    //At some point: could add the username to the top of the list

    for ($x = 0; $x < count($users); $x++) {
        if ($userX == $users[$x]) {
            
            if(!in_array($subjects[$x], $duplicates, true)){
                array_push($duplicates, $subjects[$x]);
                $html = "<p style='text-align: center;'>$subjects[$x]</p>";
                array_push($onlyPositive, $html);
            }
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////
    //Part 3 Number 4//
    ///////////////////

    $topUsers = [];
    $posters = []; 

    $sql_t1 = "SELECT `postuser` FROM `blogs` WHERE `postdate` = '2020-05-08' GROUP BY `postuser` HAVING COUNT(`postuser`) = 2";
    $result = mysqli_query($db, $sql_t1);

    while($row = $result->fetch_array()){
        //push to array for later - the correct row index
        array_push($posters, $row['postuser']);
    }

    if(count($posters)== 0) {

        
        $sql_t2 = "SELECT `postuser` FROM `blogs` WHERE `postdate` = '2020-05-08' GROUP BY `postuser` HAVING COUNT(`postuser`) = 1";
           
        $result2 = mysqli_query($db, $sql_t2);

        while($row = $result2->fetch_array()){
            //push to array for later - the correct row index
            array_push($posters, $row['postuser']);
        }
        
        
        //Display in HTML
        $top = [];

        for ($x = 0; $x < count($posters); $x++) {
            $html = "<p style='text-align: center;'>$posters[$x]</p>";
            array_push($topUsers, $html);
        }   
    
    
    } else{
        //Display in HTML
        $top = [];

        for ($x = 0; $x < count($posters); $x++) {
            $html = "<p style='text-align: center;'>$posters[$x]</p>";
            array_push($topUsers, $html);
        }    
    }


//////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////
    //Part 3 Number 5//
    ///////////////////

    $leaders = [];

    if(isset($_POST['UserXYSearch'])){
        
        $userX = $_POST['userX'];
        $userY = $_POST['userY'];
        
        $sql = "SELECT `leader` FROM `follows` WHERE `follower` = '$userX' AND `leader` in (SELECT `leader` FROM `follows` WHERE `follower` ='$userY');";
        
        $result_leader = mysqli_query($db, $sql_b);
        while($row = $result_leader->fetch_array()){
            array_push($leaders, $row['leader']);
        }
        

        
    }

//////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////
    //Part 3 Number 6//
    ///////////////////

    /*6.Display all the users who never posted a blog.*/

    $never = [];

    $sql_n = "SELECT `username` FROM `users` LEFT JOIN `blogs` ON `users`.`username` = `blogs`.`postuser` WHERE `blogs`.`postuser` is null;";

    $never_result = mysqli_query($db, $sql_n);

    while($row = $never_result->fetch_array()){
        //push to array for later - the correct row index
        array_push($never, $row['username']);
    }

    //Display in HTML
    $neverPosted = [];

    for ($x = 0; $x < count($never); $x++) {
        $html = "<p style='text-align: center;'>$never[$x]</p>";
        array_push($neverPosted, $html);
    }

//////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////
    //Part 3 Number 7//
    ///////////////////


    /*7.Display all the users who never posted a comment.*/
    
    $never = [];

    $sql_nc = "SELECT `username` FROM `users` LEFT JOIN `comments` ON `users`.`username` = `comments`.`author` WHERE `comments`.`author` is null;";

    $nevercommented_result = mysqli_query($db, $sql_nc);

    while($row = $nevercommented_result->fetch_array()){
        //push to array for later - the correct row index
        array_push($never, $row['username']);
    }

    //Display in HTML
    $neverCommented = [];

    for ($x = 0; $x < count($never); $x++) {
        $html = "<p style='text-align: center;'>$never[$x]</p>";
        array_push($neverCommented, $html);
    }


//8.Display all the users who posted some comments, but each of them is negative.

    ///////////////////
    //Part 3 Number 8//
    ///////////////////

    $negative = [];

    $sql_pn = "SELECT DISTINCT `author` FROM `comments` WHERE `author` NOT IN (SELECT `author` FROM `comments` WHERE `sentiment`='positive')";

    $postednegative_result = mysqli_query($db, $sql_pn);

    while($row = $postednegative_result->fetch_array()){
        /*push to array for later - the correct row index*/
        array_push($negative, $row['author']);   
    }

    /* Display in HTML*/
    $negativeUsers = [];
    for ($x = 0; $x < count($negative); $x++) {
        $html = "<p style='text-align: center;'>$negative[$x]</p>";
        array_push($negativeUsers, $html);
    } 

//9.Display those users such that all the blogs they posted so far never received any negative comments.

    ///////////////////
    //Part 3 Number 9//
    ///////////////////

    $nrnegative = [];

    $sql_nrn = "SELECT DISTINCT `postuser` FROM `blogs` WHERE `postuser` NOT IN(SELECT `postuser` FROM `blogs` LEFT JOIN `comments` ON `blogs`.`blogid` = `comments`.`blogid` WHERE `sentiment` = 'negative')";

    $neverreceivednegative_result = mysqli_query($db, $sql_nrn);

    while($row = $neverreceivednegative_result->fetch_array()){
        //push to array for later - the correct row index
        array_push($nrnegative, $row['postuser']);
    }

    //Display in HTML
    $neverReceived = [];
    for ($x = 0; $x < count($nrnegative); $x++) {
        $html = "<p style='text-align: center;'>$nrnegative[$x]</p>";
        array_push($neverReceived, $html);
    }
    /*10. List a user pair (A, B) such that they always gave each other positive comments,
    never negative comments.*/
    ////////////////////
    //Part 3 Number 10//
    ////////////////////
    $authors = [];
    $blog = [];
    $sameblog =[];
    $pairs = [];
    $postuser = "";
    $test = [];
    $sql_cap = "SELECT `author`, `blogid` FROM `comments` WHERE `sentiment` = 'positive';";
    $result = mysqli_query($db, $sql_cap);
    while($row = $result->fetch_array()){
        array_push($authors, $row['author']);
        array_push($blog, $row['blogid']);
    }
    //print_r($authors);
    //print_r($blog);
    //For each blog-id in $blog, find the post-user associated
    for ($x = 0; $x < count($blog); $x++){
        //1. From this we want to get the post-user list and see if they ever posted a comment.
        // Get the post user of the positively commented blog
        $sql_postuser = "SELECT `postuser` FROM `blogs` WHERE `blogid` = '$blog[$x]';";
        //echo("<br>");
        $result_postu = mysqli_query($db, $sql_postuser);
        while($row = $result_postu->fetch_array()){
            //push to array for later - the correct row index
            $postuser = $row['postuser'];
            //echo($postuser);
        }        
        //2. for each of these users - now in comments - (remember, we're still on one of the blog ids for example still), check if they ever commented in comments.
        for ($i = 0; $i < count($authors); $i++){
            if(in_array($postuser, $authors, true)){
                $sql_alsocommented = "SELECT `blogid` FROM `comments` WHERE `author` = '$postuser' AND `sentiment` = 'positive';";
                $result_blg = mysqli_query($db, $sql_alsocommented);
                while($row = $result_blg->fetch_array()){
                    //push to array for later - the correct row index
                    array_push($sameblog, $row['blogid']);
                    $test =$row['blogid'];
                    // If there is a user from author where blog id == a blog id in here, then we're good
                    
                    //3. Now we have the blog ids of the people for which positive comments were made and they made a comment for someone. We need to check who that someone is now.
                    $sql_pair = "SELECT `postuser` FROM `blogs` WHERE `blogid` = '$test' AND `postuser` = '$authors[$x]';";
                    $result = mysqli_query($db, $sql_pair);
                    //store the results in an array
                    //need to iterate through each row in the object (assign to "row")
                    while($row = $result->fetch_array()){
                        //push to array for later - the correct row index
                        array_push($pairs, $row['postuser']);
                        array_push($pairs, $postuser);
                    }
                }
            }
        }
    }
    
    //print_r($pairs);
    $finalpairs =[];
    $prohibited = [];
    $compare = [];
    //4. Prohibited List (users who at least made a negative comment about someone else)
    $sql = "SELECT `author`, `postuser` FROM `comments`, `blogs` WHERE `sentiment` = 'negative' AND `comments`.`blogid` = `blogs`.`blogid`;";
    $result = mysqli_query($db, $sql);
    while($row = $result->fetch_array()){
        array_push($compare, $row['author']);
        array_push($compare, $row['postuser']);
    }
    
    //like for like
    for ($x=0; $x < count($pairs) / 2; $x++){
        $blogger1 = $pairs[$x];
        $blogger2 = $pairs[$x+1];
        for ($y=0; $y < count($compare)/2; $y++){
            if($blogger1==$compare[$y] and $blogger2== $compare[$y+1]){
                $badpair = [$blogger1, $blogger2];
                array_push($prohibited, $badpair);
            }
            else{
                if(!in_array([$blogger1, $blogger2], $finalpairs, true)){
                    array_push($finalpairs, [$blogger1, $blogger2]);
                }
            }
        }
    }
    
    //backwards
    for ($x=0; $x < count($pairs) / 2; $x++){
        $blogger1 = $pairs[$x];
        $blogger2 = $pairs[$x+1];
        for ($y=0; $y < count($compare)/2; $y++){
            if($blogger2==$compare[$y] and $blogger1== $compare[$y+1]){
                $badpair = [$blogger2, $blogger1];
                array_push($prohibited, $badpair);
            }
            else{
                if(!in_array([$blogger2, $blogger1], $finalpairs, true)){
                    array_push($finalpairs, [$blogger2, $blogger1]);
                }
            }
        }
    }
    //Display in HTML
    $Pairs = [];
    for ($x = 0; $x < count($finalpairs)/2; $x++) {
        foreach($finalpairs[$x] as &$a) {
            $html = "<p style='text-align: center;'>($a,)</p>";
        }
        array_push($Pairs, $html);
    }


?>

<?php
        $blogArray = [];   
        $blogSubjects = [];
        $blogDescriptions =[];
        $blogUsers = [];
        $blogDates  = [];
        $content = [];
        $i = $_GET['index'];


    //If the Search button is clicked
    if (isset($_POST['Search'])) {
        $taggings = mysqli_real_escape_string($db, $_POST['Searchtags']);
        $delimiter = " ";
        $tags = explode($delimiter, $taggings);

        
        //for each tag in the array,
        //obtain the blog-id number associated with it
        foreach ($tags as &$value) {
            $sql = "SELECT `blogid`  FROM `blogtags` WHERE `tag` = ('$value')";
            $result = mysqli_query($db, $sql);
            
            //need to iterate through each row in the object (assign to "row")
            while($row = $result->fetch_array()){
                //push to array for later - the correct row index
                array_push($blogArray, $row['blogid']);
                //print_r($row['blog-id']);
                $_SESSION['blogId'] = $row['blogid'];
            }
        }
        
        //for debugging purposes
        //echo json_encode($blogArray);
        //print_r($blogArray);
        
        
        //for each blog-id in the array, push to blog_description array for displaying
        foreach ($blogArray as &$v) {
            $sql = "SELECT `subject`, `description`, `postuser`, `postdate` FROM `blogs` WHERE `blogid` = ('$v')";
            
            //returns a mysqli Object
            $result = mysqli_query($db, $sql);

            //need to iterate through each row in the object (assign to "row")
            while($row = $result->fetch_array()){
                //since this is chronological, they will
                //all share the same index
                array_push($blogSubjects, $row["subject"]);
                array_push($blogDescriptions, $row["description"]);
                array_push($blogUsers, $row["postuser"]);
                array_push($blogDates, $row["postdate"]);
            }
            
            //Session variables (Arrays) so that we can use the info in comments.php
            // to determine which blog we should be inserting into
            $_SESSION['blogSubjects'] = $blogSubjects;
            $_SESSION['blogDescriptions'] = $blogDescriptions;
            $_SESSION['blogUsers'] = $blogUsers;
            $_SESSION['blogDates'] = $blogDates;

        }

        //Number of blogs with the given tags
        $len = count($blogDates);
        
        // List the blogs in HTML
        if(mysqli_num_rows($result) > 0){
            for ($i = 0; $i < $len; $i++) {
                
                $number = $i +1;
                
            //show the list of blogs for commenting
            $html = "<h2>$number. <a href='welcome.php?index=$i&clicked=1'>$blogSubjects[$i]</a></h2>";
                array_push($content, $html);
                $number = 0;

            }
        }   
    }


    //Once the search button has been pressed, now we want to ADD a comment to a blog.
    //Select one of the blogs
    //refresh the page with the right number selected
    //display in html all the code we had before
    if ($_GET['clicked'] == 1) {

        $blgID = $_SESSION['blogId'];
        $sub = $_SESSION['blogSubjects'][$i];
        $des = $_SESSION['blogDescriptions'][$i];
        $usr = $_SESSION['blogUsers'][$i];
        $dat = $_SESSION['blogDates'][$i];
        
        $c_usr = $_SESSION['login_user'];
        $c_dat = date("Y-m-d");

    $html = "
        <style>
        .dropbtn {
          background-color: #4CAF50;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
        }

        .dropdown {
          position: relative;
          display: inline-block;
        }

        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .dropdown-content a:hover {background-color: #ddd;}

        .dropdown:hover .dropdown-content {display: block;}

        .dropdown:hover .dropbtn {background-color: #3e8e41;}
        </style>

    <div style='border: hidden;'>
    <div style='border: 2px solid black; padding: 5px; text-align: center;'>
        <p>$dat</p><h2><a href='welcome.php'>$sub</a></h2><p>written by $usr</p><br><p>$des</p>
        <div>
        <h2>Comment</h2>
        <form action='' method='post'>
            <textarea type='text' name='CommentText' rows='7' placeholder='Write your comment here.'></textarea>
            <input type='submit' value='>>' name='CommentSubmit'/>
        <div class = 'dropdown'>
        <label class = 'dropbtn' for='sentiment'>Choose a sentiment:</label>
        <div class = 'dropdown-content'>
        <select id='sentiment' name='Sentiment'>
            <option value='positive'>Positive</option>
            <option value='negative'>Negative</option>
        </select>
        </div>
        </div>
        </form>
    </div>
    </div>

    ";
    $content = [];
    array_push($content, $html);

    //Once the submit button has been pushed for a comment...
    if (isset($_POST['CommentSubmit'])) {
                
        $blogcomment = mysqli_real_escape_string($db, $_POST['CommentText']);
        $blogsentiment = mysqli_real_escape_string($db, $_POST['Sentiment']);
        $commentsql = "INSERT INTO `comments` (`commentid`, `sentiment`, `description`, `commentdate`, `blogid`, `author`) VALUES (NULL, '$blogsentiment', '$blogcomment', '$c_dat', '$blgID', '$c_usr')";
        
        mysqli_query($db, $commentsql);
        
        header("location: welcome.php?index=0&clicked=0");

    }
    }
?>
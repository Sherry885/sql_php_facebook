<!--Include initialize.php to connect and query the localhost database-->
<?php
    include("blog-submission-server.php");
    include("initialize.php");
    include("search-server.php");
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
        <h1>Welcome, <?php echo $_SESSION['login_user'] ?>!</h1>
        </div>
        </header>
        
        <section>
            <nav>
            <ul>
                <li><a class="active" href="welcome.php?index=0&clicked=0">Welcome</a></li>
                  <li><a href="siteinfo.php">Site Info</a></li>
                  <li><a href="#contact">Contact</a></li>
                  <li><a href="#about">About</a></li>
            </ul>
            </nav>    
            
        <section class="search-blogs">
            <h3 style="text-align: center;">Search for blog posts</h3>
            <form action="welcome.php?index=0&clicked=0" method="post">
                Enter tags:<input type="text" name="Searchtags" value="">
                <input type="submit" value=">>" name="Search"/>
            </form>

            <!---Output the blog posts for the given tags--->
            <?php
                    $length = count($content);
                    if ($length > 0) {
                        for($x=0; $x < $length; $x++) {
                            echo($content[$x]);
                        }
                    }
            ?>
        </section>
            
        <section class="blog-posts">
            
            <h1>Your Blog Posts</h1>
            
            <form id="myform" action="" method="post">
              <span id="result"></span>

              <h2>New Post</h2>
              <!---Subject--->

              <div .button>
                <input name="subject" type="text" placeholder="Subject" />
              </div>

              <!---Blog text--->
              <div>
                <textarea
                  name="textarea"
                  rows="7"
                  placeholder="Write your blog here"
                ></textarea>
              </div>

              <!---Tags--->
              <div><h3>Add tags for your post here. Press space to separate tags:</h3></div>
              <div class="container">
                <div class="tag-container">
                  <input name="tags" />
                </div>
              </div>

              <!---Submit button--->
              <div class="button">
                <input type="submit" name="Submit" value="Submit" id="submit" />
              </div>
            </form>


            <section>
                <div class="row">
                    <div class="leftcolumn">
                        <h2>Past Posts</h2>
                        
                        <!---CARD 1--->                        
                        <div class="card">    
                            <!---pull from database--->
                            <h2>SUBJECT</h2>
                            <h5>Post date: </h5>
                            
                            <div class="fakeimg" style="height:200px;">description</div>
                            <p>Some text..</p>
                        </div>
                        
                        <!---CARD 2--->                        
                        <div class="card">
                            <h2>TITLE HEADING</h2>
                            <h5>Title description, Sep 2, 2017</h5>
                            <div class="fakeimg" style="height:200px;">Image</div>
                            <p>Some text..</p>
                        </div>
                    </div>
                    
                    
                    <div class="rightcolumn">
                        
                        <!---CARD 3--->                        
                        <div class="card">
                            <h2>About Me</h2>
                            <div class="fakeimg" style="height:100px;">Image</div>
                            <p>My hobbies</p></div>
                        
                        <!---CARD 4--->  
                        <div class="card">
                            <h3>Popular Posts</h3>
                            <div class="fakeimg">Image</div><br>
                            <div class="fakeimg">Image</div><br>
                            <div class="fakeimg">Image</div>
                        </div>
                        
                        <!---CARD 5--->                        
                        <div class="card">
                            <h3>Follow Me</h3>
                            <p>Text</p>
                        </div>
                    </div>
                </div>
            </section>
            
        </section>
        
        <div class="footer">
            <form method="POST" action="">
            <input type= "submit" name="button" value="Generate Database"></form>
        </div>
        
        </section>
    </body>
</html>
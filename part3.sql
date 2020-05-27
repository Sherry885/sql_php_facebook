/*part 2 bugs
1. bug natalie said in 
2. trigger, insert 3 comments bug not on user's post
3. error message
---------------------------------
part 3(change post-user to post_user)

/*2. List the users who post at least two blogs, one has a tag of “X,” and another has a tag of “Y”. */
SELECT blogid 
FROM blogs 
WHERE postuser= '$users[$i]';

/*3. List all the blogs of user X, such that all the comments are positive for these blog*/
SELECT blogid 
FROM comments 
WHERE sentiment = 'positive';

/*4. List the users who posted the most number of blogs on 2/10/2020; if there is a tie, list all the users who have a tie*/
SELECT postuser 
FROM blogs 
WHERE postdate = '2020-04-10' 
GROUP BY postuser 
HAVING COUNT(postuser) = 2;

SELECT postuser 
FROM blogs 
WHERE postdate = '2020-04-10' 
GROUP BY postuser 
HAVING COUNT(postuser) = 1;

/*5. List the users who are followed by both X and Y. Usernames X and Y are inputs from the user*/
SELECT leader 
FROM follows 
WHERE follower = '$userX' 
AND leader 
IN (SELECT leader 
    FROM follows 
    WHERE follower ='$userY');

/*6.Display all the users who never posted a blog.*/
SELECT username 
FROM users 
LEFT JOIN blogs ON users.username = blogs.postuser 
WHERE blogs.postuser is null;

/*7.Display all the users who never posted a comment. */
SELECT username 
FROM users 
LEFT JOIN comments ON users.username = comments.author 
WHERE comments.author is null;

/*8.Display all the users who posted some comments, but each of them is negative.*/
SELECT DISTINCT author
FROM comments
WHERE author 
NOT IN(
    SELECT author
    FROM comments
    WHERE sentiment='positive')

-- 9.Display those users such that all the blogs they posted so far never received any negative comments. */
SELECT DISTINCT blogs.postuser
FROM blogs 
WHERE blogs.postuser
NOT IN(
    SELECT blogs.postuser
    FROM blogs 
    LEFT JOIN comments ON blogs.blogid = comments.blogid
    WHERE sentiment='negative')

/*10. List a user pair (A, B) such that they always gave each other positive comments, never negative comments*/
SELECT author, blogid 
FROM comments 
WHERE sentiment = 'positive';

SELECT postuser 
FROM blogs 
WHERE blogid = '$blog[$x]';

SELECT blogid 
FROM comments 
WHERE author = '$postuser' 
AND sentiment='positive';

SELECT postuser 
FROM blogs 
WHERE blogid = '$sameblog[$x]' 
AND postuser = '$authors[$x]';

SELECT author, postuser 
FROM comments, blogs 
WHERE sentiment = 'negative' 
AND comments.blogid = blogs.blogid;
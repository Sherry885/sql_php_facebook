# sql_php_facebook
Description 
Consider the design of the following database system for managing a social network website: each user is registered with the website with a username, password, first name, last name, and an email. Username and email are unique. Each user is associated with a list of hobbies, selected from the following list: hiking, swimming, calligraphy, bowling, movie, cooking, and dancing. A user can follow a list of other users and can also be followed by another list of users. See https://steemit.com/ for an example.  Moreover, a user can post a blog, modify the blog, and delete it afterward. Given a blog, another user, and only another user can give a comment to the blog, modify the comment, or delete the comment afterward. To ensure the quality of the website, each user can post at most 2 blogs a day, and each user can give at most 3 comments in one day. For each blog, the user who posted the blog cannot give any comment (no self-comment), and another user can give at most one comment. Each blog is identified by a blogid, subject, description, and a list of tags for search purposes. Each comment is identified by a commentid, a sentiment (positive or negative), and a description. 
 
For all parts of this project, your system must be application or web-based. Some simple GUI interfaces are required for each functionality. All functionality must be performed via the interface of your system, direct SQL statement execution via any tools (e.g., MySQL workbench) is not allowed.  

Part 1 – Deadline:  Friday, 04/03 by midnight Use Java/C#/PHP/Python and SQL, implement the following functionality: 
1. Implement a user registration and login interface so that only a registered user can login into the system. You have to prevent the SQL injection attack.  
2. Implement a button called “Initialize Database”. When a user clicks it, all necessary tables will be created (or recreated) automatically, with each table be populated with at least 10 tuples so that each query below will return some results. All students should use the username “john”, and password “pass1234”.  

Part 2: Deadline: ~2 Weeks – Thursday, 04/16 by 2:00 PM Based on part 1, implement the following functionality using your programming language and SQL with necessary GUI interfaces. Part 2 emphasizes the programming of GUI interfaces and design and their integration with database operations.   
1. Complete the E-R diagram (we will discuss it in the class) 
2. Implement a GUI interface so that a user can insert a blog such as               
          Subject: The future of blockchain              
          Description: Blockchain is a buzz word nowadays. …              
          Tags: blockchain, bitcoin, decentralized 
   The ids of the blogs should be generated automatically using the autoincrement feature of MySQL. Make sure that a user can only insert 2 blogs a day. 
3. Implement a search interface as a form so that after one type in a tag, all the blogs with that tag are returned. The result needs to be shown as a table/list in a page. 
4. Select a blog from the above list; one can write a comment like the following:  A dropdown menu to choose “Negative” or “positive,” and then a description such as “This is a nice blog. I like the comparison between blockchain and the Internet.”. Make sure that a user can give at most 3 comments a day and, at most, one comment for each blog and not to his own blog. 

Part 3: Deadline: 2 weeks – Thursday 04/30 by 2:00 PM Based on part 1 & part 2, implement the following functionality using Java and SQL with necessary GUI interfaces. Part 3 emphasizes both the GUI interfaces and their integration with backend database operations.    
1. Sign up for a new user with information such as: username, password, password confirmed, first name, last name, email. Duplicate username, and email should be detected and fail the signup. Unmatching passwords should be detected, as well. 
2. List the users who post at least two blogs, one has a tag of “X,” and another has a tag of “Y”.  
3. List all the blogs of user X, such that all the comments are positive for these blogs.  
4. List the users who posted the most number of blogs on 2/10/2020; if there is a tie, list all the users who have a tie. 
5. List the users who are followed by both X and Y. Usernames X and Y are inputs from the user. 
6. Display all the users who never posted a blog. 
7. Display all the users who never posted a comment. 
8. Display all the users who posted some comments, but each of them is negative. 
9. Display those users such that all the blogs they posted so far never received any negative comments. 
10. List a user pair (A, B) such that they always gave each other positive comments, never negative comments. 

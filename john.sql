use `john`;

DROP TABLE IF EXISTS `users`;

/*Create the user table*/
CREATE TABLE `users`(`username` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `password` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci, `firstname` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci, `lastname` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci, `email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY (`username`), UNIQUE (`email`, `username`)) ENGINE = InnoDB;

LOCK TABLES `users` WRITE;
INSERT INTO `users` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES ('abanana123', 'bob', 'alice', 'broadbet', 'alicebroadbet@gmail.com'), ('hanwam', 'coffeelove12', 'hannah', 'western', 'hannahamawestern@gmail.com'), ('bennyandthejets', 'wimblewomble', 'benjamin', 'jensen', 'benjensen@gmail.com'), ('mermer22', 'ilovetea123', 'merly', 'sigrah', 'merleysigrah@yahoo.com'), ('javi_vel', 'hikingmtns', 'javier', 'velez', 'jvelez@gmail.com'), ('himahima', 'planplan345', 'himari', 'sato', 'himarisato@yahoo.com'), ('darwindarvin', 'casesens1t1ve', 'Darvin', 'Darbandi', 'ddarbani@gmail.com'), ('rrrmy_12', 'acfrog43TRz62', 'Remy', 'Mauran', 'rrrmy@pm.me'), ('laurejean', 'gateauxetthe', 'laura-emma', 'jeanjean', 'laura-emmajeanjean@yahoo.fr'), ('meimei_', 'orangegrove', 'meilin', 'wu', 'meilinwu@gmail.com');
UNLOCK TABLES;

DROP TABLE IF EXISTS `hobbies`;

/*Create the hobbies table*/
CREATE TABLE `hobbies` (`username` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci, `hobby` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci, PRIMARY KEY (`username`, `hobby`), FOREIGN KEY (`username`) REFERENCES `users`(`username`)) ENGINE = InnoDB;

LOCK TABLES `hobbies` WRITE;
INSERT INTO `hobbies` (`username`, `hobby`) VALUES ('abanana123', 'painting'),('hanwam', 'painting'),('bennyandthejets', 'cooking'),('mermer22', 'guitar'),('javi_vel', 'hiking'),('himahima', 'guitar'),('darwindarvin','Netflix'),('rrrmy_12', 'puzzles'),('laurejean', 'dancing'),('meimei_', 'guitar');
UNLOCK TABLES;

DROP TABLE IF EXISTS `follows`;

/*Create the follows table*/
CREATE TABLE `follows` (`leader` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci, `follower` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci, PRIMARY KEY (`leader`, `follower`), FOREIGN KEY (`leader`) REFERENCES `users`(`username`), FOREIGN KEY (`follower`) REFERENCES `users`(`username`)) ENGINE = InnoDB;

LOCK TABLES `follows` WRITE;
INSERT INTO `follows` (`leader`, `follower`) VALUES ('abanana123', 'javi_vel'),('hanwam', 'himahima'),('bennyandthejets', 'himahima'),('mermer22', 'bennyandthejets'),('javi_vel', 'abanana123'),('himahima', 'abanana123'),('darwindarvin','mermer22'),('rrrmy_12', 'laurejean'),('laurejean', 'bennyandthejets'),('meimei_', 'bennyandthejets');
UNLOCK TABLES;

DROP TABLE IF EXISTS `blogs`;

/*Create the blogs table*/
CREATE TABLE `blogs` (`blogid` INT NOT NULL AUTO_INCREMENT, `subject` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci, `description` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci, `postuser` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `postdate` DATE NOT NULL, PRIMARY KEY (`blogid`), FOREIGN KEY (`postuser`) REFERENCES `users`(`username`)) ENGINE = InnoDB;

LOCK TABLES `blogs` WRITE;
INSERT INTO `blogs` (`blogid`, `subject`, `description`, `postuser`, `postdate`) VALUES ('1', 'watercolor paints', 'I enjoy using watercolors because it makes the blending process easier', 'abanana123', '2020-04-10');
INSERT INTO `blogs` (`blogid`, `subject`, `description`, `postuser`, `postdate`) 
             VALUES ('2', 'subject 2', 'post 2', 'abanana123', '2020-04-10'),
                    ('3', 'subject 3', 'post 3', 'hanwam', '2020-05-04'),
                    ('4', 'subject 4', 'post 4', 'bennyandthejets', '2020-05-04'),
                    ('5', 'subject 5', 'post 5', 'abanana123', '2020-05-04'),
                    ('6', 'subject 6', 'post 6', 'hanwam', '2020-05-08'),
                    ('7', 'subject 7', 'post 7', 'bennyandthejets', '2020-05-08');
UNLOCK TABLES;

DROP TABLE IF EXISTS `blogtags`;

/*Create the blogtags table*/
CREATE TABLE `blogtags` (`blogid` INT NOT NULL, `tag` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY (`blogid`, `tag`), FOREIGN KEY (`blogid`) REFERENCES `blogs`(`blogid`)) ENGINE = InnoDB;

LOCK TABLES `blogtags` WRITE;
INSERT INTO `blogtags` (`blogid`, `tag`) VALUES ('1', 'paintings'),('1', 'watercolor'),('1', 'picasso'), ('2', 'tree'), ('2', 'birdfeeder'), ('3', 'soda'), ('3', 'applejuice'), ('5', 'elephant'), ('5', 'mouse'), ('7', 'scarf'), ('7', 'blanket'), ('7', 'elephant');
UNLOCK TABLES;

DROP TABLE IF EXISTS `comments`;

/*Create the comments table*/
/*Could only create 'author' as column name for foreign key contraint such that th requirement must be fulfilled: same collation must be used*/
CREATE TABLE `comments` (`commentid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `sentiment` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci, `description` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci, `commentdate` DATE NOT NULL, `blogid` INT NOT NULL, `author` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, FOREIGN KEY(`blogid`) REFERENCES `blogs`(`blogid`), FOREIGN KEY(`author`) REFERENCES `users`(`username`)) ENGINE = InnoDB;

LOCK TABLES `comments` WRITE;
INSERT INTO `comments` (`commentid`, `sentiment`, `description`, `commentdate`, `blogid`, `author`) VALUES ('1', 'positive', 'great post! I would like to paint a mountain!', '2020-04-14', '1','javi_vel');
INSERT INTO comments (`commentid`, `sentiment`, `description`, `commentdate`, `blogid`, `author`) 
              VALUES ('2', 'positive', ' comment 2', '2020-04-14', '3','abanana123'),
                     ('3', 'positive', ' comment 3', '2020-04-14', '4','abanana123'),
                     ('4', 'positive', ' comment 4', '2020-05-04', '2','hanwam'),
                     ('5', 'positive', ' comment 5', '2020-05-05', '4','hanwam'),
                     ('6', 'positive', ' comment 6', '2020-05-06', '6','abanana123'),
                     ('7', 'negative', ' comment 7', '2020-05-07', '3','bennyandthejets'),
                     ('8', 'positive', ' comment 8', '2020-05-08', '4','hanwam'),
                     ('9', 'negative', ' comment 9', '2020-05-08', '5','bennyandthejets');
UNLOCK TABLES;


DROP TRIGGER IF EXISTS `tr_AddToBlogs_Constraint`;
/* Define Trigger for Blog Constraints*/
DELIMITER $$
CREATE DEFINER =`John`@`localhost`
TRIGGER `tr_AddToBlogs_Constraint`
BEFORE INSERT ON `john`.`blogs`
FOR EACH ROW
BEGIN
	DECLARE rowcount INT;
    SELECT COUNT(*) INTO rowcount
    FROM `blogs`
    WHERE `postuser` = new.`postuser` AND `postdate` = CURDATE();
    IF rowcount >= 2
        THEN
            DELETE FROM `blogs` WHERE `postuser` = new.`postuser`;
    END IF ;
END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_LimitCommentsPerDay`;
/* Define Trigger for Blog Constraints*/
DELIMITER $$
CREATE DEFINER =`John`@`localhost`
TRIGGER `tr_LimitCommentsPerDay`
BEFORE INSERT ON `john`.`comments`
FOR EACH ROW
BEGIN
	DECLARE rowcount INT;
    SELECT COUNT(*) INTO rowcount
    FROM `comments`
    WHERE `author` = new.`author` AND `commentdate` = CURDATE();
    IF rowcount >= 3
        THEN
            DELETE FROM `comments` WHERE `author` = new.`author`;
    END IF ;
END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_LimitCommentsPerBlog`;
/* Define Trigger for Blog Constraints*/
DELIMITER $$
CREATE DEFINER =`John`@`localhost`
TRIGGER `tr_LimitCommentsPerBlog`
BEFORE INSERT ON `john`.`comments`
FOR EACH ROW
BEGIN
	DECLARE rowcount INT;
    SELECT COUNT(*) INTO rowcount
    FROM `comments`,`blogs`
    WHERE `blogs`.`postuser` = new.`author` AND `comments`.`commentdate` = CURDATE() AND `comments`.`blogid` = new.`blogid`;
    IF rowcount >= 1
        THEN
            DELETE FROM `comments` WHERE `author` = new.`author`;
    END IF ;
END$$
DELIMITER ;
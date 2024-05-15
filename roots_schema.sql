CREATE DATABASE roots_db;
USE roots_db;

CREATE TABLE users
(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    reg_no VARCHAR(50) UNIQUE,
    username VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    pwd VARCHAR(200),
    profile_picture VARCHAR(255) DEFAULT 'default_user.jpg',
    user_type INT NOT NULL
);


CREATE TABLE post
(
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT,
    cover_image VARCHAR(255) DEFAULT 'default.jpg',
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


CREATE TABLE post_like
(
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    liked_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (post_id) REFERENCES post(post_id)
);


CREATE TABLE comment
(
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    content TEXT,
    commented_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES post(post_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


ALTER TABLE users
    MODIFY COLUMN user_type ENUM ('alumni', 'current_student') NOT NULL;


--
-- Dumping data for table the tables
--

INSERT INTO users (reg_no, username, email, pwd, profile_picture, user_type)
VALUES ('2020331022', 'Shafa', 'shafa@example.com', 'shafa123', 'shafa_profile.jpg', 'current_student'),
       ('2020331072', 'Chonchol', 'fusitivechonchol@gmail.com', 'chonchol123', 'chonchol_profile.jpg', 'current_student'),
       ('2020331054', 'Sazia', 'sazia@example.com', 'sazia123', 'sazia_profile.jpg', 'current_student'),
       ('2017331064', 'Sajib', 'sajib@example.com', 'sajib123', 'Sajib_profile.jpg', 'alumni');


INSERT INTO post (userid, content, cover_image)
VALUES (1, 'Excited to join SUST CSE Department!', 'post_image1.jpg'),
       (2, 'First day at SUST CSE Department!', 'post_image2.jpg'),
       (3, 'Another semester begins at SUST CSE Department!', 'post_image3.jpg'),
       (4, 'Throwback to my time at SUST CSE Department!', 'post_image4.jpg');


INSERT INTO post_like(user_id, post_id)
VALUES (2, 1),
       (3, 2),
       (1, 3),
       (4, 1);

INSERT INTO comment (post_id, user_id, content)
VALUES (1, 3, 'Welcome to SUST CSE, Shafa!'),
       (2, 1, 'Hope you have a great start, Chanchal!'),
       (3, 2, 'Best of luck, Sazia!'),
       (4, 4, 'Good times, Sajib!');


ALTER TABLE users
    ADD COLUMN last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

DELIMITER //

CREATE TRIGGER update_user_last_modified
    BEFORE UPDATE
    ON users
    FOR EACH ROW
BEGIN
    SET NEW.last_modified = CURRENT_TIMESTAMP;
END//

DELIMITER ;


CREATE FUNCTION likeCountByPostID(post_id INT)
    RETURNS INT
    READS SQL DATA
    DETERMINISTIC
BEGIN
    DECLARE total_likes INT;

    SELECT COUNT(*) INTO total_likes
    FROM post_like
    WHERE post_id = post_id;

    RETURN total_likes;
END;

CREATE USER 'amjonota'@'%' IDENTIFIED BY '12345678';
GRANT SELECT ON roots_db.* TO 'amjonota'@'%';

CREATE USER 'sir'@'10.100.32.71' IDENTIFIED BY 'iamsir';
GRANT SELECT, INSERT, UPDATE, DELETE ON roots_db.* TO 'sir'@'10.100.32.71';






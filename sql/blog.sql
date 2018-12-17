/**
 * Author:  Reinier
 * Created: Jan 29, 2018
 */


CREATE DATABASE reymillenium_blog
    DEFAULT CHARACTER SET utf8;


USE reymillenium_blog;


CREATE TABLE users (

        user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

	user_firstname VARCHAR(255) NOT NULL,
	user_secondname VARCHAR(255) NULL,
	user_lastname VARCHAR(255) NOT NULL,
	user_email VARCHAR(255) NOT NULL UNIQUE,
	user_password VARCHAR(255) NOT NULL,

	user_phone BIGINT NOT NULL UNIQUE,
	user_gender VARCHAR(24) NOT NULL,
	
	user_is_active BOOLEAN NOT NULL DEFAULT TRUE,
	user_kind VARCHAR(64) NOT NULL,
	user_creation_date DATETIME NOT NULL,
	user_image VARCHAR(255) NULL

);


CREATE TABLE posts (

        post_id INT NOT NULL AUTO_INCREMENT,

        post_author_id INT NOT NULL,

        post_url VARCHAR(255) NOT NULL UNIQUE,
        post_title VARCHAR(255) NOT NULL,
        post_text TEXT CHARACTER SET utf8 NOT NULL,
        post_is_active BOOLEAN NOT NULL,
        post_creation_date DATETIME NOT NULL, 

            PRIMARY KEY (post_id),

            FOREIGN KEY (post_author_id)
                REFERENCES users(user_id) 
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT

);


CREATE TABLE comments (

        comment_id INT NOT NULL UNIQUE AUTO_INCREMENT,

        comment_author_id INT NOT NULL,
        comment_post_id INT NOT NULL,

        comment_title VARCHAR(255) NOT NULL,
        comment_text TEXT CHARACTER SET utf8 NOT NULL,
        comment_creation_date DATETIME NOT NULL,

            PRIMARY KEY (comment_id),

            FOREIGN KEY (comment_author_id)
                REFERENCES users(user_id)
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT,

            FOREIGN KEY (comment_post_id)
                REFERENCES posts(post_id)
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT

);

CREATE TABLE password_recoveries (
        
        password_recovery_id INT NOT NULL UNIQUE AUTO_INCREMENT,

        password_recovery_author_id INT NOT NULL,

        password_recovery_secret_url VARCHAR(255) NOT NULL,
        password_recovery_creation_date DATETIME NOT NULL,

            PRIMARY KEY (password_recovery_id),

            FOREIGN KEY (password_recovery_author_id)
                REFERENCES users(user_id)
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT

);

CREATE TABLE dirty_words (
        
        dirty_word_id INT NOT NULL UNIQUE AUTO_INCREMENT,

        dirty_word_name VARCHAR(255) NOT NULL,
        dirty_word_language VARCHAR(5) NOT NULL,

            PRIMARY KEY (dirty_word_id)

);



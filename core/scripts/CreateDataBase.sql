-- Script de création des tables du coeur du framework
-- Il est nécessaire pour tous les modules

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS user, profession, keyword, page, menu_block;
DROP TRIGGER IF EXISTS page_created;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE user (
  user_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  user_mail VARCHAR(128) NOT NULL,
  user_fname VARCHAR(64) NOT NULL,
  user_lname VARCHAR(64) NOT NULL,
  user_password BINARY(20) NOT NULL,
  user_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_website VARCHAR(128) NULL,
  profession_id INTEGER UNSIGNED NULL,
  hash_validation VARCHAR(40) NULL,
  user_active TINYINT(1) NOT NULL DEFAULT 0,
  CONSTRAINT pk_user PRIMARY KEY (user_id),
  CONSTRAINT uk_user_mail UNIQUE (user_mail)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE profession (
  profession_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  profession_name VARCHAR(128) NOT NULL ,
  CONSTRAINT pk_profession PRIMARY KEY (profession_id),
  CONSTRAINT u_profession_name UNIQUE (profession_name)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE keyword (
  keyword_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  keyword_name VARCHAR(32) NOT NULL,
  CONSTRAINT pk_keyword PRIMARY KEY (keyword_id),
  CONSTRAINT uk_keyword_name UNIQUE (keyword_name)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci; -- ATTENTION : utf8_bin sensible casse + accentuation // utf8_general_ci insensible

CREATE TABLE page (
  page_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  page_title VARCHAR(128) NOT NULL,
  page_content TEXT NOT NULL,
  page_created TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  page_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  user_id INTEGER UNSIGNED NULL,
  page_rewrite_url VARCHAR(128) NOT NULL,
  CONSTRAINT pk_page PRIMARY KEY (page_id),
  CONSTRAINT uk_page_rewrite_url UNIQUE (page_rewrite_url)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TRIGGER page_created BEFORE INSERT ON page FOR EACH ROW SET NEW.page_created = CURRENT_TIMESTAMP;

CREATE TABLE menu_block (
  menu_block_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  menu_block_title VARCHAR(128) NOT NULL,
  menu_block_link VARCHAR(128) NOT NULL,
  CONSTRAINT pk_menu_block PRIMARY KEY (menu_block_id),
  CONSTRAINT uk_menu_block_title UNIQUE (menu_block_title)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- FOREIGN KEYS
ALTER TABLE user ADD CONSTRAINT fk_user_profession FOREIGN KEY (profession_id) REFERENCES profession(profession_id) ON DELETE SET NULL;

ALTER TABLE page ADD CONSTRAINT fk_page_user FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE SET NULL;
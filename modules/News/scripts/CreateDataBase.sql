-- Script de création des tables du module de news
-- Nécessite le module de galerie

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS news, news_categ, news_keyword;
DROP TRIGGER IF EXISTS news_created;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE news (
  news_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  news_title VARCHAR(128) NOT NULL,
  news_content TEXT NOT NULL,
  news_created TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  news_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  news_categ_id INTEGER UNSIGNED NULL,
  user_id INTEGER UNSIGNED NULL,
  galerie_id INTEGER UNSIGNED NULL,
  news_image_url VARCHAR(255) NULL,
  news_active TINYINT(1) NOT NULL DEFAULT 0,
  CONSTRAINT pk_news PRIMARY KEY (news_id),
  CONSTRAINT uk_news_image_url UNIQUE (news_image_url)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TRIGGER news_created BEFORE INSERT ON news FOR EACH ROW SET NEW.news_created = CURRENT_TIMESTAMP;

CREATE TABLE news_categ (
  news_categ_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  news_categ_title VARCHAR(128) NOT NULL,
  news_categ_description VARCHAR(255) NOT NULL,
  CONSTRAINT pk_news_categ PRIMARY KEY (news_categ_id),
  CONSTRAINT uk_news_categ_title UNIQUE (news_categ_title)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE news_keyword (
  news_id INTEGER UNSIGNED NOT NULL,
  keyword_id INTEGER UNSIGNED NOT NULL,
  CONSTRAINT pk_news_keyword PRIMARY KEY (news_id, keyword_id)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- FOREIGN KEYS
ALTER TABLE news ADD CONSTRAINT fk_news_categ FOREIGN KEY (news_categ_id) REFERENCES news_categ(news_categ_id) ON DELETE SET NULL;
ALTER TABLE news ADD CONSTRAINT fk_news_user FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE SET NULL;
ALTER TABLE news ADD CONSTRAINT fk_news_galerie FOREIGN KEY (galerie_id) REFERENCES galerie(galerie_id) ON DELETE SET NULL;

ALTER TABLE news_keyword ADD CONSTRAINT fk_news_keyword1 FOREIGN KEY (news_id) REFERENCES news(news_id) ON DELETE CASCADE;
ALTER TABLE news_keyword ADD CONSTRAINT fk_news_keyword2 FOREIGN KEY (keyword_id) REFERENCES keyword(keyword_id) ON DELETE CASCADE;
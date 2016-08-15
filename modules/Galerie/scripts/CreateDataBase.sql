-- Script de création des tables du module de galerie

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS galerie, galerie_keyword, image, image_keyword;
DROP TRIGGER IF EXISTS galerie_created;
DROP PROCEDURE IF EXISTS image_order_insert;
DROP PROCEDURE IF EXISTS image_order_update;
DROP PROCEDURE IF EXISTS image_delete;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE galerie (
  galerie_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  galerie_title VARCHAR(128) NOT NULL,
  galerie_description VARCHAR(255) NULL,
  galerie_created TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  galerie_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  user_id INTEGER UNSIGNED NULL,
  galerie_active TINYINT(1) NOT NULL DEFAULT 0,
  CONSTRAINT pk_galerie PRIMARY KEY (galerie_id)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE galerie_keyword (
  galerie_id INTEGER UNSIGNED NOT NULL,
  keyword_id INTEGER UNSIGNED NOT NULL,
  CONSTRAINT pk_galerie_keyword PRIMARY KEY (galerie_id, keyword_id)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE image (
  image_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  image_title VARCHAR(128) NULL,
  image_description VARCHAR(255) NULL,
  image_url VARCHAR(255) NOT NULL,
  image_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_id INTEGER UNSIGNED NULL,
  image_active TINYINT(1) NOT NULL DEFAULT 0,
  galerie_id INTEGER UNSIGNED NOT NULL,
  image_size INTEGER UNSIGNED NOT NULL,
  image_order INTEGER UNSIGNED DEFAULT NULL,
  CONSTRAINT pk_galerie PRIMARY KEY (image_id),
  CONSTRAINT uk_image_url UNIQUE (image_url),
  CONSTRAINT uk_image_order UNIQUE (galerie_id, image_order)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE image_keyword (
  image_id INTEGER UNSIGNED NOT NULL,
  keyword_id INTEGER UNSIGNED NOT NULL,
  CONSTRAINT pk_image_keyword PRIMARY KEY (image_id, keyword_id)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- FOREIGN KEYS
ALTER TABLE galerie ADD CONSTRAINT fk_galerie_user FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE SET NULL;

ALTER TABLE galerie_keyword ADD CONSTRAINT fk_galerie_keyword1 FOREIGN KEY (galerie_id) REFERENCES galerie(galerie_id) ON DELETE CASCADE;
ALTER TABLE galerie_keyword ADD CONSTRAINT fk_galerie_keyword2 FOREIGN KEY (keyword_id) REFERENCES keyword(keyword_id) ON DELETE CASCADE;

ALTER TABLE image ADD CONSTRAINT fk_image_user FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE SET NULL;
ALTER TABLE image ADD CONSTRAINT fk_image_galerie FOREIGN KEY (galerie_id) REFERENCES galerie(galerie_id) ON DELETE CASCADE;

ALTER TABLE image_keyword ADD CONSTRAINT fk_image_keyword1 FOREIGN KEY (image_id) REFERENCES image(image_id) ON DELETE CASCADE;
ALTER TABLE image_keyword ADD CONSTRAINT fk_image_keyword2 FOREIGN KEY (keyword_id) REFERENCES keyword(keyword_id) ON DELETE CASCADE;

-- TRIGGERS ET PROCEDURES
CREATE TRIGGER galerie_created BEFORE INSERT ON galerie FOR EACH ROW SET NEW.galerie_created = CURRENT_TIMESTAMP;

delimiter //

-- A lancer avant d'insérer une image
CREATE PROCEDURE image_order_insert (IN galId INT, IN insertOrder INT)
BEGIN
    -- On prend les images dont l'ordre est supérieur ou égal, et on l'incrémente
    UPDATE image SET image_order = image_order + 1 WHERE galerie_id = galId AND image_order >= insertOrder ORDER BY image_order DESC;
END//

-- A lancer avant de mettre à jour une image
CREATE PROCEDURE image_order_update (IN imageId INT, IN newOrder INT, OUT realOrder INT)
BEGIN
    DECLARE oldOrder INT;
    DECLARE galId INT;
    SELECT image_order INTO oldOrder FROM image WHERE image_id = imageId;
    SELECT galerie_id INTO galId FROM image WHERE image_id = imageId;
 
    -- Si on veut ajouter un ordre à cette image
    IF newOrder IS NOT NULL AND oldOrder IS NULL THEN
        -- On prend les dont l'ordre est supérieur ou égal et on l'incrémente
        UPDATE image SET image_order = image_order + 1 WHERE galerie_id = galId AND image_order >= newOrder ORDER BY image_order DESC;

    -- Sinon si on supprime l'ordre de cet image
    ELSEIF oldOrder IS NOT NULL AND newOrder IS NULL THEN
        -- On enlève l'ordre à notre image
        UPDATE image SET image_order = NULL WHERE image_id = imageId;
        -- On prend les images dont l'ordre est supérieur à l'ancien ordre, et on le décrémente
        UPDATE image SET image_order = image_order - 1 WHERE galerie_id = galId AND image_order > oldOrder ORDER BY image_order ASC;
        
    -- Sinon on modifie
    ELSEIF newOrder IS NOT NULL AND oldOrder IS NOT NULL AND newOrder != oldOrder THEN
        -- On enlève l'ordre à notre image
        UPDATE image SET image_order = NULL WHERE image_id = imageId;
        -- On prend les images dont l'ordre est supérieur à l'ancien ordre, et on le décrémente
        UPDATE image SET image_order = image_order - 1 WHERE galerie_id = galId AND image_order > oldOrder ORDER BY image_order ASC;
        -- On prend les images dont l'ordre est supérieur ou égal au nouvel ordre, et on l'incrémente
        UPDATE image SET image_order = image_order + 1 WHERE galerie_id = galId AND image_order >= newOrder ORDER BY image_order DESC;
    END IF;

    IF newOrder = ((SELECT MAX(image_order) FROM image WHERE galerie_id = galId AND image_id != imageId) + 2) THEN
        SET realOrder := (newOrder - 1);
    ELSE
        SET realOrder := newOrder;
    END IF;
END//

-- Suppression d'une image
CREATE PROCEDURE image_delete (IN imageId INT)
BEGIN
    DECLARE imgOrder INT;
    DECLARE galId INT;
    SELECT image_order INTO imgOrder FROM image WHERE image_id = imageId;
    SELECT galerie_id INTO galId FROM image WHERE image_id = imageId;

    IF imgOrder IS NOT NULL THEN
        -- On enlève l'ordre à notre image
        UPDATE image SET image_order = NULL WHERE image_id = imageId;
        -- On prend les images dont l'ordre est supérieur, et on le décrémente
        UPDATE image SET image_order = image_order - 1 WHERE galerie_id = galId AND image_order > imgOrder ORDER BY image_order ASC;
    END IF;

    DELETE FROM image WHERE image_id = imageId;
END//

delimiter ;
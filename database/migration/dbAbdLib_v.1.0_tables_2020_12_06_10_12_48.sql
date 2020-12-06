DROP DATABASE IF EXISTS `dbAbdLib_v.1.0`;
CREATE DATABASE IF NOT EXISTS `dbAbdLib_v.1.0`;
USE `dbAbdLib_v.1.0`;

CREATE TABLE `aquipe` ( 
id int(11) NOT NULL  AUTO_INCREMENT ,
nom varchar(255) NOT NULL  UNIQUE ,
couleur varchar(255) NOT NULL ,
PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `rencontre` ( 
id int(11) NOT NULL  AUTO_INCREMENT ,
aquipe_id int(11) NOT NULL ,
equipe_id int(11) NOT NULL ,
PRIMARY KEY (`id`) ,
CONSTRAINT FOREIGN KEY (`aquipe_id`) REFERENCES `aquipe` (`id`)  ON DELETE CASCADE ,
CONSTRAINT FOREIGN KEY (`equipe_id`) REFERENCES `aquipe` (`id`)  ON DELETE CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `match` ( 
id int(11) NOT NULL  AUTO_INCREMENT ,
aquipe_id int(11) NOT NULL ,
equipe_id int(11) NOT NULL ,
PRIMARY KEY (`id`) ,
CONSTRAINT FOREIGN KEY (`aquipe_id`) REFERENCES `aquipe` (`id`)  ON DELETE CASCADE ,
CONSTRAINT FOREIGN KEY (`equipe_id`) REFERENCES `aquipe` (`id`)  ON DELETE CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

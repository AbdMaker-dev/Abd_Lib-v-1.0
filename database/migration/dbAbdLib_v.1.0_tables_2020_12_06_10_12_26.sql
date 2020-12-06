DROP DATABASE IF EXISTS `dbAbdLib_v.1.0`;
CREATE DATABASE IF NOT EXISTS `dbAbdLib_v.1.0`;
USE `dbAbdLib_v.1.0`;

CREATE TABLE `user` ( 
id int(11) NOT NULL  AUTO_INCREMENT ,
username varchar(255) NOT NULL  UNIQUE ,
password varchar(255) NOT NULL ,
PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

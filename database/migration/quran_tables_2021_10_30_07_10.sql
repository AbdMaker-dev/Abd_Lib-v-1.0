DROP DATABASE IF EXISTS `quran`;
CREATE DATABASE IF NOT EXISTS `quran`;
USE `quran`;

CREATE TABLE `surah` ( 
number int(11) NOT NULL ,
name varchar(255) UNIQUE ,
englishName varchar(255),
englishNameTranslation varchar(255),
PRIMARY KEY (`number`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ayat` ( 
number int(11) NOT NULL ,
text varchar(255),
number_surah int(11) NOT NULL ,
PRIMARY KEY (`number`) ,
CONSTRAINT FOREIGN KEY (`number_surah`) REFERENCES `surah` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

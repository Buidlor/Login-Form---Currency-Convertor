CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;

CREATE TABLE users (
	PersonID int(10) unsigned NOT NULL AUTO_INCREMENT,
	UserName varchar(255) NOT NULL,
	email varchar(255) 	NOT NULL,
	Pw varchar(255) 	NOT NULL,
	PRIMARY KEY (PersonID),
	UNIQUE KEY UserName (UserName)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

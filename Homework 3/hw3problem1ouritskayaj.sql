DROP DATABASE IF EXISTS athenastudio;
CREATE DATABASE IF NOT EXISTS athenastudio;
USE athenastudio;

CREATE TABLE genre (
genre_name ENUM('realism', 'impressionism', 'cubism', 'fauvism', 'pointillism', 'naïve art') PRIMARY KEY ,
century INT
);

CREATE TABLE artist (
artist_name VARCHAR(64) PRIMARY KEY,
sex VARCHAR(16),
year_of_birth YEAR,
country_of_origin VARCHAR(64),
no_masterpieces INT
);

CREATE TABLE museum (
museum_name VARCHAR(64) NOT NULL UNIQUE, 
city VARCHAR(64) NOT NULL,
country VARCHAR(64) NOT NULL,
PRIMARY KEY (museum_name, city, country)
);

CREATE TABLE masterpiece (
title VARCHAR(64) PRIMARY KEY,
length FLOAT,
width FLOAT,
height FLOAT,
material ENUM ('oil', 'acrylic', 'watercolor', 'pastel'),
year YEAR,
genre_name ENUM('realism', 'impressionism', 'cubism', 'fauvism', 'pointillism', 'naïve art') NOT NULL,
museum_name VARCHAR(64) NOT NULL,
city VARCHAR(64) NOT NULL,
country VARCHAR(64) NOT NULL,
artist_name VARCHAR(64) NOT NULL, 
FOREIGN KEY (genre_name) REFERENCES genre(genre_name)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (museum_name, city, country) REFERENCES museum(museum_name, city, country)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (artist_name) REFERENCES artist(artist_name)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE replicate (
title VARCHAR(64) NOT NULL,
copies_sold INT,
replicas_for_sale INT,
FOREIGN KEY (title) REFERENCES masterpiece(title) 
	ON UPDATE CASCADE ON DELETE RESTRICT
);


SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Workshop05;
CREATE DATABASE Workshop05;

USE Workshop05;

CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(100) NOT NULL UNIQUE,
    password char(255) NOT NULL,
    address varchar(100) NOT NULL,
    dob DATE NOT NULL,
    userRole varchar(25) NOT NULL,
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON Workshop05.users TO dbadmin@localhost;
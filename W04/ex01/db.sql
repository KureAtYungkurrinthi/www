SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Workshop04;
CREATE DATABASE Workshop04;

USE Workshop04;

CREATE TABLE StudentResults(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    mark int NOT NULL,
    feesPaid boolean NOT NULL DEFAULT 0,
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON Workshop04.StudentResults TO dbadmin@localhost;

INSERT INTO StudentResults(name) VALUES('John Smith');
INSERT INTO StudentResults(name) VALUES('Jane Doe');
INSERT INTO StudentResults(name) VALUES('Omar Ali');
INSERT INTO StudentResults(name) VALUES('Zihan Wang');
INSERT INTO StudentResults(name) VALUES('Aarav Devi');

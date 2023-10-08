SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS FlindersCare;
CREATE DATABASE FlindersCare;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON FlindersCare TO dbadmin@localhost;

USE FlindersCare;

CREATE TABLE Teams (
                       teamID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       teamName VARCHAR(50),
                       description TEXT
) AUTO_INCREMENT = 1;

CREATE TABLE Users (
                       userID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       firstName VARCHAR(50),
                       lastName VARCHAR(50),
                       email VARCHAR(100),
                       password VARCHAR(100),
                       teamID INT,
                       role VARCHAR(50),
                       FOREIGN KEY (teamID) REFERENCES Teams(teamID)
) AUTO_INCREMENT = 1;

CREATE TABLE Rooms (
                       roomID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       roomNumber VARCHAR(50),
                       roomType VARCHAR(50)
) AUTO_INCREMENT = 1;

CREATE TABLE Patients (
                          patientID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          firstName VARCHAR(50),
                          lastName VARCHAR(50),
                          DOB DATE,
                          admitDate DATE,
                          dischargeDate DATE,
                          roomID INT,
                          FOREIGN KEY (roomID) REFERENCES Rooms(roomID)
) AUTO_INCREMENT = 1;

CREATE TABLE Tasks (
                       taskID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       taskDescription TEXT,
                       assigneeTeamID INT,
                       patientID INT,
                       roomID INT,
                       createdAt TIMESTAMP,
                       deadline DATE,
                       status VARCHAR(50),
                       priority VARCHAR(50),
                       FOREIGN KEY (assigneeTeamID) REFERENCES Teams(teamID),
                       FOREIGN KEY (patientID) REFERENCES Patients(patientID),
                       FOREIGN KEY (roomID) REFERENCES Rooms(roomID)
) AUTO_INCREMENT = 1;

CREATE TABLE PatientDocuments (
                                  documentID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                  patientID INT,
                                  documentType VARCHAR(50),
                                  documentPath VARCHAR(255),
                                  uploadDate TIMESTAMP,
                                  FOREIGN KEY (patientID) REFERENCES Patients(patientID)
) AUTO_INCREMENT = 1;

INSERT INTO Teams VALUES
                      (1, 'Administrator', 'Administrator Team'),
                      (2, 'Medic', 'Medic Team'),
                      (3, 'Maintainer', 'Maintenance Team');

INSERT INTO Users VALUES
                      (1, 'John', 'Doe', 'john@example.com', 'password1', 1, 'Admin'),
                      (2, 'Jane', 'Doe', 'jane@example.com', 'password2', 2, 'Nurse'),
                      (3, 'Jim', 'Beam', 'jim@example.com', 'password3', 2, 'Doctor'),
                      (4, 'Jack', 'Daniels', 'jack@example.com', 'password10', 3, 'Staff');

INSERT INTO Rooms VALUES
                      (1, '101', 'Regular'),
                      (2, '102', 'Premium'),
                      (3, '103', 'VIP');

INSERT INTO Patients VALUES
                         (1, 'Alice', 'Wonder', '1945-10-15', '2023-05-01', NULL, 1),
                         (2, 'Bob', 'Builder', '1955-06-23', '2023-05-02', NULL, 2),
                         (3, 'Gary', 'Oak', '1980-08-15', '2023-05-10', NULL, 3);

INSERT INTO Tasks VALUES
                      (1, 'Check vitals', 1, 1, 1, '2023-05-01 08:00:00', '2023-05-01', 'Open', 'High'),
                      (2, 'Administer medicine', 2, 2, 2, '2023-05-02 09:00:00', '2023-05-02', 'In Progress', 'Medium'),
                      (3, 'Conduct physiotherapy', 3, 3, 3, '2023-05-10 11:00:00', '2023-05-10', 'Closed', 'Low');
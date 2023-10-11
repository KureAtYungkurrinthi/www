SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS FlindersCare;
CREATE DATABASE FlindersCare;

USE FlindersCare;

CREATE TABLE Teams (
                       teamID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       teamName VARCHAR(50) UNIQUE,
                       description TEXT
) AUTO_INCREMENT = 1;

CREATE TABLE Users (
                       userID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       firstName VARCHAR(50),
                       lastName VARCHAR(50),
                       email VARCHAR(100) UNIQUE,
                       password VARCHAR(100),
                       role VARCHAR(50),
                       teamID INT,
                       FOREIGN KEY (teamID) REFERENCES Teams(teamID)
) AUTO_INCREMENT = 1;

CREATE TABLE Rooms (
                       roomID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       roomNumber VARCHAR(50) UNIQUE,
                       roomType ENUM('Regular', 'Premium', 'VIP')
) AUTO_INCREMENT = 1;

CREATE TABLE Patients (
                          patientID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          firstName VARCHAR(50),
                          lastName VARCHAR(50),
                          gender ENUM('Male', 'Female', 'Other'),
                          DOB DATE,
                          admitDate DATE,
                          dischargeDate DATE,
                          roomID INT,
                          patientDetails TEXT,
                          notes TEXT,
                          FOREIGN KEY (roomID) REFERENCES Rooms(roomID)
) AUTO_INCREMENT = 1;

CREATE TABLE Tasks (
                       taskID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       taskName VARCHAR(100),
                       taskDescription TEXT,
                       assigneeTeamID INT,
                       patientID INT,
                       createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       deadline DATE,
                       status ENUM('Pending', 'In Progress', 'Completed'),
                       priority ENUM('High', 'Medium', 'Low'),
                       FOREIGN KEY (assigneeTeamID) REFERENCES Teams(teamID),
                       FOREIGN KEY (patientID) REFERENCES Patients(patientID)
) AUTO_INCREMENT = 1;

CREATE TABLE PatientDocuments (
                                  documentID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                  patientID INT,
                                  documentType VARCHAR(50),
                                  documentPath VARCHAR(255),
                                  uploadDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                  FOREIGN KEY (patientID) REFERENCES Patients(patientID)
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON FlindersCare.Teams TO dbadmin@localhost;
GRANT all privileges ON FlindersCare.Users TO dbadmin@localhost;
GRANT all privileges ON FlindersCare.Rooms TO dbadmin@localhost;
GRANT all privileges ON FlindersCare.Patients TO dbadmin@localhost;
GRANT all privileges ON FlindersCare.Tasks TO dbadmin@localhost;
GRANT all privileges ON FlindersCare.PatientDocuments TO dbadmin@localhost;

INSERT INTO Teams (teamName, description) VALUES
                      ('Manager', 'Management Team'),
                      ('Medic', 'Medical Team'),
                      ('Maintainer', 'Operational Team');

INSERT INTO Users (firstName, lastName, email, password, role, teamID) VALUES
                      ('Maggie', 'Reynolds', 'maggie@flinders.com', 'password1', 'Manager', 1),
                      ('Carlos', 'Taylor', 'carlos@flinders.com', 'password2', 'Worker', 3),
                      ('Hussnain', 'Shakeel', 'shak0093@flinders.edu.au', 'shak0093', 'Nurse', 2),
                      ('Poonam', 'Panchal', 'panc0050@flinders.edu.au', 'panc0050', 'Cleaner', 3),
                      ('Shengfan', 'Wang', 'wang2147@flinders.edu.au', 'wang2147', 'Worker', 3);

INSERT INTO Rooms (roomNumber, roomType) VALUES
                      ('101', 'Regular'),
                      ('102', 'Premium'),
                      ('103', 'VIP'),
                      ('104', 'Regular'),
                      ('105', 'VIP');

INSERT INTO Patients (firstName, lastName, gender, DOB, admitDate, dischargeDate, roomID, patientDetails, notes) VALUES
                      ('John', 'Doe', 'Male', '1950-01-15', '2023-01-10', NULL, 1, 'Patient has chronic pain', 'Needs frequent monitoring'),
                      ('Jane', 'Doe', 'Female', '1945-03-20', '2023-01-12', NULL, 2, 'Heart patient', 'Monitor heart rate'),
                      ('Jim', 'Beam', 'Male', '1960-07-22', '2023-02-05', NULL, 3, 'Undergoing physiotherapy', 'Mild exercise only'),
                      ('Jack', 'Daniels', 'Male', '1935-11-30', '2023-02-10', NULL, 4, 'Asthmatic patient', 'Keep inhaler handy'),
                      ('Jill', 'White', 'Female', '1925-05-17', '2023-03-02', NULL, 5, 'Requires frequent check-ups', 'Consider moving to VIP room');

INSERT INTO Tasks (taskName, taskDescription, assigneeTeamID, patientID, createdAt, deadline, status, priority) VALUES
                      ('Medication', 'Administer medication', 2, 1, '2023-04-01 09:00:00', '2023-04-01', 'Pending', 'High'),
                      ('Check-up', 'Routine check-up', 2, 2, '2023-04-02 10:00:00', '2023-04-02', 'Pending', 'Medium'),
                      ('Physiotherapy', 'Daily physiotherapy', 2, 3, '2023-04-03 11:00:00', '2023-04-03', 'In Progress', 'Low'),
                      ('Cleaning', 'Bed cleaning', 3, 4, '2023-04-04 12:00:00', '2023-04-04', 'Completed', 'Low'),
                      ('Vaccination', 'Administer vaccine', 2, 5, '2023-04-05 13:00:00', '2023-04-05', 'Pending', 'High');
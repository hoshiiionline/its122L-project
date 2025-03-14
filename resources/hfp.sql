CREATE TABLE `users` (
    `userID` INT(11) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `emailAddress` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `isAdmin` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`userID`)
);

CREATE TABLE `reservation` (
    `reservationID` INT(11) NOT NULL AUTO_INCREMENT,
    `referenceNo` VARCHAR(50) NOT NULL,
    `userID` INT(11) NOT NULL,
    `status` VARCHAR(50) NOT NULL,
    `requestedDate` DATE NOT NULL,
    `notes` TEXT,
    `isPaid` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`reservationID`),
    CONSTRAINT `fk_reservation_user` FOREIGN KEY (`userID`) REFERENCES `users`(`userID`)
);

CREATE TABLE `wedding` (
    `weddingID` INT(11) NOT NULL AUTO_INCREMENT,
    `reservationID` INT(11) NOT NULL,
    `groomName` VARCHAR(50) NOT NULL,
    `brideName` VARCHAR(50) NOT NULL,
    `guestsNo` INT(11) NOT NULL,
    PRIMARY KEY (`weddingID`),
    CONSTRAINT `fk_wedding_reservation` FOREIGN KEY (`reservationID`) REFERENCES `reservation`(`reservationID`)
);

CREATE TABLE `baptism` (
    `baptismID` INT(11) NOT NULL AUTO_INCREMENT,
    `reservationID` INT(11) NOT NULL,
    `childName` VARCHAR(50) NOT NULL,
    `dateOfBirth` DATE NOT NULL,
    `motherName` VARCHAR(50) NOT NULL,
    `fatherName` VARCHAR(50) NOT NULL,
    `godparentsNo` INT(11) NOT NULL,
    `certificateStatus` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`baptismID`),
    CONSTRAINT `fk_baptism_reservation` FOREIGN KEY (`reservationID`) REFERENCES `reservation`(`reservationID`)
);

CREATE TABLE `priest` (
    `priestID` INT(11) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `emailAddress` VARCHAR(50) NOT NULL,
    `contactNo` INT(11) NOT NULL,
    `availability` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`priestID`)
);

CREATE TABLE `assignment` (
    `assignmentID` INT(11) NOT NULL AUTO_INCREMENT,
    `reservationID` INT(11) NOT NULL,
    `priestID` INT(11) NOT NULL,
    PRIMARY KEY (`assignmentID`),
    CONSTRAINT `fk_assignment_reservation` FOREIGN KEY (`reservationID`) REFERENCES `reservation`(`reservationID`),
    CONSTRAINT `fk_assignment_priest` FOREIGN KEY (`priestID`) REFERENCES `priest`(`priestID`)
);

CREATE TABLE confirmedEvents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    allDay TINYINT(1) NOT NULL DEFAULT 0,
    start DATETIME NOT NULL,
    end DATETIME DEFAULT NULL
);

CREATE TABLE pendingEvents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    purpose VARCHAR(255) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    schedule DATETIME NOT NULL
);

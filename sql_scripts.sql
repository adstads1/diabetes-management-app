//Code is for the revised app

CREATE TABLE reading
(
userID VARCHAR(20) not null,
readingID INT(10) AUTO_INCREMENT unique not null,
activityType VARCHAR(20) not null,
carbIntake DOUBLE(2,1),    
date Date not null,
time Time not null,
bgLevel DOUBLE(2,1) not null,
emotionalS VARCHAR(10) not null,    
qAInsluin DOUBLE(2,1) not null,
backInsulin DOUBLE(2,1) not null,
injection_Location VARCHAR(15) not null,  
workload VARCHAR(20),
workAtmosphere VARCHAR(7),
workEmotion VARCHAR(7) not null, 
medName VARCHAR(40) not null,
PRIMARY KEY (readingID),
FOREIGN KEY (userID) REFERENCES users(userID)
)
ENGINE=InnoDB;

////////////////////////////////////
CREATE TABLE users
(
userID VARCHAR(20) unique not null,
fname VARCHAR(20) not null,
sName VARCHAR(20) not null,
password VARCHAR(20) not null,
dob Date not null,
gender VARCHAR(7) not null,     
weight INT(5) not null,  
bgRange1 INT(2) not null,  
bgRange2 INT(2) not null, 
PRIMARY KEY (userID)
)
ENGINE=InnoDB;


CREATE TABLE work_reading
(
userID VARCHAR(20) not null,
workID INT(10) AUTO_INCREMENT unique not null,
activityType VARCHAR(20) not null,
workload VARCHAR(20),
workAtmosphere VARCHAR(7),
workEmotion VARCHAR(7) not null,     
date Date not null,
time Time not null,
bgLevel DOUBLE(2,1) not null,
emotionalS VARCHAR(10) not null,    
qAInsluin DOUBLE(2,1) not null,
backInsulin DOUBLE(2,1) not null,
injection_Location VARCHAR(15) not null,  
PRIMARY KEY (workID),
FOREIGN KEY (userID) REFERENCES users(userID)
)
ENGINE=InnoDB;

CREATE TABLE nutrition_reading
(
userID VARCHAR(20) not null,
nutritionID INT(10) AUTO_INCREMENT unique not null,
activityType VARCHAR(20) not null,
carbIntake DOUBLE(2,1),    
date Date not null,
time Time not null,
bgLevel DOUBLE(2,1) not null,
emotionalS VARCHAR(10) not null,    
qAInsluin DOUBLE(2,1) not null,
backInsulin DOUBLE(2,1) not null,
injection_Location VARCHAR(15) not null,  
PRIMARY KEY (nutritionID),
FOREIGN KEY (userID) REFERENCES users(userID)
)
ENGINE=InnoDB;


CREATE TABLE med_name
(
userID VARCHAR(20) not null,
medName VARCHAR(40) not null,
/*PRIMARY KEY (medName),*/
FOREIGN KEY (userID) REFERENCES users(userID)
)
ENGINE=InnoDB;

/*make the combination of userID and medname unique*/
CREATE UNIQUE INDEX uq_medication_name
  ON med_name(userID, medName);


CREATE TABLE med_reading
(
userID VARCHAR(20) not null,
medicationID INT(10) AUTO_INCREMENT unique not null ,
medName VARCHAR(40) not null,
activityType VARCHAR(20) not null,
date Date not null,
time Time not null,
bgLevel DOUBLE(2,1) not null,
emotionalS VARCHAR(10) not null,    
qAInsluin DOUBLE(2,1) not null,
backInsulin DOUBLE(2,1) not null,
injection_Location VARCHAR(15) not null,  
PRIMARY KEY (medicationID),
FOREIGN KEY (userID) REFERENCES users(userID)
)
ENGINE=InnoDB;

SELECT bgLevel FROM work_reading WHERE userID=''
UNION
SELECT bgLevel FROM nutrition_reading userID=''
UNION
SELECT bgLevel FROM med_reading userID=''

SELECT bgLevel, time FROM `work_reading` WHERE date='$currentDate' AND userid='$user'
UNION
SELECT bgLevel, time FROM `nutrition_reading` WHERE date='$currentDate' AND userid='$user'
UNION
SELECT bgLevel, time FROM `med_reading` WHERE date='$currentDate' AND userid='$user'

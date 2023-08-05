CREATE DATABASE dbRegister;

USE dbRegister;

CREATE TABLE tblSex (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255)
);

CREATE TABLE tblMarried (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255)
);


CREATE TABLE tblShift (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255)
);

CREATE TABLE tblPayment (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255)
);

CREATE TABLE tblRelationship (
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255)
);

select * from tblRegister;
drop table tblRegister;

CREATE TABLE tblRegister (
	ID INT AUTO_INCREMENT PRIMARY KEY,
	Ref VARCHAR(30),
	Photo VARCHAR(255),
	First_Name_Kh NVARCHAR(255),
	Last_Name_Kh NVARCHAR(255),
	First_Name_En VARCHAR(255),
	Last_Name_En VARCHAR(255),
	Sex INT,
	Village_POB VARCHAR(255),
	Commune_POB VARCHAR(255),
	District_POB VARCHAR(255),
	Province_POB VARCHAR(255),
	DOB DATE,
	Village_Current VARCHAR(255),
	Commune_Current VARCHAR(255),
	District_Current VARCHAR(255),
	Province_Current VARCHAR(255),
	Nationality VARCHAR(255),
	Father_Name VARCHAR(255),
	Father_Tel VARCHAR(20),
	Mother_Name VARCHAR(255),
	Mother_Tel VARCHAR(20),
	Marital_Status INT,
	Emergency_Contact_Name VARCHAR(255),
	Emergency_Contact_Relation INT,
	Emergency_Contact_Tel VARCHAR(20),
	Apply_For INT,
	Major INT,
	Shift INT,
	Tel VARCHAR(30),
	Email VARCHAR(100),
	Payment_Method INT,
	Diploma_Certificate VARCHAR(255),
	Student_ID_File VARCHAR(255),
	Khmer_ID_File VARCHAR(255),
    ReqDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (Sex) REFERENCES tblSex(ID),
	FOREIGN KEY (Marital_Status) REFERENCES tblMarried(ID),
	FOREIGN KEY (Emergency_Contact_Relation) REFERENCES tblRelationship(ID),
	FOREIGN KEY (Apply_For) REFERENCES tblLevel(ID),
	FOREIGN KEY (Major) REFERENCES tblMajor(ID),
	FOREIGN KEY (Shift) REFERENCES tblShift(ID),
	FOREIGN KEY (Payment_Method) REFERENCES tblPayment(ID)
);

SELECT r.ID, r.Ref, r.Photo, r.First_Name_Kh, r.Last_Name_Kh, r.First_Name_En, r.Last_Name_En, s.Title AS Major, l.Title AS Level, sh.Title AS Shift, x.Sex, r.DOB, r.Village_POB, r.Commune_POB, r.District_POB, r.Province_POB, r.Village_Current, r.Commune_Current, r.District_Current, r.Province_Current, r.Nationality, r.Father_Name, r.Father_Tel, r.Mother_Name, r.Mother_Tel, m.Status AS Marital_Status, ec.Name AS Emergency_Contact_Name, r.Emergency_Contact_Tel, r.Tel, r.Email, pm.Title AS Payment_Method, r.Diploma_Certificate, r.Student_ID_File, r.Khmer_ID_File, r.ReqDate
FROM tblRegister r
JOIN tblMajor s ON r.Major = s.ID
JOIN tblLevel l ON r.Apply_For = l.ID
JOIN tblShift sh ON r.Shift = sh.ID
JOIN tblSex x ON r.Sex = x.ID
JOIN tblMarried m ON r.Marital_Status = m.ID
JOIN tblRelationship ec ON r.Emergency_Contact_Relation = ec.ID
JOIN tblPayment pm ON r.Payment_Method = pm.ID;

select * from tblSex;
drop table tblSex;

drop trigger trg_set_ref;

DELIMITER $$
CREATE TRIGGER trg_set_ref BEFORE INSERT ON tblRegister
FOR EACH ROW
BEGIN
    SET NEW.Ref = CONCAT(
        IF(NEW.Apply_For = 1, 'ABA', IF(NEW.Apply_For = 2, 'BBA', IF(NEW.Apply_For = 3, 'MAS', ''))),
        YEAR(NOW()),
        NEW.ID
    );
END $$
DELIMITER ;

SELECT Batch, COUNT(*) AS NumRecords
FROM tblRegister
WHERE Batch IN (1, 2)
GROUP BY Batch;

SELECT COUNT(*) AS NumRecords FROM tblRegister WHERE YEAR(ReqDate) = YEAR(CURRENT_TIMESTAMP) AND Batch IN (1, 2)
UNION ALL
SELECT COUNT(*) AS NumRecords FROM tblRegister WHERE YEAR(ReqDate) = YEAR(CURRENT_TIMESTAMP) - 10 AND Batch IN (1, 2);

SELECT * FROM tblRegister WHERE ID = 2 OR Ref = 'BBA-20230515185227476';

SELECT r.ID, r.Batch, r.Photo, r.Sex, r.DOB, r.Email, r.Tel, r.Ref, r.First_Name_Kh, r.Last_Name_Kh, r.First_Name_En, r.Last_Name_En, s.Title AS Major, l.Title AS Level, sh.Title AS Shift, r.ReqDate, r.Status, pm.Title AS Payment_Method
                        FROM tblRegister r
                        JOIN tblMajor s ON r.Major = s.ID
                        JOIN tblLevel l ON r.Apply_For = l.ID
                        JOIN tblShift sh ON r.Shift = sh.ID
                        JOIN tblPayment pm ON r.Payment_Method = pm.ID ORDER BY ID DESC;

SELECT r.ID, r.Batch, r.Ref, r.Photo, r.First_Name_Kh, r.Last_Name_Kh,
       r.First_Name_En, r.Last_Name_En, s.Title AS Sex, m.Title AS Marital_Status, r.Village_POB, r.Commune_POB,
       r.District_POB, r.Province_POB, r.DOB, r.Village_Current, r.Commune_Current,
       r.District_Current, r.Province_Current, r.Nationality, r.Father_Name,
       r.Father_Tel, r.Mother_Name, r.Mother_Tel, r.Emergency_Contact_Name, rel.Title AS Emergency_Contact_Relation,
       r.Emergency_Contact_Tel, r.Tel, r.Email,
       r.Diploma_Certificate, r.Student_ID_File, r.Khmer_ID_File, r.ReqDate,
       l.Title AS Level, ma.Title AS Major, sh.Title AS Shift, p.Title AS Payment_Method
FROM tblRegister r
JOIN tblSex s ON r.Sex = s.ID
JOIN tblMarried m ON r.Marital_Status = m.ID
JOIN tblRelationship rel ON r.Emergency_Contact_Relation = rel.ID
JOIN tblLevel l ON r.Apply_For = l.ID
JOIN tblMajor ma ON r.Major = ma.ID
JOIN tblShift sh ON r.Shift = sh.ID
JOIN tblPayment p ON r.Payment_Method = p.ID WHERE Ref = 'BBA-20230515202851727';

CREATE TABLE tblRegister (
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Batch INT,
	Ref VARCHAR(30),
	Photo VARCHAR(255),
	First_Name_Kh NVARCHAR(255),
	Last_Name_Kh NVARCHAR(255),
	First_Name_En VARCHAR(255),
	Last_Name_En VARCHAR(255),
	Sex INT,
	Village_POB VARCHAR(255),
	Commune_POB VARCHAR(255),
	District_POB VARCHAR(255),
	Province_POB VARCHAR(255),
	DOB DATE,
	Village_Current VARCHAR(255),
	Commune_Current VARCHAR(255),
	District_Current VARCHAR(255),
	Province_Current VARCHAR(255),
	Nationality VARCHAR(255),
	Father_Name VARCHAR(255),
	Father_Tel VARCHAR(20),
	Mother_Name VARCHAR(255),
	Mother_Tel VARCHAR(20),
	Marital_Status INT,
	Emergency_Contact_Name VARCHAR(255),
	Emergency_Contact_Relation INT,
	Emergency_Contact_Tel VARCHAR(20),
	Student_ID VARCHAR(20),
	Identity_Card VARCHAR(20),
	Apply_For INT,
	Major INT,
	Shift INT,
	Tel VARCHAR(30),
	Email VARCHAR(100),
	Payment_Method INT,
	Diploma_Certificate VARCHAR(255),
	Student_ID_File VARCHAR(255),
	Khmer_ID_File VARCHAR(255),
    ReqDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (Sex) REFERENCES tblSex(ID),
	FOREIGN KEY (Marital_Status) REFERENCES tblMarried(ID),
	FOREIGN KEY (Emergency_Contact_Relation) REFERENCES tblRelationship(ID),
	FOREIGN KEY (Apply_For) REFERENCES tblLevel(ID),
	FOREIGN KEY (Major) REFERENCES tblMajor(ID),
	FOREIGN KEY (Shift) REFERENCES tblShift(ID),
	FOREIGN KEY (Payment_Method) REFERENCES tblPayment(ID)
);

SELECT * FROM tblRegister;
drop table tblRegister;
drop table tblMajor;

ALTER TABLE tblRegister ADD COLUMN dBy VARCHAR(30) DEFAULT 'N/A';
ALTER TABLE tblRegister ADD COLUMN dDate DATETIME DEFAULT null;
ALTER TABLE tblRegister ADD COLUMN Reason LONGTEXT DEFAULT 'N/A';

INSERT INTO tblRegister (Batch, Ref, Photo, First_Name_Kh, Last_Name_Kh, First_Name_En, Last_Name_En, Sex, Village_POB, Commune_POB, District_POB, Province_POB, DOB, Village_Current, Commune_Current, District_Current, Province_Current, Nationality, Father_Name, Father_Tel, Mother_Name, Mother_Tel, Marital_Status, Emergency_Contact_Name, Emergency_Contact_Relation, Emergency_Contact_Tel, Student_ID, Identity_Card, Apply_For, Major, Shift, Tel, Email, Payment_Method, Diploma_Certificate, Student_ID_File, Khmer_ID_File)
VALUES (1, 'BBA2023051636', 'profile_16.jpg', 'សុខ', 'វណ្ណា', 'Sok', 'Vanna', 1, 'Oh Bi Chorn', 'Oh Bi Chorn', 'Oh Chrov', 'Preah Sihanouk', '2000-09-01', 'Oh Bi Chorn', 'Oh Bi Chorn', 'Oh Chrov', 'Preah Sihanouk', 'Khmer', 'Meng Mon', '012345678', 'Meas Nika', '012345678', 1, 'Sok Kanha', 4, '012345678', '000001', '123456789', 1, 1, 1, '0123456789', 'example@example.com', 1, 'diploma.pdf', 'student_id.pdf', 'khmer_id.pdf');

INSERT INTO tblRegister VALUES
(null, 'Photo1.png', 'Meng', 'Theara', '', '', 1, 'Ang', 'Krang', 'Saang', 'Kandal', '2004-12-09', 'Phum 7', 'Tul K','Sen Sok 1', 'Phnom Penh', 'Khmer', 'Meng', '098674523', 'Sara', '089750045', 1, 'Heng', 'Brother', '012345678', 'ThStudent.png', '', 'thid.jpg', 2, 3, 2, 1),
(null, 'Photo2.png', 'Duk', 'Sima', '', '', 2, 'Valabong', 'AngKorAng', 'Peamchor', 'Preyveng', '2005-04-25', 'St 352', 'Boeng Keng Kong 1', 'Sen Sok', 'Phnom Phenh', 'Khmer', 'Thy', '0129687535', 'Ka', '0967464633', 1, 'Pich', 'Sister', '078594837', 'smStudent.png', '', 'smId.jpg', 1, 2, 4, 3),
(null, 'Photo3.png', 'Chan', 'Sarah', '', '', 1, 'Preah Monivong', 'Srah Chork', 'Daun Penh', 'Phnom Penh', '2003-07-25', 'Preah Monivong', 'Srah Chork', 'Daun Penh', 'Phnom Penh', 'Khmer', 'Thol', '0963852145', 'Thida', '0121347874', 3, 'Kanha', 'Friend', '0968574123', '', 'srStudent.png', 'srId.png', 3, 1, 5, 2),
(null, 'Photo4.png', 'Pho', 'Phearak', '', '',  2, 'Ompel Phaem', 'Vihear Loung', 'Ponhea Leu', 'Kandal', '2003-01-16', 'Anlong Kngan', 'Kmounh', 'Sen Sok', 'Phnom Penh', 'Khmer', 'Ku Khan', '0963852741', 'Oung Channy', '014787412', 2, 'Ountouch', 'Friend', '012121212', '', 'phStudent.png',  'myid.png', 1, 3, 1, 2);

INSERT INTO tblRegister VALUES
(null, 'Photo1.png', 'Meng', 'Theara', '', '', 1, 'Ang', 'Krang', 'Saang', 'Kandal', '2004-12-09', 'Phum 7', 'Tul K','Sen Sok 1', 'Phnom Penh', 'Khmer', 'Meng', '098674523', 'Sara', '089750045', 1, 'Heng', 'Brother', '012345678', 'ThStudent.png', '', 'thid.jpg', 2, 3, 2, 1),
(null, 'Photo2.png', 'Duk', 'Sima', '', '', 2, 'Valabong', 'AngKorAng', 'Peamchor', 'Preyveng', '2005-04-25', 'St 352', 'Boeng Keng Kong 1', 'Sen Sok', 'Phnom Phenh', 'Khmer', 'Thy', '0129687535', 'Ka', '0967464633', 1, 'Pich', 'Sister', '078594837', 'smStudent.png', '', 'smId.jpg', 1, 2, 4, 3),
(null, 'Photo3.png', 'Chan', 'Sarah', '', '', 1, 'Preah Monivong', 'Srah Chork', 'Daun Penh', 'Phnom Penh', '2003-07-25', 'Preah Monivong', 'Srah Chork', 'Daun Penh', 'Phnom Penh', 'Khmer', 'Thol', '0963852145', 'Thida', '0121347874', 3, 'Kanha', 'Friend', '0968574123', '', 'srStudent.png', 'srId.png', 3, 1, 5, 2);

INSERT INTO tblRegister VALUES (null, 'Mathin-Jazz.png', 'a', 'a', 'a', 'a' , '2', 'a', 'a', 'a', 'a', '2023-05-03' , 'a', 'a', 'a', 'a', 'a', 'a' , 'a', 'a', 'a', '2', 'a', '1' , 'a', 'apple-touch-icon.png', 'cta-bg.jpg', '1', '2', '5', '1');

INSERT INTO tblSex VALUES (null, 'Female'), (null, 'Male');
INSERT INTO tblMarried VALUES (null, 'Single'), (null, 'Married'), (null, 'Window(er)');
INSERT INTO tblShift VALUES (null, 'Morning(07:45-10:45)'), (null, 'Afternoon(11:00-14:00)'), (null, 'Afternoon(14:00-17:00)'), (null, 'Evening(17:30-20:30)'), (null, 'Weekend');
INSERT INTO tblPayment VALUES (null, 'Quarter'), (null, 'Semester'), (null, 'Yearly');
INSERT INTO tblRelationship VALUES (null, 'Mother'), (null, 'Father'), (null, 'Brother'), (null, 'Sister'), (null, 'Uncle'), (null, 'Aunt'), (null, 'Grandma'), (null, 'Grandpa'), (null, 'Other');

CREATE TABLE tblExpired(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Batch INT,
    Year INT,
    StartDate DATE,
    ExpiredDate DATE,
    StartClass DATE
);

select * from tblexpired;

INSERT INTO tblExpired VALUES
(null, 1, 2022, '2022-01-16', '2022-03-31', '2022-04-10'),
(null, 2, YEAR(NOW()), '2023-01-16', '2023-05-17', '2023-06-01');

UPDATE tblexpired SET ExpiredDate = '2023-05-30' WHERE ID = 2;

select * from tblUser;
drop table tblUser;

SELECT tblUser.ID, tblUser.Username, tblUser.Password, tblUser.Email, tblRole.Title AS Role, tblStatus.Title AS Status, tblUser.Profile 
            FROM tblUser
            INNER JOIN tblRole ON tblUser.Role = tblRole.ID
            INNER JOIN tblStatus ON tblUser.Status = tblStatus.ID
            WHERE tblUser.Username = 'Phearak';

drop table tblExpired;

CREATE TABLE tblAcademicProgram(
	ID INT AUTO_INCREMENT PRIMARY KEY,
	IconName VARCHAR(255) NOT NULL,
	IconSize INT NOT NULL,
	IconType VARCHAR(50) NOT NULL,
    Title VARCHAR(50),
    Description LONGTEXT
);

CREATE TABLE tblRole(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(10)
);

CREATE TABLE tblStatus(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(10)
);

CREATE TABLE tblUser(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(30) NOT NULL,
    Password LONGTEXT NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Role INT NOT NULL,
    Status INT NOT NULL,
    Created_by VARCHAR(30),
    Date DATETIME DEFAULT NOW(),
    Profile LONGTEXT NOT NULL,
    FOREIGN KEY (Role) REFERENCES tblRole(ID),
    FOREIGN KEY (Status) REFERENCES tblStatus(ID)
);

drop table tblUser;

INSERT INTO tblRole VALUES (null, 'Owner'), (null, 'Admin');
INSERT INTO tblStatus VALUES (null, 'Active'), (null, 'Inactive');

INSERT INTO tblUser(Username, Password, Email, Role, Status, Profile, Created_by) VALUES
('Phearak', '1232', 'phearakph2003@gmail.com', 1, 1, 'profile_7.jpg', 'Pho Phearak');

SELECT tblUser.ID, tblUser.Username, tblUser.Password, tblUser.Email, tblRole.Title AS Role, tblStatus.Title AS Status, tblUser.Profile 
                    FROM tblUser
                    INNER JOIN tblRole ON tblUser.Role = tblRole.ID
                    INNER JOIN tblStatus ON tblUser.Status = tblStatus.ID
                    WHERE tblUser.Username = 'Kimheak';

SELECT * FROM tblUser;
SELECT COUNT(*) AS count FROM tblUser WHERE Username = 'Nidet';
DELIMITER //
CREATE PROCEDURE userAccount(IN username VARCHAR(30))
BEGIN
    SELECT tblUser.ID, tblUser.Username, tblUser.Password, tblUser.Email, tblRole.Title AS Role, tblStatus.Title AS Status, tblUser.Profile 
	FROM tblUser
	INNER JOIN tblRole ON tblUser.Role = tblRole.ID
	INNER JOIN tblStatus ON tblUser.Status = tblStatus.ID
	WHERE tblUser.Username = username;
END //
DELIMITER ;

CALL userAccount('Phearak');
DROP PROCEDURE IF EXISTS userAccount;

DELIMITER //
CREATE PROCEDURE getUsers()
BEGIN
    SELECT tblUser.ID, tblUser.Username, tblUser.Password, tblUser.Email, tblRole.Title AS Role, tblStatus.Title AS Status, tblUser.Profile 
	FROM tblUser
	INNER JOIN tblRole ON tblUser.Role = tblRole.ID
	INNER JOIN tblStatus ON tblUser.Status = tblStatus.ID
    WHERE tbluser.Role <> 1;
END //
DELIMITER ;
drop procedure getUsers;
CALL getUsers();

SELECT tblUser.ID, tblUser.Username, tblUser.Password, tblUser.Email, tblRole.Title AS Role, tblStatus.Title AS Status, tblUser.Profile 
FROM tblUser
INNER JOIN tblRole ON tblUser.Role = tblRole.ID
INNER JOIN tblStatus ON tblUser.Status = tblStatus.ID
WHERE tblUser.Username = 'Phearak';

SELECT Status FROM tblUser WHERE Username = 'Phearak' AND Password = '1232';

CALL userAccount('Phearak');

CALL userAccount('Phearak');

CREATE TABLE tblMenu(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Menu_ID VARCHAR(30),
    Div_ID VARCHAR(30),
    Icon VARCHAR(100),
    Title VARCHAR(30),
    Span VARCHAR(200)
);

INSERT INTO tblMenu VALUES
(null, 'btnDashboard', 'dashboard', '<i class="fa-solid fa-house"></i>', 'Dashboard', ''),
(null, 'btnRequest', 'request', '<i class="fa-solid fa-graduation-cap"></i>', 'Enrollment Request', '<span class="badge bg-soft-danger text-danger rounded-pill d-inline-flex align-items-center ms-auto">'),
(null, 'btnUser', 'user', '<i class="fa-solid fa-users"></i>', 'Users', '<span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">'),
(null, 'btnSetting', 'setting', '<i class="fa-solid fa-gear"></i>', 'Site Setting', ''),
(null, 'btnComment', 'comment', '<i class="fa-regular fa-comment-dots"></i>', 'Comment', ''),
(null, 'btnSubscribe', 'subscribe', '<i class="fa-solid fa-newspaper"></i>', 'News Letter', '');

drop table tblMenu;

CREATE TABLE tblAccess(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Role INT,
    Menu INT,
    FOREIGN KEY (Role) REFERENCES tblRole(ID),
    FOREIGN KEY (Menu) REFERENCES tblMenu(ID)
);

INSERT INTO tblAccess VALUES
(null, 1, 1),
(null, 1, 2),
(null, 1, 3),
(null, 1, 4),
(null, 1, 5),
(null, 1, 6),
(null, 2, 1),
(null, 2, 2),
(null, 2, 4),
(null, 2, 5),
(null, 2, 6);

SELECT COUNT(*) FROM tblUser;

SELECT tblMenu.* FROM tblMenu 
INNER JOIN tblAccess ON tblMenu.ID = tblAccess.Menu 
INNER JOIN tblRole ON tblAccess.Role = tblRole.ID 
WHERE tblRole.Title = 'Owner';

SELECT * FROM tblRole;
SELECT * FROM tblMenu;
SELECT * FROM tblaccess;

drop table tblMenu;
drop table tblAccess;

drop database dbRegister;

drop table tblDepartment;
drop table tblMajor;
drop table tblSubject;
select * from tblMajor;
select * from tblDepartment;
select * from tblSubject;

SELECT tblMajor.ID, tblMajor.Title AS Major, tblMajor.Description, tblDepartment.Title AS Department, tblDepartment.Icon
FROM tblDepartment
JOIN tblMajor ON tblMajor.Department = tblDepartment.ID;
-------------------------------------------------------------------
CREATE TABLE tblTuitionFee(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Level INT,
    Price DECIMAL(10, 2),
    Description LONGTEXT,
    FOREIGN KEY (Level) REFERENCES tblLevel (ID)
);

INSERT INTO tblTuitionFee VALUES
(null, 1, 450, ''),
(null, 2, 600, ''),
(null, 3, 800, '');

SELECT tblTuitionFee.ID, tblLevel.Title, tblTuitionFee.Price, tblTuitionFee.Description FROM tblTuitionFee
JOIN tblLevel ON tblTuitionFee.Level = tblLevel.ID;
------------------------------------------------------------------
CREATE TABLE tblSubscribe(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(30) NOT NULL,
    Email LONGTEXT NOT NULL,
    Subscribe_Date DATETIME NOT NULL
);
truncate table ratings;

alter table tblSubscribe add column status VARCHAR(10) DEFAULT 'Active';
SELECT Email FROM tblSubscribe;
drop table tblContact;
SELECT * FROM tblContact WHERE ID BETWEEN 2 AND 4 ORDER BY ID DESC;
SELECT * FROM tblContact;
SELECT * FROM tblSubscribe;
SELECT COUNT(*) FROM ratings;

alter table tblSubscribe modify column Status VARCHAR(10) DEFAULT 'Active';
update tblSubscribe set Status = 'Active' WHERE ID = 1;

INSERT INTO tblSubscribe (Name, Email, Subscribe_Date) VALUES ('Phearak', 'phearak@gmail.com', NOW());

CREATE TABLE tblContact(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50),
    Icon VARCHAR(100),
    Text VARCHAR(255),
    Link LONGTEXT
);

INSERT INTO tblContact VALUES
(null, 'INFINITY Institute', 'infinity-logo.png', '', 'http://localhost:8080/application%20form/index.php'),
(null, 'Location', '<i class="fa-solid fa-location-dot"></i>', 'St. 5th, Vinhear Loung, Ponhea Leu, Kandal, Cambodia', 'https://www.google.com/maps/place/Glory+International+School+in+Oudong/@11.8229794,104.76758,15z/data=!4m6!3m5!1s0x310eb0e3c61ba661:0x2c4c593264eeefbc!8m2!3d11.8210473!4d104.7832061!16s%2Fg%2F11c6cbgyq0'),
(null, 'Email', '<i class="fa-regular fa-envelope"></i>', 'phearakph2003@gmail.com', 'mailto:phearakph2003@gmail.com'),
(null, 'Phone', '<i class="fa-solid fa-mobile-screen"></i>', '(+855) 96 848 4940', 'tel:(+855)968484940'),
(null, 'Telegram', '<i class="fa-brands fa-telegram"></i>', 'Pho Phearak', 'https://t.me/phearak2003'),
(null, 'Facebook', '<i class="fa-brands fa-facebook-f"></i>', 'Pho Phearak', 'https://www.facebook.com/phearak2003'),
(null, 'LinkedIn', '<i class="fa-brands fa-linkedin-in"></i>', 'Pho Phearak', 'https://www.linkedin.com/in/pho-phearak-32402024b/');

USE dbRegister;

CREATE TABLE ratings (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  rating INT(1) NOT NULL,
  name VARCHAR(255) NOT NULL,
  comments TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(10) DEFAULT 'Active'
);

alter table ratings add column Status INT DEFAULT 1;
INSERT INTO ratings (rating, name, comments) VALUES (4, 'John Doe', 'Great product!');

select * from ratings;
select * from tblMajor;
select * from tbllevel;
select * from tblSubject;

SELECT tblMajor.ID, tblMajor.Title AS Major, tblLevel.Title AS Level
FROM tblSubject
JOIN tblMajor ON tblSubject.Title = tblMajor.ID
JOIN tblLevel ON tblSubject.Level = tblLevel.ID WHERE tblLevel.ID = 3;

drop table tblDepartment;
drop table tblMajor;
drop table tbllevel;
drop table tblSubject;
drop table tblTuitionFee;
drop table tblUser;

select * from tbldepartment;

CREATE TABLE tblFormReg(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Form INT
);

INSERT INTO tblFormReg VALUES (null, 1);

delete from tblSex WHERE ID IN (3, 4);

alter table tblRegister add column Status VARCHAR(30) DEFAULT 'Under Review'; 

UPDATE tblRegister SET Status = 'Rejected' WHERE ID = 1;

USE dbRegister;
SELECT * FROM tblFormReg;
SELECT * FROM tblSubject;
SELECT * FROM tblSex;
SELECT * FROM tblMarried;
SELECT * FROM tblLevel;
SELECT * FROM tblMajor;
SELECT * FROM tblShift;
SELECT * FROM tblPayment;
SELECT * FROM tblRelationship;
SELECT * FROM tblRegister;
SELECT * FROM tblExpired WHERE Year = YEAR(NOW());
SELECT * FROM tblAcademicProgram;
SELECT * FROM tblRole;
SELECT * FROM tblStatus;
SELECT * FROM tblUser;
SELECT * FROM tblSubscribe;
SELECT * FROM tblMenu;
SELECT * FROM tblAccess;
SELECT * FROM tblTuitionFee;
SELECT * FROM tblMajor;
SELECT * FROM tblDepartment;
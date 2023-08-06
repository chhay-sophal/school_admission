Create database dbRegister;
USE dbRegister;

---------------------------------------------------------------------------------------------
CREATE TABLE tblDepartment(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Icon LONGTEXT NOT NULL,
    Title VARCHAR(30)
);
INSERT INTO tblDepartment VALUES
(null, '<i class="bi bi-pc-display-horizontal"></i>', 'Techonology'),
(null, '<i class="bi bi-cash"></i>', 'Finance'),
(null, '<i class="bi bi-bank"></i>', 'Banking'),
(null, '<i class="bi bi-chat-left-quote"></i>', 'Language');
drop table tblMajor;
CREATE TABLE tblMajor(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(50),
    Description LONGTEXT,
    Department INT,
    FOREIGN KEY (Department) REFERENCES tblDepartment (ID)
);
INSERT INTO tblMajor (Title, Description, Department) VALUES
('Computer Science', 'Study algorithms, programming languages, and software development', 1),
('Cybersecurity', 'Protect computer systems and networks from unauthorized access and attacks.', 1),
('Robotics', 'Design, build and program robots for various applications.', 1),
('Finance', 'Study investments, financial analysis, and risk management.', 2),
('Accounting', 'Learn financial reporting, auditing, and taxation.', 2),
('Economics', 'Analyze economic systems, policies, and market trends.', 2),
('Business Administration', 'Develop managerial and decision-making skills for various business contexts.', 2),
('Banking and Finance', 'Study financial markets, banking operations, and investment strategies.', 3),
('Risk Management', 'Assess and mitigate risks in banking and financial services.', 3),
('Financial Analysis', 'Analyze financial statements, market trends, and investment opportunities.', 3),
('Teaching English as a Foreign Language (TEFL)', 'focuses on teaching English to non-native speakers using various methods and techniques to develop language skills.', 4),
('English for Business Communication', 'teaches effective communication skills in English for professional contexts, including writing emails, making presentations, and negotiating deals.', 4);

CREATE TABLE tblSubject(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Title INT,
    Level INT,
    foreign key(Title) REFERENCES tblMajor(ID),
    foreign key(LEVEL) REFERENCES tbllevel(ID)
);
INSERT INTO tblSubject (Title, Level)
VALUES
(3, 1),
(4, 1),
(8, 1),
(10, 1),
(12, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(6, 3),
(7, 3),
(8, 3),
(11, 3);

CREATE TABLE tblLevel (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255)
);
INSERT INTO tblLevel VALUES (null, 'Associate Degree'), (null, 'Bachelor Degree'), (null, 'Master Degree');
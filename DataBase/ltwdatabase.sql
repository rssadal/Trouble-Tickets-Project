PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

.mode columns
.headers on

-- Table: User2
DROP TABLE IF EXISTS User2;
CREATE TABLE User2 (
    username    TEXT    PRIMARY KEY    NOT NULL,
    nome        TEXT    NOT NULL,
    password2   TEXT    NOT NULL,
    email       TEXT    NOT NULL,
    role2       TEXT    NOT NULL
);

-- Table: Ticket
DROP TABLE IF EXISTS Ticket;
CREATE TABLE Ticket (
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    department   TEXT NOT NULL,
    hashtag         TEXT    NOT NULL,
    title           TEXT    NOT NULL,
    date2           TEXT,
    description2    TEXT    NOT NULL,
    status2         TEXT    NOT NULL,
    user_username         TEXT,
    FOREIGN KEY (user_username) REFERENCES User2(username)
);

-- Table: AgentTicket
DROP TABLE IF EXISTS AgentTicket;
CREATE TABLE AgentTicket (
    user_username   TEXT,
    ticket_id       INTEGER,
    FOREIGN KEY (user_username) REFERENCES User2(username),
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id)
);

-- Table: Department
DROP TABLE IF EXISTS Department;
CREATE TABLE Department (
    id      INTEGER PRIMARY KEY AUTOINCREMENT,
    nome    TEXT
);

-- Table: UserDepartment
DROP TABLE IF EXISTS UserDepartment;
CREATE TABLE UserDepartment (
    user_username   TEXT,
    department_id   INTEGER,
    FOREIGN KEY (department_id) REFERENCES Department(id),
    FOREIGN KEY (user_username) REFERENCES User2(username)
);

-- Table: Faq
DROP TABLE IF EXISTS Faq;
CREATE TABLE Faq (
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    title           TEXT    NOT NULL,
    Description     TEXT    NOT NULL,
    date2           TEXT    NOT NULL
);

-- Table: Faq_department
DROP TABLE IF EXISTS Faq_department;
CREATE TABLE Faq_department (
    department_id   INTEGER,
    faq_id          INTEGER,
    FOREIGN KEY (department_id) REFERENCES Department(id),
    FOREIGN KEY (faq_id) REFERENCES Faq(id)
);

-- Table: Answers
DROP TABLE IF EXISTS Answers;
CREATE TABLE Answers (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    answer     TEXT    NOT NULL
   
);

-- Table: Ticket_Answer
DROP TABLE IF EXISTS Ticket_Answer;
CREATE TABLE Ticket_Answer (
    ticket_id   INTEGER,
    answer_id   INTEGER,
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id),
    FOREIGN KEY (answer_id) REFERENCES Answers(id)
);

-- Table: Answer_Worker
DROP TABLE IF EXISTS Answer_Worker;
CREATE TABLE Answer_Worker (
    answer_id   INTEGER,
    username    TEXT,  
    FOREIGN KEY (answer_id) REFERENCES Answers(id),
    FOREIGN KEY (username) REFERENCES User2(username)
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = ON;

PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

-- Insert data into User2 table
INSERT INTO User2 VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
INSERT INTO User2 VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('user', 'eu', '123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('novo', 'eusounovo', '123', 'novo@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('maria69', 'maria69', '69', 'maria@hotmail.com', 'Services');

INSERT INTO Department (nome) VALUES ("marketing");
INSERT INTO Department (nome) VALUES ("tech help");
INSERT INTO Department (nome) VALUES ("information");

INSERT INTO Ticket (department, hashtag, date2, title, status2, user_username, description2) VALUES ('Marketing', '#', '04-05-2023', 'client waiting for meeting with business team', 'waiting','diogo13350', "");
INSERT INTO Ticket (department, hashtag, date2, title, status2, user_username, description2) VALUES ('Tech Help', '#', '05-05-2023', 'client waiting for tech help', 'waiting','diogo13350', "");
INSERT INTO Ticket (department, hashtag, date2, title, status2, user_username, description2) VALUES ('Tech Help', '#', '06-05-2023', 'client waiting for tech help', 'waiting','Pedroxx', "");
INSERT INTO Ticket (department, hashtag, date2, title, status2, user_username, description2) VALUES ('Marketing', '#', '02-05-2023', 'client waiting for meeting with business team', 'waiting','Pedroxx', "");
INSERT INTO Ticket (department, hashtag, date2, title, status2, user_username, description2) VALUES ('Information', '#', '04-05-2023', 'client requires information about a product', 'waiting','franca123', "");

INSERT INTO Answers (answer) VALUES ('This is the answer to the first question.');
INSERT INTO Answers (answer) VALUES ('Here is the answer to the second question.');
INSERT INTO Answers (answer) VALUES ('The answer to the third question is as follows.');
INSERT INTO Answers (answer) VALUES ('For the fourth question, the answer is provided here.');
INSERT INTO Answers (answer) VALUES ('Finally, here is the answer to the fifth question.');

INSERT INTO Faq VALUES (0,'what departments do you have?','What departments do you have and which one should i submit my request?','04-05-2023');
INSERT INTO Faq VALUES (1,'Submit question to department','Can i submit a question to the deparment?','02-09-2023');
INSERT INTO Faq VALUES (2,'Can I have acess to all the clients that have requested a ticket?','Question in the title','02-12-2021');
INSERT INTO Faq VALUES (3,'What does this company do?','WHat do guys speacilize in','10-10-2023');
INSERT INTO Faq VALUES (4,'Ticket to department','can i see what depaetment is the ticket associated','01-01-2023');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;



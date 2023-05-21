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

COMMIT TRANSACTION;
PRAGMA foreign_keys = ON;

PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

-- Insert data into User2 table
INSERT INTO User2 (username, nome, password2, email, role2) VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
INSERT INTO User2 (username, nome, password2, email, role2) VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
INSERT INTO User2 (username, nome, password2, email, role2) VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');

-- INSERT INTO User2 (username, nome, password2, email, role2) VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
-- INSERT INTO User2 (username, nome, password2, email, role2) VALUES ('Pedroxx', 'diogo camara', 'Adivinha', 'pedroxx@gmail.com', 'cliente');

INSERT INTO Department (nome) VALUES ("marketing");
INSERT INTO Department (nome) VALUES ("tech help");
INSERT INTO Department (nome) VALUES ("information");

-- INSERT INTO UserDepartment (user_username, department_id) VALUES ("diogo13350", "marketing");

-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('tech help', '#', 'client waiting for tech help', '05-05-2023', "",'waiting','diogo13350');
-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('tech help', '#', 'client waiting for tech help', '06-05-2023', "", 'waiting','Pedroxx');
-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('marketing', '#', 'client waiting for meeting with business team', '06-05-2023', "", 'waiting','Pedroxx');
-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('information', '#', 'client requires information about a product', '06-05-2023', "", 'waiting','franca123');

-- INSERT INTO AgentTicket (user_username, ticket_id) VALUES ("diogo13350", 0);
-- INSERT INTO AgentTicket (user_username, ticket_id) VALUES ("diogo13350", 1);
-- INSERT INTO AgentTicket (user_username, ticket_id) VALUES ("Pedroxx", 3);

INSERT INTO Faq VALUES (0,'what departments do you have?','What departments do you have and which one should i submit my request?','04-05-2023');
INSERT INTO Faq VALUES (1,'Submit question to department','Can i submit a question to the deparment?','02-09-2023');
INSERT INTO Faq VALUES (2,'Can I have acess to all the clients that have requested a ticket?','Question in the title','02-12-2021');
INSERT INTO Faq VALUES (3,'What does this company do?','WHat do guys speacilize in','10-10-2023');
INSERT INTO Faq VALUES (4,'Ticket to department','can i see what depaetment is the ticket associated','01-01-2023');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;



PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

.mode columns
.headers on

-- Table: User2
DROP TABLE IF EXISTS User2;
CREATE TABLE User2 (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    username    TEXT    NOT NULL,
    nome        TEXT    NOT NULL,
    password2   TEXT    NOT NULL,
    email       TEXT    NOT NULL,
    role2       TEXT    NOT NULL
);

-- Table: Ticket
DROP TABLE IF EXISTS Ticket;
CREATE TABLE Ticket (
    id              INTEGER PRIMARY KEY,
    department_id   INTEGER NOT NULL,
    hashtag         TEXT    NOT NULL,
    title           TEXT    NOT NULL,
    date2           TEXT,
    description2    TEXT    NOT NULL,
    status2         TEXT    NOT NULL,
    user_id         TEXT,
    FOREIGN KEY (user_id) REFERENCES User2(id)
    FOREIGN KEY (department_id) REFERENCES Department(id)
);

-- Table: UsernameTicket
DROP TABLE IF EXISTS AgentTicket;
CREATE TABLE AgentTicket (
    user_id   TEXT,
    ticket_id       INTEGER,
    FOREIGN KEY (user_id) REFERENCES User2(id),
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id)
);

-- Table: Department
DROP TABLE IF EXISTS Department;
CREATE TABLE Department (
    id      INTEGER PRIMARY KEY,
    nome    TEXT
);

DROP TABLE IF EXISTS Faq;
CREATE TABLE Faq (
    id              INTEGER PRIMARY KEY,
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
-- INSERT INTO User2 VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
-- INSERT INTO User2 VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
-- INSERT INTO User2 VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');

INSERT INTO User2 (username, nome, password2, email, role2) VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
INSERT INTO User2 (username, nome, password2, email, role2) VALUES ('Pedroxx', 'diogo camara', 'Adivinha', 'pedroxx@gmail.com', 'cliente');

INSERT INTO Faq VALUES (0,'what departments do you have?','What departments do you have and which one should i submit my request?','04-05-2023');
INSERT INTO Faq VALUES (1,'Submit question to department','Can i submit a question to the deparment?','02-09-2023');
INSERT INTO Faq VALUES (2,'Can I have acess to all the clients that have requested a ticket?','Question in the title','02-12-2021');
INSERT INTO Faq VALUES (3,'What does this company do?','WHat do guys speacilize in','10-10-2023');
INSERT INTO Faq VALUES (4,'Ticket to department','can i see what depaetment is the ticket associated','01-01-2023');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;



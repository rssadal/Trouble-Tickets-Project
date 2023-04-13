PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

.mode columns
.headers on

-- Table: User2
DROP TABLE IF EXISTS User2;

CREATE TABLE User2 (
    username    TEXT    PRIMARY KEY,
    nome        TEXT    NOT NULL,
    password2   TEXT    NOT NULL,
    email       TEXT    NOT NULL,
    role2       TEXT    NOT NULL
);

-- Table: Ticket
DROP TABLE IF EXISTS Ticket;
CREATE TABLE Ticket (
    id              INTEGER PRIMARY KEY,
    department      TEXT    NOT NULL,
    hashtag         TEXT    NOT NULL,
    date2           TEXT,
    description2    TEXT    NOT NULL,
    status2         TEXT    NOT NULL,
    user_username   TEXT,
    FOREIGN KEY (user_username) REFERENCES User2(username)
);

-- Table: UsernameTicket
DROP TABLE IF EXISTS UsernameTicket;
CREATE TABLE UsernameTicket (
    user_username   TEXT,
    ticket_id       INTEGER,
    FOREIGN KEY (user_username) REFERENCES User2(username),
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id)
);

-- Table: Department
DROP TABLE IF EXISTS Department;
CREATE TABLE Department (
    id      INTEGER PRIMARY KEY,
    nome    TEXT
);

-- Table: Faq
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
INSERT INTO User2 VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
INSERT INTO User2 VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;



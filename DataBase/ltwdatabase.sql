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
DROP TABLE IF EXISTS UsernameTicket;
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

-- Table: Faq
DROP TABLE IF EXISTS Faq;
CREATE TABLE Faq (
    id              INTEGER PRIMARY KEY,
    title           TEXT    NOT NULL,
    description     TEXT    NOT NULL,
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

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;



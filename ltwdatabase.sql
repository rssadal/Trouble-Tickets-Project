
PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

-- Table: Cliente
DROP TABLE IF EXISTS User2;

CREATE TABLE User2 (
    username        TEXT    PRIMARY KEY,
    nome            TEXT    NOT NULL,
    password2       TEXT    NOT NULL,
    email           TEXT    NOT NULL,
    role2           TEXT    NOT NULL

);

-- Table: Artigo
DROP TABLE IF EXISTS Ticket;

CREATE TABLE Ticket (
    id INTEGER PRIMARY KEY,
    department   TEXT    NOT NULL,
    hashtag      TEXT    NOT NULL,
    date2        TEXT,
    description2 TEXT   NOT NULL,
    status2      TEXT   NOT NULL,
    user_usarname TEXT,
    FOREIGN KEY (user_usarname) REFERENCES User2(username)
);


-- Table:  UsernameTicke
DROP TABLE IF EXISTS  UsernameTicke;

CREATE TABLE  UsernameTicke (
    user_username     TEXT,
    ticket_id     INTEGER,
    FOREIGN KEY (user_usarname) REFERENCES User2(username),
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id)
);

-- Table:  Department 
DROP TABLE IF EXISTS  Department ;

CREATE TABLE  Department  (
    id INTEGER PRIMARY KEY,
    nome  TEXT 
  
);

-- Table:  FAQ 
DROP TABLE IF EXISTS  Faq ;

CREATE TABLE  Faq  (
    id INTEGER PRIMARY KEY,
    title  TEXT NOT NULL,
    Descrition  TEXT NOT NULL,
    date2 TEXT NOT NULL
);


-- Table:  faq_department 
DROP TABLE IF EXISTS  faq_department ;

CREATE TABLE   faq_department   (
    deparment_id  INTEGER,
    faq_id  INTEGER,
    FOREIGN KEY (department_id) REFERENCES Department(id),
    FOREIGN KEY (faq_id) REFERENCES Faq(id)

);



COMMIT TRANSACTION;

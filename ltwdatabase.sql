--
-- File generated with SQLiteStudio v3.1.1 on domingo abr 15 20:33:39 2018
--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

-- Table: Cliente
DROP TABLE IF EXISTS User2;

CREATE TABLE User2 (
    Username        TEXT    PRIMARY KEY,
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
    user_usarname TEXT FOREIGN KEY


);

-- Table:  UsernameTicke
DROP TABLE IF EXISTS  UsernameTicke;

CREATE TABLE  UsernameTicke (
    user_username     TEXT FOREIGN KEY,
    ticket_id     INTEGER FOREIGN KEY
  
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
    deparment_id  INTEGER FOREIGN KEY,
    faq_id  INTEGER FOREIGN KEY
);



COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
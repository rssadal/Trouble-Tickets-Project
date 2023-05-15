
CREATE TABLE User2 (
    username    TEXT    PRIMARY KEY,
    nome        TEXT    NOT NULL,
    password2   TEXT    NOT NULL,
    email       TEXT    NOT NULL,
    role2       TEXT    NOT NULL
);

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

CREATE TABLE UsernameTicket (
    user_username   TEXT,
    ticket_id       INTEGER,
    FOREIGN KEY (user_username) REFERENCES User2(username),
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id)
);

CREATE TABLE Department (
    id      INTEGER PRIMARY KEY,
    nome    TEXT
);

CREATE TABLE Faq (
    id              INTEGER PRIMARY KEY,
    title           TEXT    NOT NULL,
    Description     TEXT    NOT NULL,
    date2           TEXT    NOT NULL
);


CREATE TABLE Faq_department (
    department_id   INTEGER,
    faq_id          INTEGER,
    FOREIGN KEY (department_id) REFERENCES Department(id),
    FOREIGN KEY (faq_id) REFERENCES Faq(id)
);


INSERT INTO User2 VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
INSERT INTO User2 VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('user', 'eu', '123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('novo', 'eusounovo', '123', 'novo@hotmail.com', 'cliente');

INSERT INTO Ticket VALUES (0, 'marketing', '#', '04-05-2023', 'client waiting for meeting with business team', 'waiting','diogo13350');
INSERT INTO Ticket VALUES (1, 'tech help', '#', '05-05-2023', 'client waiting for tech help', 'waiting','diogo13350');
INSERT INTO Ticket VALUES (2, 'tech help', '#', '06-05-2023', 'client waiting for tech help', 'waiting','Pedroxx');
INSERT INTO Ticket VALUES (3, 'marketing', '#', '02-05-2023', 'client waiting for meeting with business team', 'waiting','Pedroxx');
INSERT INTO Ticket VALUES (4, 'information', '#', '04-05-2023', 'client requires information about a product', 'waiting','franca123');

INSERT INTO Faq VALUES (0,'what departments do you have?','What departments do you have and which one should i submit my request?','04-05-2023');
INSERT INTO Faq VALUES (1,'Submit question to department','Can i submit a question to the deparment?','02-09-2023');
INSERT INTO Faq VALUES (2,'Can I have acess to all the clients that have requested a ticket?','Question in the title','02-12-2021');
INSERT INTO Faq VALUES (3,'What does this company do?','WHat do guys speacilize in','10-10-2023');
INSERT INTO Faq VALUES (4,'Ticket to department','can i see what depaetment is the ticket associated','01-01-2023');
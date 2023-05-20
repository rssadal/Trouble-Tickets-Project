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

CREATE TABLE Answers (
    id         INTEGER PRIMARY KEY,
    answer     TEXT    NOT NULL
   
);

CREATE TABLE Ticket_Answer (
    ticket_id   INTEGER,
    answer_id   INTEGER,
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id),
    FOREIGN KEY (answer_id) REFERENCES Answers(id)
);

CREATE TABLE Answer_Worker (
    answer_id   INTEGER,
    username    TEXT,  
    FOREIGN KEY (answer_id) REFERENCES Answers(id),
    FOREIGN KEY (username) REFERENCES User2(username)
);

INSERT INTO User2 VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
INSERT INTO User2 VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('user', 'eu', '123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('novo', 'eusounovo', '123', 'novo@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('maria69', 'maria69', '69', 'maria@hotmail.com', 'Services');

INSERT INTO Ticket VALUES (0, 'marketing', '#', '04-05-2023', 'client waiting for meeting with business team', 'waiting','diogo13350');
INSERT INTO Ticket VALUES (1, 'tech help', '#', '05-05-2023', 'client waiting for tech help', 'waiting','diogo13350');
INSERT INTO Ticket VALUES (2, 'tech help', '#', '06-05-2023', 'client waiting for tech help', 'waiting','Pedroxx');
INSERT INTO Ticket VALUES (3, 'marketing', '#', '02-05-2023', 'client waiting for meeting with business team', 'waiting','Pedroxx');
INSERT INTO Ticket VALUES (4, 'information', '#', '04-05-2023', 'client requires information about a product', 'waiting','franca123');

INSERT INTO Answers VALUES (0, 'This is the answer to the first question.');
INSERT INTO Answers VALUES (1, 'Here is the answer to the second question.');
INSERT INTO Answers VALUES (2, 'The answer to the third question is as follows.');
INSERT INTO Answers VALUES (3, 'For the fourth question, the answer is provided here.');
INSERT INTO Answers VALUES (4, 'Finally, here is the answer to the fifth question.');

INSERT INTO Ticket_Answer VALUES  (0, 0);
INSERT INTO Ticket_Answer VALUES  (0, 1);
INSERT INTO Ticket_Answer VALUES  (0, 2);
INSERT INTO Ticket_Answer VALUES  (1, 3);
INSERT INTO Ticket_Answer VALUES  (1, 4);

INSERT INTO Answer_Worker VALUES  (0, 'maria69');
INSERT INTO Answer_Worker VALUES  (1, 'maria69');
INSERT INTO Answer_Worker VALUES  (2, 'maria69');
INSERT INTO Answer_Worker VALUES  (3, 'maria69');
INSERT INTO Answer_Worker VALUES  (4, 'maria69');





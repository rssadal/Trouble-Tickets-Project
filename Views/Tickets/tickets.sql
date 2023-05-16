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

INSERT INTO User2 VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
INSERT INTO User2 VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('user', 'eu', '123', 'francisco.amaizade@hotmail.com', 'cliente');
INSERT INTO User2 VALUES ('novo', 'eusounovo', '123', 'novo@hotmail.com', 'cliente');

INSERT INTO Ticket VALUES (0, 'marketing', '#', '04-05-2023', 'Does the IT company have a dedicated customer support team?', 'waiting','diogo13350');
INSERT INTO Ticket VALUES (1, 'tech help', '#', '05-05-2023', 'How does the IT company ensure data security for its clients?', 'waiting','diogo13350');
INSERT INTO Ticket VALUES (2, 'tech help', '#', '06-05-2023', 'Does the IT company provide ongoing IT maintenance and support?','Pedroxx');
INSERT INTO Ticket VALUES (3, 'marketing', '#', '02-05-2023', 'client waiting for meeting with business team', 'waiting','Pedroxx');
INSERT INTO Ticket VALUES (4, 'information', '#', '04-05-2023', 'client requires information about a product', 'waiting','franca123');


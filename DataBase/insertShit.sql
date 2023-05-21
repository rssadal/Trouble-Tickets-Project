-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('tech help', '#', 'client waiting for tech help', '05-05-2023', "",'waiting','diogo13350');
-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('tech help', '#', 'client waiting for tech help', '06-05-2023', "", 'waiting','Pedroxx');
-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('marketing', '#', 'client waiting for meeting with business team', '06-05-2023', "", 'waiting','Pedroxx');
-- INSERT INTO Ticket (department, hashtag, title, date2, description2, status2, user_username) VALUES ('information', '#', 'client requires information about a product', '06-05-2023', "", 'waiting','franca123');

-- INSERT INTO AgentTicket (user_username, ticket_id) VALUES ("diogo13350", 0);
-- INSERT INTO AgentTicket (user_username, ticket_id) VALUES ("diogo13350", 1);
-- INSERT INTO AgentTicket (user_username, ticket_id) VALUES ("Pedroxx", 3);

-- INSERT INTO UserDepartment (user_username, department_id) VALUES ("diogo13350", "marketing");

INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES  (0, 0);
INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES  (0, 1);
INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES  (0, 2);
INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES  (1, 3);
INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES  (1, 4);

-- INSERT INTO Answer_Worker VALUES  (0, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (1, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (2, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (3, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (4, 'maria69');

-- INSERT INTO User2 VALUES ('diogo13350', 'diogo camara', 'Adivinha', 'diogo13350@hotmail.com', 'cliente');
-- INSERT INTO User2 VALUES ('Pedroxx', 'pedro albranaz', '12345', 'pedroxx@gmail.com', 'cliente');
-- INSERT INTO User2 VALUES ('franca123', 'francisco franco', 'ilove123', 'francisco.amaizade@hotmail.com', 'cliente');
-- INSERT INTO User2 VALUES ('user', 'eu', '123', 'francisco.amaizade@hotmail.com', 'cliente');
-- INSERT INTO User2 VALUES ('novo', 'eusounovo', '123', 'novo@hotmail.com', 'cliente');
-- INSERT INTO User2 VALUES ('maria69', 'maria69', '69', 'maria@hotmail.com', 'Agent');

-- INSERT INTO Answers (answer) VALUES ('This is the answer to the first question.');
-- INSERT INTO Answers (answer) VALUES ('Here is the answer to the second question.');
-- INSERT INTO Answers (answer) VALUES ('The answer to the third question is as follows.');
-- INSERT INTO Answers (answer) VALUES ('For the fourth question, the answer is provided here.');
-- INSERT INTO Answers (answer) VALUES ('Finally, here is the answer to the fifth question.');

-- INSERT INTO Answer_Worker VALUES  (0, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (1, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (2, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (3, 'maria69');
-- INSERT INTO Answer_Worker VALUES  (4, 'maria69');
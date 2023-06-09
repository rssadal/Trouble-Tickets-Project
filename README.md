# Trouble-Tickets-Project

Project for the 2023 edition of the Web Languages and Technologies course.

# Team
- Adalberto Guedes
- Diogo Câmara
- Mariana Cavalcante

# Objective
Develop a website to streamline and manage trouble tickets effectively. The system should enable users to submit, track, and resolve tickets promptly and efficiently. Additionally, the website should have intuitive user interfaces and reporting functionalities to provide real-time insights into ticket status and performance metrics.

To create this website, we:

 - Create an SQLite database that stores information about users, tickets, departments, hashtags, and frequently asked questions (FAQ).
 - Create documents using HTML and CSS representing the application's web pages.
 - Use PHP to generate those web pages after retrieving/changing data from the database.
 - Use Javascript to enhance the user experience (for example, using Ajax).

# How to run
```
git clone https://github.com/rssadal/Trouble-Tickets-Project.git

cd Trouble-Tickets-Project

git checkout final-delivery-v1

sqlite3 database/ltwdatabase.db < database/ltwdatabase.sql

php -S localhost:9000
```

## Features
All users should be able to:
- [x] Register a new account.
- [x] Login and logout.
- [x] Edit their profile (at least name, username, password, and e-mail).

Clients should be able to:
- [X] Submit a new ticket *optionally* choosing a department (e.g., "Accounting")
- [X] List and track tickets they have submitted.
- [X] Reply to inquiries (e.g., the agent asks for more details) about their tickets and add more information to already submitted tickets.

Agents should be able to (they are also clients):
- [X] List tickets from their departments (e.g., "Accounting"), and filter them in different ways (e.g., by date, by assigned agent, by status, by priority, by hashtag).
- [X] Change the department of a ticket (e.g., the client chose the wrong department).
- [X] Assign a ticket to themselves or someone else.
- [X] Change the status of a ticket. Tickets can have many statuses (e.g., open, assigned, closed); some may change automatically (e.g., ticket changes to "assigned" after being assigned to an agent).
- [X] Edit ticket hashtags easily (just type hashtag to add (with autocomplete), and click to remove).
- [X] List all changes done to a ticket (e.g., status changes, assignments, edits).
- [X] Manage the FAQ and use an answer from the FAQ to answer a ticket.

Admins should be able to (they are also agents):
- [X] Upgrade a client to an agent or an admin.
- [X] Assign agents to departments.
- [X] Control the whole system.


## User privileges

| Action                                         | Client | Agent | Admin |
| --------------------------------------------   | ------ | ----- | ----- |
| Submit a new ticket                            | X      | X     |    X  |
| List and track tickets they have submitted     | X      | X     |    X  |
| List tickets from their departments            |        | X     |    X  |
| filter tickets*                                |        | X     |    X  | 
| Change the department of a ticket              |        | X     |    X  | 
| Assign a ticket to themselves or someone else. |        | X     |    X  |
| Change the status of a ticket.                 |        | X     |    X  | 
| Edit ticket hashtags                           |        | X     |    X  | 
| List all changes done to a ticket (ticket history) |        | X     |    X  |
| Manage the FAQ                                 |        | X     |    X  | 
| Use an answer from the FAQ to answer a ticket  |        | X     |    X  |
| Upgrade a client to an agent or an admin       |        |       |    X  |
| Add new departments, statuses, and other relevant entities       |        |       |    X  |
| Assign agents to departments                   |        |       |    X  | 

*by date, by assigned agent, by status, by priority, by hashtag


### Technologies
- [x] Sqlite
- [x] Semantic HTML tags
- [x] PHP 
- [x] Responsive CSS
- [x] Javascript


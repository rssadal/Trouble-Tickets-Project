<!DOCTYPE html>

<html>
    <style>
        /* Remove the border */
        iframe {
            border: none;
        }

    </style>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../Style/master.css">
        <link rel="stylesheet" href="../../Style/tickets.css">
        <script src="../../Scripts/master.js"></script>
        <link type="image/png" sizes="32x32" rel="icon" href="../../Images/icon.png">
        <title>Tickets</title>
    </head>

    <body>

        <header>
            <div onclick="mainPrincipal()" id="logo"><h2>Solve Us</h2></div>
            <div id="icon" onclick="goToProfile()">
                <img src="../../Images/pngwing.com.png" alt="Image" class="square-image">
            </div>
        </header>
        <div id="container" class="box">

        
            <h1>
                Ticket Solver
            </h1>
         
            <h2>
                Current Ticket
            </h2>
            
            <?php

                session_start();
                include_once('../Login/connect.php');
                global $db;

                $currentUsername = $_SESSION['username'];
             
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $stmt = $db->prepare('SELECT id, department ,hashtag, date2, description2, status2, user_username FROM Ticket WHERE id = :id');
                    $stmt->bindParam(':id', $id);
                    $result = $stmt->execute();

                    if (!$result) {
                        echo "Error fetching from db";
                        throw new Exception('Query execution failed');
                    }
                
                    $tickets = array();
                
                    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                        foreach ($row as $rowItem){
                            $id = $rowItem['id'];
                            $department = $rowItem['department'];
                            $hashtag = $rowItem['hashtag'];
                            $date = $rowItem['date2'];
                            $description = $rowItem['description2'];
                            $status = $rowItem['status2'];
                            $username = $rowItem['user_username'];
                    
                            $tickets[] = array($id, $department, $hashtag, $date, $description, $status, $username);
                        }
                    }
                   
                    echo '<div class="ticket-container cdd">';
                    echo '<h2 class="ticket-id">Ticket ID: ' . $id . '</h2>';
                    echo '<h3 class="ticket-status-date">Ticket status:';
                
                    // Dropdown for ticket status
                    echo '<select id="status-dropdown" class="status-dropdown">';
                    echo '<option value="' . $status . '" selected>' . $status . '</option>';
                    echo '<option value="Open">Open</option>';
                    echo '<option value="In Progress">In Progress</option>';
                    echo '<option value="Resolved">Resolved</option>';
                    echo '</select>';
                    echo '</h3>';
                    echo '<h3 class="ticket-status-date">';
                    echo ' Department:';
                
                    // Dropdown for department
                    echo '<select id="department-dropdown" class="department-dropdown">';
                    echo '<option value="' . $department . '" selected>' . $department . '</option>';
                    echo '<option value="Marketing">Marketing</option>';
                    echo '<option value="Tech Help">Tech Help</option>';
                    echo '<option value="Information">Information</option>';
                    echo '</select>';

                
                
                    //TICKET INFORMATION
                    echo '</h3>';
                    echo '<p class="ticket-description">' . $description . '</p>';
                    echo '<p>Submited by: ' . $username . ' in: ' . $date . '</p>';

                    // new hashtag
                    echo '<p> Ticket HashTag: ' . $hashtag . '</p>';
                    echo '<button id="new_tag" class="new_tag basic" onclick="newtag(' . $id . ')">Edit HashTag</button>';
                
                    echo '</div>';
                } 
                
                else {
                    echo "No ID provided.";
                }

                //GET NUMBER OF ASSOCIATED ANSWER TO THIS TICKET
                $query = $db->prepare('SELECT COUNT(*) AS answer_count
                    FROM Ticket_Answer
                    JOIN Answers ON Ticket_Answer.answer_id = Answers.id
                    WHERE Ticket_Answer.ticket_id = :ticket_id
                ');
                if (!$query) {
                    echo "Error fetching from db";
                    throw new Exception('Query execution failed');
                }
                $query->bindValue(':ticket_id', $id);
                $result = $query->execute();

                if (!$result) {
                    echo "Error fetching from db";
                    throw new Exception('Query execution failed');
                }
                $answerCount = $query->fetchColumn();;
                
                // Retrieve the answer count
                
            
                echo "<h2>Talk with one of our Service member</h2>";
                echo "Ticket with ID " . $id . " is associated with " . $answerCount . " answer(s).";

        $query = $db->prepare('SELECT Answers.answer, Answers.id, Answer_Worker.username, User2.role2
            FROM Ticket
            JOIN Ticket_Answer ON Ticket.id = Ticket_Answer.ticket_id
            JOIN Answers ON Ticket_Answer.answer_id = Answers.id
            JOIN Answer_Worker ON Answers.id = Answer_Worker.answer_id
            JOIN User2 ON Answer_Worker.username = User2.username
            WHERE Ticket.id = :ticket_id
        ');
        $query->bindValue(':ticket_id', $id);

        // Execute the query and fetch the results
        $result = $query->execute();
        if (!$result) {
            echo "Error fetching from db";
            throw new Exception('Query execution failed');
        }
        echo '<div class="chat">'; 
        // Loop through the results and output the response answers with usernames and roles
        while ($row = $query->fetchALL(PDO::FETCH_ASSOC)) {
            foreach ($row as $rowItem){
                if ($rowItem['role2'] === 'agent') {
                
                    echo '<div class="ticket-container2 cdd">';
                    echo '<div>';
                    echo '<span class="answer-id">This answer has been given the id ' . $rowItem['id'] . '</span>';
                    echo '</div>';
                    echo '<div>';
                    echo '<span class="answer">Answer: ' . $rowItem['answer'] . '</span>';
                    echo '</div>';
                    echo '<div>';
                    echo '<span class="username">Answered by: ' . $rowItem['username'] . '</span>';
                    echo '</div>';
                    echo '<div>';
                    echo '<span class="role"> with role of ' . $rowItem['role2'] . '</span>';
                    echo '</div>';
                    echo '</div>';
                }
                
                else{
                    echo '<div class="ticket-container1 cdd">';
                    echo '<div>';
                    echo '<span class="answer-id">This answer has been given the id ' . $rowItem['id'] . '</span>';
                    echo '</div>';
                    echo '<div>';
                    echo '<span class="answer">Answer: ' . $rowItem['answer'] . '</span>';
                    echo '</div>';
                    echo '<div>';
                    echo '<span class="username">Answered by: ' . $rowItem['username'] . '</span>';
                    echo '</div>';
                    echo '<div>';
                    echo '<span class="role"> with role of ' . $rowItem['role2'] . '</span>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
            echo '</div>';
            // Close the database connection
            $db = null;

            echo "<h2> Answer to this Ticket(only Ticket owner or Company worker might post here) </h2>";
            // input box and button
            echo '<div class="message-box">';
            echo '<div><textarea id="message-input" rows="4" cols="50" class="message-input" placeholder="Write your message here"></textarea></div>';
            echo '<div><button id="send-button" class="send-button confirm" onclick="sendMessage(' . $id . ')">Send</button></div>';
            echo '</div>';


        ?>  
        </div>         
        <script>

            function goBack() {
                window.location.href = "../../Views/Login/login.html";
            }

            function newtag(ticketId) {
                var userInput = prompt("Enter new hashtag:");
                if (userInput !== null) { // Check OK or Cancel
                    console.log(userInput + "estou aqui");
                }
                console.log(ticketId);
                console.log("change hashtag");
                var formData = new FormData();
                formData.append('userInput', userInput);
                formData.append('ticketId', ticketId);

                
                fetch('change_hashtag.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Response:', data);
                    location.reload();
             
                })
                .catch(error => {
                  
                    console.error('Error:', error);
                });

            }

            function sendMessage(ticketId){
                console.log("CLIQUEI NO BOTAO");
                var messageinput = document.getElementById("message-input").value;


                console.log(messageinput);
                console.log('Sending message for ticket ID: ' + ticketId);

                var formData = new FormData();
                formData.append('ticketId', ticketId);
                formData.append('messageinput', messageinput); 

            
                fetch('add_answer_to_ticket.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Response:', data);
             
                })
                .catch(error => {
                  
                    console.error('Error:', error);
                });

                location.reload();
                     
            }

            
            //Change the status of the ticket
            var statusDropdown = document.getElementById("status-dropdown");
            statusDropdown.addEventListener("change", function() {
                // Get the selected status
                var selectedStatus = statusDropdown.value;
                // Get the current ticket ID from PHP code
                var currentTicketId = <?php echo $id; ?>;
                updateTicketStatus(currentTicketId,selectedStatus);
            });


          
            //Change the department the tickets belongs
            var departmentDropdown = document.getElementById("department-dropdown");
            departmentDropdown.addEventListener("change", function() {
                var selectedDepartment = departmentDropdown.value;
                var currentTicketId = <?php echo $id; ?>;
                updateTicketDepartment(currentTicketId, selectedDepartment);
            });

            function updateTicketDepartment(ticketId, newDepartment) {
                console.log("Entered the function to update the department");
                console.log(ticketId);
                console.log(newDepartment);
                var xhr = new XMLHttpRequest();

                xhr.open("POST", "update_ticket_department.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log(xhr.responseText);
                    }
                };

              
                var data = "ticketId=" + encodeURIComponent(ticketId) + "&newdepartment=" + encodeURIComponent(newDepartment);
                xhr.send(data);
            }

            function updateTicketStatus(ticketId,newStatus) {
                console.log("entrei na funcao de dar update ao status")
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_ticket_status.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log(xhr.responseText);
                    }
                };

                var data = "ticketId=" + encodeURIComponent(ticketId) + "&newStatus=" + encodeURIComponent(newStatus);
                xhr.send(data);
   
            }

        </script>

        <footer>
            <div class="footer">
                University of Porto
            </div>
        </footer>


    </body>

</html>

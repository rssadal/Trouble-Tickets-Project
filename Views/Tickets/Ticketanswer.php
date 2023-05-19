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
        <title>Tickets</title>
    </head>

    <body>

        <header>
            <div onclick="goBacktoMainPage()" id="logo"><h2>Solve Us</h2></div>
            <div id="icon">
                    <img src="../../Images/pngwing.com.png" alt="Image" class="square-image">
            </div>
        
        </header>

            <h1>
                Ticket Answering
            </h1>
         
            <?php
             
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $db = new SQLite3('tickets.db');
                    $stmt = $db->prepare('SELECT id, department ,hashtag, date2, description2, status2, user_username FROM Ticket WHERE id = :id');
                    $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
                    $result = $stmt->execute();
                
                    $tickets = array();
                
                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        $id = $row['id'];
                        $department = $row['department'];
                        $hashtag = $row['hashtag'];
                        $date = $row['date2'];
                        $description = $row['description2'];
                        $status = $row['status2'];
                        $username = $row['user_username'];
                
                        $tickets[] = array($id, $department, $hashtag, $date, $description, $status, $username);
                    }

                    // Count the total number of rows in the ticket table
                    $countStmt = $db->prepare('SELECT COUNT(*) AS total FROM Ticket');
                    $countResult = $countStmt->execute();
                    $totalRows = $countResult->fetchArray(SQLITE3_ASSOC)['total'];

                    echo '<div class="ticket-container cdd">';
                    echo '<h2 class="ticket-id">Ticket ID: ' . $id . '</h2>';
                    echo '<h3 class="ticket-status-date">Ticket status:';

                    // Dropdown button
                    echo '<select id="status-dropdown" class="status-dropdown">';
                    echo '<option selected>' . $status . '</option>';
                    echo '<option value="Open">Open</option>';
                    echo '<option value="In Progress">In Progress</option>';
                    echo '<option value="Resolved">Resolved</option>';
                    echo '</select>';

                    echo ' | Submited ' . $date . '</h3>';
                    echo '<p class="ticket-description">' . $description . '</p>';
                    echo '</div>';
                   

                } 
                
                else {
                    echo "No ID provided.";
                }

                //GET NUMBER OF ASSOCIATED ANSWER TO THIS TICKET
                $query = $db->prepare('
                SELECT COUNT(*) AS answer_count
                FROM Ticket_Answer
                JOIN Answers ON Ticket_Answer.answer_id = Answers.id
                WHERE Ticket_Answer.ticket_id = :ticket_id
                ');
                $query->bindValue(':ticket_id', $id, SQLITE3_INTEGER);
                
                // Execute the query and fetch the result
                $result = $query->execute();
                $row = $result->fetchArray(SQLITE3_ASSOC);
                
                // Retrieve the answer count
                $answerCount = $row['answer_count'];
                
                // Output the answer count
                echo "Ticket ID " . $id . " is associated with " . $answerCount . " answer(s).";
            

                $query = $db->prepare('
                SELECT Answers.answer
                FROM Ticket
                JOIN Ticket_Answer ON Ticket.id = Ticket_Answer.ticket_id
                JOIN Answers ON Ticket_Answer.answer_id = Answers.id
                WHERE Ticket.id = :ticket_id
                ');
                $query->bindValue(':ticket_id', $id, SQLITE3_INTEGER);

                // Execute the query and fetch the results
                $result = $query->execute();

                // Loop through the results and output the response answers
                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    echo "Response: " . $row['answer'] . "\n";
                }

                // Close the database connection
                $db->close();





  
                // Message input box and button
                echo '<div class="message-box">';
                echo '<textarea id="message-input" class="message-input" placeholder="Write your message here"></textarea>';
                echo '<button id="send-button" class="send-button" onclick="sendMessage(' . $id . ')">Send</button>';
                echo '</div>';



 



            ?>
           
        <script>
            function goBack() {
                window.location.href = "../../Views/Login/login.html";
            }

            function sendMessage(ticketId){
                console.log("CLIQUEI NO BOTAO");
                var department = document.getElementById("message-input").value;
                console.log(department);
                console.log('Sending message for ticket ID: ' + ticketId);
                
            }

            

            // Get a reference to the dropdown element
            var statusDropdown = document.getElementById("status-dropdown");
            // Attach an event listener for the change event
            statusDropdown.addEventListener("change", function() {
                // Get the selected status
                var selectedStatus = statusDropdown.value;

                // Get the current ticket ID from PHP code
                var currentTicketId = <?php echo $id; ?>;

                // Send the updated status to the server
                updateTicketStatus(currentTicketId,selectedStatus);
                
            });

            function updateTicketStatus(ticketId,newStatus) {
                console.log("entrei na funcao de dar update ao status")
                var xhr = new XMLHttpRequest();

                xhr.open("POST", "update_ticket_status.php", true);

                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Request successful, do something with the response if needed
                        console.log(xhr.responseText);
                    }
                };

                // Prepare the data to be sent
                var data = "ticketId=" + encodeURIComponent(ticketId) + "&newStatus=" + encodeURIComponent(newStatus);

                // Send the request
                xhr.send(data);
   
            }


        </script>

    </body>

</html>

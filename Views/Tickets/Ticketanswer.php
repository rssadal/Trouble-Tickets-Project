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
    
            <div id="logo" onclick="goBack()">
                <h2>Solve Us</h2>
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


                    // Retrieve the associated answers
                    $stmt = $db->prepare('SELECT A.id AS answer_id,A.answer FROM Answers A INNER JOIN Ticket_Answer TA ON A.id = TA.answer_id WHERE TA.ticket_id = :ticket_id');
                    $stmt->bindParam(':ticket_id', $id, SQLITE3_INTEGER);
                    $result = $stmt->execute();

                    $answers = array();
                    $answerCount=0;
                    $lastAnswerId;
                    
                   

                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        $answerId = $row['answer_id'];
                        $answerContent = $row['answer'];
                        $answers[] = array($answerId, $answerContent);
                    }

                    // Display the answers
                    if (!empty($answers)) {
                        $answerCount = count($answers); // Count the number of answers
                        echo '<h2>Answers:</h2>';
                        foreach ($answers as $answer) {
                            $answerId = $answer[0];
                            $answerContent = $answer[1];
                            $lastAnswerId = $answerId; 
                            echo '<div class="ticket-container cdd">';
                            echo '<h3 class="answer-id">Answer ID: ' . $answerId . '</h3>';
                            echo '<p>' . $answerContent . '</p>';
                            echo '</div>';
                        }
                    } 
                    
                    else {
                        echo '<p>No answers found for this ticket.</p>';
                    }

                   
                    
                    echo '<h2>Answer to costumer</h2>';
        

                    echo '<div id="answering-box">';
                    echo '<textarea id="answer-textarea" rows="4" cols="100" placeholder="Write your answer..."></textarea>';
                    echo '<button onclick="Sendanswer(' . $id . ', ' . $answerCount . ', ' . $lastAnswerId . ', ' . $totalRows . ')">Answer</button>';
                    echo '</div>';


                } else {
                    echo "No ID provided.";
                }

            ?>
           
        <script>
            function goBack() {
                window.location.href = "../../Views/Login/login.html";
            }

            function Sendanswer(ticketId,answerCount,lastAnswerId,totalRows) {
                console.log("CLIQUEI NO BOTAO");
                var answerTextarea = document.getElementById("answer-textarea");
                var answer = answerTextarea.value;

                console.log(answer);
                console.log(ticketId);

                console.log(answerCount); // Access the answer count parameter
                console.log(lastAnswerId); // last id of the answer

                console.log(totalRows); // last id of the answer

            

                var xhr = new XMLHttpRequest();

                xhr.open("POST", "insert_ticket.php", true);

                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Request successful, do something with the response if needed
                        console.log(xhr.responseText);
                    }
                };

                // Prepare the data to be sent
                var data = "ticketId=" + encodeURIComponent(ticketId) + "&answer=" + encodeURIComponent(answer)+  "&lastAnswerId=" + encodeURIComponent(lastAnswerId)+  "&totalRows=" + encodeURIComponent(totalRows);

                // Send the request
                xhr.send(data);
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

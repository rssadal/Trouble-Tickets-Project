<?php
// add_answer_to_ticket.php

$ticketId = $_POST['ticketId'];
$messageinput = $_POST['messageinput'];

$db = new SQLite3('tickets.db');

// Execute SQL query to get the number of rows in the "Answers" table
$query = "SELECT COUNT(*) AS answer_count FROM Answers";
$result = $db->querySingle($query);

if ($result === false) {
    // Display the error message
    echo "Error executing query: " . $db->lastErrorMsg();
}

else {
    // Retrieve the answer count
    $answerCount = $result;
     // Insert a new row into the "Answers" table

    $insertQuery = "INSERT INTO Answers (id, answer) VALUES ($answerCount, '$messageinput')";
    $insertResult = $db->exec($insertQuery);

    if ($insertResult === false) {
        // Display the error message
        echo "Error executing query: " . $db->lastErrorMsg();
    }
    else  {
        // Insert a new row into the "Ticket_Answer" table
        $ticketAnswerQuery = "INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES ($ticketId, $answerCount)";
        $ticketAnswerResult = $db->exec($ticketAnswerQuery);

        if ($ticketAnswerResult === false) {
            // Display the error message
            echo "Error executing query: " . $db->lastErrorMsg();
        } else {
            // Return the answer count as the response
            echo "ADICIONE RESPOTA A ESTE TICKET";
        }
    }
}

$db->close();


?>

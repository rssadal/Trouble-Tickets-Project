<?php
// add_answer_to_ticket.php

$ticketId = $_POST['ticketId'];
$messageinput = $_POST['messageinput'];

session_start();
include_once('connect.php');
$currentUsername = $_SESSION['username'];


$response = 'USER LOGGED IN WITH USERNAME: ' . $currentUsername . ' . ' ;
echo $response;

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
        echo "Error executing query1 " . $db->lastErrorMsg();
    }
    else  {
        // Insert a new row into the "Ticket_Answer" table
        $ticketAnswerQuery = "INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES ($ticketId, $answerCount)";
        $ticketAnswerResult = $db->exec($ticketAnswerQuery);

        if ($ticketAnswerResult === false) {
            // Display the error message
            echo "Error executing query2: " . $db->lastErrorMsg();
        } else {
            // Insert a new row into the "Answer_Worker" table
            $answerWorkerQuery = "INSERT INTO Answer_Worker (answer_id, username) VALUES ($answerCount, '$currentUsername')";
            $answerWorkerResult = $db->exec($answerWorkerQuery);

            if ($answerWorkerResult === false) {
                // Display the error message
                echo "Error executing query3: " . $db->lastErrorMsg();
            } else {
                // Return the answer count as the response
                echo "ADICIONEI RESPOSTA A ESTE TICKET";
            }
        }
    }
}

$db->close();


?>

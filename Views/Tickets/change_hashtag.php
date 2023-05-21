<?php
// add_answer_to_ticket.php

$userInput = $_POST['userInput'];
$ticketId = $_POST['ticketId'];

session_start();
include_once('connect.php');
$currentUsername = $_SESSION['username'];

$response = 'USER LOGGED IN WITH USERNAME: ' . $currentUsername . ' . ' ;
echo $response;

$db = new SQLite3('tickets.db');

// Prepare and execute the SQL query to update the ticket department
$sql = "UPDATE Ticket SET hashtag = :newhashtag WHERE id = :ticketId";
$stmt = $db->prepare($sql);
$stmt->bindValue(':newhashtag', $userInput, SQLITE3_TEXT);
$stmt->bindValue(':ticketId', $ticketId, SQLITE3_INTEGER);
$result = $stmt->execute();

// Check if the update was successful
if ($result) {
    echo "Ticket hashtag updated successfully!";
}
else {
    echo "Failed to update ticket hahstag";
}

$db->close();


?>

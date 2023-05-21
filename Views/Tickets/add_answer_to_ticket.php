<?php
// add_answer_to_ticket.php

session_start();
include_once('../Login/connect.php');

global $db;

$ticketId = $_POST['ticketId'];
$messageinput = $_POST['messageinput'];

$currentUsername = $_SESSION['username'];


$response = 'USER LOGGED IN WITH USERNAME: ' . $currentUsername . ' . ' ;
echo $response;

$stmt = $db->prepare('SELECT COUNT(*) AS answer_count FROM Answers');
$result = $stmt->execute();

if (!$result) {
    echo "Error fetching from db";
    throw new Exception('Query execution failed');
}

$answerCount = $stmt->fetchColumn();

$stmt = $db->prepare('INSERT INTO Answers (answer) VALUES (:answer)');
$stmt->bindValue(':answer', $messageinput, PDO::PARAM_STR);
$result = $stmt->execute();

if (!$result) {
    echo "Error fetching from db";
    throw new Exception('Query execution failed');
} else {
    $stmt = $db->prepare("INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES (:ticketId, :answerCount);");
    $stmt->bindValue(':ticketId', $ticketId, PDO::PARAM_STR);
    $stmt->bindValue(':answerCount', $answerCount, PDO::PARAM_STR);

    $result = $stmt->execute();

    if (!$result) {
        echo "Error adding to db";
        throw new Exception('Query execution failed');
    } else {
        $stmt = $db->prepare("INSERT INTO Answer_Worker (answer_id, username) VALUES (:answerCount, :currentUsername);");
        $stmt->bindValue(':answerCount', $answerCount, PDO::PARAM_STR);
        $stmt->bindValue(':currentUsername', $currentUsername, PDO::PARAM_STR);
        $result = $stmt->execute();

        if (!$result) {
            echo "Error adding to db";
            throw new Exception('Query execution failed');
        } else {
            echo "ADICIONEI RESPOSTA A ESTE TICKET";
        }
    }
}


$db = null;


?>

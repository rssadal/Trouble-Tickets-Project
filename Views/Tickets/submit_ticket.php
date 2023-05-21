<?php

if (isset($_POST['ticketText']) && isset($_POST['department']) && isset($_POST['HashTag'])) {
    
    session_start();
    include_once('../Login/connect.php');
    $currentUsername = $_SESSION['username'];
    echo $currentUsername;

    
    $HashTag = $_POST['HashTag'];
    $ticketText = $_POST['ticketText'];
    $department = $_POST['department'];
    $dateString = $_POST['dateString'];
    $date = str_replace('-', '/', date('d-m-Y')); // Get the current date

    global $db;

   




    $stmt = $db->prepare('SELECT * FROM Ticket');
    $result = $stmt->execute();

    if (!$result) {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    // Iterate through each row
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($row as $rowItem){
            $description = $rowItem['description2'];
            if($description == $ticketText){
                echo "Ticket aready exists";
                return;
            }
        }
    }

    // Get the number of rows in the ticket table
    $stmt = $db->prepare('SELECT COUNT(*) as count FROM Ticket');
    $rowCount = $stmt->fetchColumn();

    // Insert the new row into the tickets table with the specified ID
    $stmt = $db->prepare('INSERT INTO Ticket (department, hashtag, date2, description2, status2, user_username, title) VALUES (:department, :hashtag, :date2, :description2, :status2, :user_username, "")');
    $stmt->bindValue(':department', $department);
    $stmt->bindValue(':hashtag', 'hardcoded_hashtag');
    $stmt->bindValue(':date2', $date);
    $stmt->bindValue(':description2', $ticketText);
    $stmt->bindValue(':status2', 'waiting');
    $stmt->bindValue(':user_username',$currentUsername); 
    $result = $stmt->execute();

    if (!$result) {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    $db = null;
    
    // Prepare the response
    $response = 'Received ticket text: ' . $ticketText . ', Department: ' . $department . ', Total rows in ticket table: ' . $rowCount ;

    } else {
        $response = 'No ticket text provided.';
    }

    echo $response;
?>

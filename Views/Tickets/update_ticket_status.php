<?php
    // Retrieve the ticketId and newStatus from the POST request
    $ticketId = $_POST['ticketId'];
    $newStatus = $_POST['newStatus'];

    // Connect to your SQLite database
    session_start();
    include_once('../Login/connect.php');

    global $db;

    // Prepare and execute the SQL query to update the ticket status
    //$sql = "UPDATE Ticket SET status2 = :newStatus WHERE id = :ticketId";
    $stmt = $db->prepare('UPDATE Ticket SET status2 = :newStatus WHERE id = :ticketId');
    $stmt->bindValue(':ticketId', $ticketId);
    $stmt->bindValue(':newStatus', $newStatus);
    $result = $stmt->execute();

    // Check if the update was successful
    if ($result) {
        echo "Ticket status updated successfully! " . $ticketId . " " . $newStatus;
    }
    else {
        echo "fail in updating row";
    }

?>


    

    


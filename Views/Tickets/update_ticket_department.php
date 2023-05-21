<?php
    // Retrieve the ticketId and newdepartment from the POST request
    $ticketId = $_POST['ticketId'];
    $newdepartment = $_POST['newdepartment'];

    // Connect to your SQLite database
    session_start();
    include_once('../Login/connect.php');

    global $db;

    // Prepare and execute the SQL query to update the ticket department
    $sql = "UPDATE Ticket SET department = :newdepartment WHERE id = :ticketId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':newdepartment', $newdepartment);
    $stmt->bindValue(':ticketId', $ticketId);
    $result = $stmt->execute();

    // Check if the update was successful
    if ($result) {
        echo "Ticket department updated successfully!";
    }
    else {
        echo "Failed to update ticket department.";
    }
    
?>

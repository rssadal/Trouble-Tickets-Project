<?php
    // Retrieve the ticketId and newStatus from the POST request
    $ticketId = $_POST['ticketId'];
    $newStatus = $_POST['newStatus'];

    // Connect to your SQLite database
    $db = new SQLite3('tickets.db');

    // Prepare and execute the SQL query to update the ticket status
    $sql = "UPDATE Ticket SET status2 = :newStatus WHERE id = :ticketId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':newStatus', $newStatus, SQLITE3_TEXT);
    $stmt->bindValue(':ticketId', $ticketId, SQLITE3_INTEGER);
    $result = $stmt->execute();

    // Check if the update was successful
    if ($result) {
        echo "Ticket status updated successfully!";
    }
    else {
        echo "fail in updating row";
    }

?>


    

    


<?php
// your_php_script.php



if (isset($_POST['ticketText']) && isset($_POST['department'])) {
    session_start();
    include_once('connect.php');
    $currentUsername = $_SESSION['username'];
    echo $currentUsername;



    $ticketText = $_POST['ticketText'];
    $department = $_POST['department'];
    $dateString = $_POST['dateString'];
    $date = str_replace('-', '/', date('d-m-Y')); // Get the current date

    $db = new SQLite3('tickets.db');

   




    $result = $db->query('SELECT * FROM Ticket');

    // Iterate through each row
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $description = $row['description2'];
        if($description == $ticketText){
            echo "Ticket aready exists";
            return;
        }
    }

    // Get the number of rows in the ticket table
    $result = $db->query('SELECT COUNT(*) as count FROM Ticket');
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $rowCount = $row['count'];

    // Insert the new row into the tickets table with the specified ID
    $stmt = $db->prepare('INSERT INTO Ticket (id, department, hashtag, date2, description2, status2, user_username) VALUES (:id, :department, :hashtag, :date2, :description2, :status2, :user_username)');
    $stmt->bindValue(':id', $rowCount, SQLITE3_INTEGER);
    $stmt->bindValue(':department', $department, SQLITE3_TEXT);
    $stmt->bindValue(':hashtag', 'hardcoded_hashtag', SQLITE3_TEXT);
    $stmt->bindValue(':date2', $date, SQLITE3_TEXT);
    $stmt->bindValue(':description2', $ticketText, SQLITE3_TEXT);
    $stmt->bindValue(':status2', 'waiting', SQLITE3_TEXT);
    $stmt->bindValue(':user_username',$currentUsername, SQLITE3_TEXT); 
    $stmt->execute();

    $db->close();
    
    // Prepare the response
    $response = 'Received ticket text: ' . $ticketText . ', Department: ' . $department . ', Total rows in ticket table: ' . $rowCount ;

} else {
    $response = 'No ticket text provided.';
}

echo $response;
?>

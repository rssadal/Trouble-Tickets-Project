<?php
    $db = new SQLite3('users.db');

    //$id = $_SESSION['id'];

    // Prepare a SELECT statement to retrieve the columns you want to read
    $stmt = $db->prepare('SELECT * FROM USER2 WHERE username == :username');
    $stmt->bindValue(':username', 'diogo13350', SQLITE3_TEXT);
    $user = $stmt->execute();
    $row = $user->fetchArray();
    
    // Format the row data as plain text
    $response = $row['nome'] . "," . $row['username'] . "," . $row['email'] . "," . $row['role2'];
        
    // Return the response as plain text
    echo $response;
    $db->close();
?>

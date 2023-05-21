<?php
    session_start();
    include_once('connect.php');

    $username = $_SESSION['username'];

    // Prepare a SELECT statement to retrieve the columns you want to read
    $stmt = $db->prepare('SELECT * FROM USER2 WHERE username == :username');
    $stmt->bindValue(':username', $username);
    $result = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Format the row data as plain text
    $response = $row['nome'] . "," . $row['username'] . "," . $row['email'] . "," . $row['role2'];
    // Return the response as plain text
    echo $response;
    $db = null;
?>

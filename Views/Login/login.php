<?php
    
    session_start();
    include_once('connect.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate the user and send a response
    
    //  Open the SQLite3 database
    global $db;

    // Prepare a SELECT statement to retrieve the column you want to read
    $stmt = $db->prepare('SELECT username, password2 FROM User2 WHERE username == :username AND password2 == :password2');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password2', $password);
    $result = $stmt->execute();

    if (!$result) {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        if ($row["username"] != null) {
            $_SESSION['username'] = $row['username'];
            echo "sucess";
        } else {
            echo "username and password didn't match";
        }
    } else {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    $db = null;
?>
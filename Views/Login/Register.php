<?php
    session_start();
    include_once('connect.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Authenticate the user and send a response
    //Open the SQLite3 database
    //$db = new SQLite3('ltwdatabase.db');

    // Prepare a SELECT statement to retrieve the column you want to read
    global $db;

    $stmt = $db->prepare('SELECT username, password2,nome,email FROM User2');
    $result = $stmt->execute();

    if (!$result) {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    // Loop through the results and read each value
    while ($row = $stmt->fetchAll()) {
        // Read the value of the column
        foreach ($row as $rowItem){
            $currentUsername = $rowItem['username'];
            $currentPassword = $rowItem['password2'];
            $currentName = $rowItem['nome'];
            $currentEmail = $rowItem['email'];
            // Do something with the value, such as print it
            //echo $value . "<br>";
            if (($currentName == $username && $currentEmail == $email) || $currentUsername == $username  || $currentEmail == $email ) {
                // Perform an action if the condition is true, such as printing the value
                echo "Acount with this acount parameters already exists, try logging in";
                return;
            }
        }
    }

    // prepare SQL statement to insert data into table
    $stmt = $db->prepare('INSERT INTO User2 (username, password2, nome, email, role2) VALUES (:username, :password2, :nome, :email,:role2)');
    
    // bind parameters to statement
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password2', $password);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':nome', $name);
    $stmt->bindValue(':role2', 'Cliente');
    
    // execute the statement
    $result = $stmt->execute();
    
    // Execute the INSERT statement and check if it was successful
    if ($result) {
        // The row was inserted successfully
        $id = $_SESSION['id'];
        echo "Account created successfully";
    } else {
        // There was an error inserting the row
        echo "Error creating profile";
        throw new Exception('Query execution failed');
    }
    
    $db = null

    
    
?>





<?php
   

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Authenticate the user and send a response
    //Open the SQLite3 database
    $db = new SQLite3('users.db');

    // Prepare a SELECT statement to retrieve the column you want to read
    $stmt = $db->prepare('SELECT username, password2,nome,email FROM User2');
    $result = $stmt->execute();

    // Loop through the results and read each value
    while ($row = $result->fetchArray()) {
        // Read the value of the column
        $value1 = $row['username'];
        $value2 = $row['password2'];
        $value3 = $row['nome'];
        $value4 = $row['email'];
        // Do something with the value, such as print it
        //echo $value . "<br>";
        if (($value1 == $username && $value4 == $email) || $value1 == $username  || $value4 == $email ) {
            // Perform an action if the condition is true, such as printing the value
            echo "Acount with this acount parameters already exists, try logging in";
            return;
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
        echo "Account created successfully";
    } else {
        // There was an error inserting the row
      
    }
    
    $db->close();

    
    
?>





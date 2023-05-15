<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate the user and send a response
    
    //  Open the SQLite3 database
    $db = new SQLite3('users.db');

    // Prepare a SELECT statement to retrieve the column you want to read
    $stmt = $db->prepare('SELECT username, password2 FROM User2');
    $result = $stmt->execute();

    
    // Loop through the results and read each value
    while ($row = $result->fetchArray()) {
        // Read the value of the column
        $value = $row['username'];
        $value2 = $row['password2'];
        // Do something with the value, such as print it
        //echo $value . "<br>";
        
        if ($value == $username && $value2 == $password) {
            // Perform an action if the condition is true, such as printing the value
            echo "sucess";
            return;
        }
    }

    echo "failed";
    $db->close();
       
?>
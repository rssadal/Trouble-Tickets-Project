<?php
    // Retrieve the ticketId and answer from the POST request
    $ticketId = $_POST['ticketId'];
    $answer = $_POST['answer'];
    $lastAnswerId = $_POST['lastAnswerId'];
    $totalRows = $_POST['totalRows'];

    
    // Do any necessary processing with the data
    // For example, you can store it in a database or perform other operations

    // Authenticate the user and send a response
    //Open the SQLite3 database
    $db = new SQLite3('tickets.db');
 
    // Prepare a SELECT statement to retrieve the column you want to read
    $stmt = $db->prepare('SELECT id, answer FROM Answers');
    $result = $stmt->execute();

    // Loop through the results and read each value
    while ($row = $result->fetchArray()) {
        // Read the value of the column
        $value1 = $row['id'];
        $value2 = $row['answer'];
        // Do something with the value, such as print it
        //echo $value . "<br>";
        if ($answer == $value2)  {
            // Perform an action if the condition is true, such as printing the value
            echo "This answer already exists";
            return;
        }

    }

    

    // prepare SQL statement to insert data into table
    $stmt = $db->prepare('INSERT INTO Answers (id, answer) VALUES (:totalRows, :answer)');
    
    // bind parameters to statement
    $stmt->bindValue(':id', $totalRows);
    $stmt->bindValue(':answer', $answer);

    
    // execute the statement
    $result = $stmt->execute();
    
    // Execute the INSERT statement and check if it was successful
    if ($result) {
        // The row was inserted successfully
        echo "Added new answer with ID " . $totalRows;
    } else {
        echo "error1";
        // There was an error inserting the row
      
    }

    $stmt = $db->prepare('INSERT INTO Ticket_Answer (ticket_id, answer_id) VALUES (:ticketId, :totalRows)');
    $stmt->bindValue(':ticketId', $ticketId);
    $stmt->bindValue(':answerId', $totalRows);
    
    // Execute the INSERT statement and check if it was successful
    $result = $stmt->execute();
    if ($result) {
        // The row was inserted successfully
        echo "New row inserted into Ticket_Answer table with Ticket ID " . $ticketId . "and Answer ID " . $totalRows ;
    } else {
        echo "error2";
        // There was an error inserting the row
        // Handle the error case
    }


    $db->close();

    
?>

<?php
    session_start();
    include_once('../Login/connect.php');

    // $db = new SQLite3('database.db');

    global $db;

    // Prepare a SELECT statement to retrieve the columns you want to read
    $stmt = $db->prepare('SELECT *  FROM Faq');
    $result = $stmt->execute();

    if (!$result) {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    $tickets = array();

    // Loop through the results and read each row into the $tickets array
    while ($row = $stmt->fetchALL(PDO::FETCH_ASSOC)) {
        foreach ($row as $rowItem){
            $id = $rowItem['id'];
            $title = $rowItem['title'];
            $Description = $rowItem['Description'];
            $date2 = $rowItem['date2'];
       
            $tickets[] = array($id, $title, $Description, $date2);
       }
    }

    // Close the database connection
    $db = null;

    //Escolhemos qual a informacao queremos no ecrã
    foreach ($tickets as $ticket) {
        ?>
        <div class="ticket">
            <div><?php echo $ticket[0]; ?></div>
            <div><?php echo $ticket[1]; ?></div>
            <div><?php echo $ticket[2]; ?></div>
        </div>
        <?php
    }
?>
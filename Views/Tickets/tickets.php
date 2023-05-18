<style>
    .ticket {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 10px;
        margin-right: 10px;

    }
</style>

<div id="list">
    <?php
    $db = new SQLite3('tickets.db');

    // Prepare a SELECT statement to retrieve the columns you want to read
    $stmt = $db->prepare('SELECT id, department ,hashtag, date2,description2 ,status2, user_username FROM Ticket');
    $result = $stmt->execute();

    $tickets = array();

    // Loop through the results and read each row into the $tickets array
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = $row['id'];
        $department = $row['department'];
        $hashtag = $row['hashtag'];
        $date = $row['date2'];
        $description = $row['description2'];
        $status = $row['status2'];
        $username = $row['user_username'];

        $tickets[] = array($id, $department, $hashtag, $date, $description, $status, $username);
    }

    $db->close();

    //Escolhemos qual a informacao queremos no ecrã
    foreach ($tickets as $ticket) {
        ?>
        <div class="ticket">
            <div><?php echo $ticket[0]; ?></div>
            <div><?php echo $ticket[4]; ?></div>
            <div><?php echo $ticket[3]; ?></div>
        </div>
        <?php
    }
    ?>
</div>

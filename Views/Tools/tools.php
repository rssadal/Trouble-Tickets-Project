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
        if ($ticket[1] === 'Tech Help') {
            ?>
                    <div class="wrapper">
                        <div class="option">
                            <input class="input" type="radio" name="btn" value="option1" checked="">
                            <div class="btn">
                                <span class="span">Marketing</span>
                            </div>
                        </div>
                        <div class="option">
                            <input class="input" type="radio" name="btn" value="option2">
                            <div class="btn">
                                <span class="span">Tech Help</span>
                            </div>  
                        </div>
                        <div class="option">
                            <input class="input" type="radio" name="btn" value="option3">
                            <div class="btn">
                                <span class="span">Information</span>
                            </div>  
                        </div>
                    </div>
            <?php
        }
    }
    ?>
</div>

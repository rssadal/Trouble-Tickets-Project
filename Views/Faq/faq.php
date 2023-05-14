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

    $db = new SQLite3('database.db');


    // Prepare a SELECT statement to retrieve the columns you want to read
    $stmt = $db->prepare('SELECT id, title,  Description, date2  FROM Faq');
    $result = $stmt->execute();

    $tickets = array();

    // Loop through the results and read each row into the $tickets array
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = $row['id'];
        $title = $row['title'];
        $Description = $row['Description'];
        $date2 = $row['date2'];
       
        $tickets[] = array($id, $title, $Description, $date2);
    }

    $db->close();

    //Escolhemos qual a informacao queremos no ecrã
    foreach ($tickets as $ticket) {
        ?>
        <div class="ticket">
            <div><?php echo $ticket[0] .  "&nbsp;&nbsp;&nbsp;" . $ticket[1] . "&nbsp;&nbsp;&nbsp;" .$ticket[2]; ?></div>
        </div>
        <?php
    }
    ?>
</div>

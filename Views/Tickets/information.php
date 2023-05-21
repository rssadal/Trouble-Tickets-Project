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
    session_start();
    include_once('../Login/connect.php');
    // Prepare a SELECT statement to retrieve the columns you want to read
    $stmt = $db->prepare('SELECT id, department ,hashtag, date2,description2 ,status2, user_username FROM Ticket');
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
            $department = $rowItem['department'];
            $hashtag = $rowItem['hashtag'];
            $date = $rowItem['date2'];
            $description = $rowItem['description2'];
            $status = $rowItem['status2'];
            $username = $rowItem['user_username'];

            $tickets[] = array($id, $department, $hashtag, $date, $description, $status, $username);
        }
    }

    $db = null;

    //Escolhemos qual a informacao queremos no ecrã
    foreach ($tickets as $ticket) {
        if ($ticket[1] === 'Information') {
            ?>
                    <div onclick="openNewPage('Ticketanswer.php?id=<?php echo $ticket[0]; ?>')" class="cardBox">
                        <div class="card">
                            <div class="h4"><?php echo $ticket[4]; ?></div>
                                <div class="content">
                                    <div class="h3"><?php echo $ticket[5]; ?></div>
                                    <p><?php echo $ticket[2]; ?></p>
                                    <p><?php echo $ticket[3]; ?></p>
                                    
                                </div>
                        </div>
                    </div>
            <?php
        }
    }
    ?>
</div>

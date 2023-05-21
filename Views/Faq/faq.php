<div id="list">
    <?php
        session_start();
        include_once('../Login/connect.php');

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
                        <div class="cardBox">
                            <div class="card">
                                <div class="h4"><?php echo $ticket[1]; ?></div>
                                    <div class="content">
                                        <div class="h3"><?php echo $ticket[3]; ?></div>
                                        <p><?php echo $ticket[2]; ?></p>
                                    </div>
                            </div>
                        </div>
            <?php
        }
    ?>
</div>

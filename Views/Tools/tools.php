<div id="list">
    <?php
    session_start();
    include_once('../Login/connect.php');

    global $db;

    $currentUsername = $_SESSION['username'];

    // Prepare a SELECT statement to retrieve the columns you want to read
    $stmt = $db->prepare('SELECT nome, username  FROM User2 WHERE username != :username;');
    $stmt->bindParam(':username', $currentUsername);
    $result = $stmt->execute();

    if (!$result) {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    $users = array();

    // Loop through the results and read each row into the $tickets array
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($row as $rowItem){
            $nome = $rowItem['nome'];
            $username = $rowItem['username'];

            $users[] = array($nome, $username);
        }
    }

    $db = null;

    //Escolhemos qual a informacao queremos no ecrã
    foreach ($users as $user) {
            ?>
                <div onclick="openProfile('edit.php?username=<?php echo $user[1]; ?>')" class="shadowUser cardUser"><span><?php echo $user[0]; ?></span></div>
            <?php
    }
    ?>
</div>

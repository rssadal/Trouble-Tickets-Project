<?php
    session_start();
    include_once('../Login/connect.php');

    $currentUsername = $_SESSION['username'];

    // Prepare a SELECT statement to retrieve the columns you want to read
    global $db;
    $stmt = $db->prepare('SELECT t.*
        FROM Ticket AS t
        INNER JOIN AgentTicket AS at ON t.id = at.ticket_id
        WHERE at.user_username = :username;'
    );
    $stmt->bindValue(':username', $currentUsername, PDO::PARAM_STR);
    $result = $stmt->execute();

    if (!$result) {
        echo "Error fetching from db";
        throw new Exception('Query execution failed');
    }

    $tickets = array();
    // Process the result
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        $id = $row['id'];
        $department = $row['department'];
        $hashtag = $row['hashtag'];
        $date = $row['date2'];
        $description = $row['description2'];
        $status = $row['status2'];
        $username = $row['user_username'];

        $tickets[] = array($id, $department, $hashtag, $date, $description, $status, $username);
    }
    echo $tickets;
    $db = null;
?>
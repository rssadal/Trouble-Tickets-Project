<?php

    $userId = $_POST['userId'];
    $selectedOption = $_POST['selectedOption'];

    include_once('../Login/connect.php');
    global $db;

    $stmt = $db->prepare("UPDATE User2 SET role2 = :newrole WHERE username LIKE :userId");
    $stmt->bindValue(':newrole', $selectedOption);
    $stmt->bindValue(':userId', $userId);
    $result = $stmt->execute();

    // Check if the update was successful
    if ($result) {
        echo $userId;
        echo "role updated successfully!";
    }
    else {
        echo "Failed to update .";
    }
    
?>

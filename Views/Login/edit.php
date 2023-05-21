<?php
  session_start();
  include_once('connect.php');
  
  // Get the form data
  $username = $_POST['username'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Open the SQLite3 database  

  $currentUsername = $_SESSION['username'];

  try {
    global $db;
    $stmt = $db->prepare('SELECT nome, email, role2, username FROM User2 WHERE username != :username;');
    $stmt->bindParam(':username', $currentUsername);
    $result = $stmt->execute(); 

    if (!$result) {
      echo "Error fetching from db";
      throw new Exception('Query execution failed');
    }

    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      foreach ($row as $rowItem){
        $existentUsername = $rowItem['username'];
        $existentEmail = $rowItem['email'];
        
        if ($existentUsername === $username) {
          echo "An account with this username already exists. Please try another one.";
          exit();
        }

        if ($existentEmail === $email) {
          echo "An account with this email already exists. Please try another one.";
          exit();
        }
      }
    }
  } catch (Exception $e){
      echo 'Error: ' . $e->getMessage();
  }
   

  // Update the user's information in the database
  $stmt = $db->prepare("UPDATE User2 SET username = :username, password2 = :password, nome = :name, email = :email WHERE username = :currentUsername");
  $stmt->bindValue(':username', $username);
  $stmt->bindValue(':password', $password);
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':currentUsername', $currentUsername);
  $result = $stmt->execute();

  if ($result) {
      echo "Profile updated successfully";
  } else {
    $errorInfo = $stmt->errorInfo();
    echo "Query execution failed: " . $errorInfo[2];
  }

  $_SESSION['username'] = $username;

  // Close the database connection
  $db = null;
?>

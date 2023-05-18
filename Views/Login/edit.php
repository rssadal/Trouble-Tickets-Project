<?php
  session_start();
  include_once('connect.php');
  
  // Get the form data
  $username = $_POST['username'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // Open the SQLite3 database  

  $id = $_SESSION['id'];

  try {
    global $db;
    $stmt = $db->prepare('SELECT nome, email, username, role2 FROM User2 WHERE id != :id;');
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute(); 

    if (!$result) {
      echo "Error fetching from db";
      throw new Exception('Query execution failed');
    }

    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      foreach ($row as $rowItem){
        $currentUsername = $rowItem['username'];
        $currentEmail = $rowItem['email'];
        $currentName = $rowItem['nome'];
        $currentRole2 = $rowItem['role2'];
        
        if ($currentUsername === $username) {
          echo "An account with this username already exists. Please try another one.";
          exit();
        }

        if ($currentEmail === $email) {
          echo "An account with this email already exists. Please try another one.";
          exit();
        }
      }
    }
  } catch (Exception $e){
      echo 'Error: ' . $e->getMessage();
  }
   

  // Update the user's information in the database
  $stmt = $db->prepare("UPDATE User2 SET role2 = :role2, username = :username, password2 = :password, nome = :name, email = :email WHERE id = :id");
  $stmt->bindValue(':username', $username);
  $stmt->bindValue(':password', $password);
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':role2', $role);
  $stmt->bindValue(':id', $id);
  $result = $stmt->execute();

  if ($result) {
      echo "Profile updated successfully";
  } else {
      echo "Error updating profile";
      throw new Exception('Query execution failed');
  }

  // Close the database connection
  $db = null;
?>

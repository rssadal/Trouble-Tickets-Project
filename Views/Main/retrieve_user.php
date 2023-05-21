<?php
session_start();
include_once('../Login/connect.php');
$currentUsername = $_SESSION['username'];

global $db;
$stmt = $db->prepare('SELECT username, role2 FROM User2 WHERE username = :username');
$stmt->bindParam(':username', $currentUsername);
$stmt->execute();
$row = $stmt->fetch();

$role2 = $row['role2'];
echo $role2;

?>


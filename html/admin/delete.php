<?php
session_start();


include_once("connection.php");


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$id = $_GET['id'];


$sql = "DELETE FROM Menu WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();


header("Location: adminmenu.php");
exit;
?>
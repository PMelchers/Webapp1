<?php
session_start();

// Connect to the database
include_once("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get the ID of the menu item to be deleted
$id = $_GET['id'];

// Delete the menu item from the database
$sql = "DELETE FROM Menu WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

// Redirect to the home page
header("Location: adminmenu.php");
exit;
?>
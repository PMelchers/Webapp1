<?php
session_start();

// Connect to the database
include_once("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the new values from the form
    $productnaam = $_POST["productnaam"];
    $prijs = $_POST["prijs"];
    $omschrijving = $_POST["omschrijving"];

    // Insert the new menu item into the database
    $sql = "INSERT INTO Menu (Productnaam, Prijs, Omschrijving) VALUES (:productnaam, :prijs, :omschrijving)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':productnaam', $productnaam);
    $stmt->bindParam(':prijs', $prijs);
    $stmt->bindParam(':omschrijving', $omschrijving);
    $stmt->execute();

    // Redirect to the home page
    header("Location: adminmenu.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="styling/style.css">

</head>
<body>
<header>
    <h1>Broodjesbar</h1>
</header>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        
    <div class="add-item">
        <h2>Add Menu Item</h2>
        <input type="text" name="productnaam" placeholder="Productnaam" required>
        <input type="number" step="0.01" name="prijs" placeholder="Prijs" required>
        <textarea name="omschrijving" placeholder="Omschrijving"></textarea>
        <input type="submit" value="Add Menu Item">
    </div>
    </form>

</body>
</html>
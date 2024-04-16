<?php
session_start();

include_once("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['query'])) {
    $query = '%' . $_GET['query'] . '%';
    $sql = "SELECT * FROM Menu WHERE Productnaam LIKE :query";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':query', $query, PDO::PARAM_STR);
    $stmt->execute();
    
    
    } else {
    $sql = "SELECT * FROM Menu";
    $stmt = $pdo->query($sql);
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broodjesbar</title>
    <link rel="stylesheet" href="styling/style.css">

</head>
<body>
<header>
    <h1>Broodjesbar</h1>
</header>
    <form method="get" action="">
        <input type="text" name="query" placeholder="Search Menu Items" value="<?= isset($_GET['query'])? htmlspecialchars($_GET['query']) : ''?>">
        <button type="submit">Search</button>
    </form>

    <?php while ($result = $stmt->fetch()) {?>
        <div class="menu-item">
            <div class="menu-item-name">
                <?= $result['Productnaam']?>
            </div>
            <div class="menu-item-price">
                <?= "€ ". $result['Prijs']?>
            </div>
            <div class="menu-item-description">
                <?= $result['Omschrijving']?>
            </div>
        </div>
    <?php }?>

</body>
</html>
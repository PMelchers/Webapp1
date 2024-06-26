<?php
session_start();


include_once("connection.php");


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


if (isset($_GET['query'])) { //controlleerd of de parameter query is gezet
    $query = '%' . $_GET['query'] . '%'; 
    $sql = "SELECT * FROM Menu WHERE Productnaam LIKE :query"; //query die de producten zoekt die overeenkomen met de query
    $stmt = $pdo->prepare($sql); //bereid de query voor

    $stmt->bindParam(':query', $query, PDO::PARAM_STR); //bind de zoekterm aan de query
    $stmt->execute(); //voert de query uit
    
    
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
    <nav>
         <a href="adminmenu.php"class="nav-text">Menu</a>
         <a href="add.php" class="nav-text">Add Product</a>
    </nav>
</header>
    <form method="get" action="">
        <input type="text" name="query" placeholder="Search Menu Items" value="<?= isset($_GET['query'])? htmlspecialchars($_GET['query']) : ''?>">
        <button type="submit">Search</button>
    </form>

    <?php while ($result = $stmt->fetch()) {?>
        <div class="menu-item">
            <div class="menu-item-id">
                <?= $result['id']?>
            </div>
            <div class="menu-item-name">
                <?= $result['Productnaam']?>
            </div>
            <div class="menu-item-price">
                <?= "€ ". $result['Prijs']?>
            </div>
            <div class="menu-item-description">
                <?= $result['Omschrijving']?>
            </div>
            <div class="menu-item-edit">
                <a href='edit.php?id=<?= $result['id']?>'>Edit</a> Hij neemt de vult de variabele ID in $result
            </div>
            <div class="menu-item-delete">
                <a href='delete.php?id=<?= $result['id']?>'>Delete</a> //Hij neemt de vult de variabele ID in $result
            </div>
        </div>
    <?php }?>

</body>
</html>
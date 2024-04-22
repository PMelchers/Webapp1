<?php
session_start();


include_once("connection.php");

//Controleer of de gebruiker ingelogd is
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $id = $_GET['id'];

    
    $productnaam = $_POST["productnaam"];
    $prijs = $_POST["prijs"];
    $omschrijving = $_POST["omschrijving"];

    
    $sql = "UPDATE Menu SET Productnaam = :productnaam, Prijs = :prijs, Omschrijving = :omschrijving WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':productnaam', $productnaam);
    $stmt->bindParam(':prijs', $prijs);
    $stmt->bindParam(':omschrijving', $omschrijving);
    $stmt->bindParam(':id', $id);
    $stmt->execute(); //update de ingevulde gegevens in de database

    
    header("Location: adminmenu.php");
    exit;
}


$id = $_GET['id'];


$sql = "SELECT * FROM Menu WHERE id = :id"; //zoek in de database naar de id
$stmt = $pdo->prepare($sql);  //controleerd of wat jij opzoekt in de zoekbalk veilig is
$stmt->bindParam(':id', $id); //bind de door jou net ingevulde informatie aan de id in de database
$stmt->execute(); //voert de query uit
$result = $stmt->fetch();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <link rel="stylesheet" href="styling/style.css">

</head>
<body>
<header>
    <h1>Broodjesbar</h1>
</header>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $id;?>" method="post"> // stuurt de ingevulde informatie naar de database
        <h2>Edit Menu Item</h2>
        <input type="text" name="productnaam" placeholder="Productnaam" value="<?php echo $result['Productnaam'];?>" required>

        <input type="number" name="prijs" placeholder="Prijs" value="<?php echo $result['Prijs'];?>" required>

        <textarea name="omschrijving" placeholder="Omschrijving"><?php echo $result['Omschrijving'];?></textarea>

        <input type="submit" value="Save Changes">
    </form>

</body>
</html>
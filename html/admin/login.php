<?php
session_start();

// Connect to the database
include_once("connection.php");
if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF'])!= 'login.php') {
    header("Location: login.php");
    exit;
}

// Check if the search form has been submitted
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM Menu WHERE Productnaam LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':search', $searchTerm);
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
    <title>Home</title>
</head>
<body>
    <form method="get" action="">
        <input type="text" name="search" placeholder="Search Menu Items" value="<?= isset($_GET['search'])? htmlspecialchars($_GET['search']) : ''?>">
        <button type="submit">Search</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Edit</th>
                *<th>Delete</th>*
            </tr>
        </thead>
        <tbody>
        <!-- The following php code fetches the menu items from the database and displays them in a table format. -->
        <?php while ($result = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>". '<div class=product-id>'. $result['id']. '</div>'. "</td>";
            echo "<td>". '<div class=product-name>'. $result['Productnaam']. '</div>'. "</td>";
            echo "<td>". '<div class=product-price>'. "€ ". $result['Prijs']. '</div>'. "</td>";
            echo "<td>". "<a href='edit.php?id=". $result['id']. "'>Edit</a>". "</td>";
            echo "<td>". "<a href='delete.php?id=". $result['id']. "' onclick=\"return confirm('Are you sure you want to delete this item?')\">Delete</a>". "</td>";
            echo "</tr>";
        }
       ?>
        </tbody>
    </table>
</body>
</html>
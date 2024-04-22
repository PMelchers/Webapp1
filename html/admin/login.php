<?php
session_start();

$username = "pimmelchers";
$password = "DikkeBMW";




if ($_SERVER["REQUEST_METHOD"] == "POST") { //controlleert of er een post is
    
    if (empty($_POST["username"])) { //controlleert of de username leeg is
        echo "Username is verplicht";
    }

    
    if ($_POST["username"] == $username && $_POST["password"] == $password) { //Controlleert of de username en wachtwoord kloppen en stuurt je naar de admin pagina
        
        $_SESSION["username"] = $username;
        header("Location: adminmenu.php");
        exit;
    }

    } else {
        
        echo "Invalid username or password";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styling/style.css">

</head>
<body>
<header>
    <h1>Broodjesbar</h1>
</header>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

</body>
</html>
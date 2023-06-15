<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO | WEEK 6</title>
</head>
<body>
<?php
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options); 
     echo "Connected to Winkel";
}
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productnaam = $_POST["product_naam"];
    $prijsperstuk = $_POST["prijs_per_stuk"];
    $omschrijving = $_POST["omschrijving"];
    
    $sql = "UPDATE producten 
            SET product_naam = ?, prijs_per_stuk = ?, omschrijving = ? 
            WHERE id = 2";

    $sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving)
    VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $gegevenVanFormulier = array($productnaam, $prijsperstuk, $omschrijving);

    $stmt->execute($gegevenVanFormulier);
}
?>
<h2>Product bijwerken</h2>
<form method="POST" action="">
    <label for="product_naam">Productnaam:</label><br>
    <input type="text" name="product_naam" required><br><br>

    <label for="prijs_per_stuk">Prijs per stuk:</label><br>
    <input type="text" name="prijs_per_stuk" required><br><br>

    <label for="omschrijving">Omschrijving:</label><br>
    <textarea name="omschrijving" required></textarea><br><br>

    <input type="submit" value="Bijwerken">
</form>
</body>
</html>
<?php
$host = $_ENV['MYSQLHOST'] ?? 'localhost';
$user = $_ENV['MYSQLUSER'] ?? 'root';
$password = $_ENV['MYSQLPASSWORD'] ?? '';
$dbname = $_ENV['MYSQL_DATABASE'] ?? 'railway'; // <- AJOUTE LE _ ICI
$port = $_ENV['MYSQLPORT'] ?? 3306;

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>

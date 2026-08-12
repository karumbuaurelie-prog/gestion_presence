<?php
$host = $_ENV['MYSQLHOST'];
$user = $_ENV['MYSQLUSER'];
$pass = $_ENV['MYSQLPASSWORD'];
$db   = $_ENV['MYSQLDATABASE'];
$port = $_ENV['MYSQLPORT'];

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_error) {
    die("Erreur connexion: " . $mysqli->connect_error);
}
?>

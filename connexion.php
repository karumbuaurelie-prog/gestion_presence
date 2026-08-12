<?php
$url = parse_url($_ENV['MYSQL_URL']);

$host = $url['host'];
$user = $url['user'];
$pass = $url['pass'];
$db   = ltrim($url['path'], '/');
$port = $url['port'];

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>

<?php
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonnees = "gestion_presence";

$conn = mysqli_connect($serveur, $utilisateur, $motdepasse, $basededonnees);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
?>
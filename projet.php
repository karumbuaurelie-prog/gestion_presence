<?php
session_start();
include 'connexion.php';

// Si pas connecté, on redirige vers login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer le nom de l'utilisateur
$user_id = $_SESSION['user_id'];
$sql = "SELECT nom_utilisateur FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        .logout { float: right; background: red; color: white; padding: 10px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" class="logout">Déconnexion</a>
        <h1>Bienvenue <?php echo htmlspecialchars($user['nom_utilisateur']); ?> !</h1>
        <p>Ceci est ton tableau de bord du projet Gestion de Présence.</p>
        <p>Ici tu pourras ajouter les étudiants, faire l'appel, etc.</p>
    </div>
</body>
</html>

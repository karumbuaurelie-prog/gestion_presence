<?php
session_start(); // ON ENLEVE LE ini_set

// FIX POUR RAILWAY HTTPS
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// SI PAS CONNECTE, ON RETOURNE AU LOGIN
if (!isset($_SESSION['user_id'])) {
    header("Location: projet.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><title>Tableau de bord</title>
<link rel="stylesheet" href="style.css"></head><body>
<div class="sidebar"><h2>🎓 GESTION PRESENCE</h2>
<ul><li><a href="dashboard.php">⛪ Tableau de bord</a></li><li><a href="logout.php">🚪 Déconnexion</a></li></ul></div>
<div class="content"><h1>Tableau de bord</h1><p>Bienvenue, <b><?php echo $username; ?></b> !</p></div>
</body></html>

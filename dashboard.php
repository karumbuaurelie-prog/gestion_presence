<?php
session_start();

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
<!DOCTYPE html>
<html lang="fr"> 
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tableau de bord</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
<h2>🎓 GESTION PRESENCE</h2>
<ul> 
<li><a href="dashboard.php">⛪ Tableau de bord</a></li>
<li><a href="nouvelle_session.php">📆 Nouvelle session</a></li>
<li><a href="etudiants.php">👨‍🎓 Etudiants</a></li>
<li><a href="rapports.php">📊 Rapports</a></li>
<li><a href="parametres.php">⚙ Paramètres</a></li>
<li><a href="logout.php">🚪 Déconnexion</a></li>
</ul>
</div>

<div class="content"> 
<h1>Tableau de bord</h1>
<p>Bienvenue, <b><?php echo $username; ?></b> !</p>

<div class="cards">
    <div class="card"> <h2>24</h2><p>Etudiants presents</p></div>
    <div class="card"><h2>28</h2><p>Total étudiants</p></div>
    <div class="card"><h2>CS101</h2><p>Cours actuel</p></div>
    <div class="card"><h2>10:30</h2><p>Heure actuelle</p></div>
</div>
</div>
</body>
</html>

<?php
session_start(); // ON ENLEVE LE ini_set
include 'connexion.php';

// FIX POUR RAILWAY HTTPS
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// SI DEJA CONNECTE -> DASHBOARD
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}

$erreur = "";
if (isset($_POST['connexion'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id FROM utilisateurs WHERE nom_utilisateur = ? AND mot_de_passe = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id']= $user['id']; 
        $_SESSION['username']= $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $erreur = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
<html lang="fr"><head><meta charset="UTF-8"><title>Connexion</title>
<style>body{background:#f4f6f9;display:flex;justify-content:center;align-items:center;height:100vh;font-family:Arial}.login-box{width:350px;background:white;padding:30px;border-radius:10px;box-shadow:0 0 15px rgba(0,0,0,0.2)}h2{text-align:center;margin-bottom:20px;color:#007bff}input{width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px}.btn{width:100%;padding:12px;background:#007bff;color:white;border:none;border-radius:5px;font-weight:bold}.error{color:red;text-align:center}</style>
</head><body><div class="login-box"><h2>Connexion</h2>
<?php if($erreur != "") echo "<p class='error'>$erreur</p>"; ?>
<form method="POST">
<label>Nom d'utilisateur</label><input type="text" name="username" required>
<label>Mot de passe</label><input type="password" name="password" required>
<button type="submit" name="connexion" class="btn">Se connecter</button>
</form></div></body></html>

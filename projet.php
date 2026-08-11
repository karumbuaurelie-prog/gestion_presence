<?php
session_start();

// FIX POUR RAILWAY HTTPS
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

echo "<h1>ÇA MARCHE !!!</h1>";
echo "<p>Si tu vois ce message, PHP fonctionne sur Railway</p>";
?>
<html>
<body>
<form method="POST">
<input name="username" placeholder="test">
<input name="password" type="password" placeholder="test">
<button name="connexion">Se connecter</button>
</form>
</body>
</html>

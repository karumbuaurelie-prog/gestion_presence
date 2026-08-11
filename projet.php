<?php
session_start();

// FIX POUR RAILWAY HTTPS
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

include 'connexion.php';

echo "Session: ";
var_dump($_SESSION); // POUR VOIR CE QU'IL Y A DANS LA SESSION
echo "<br><a href='dashboard.php'>Aller au Dashboard</a>";
?>
<html>
<body>
<h1>PAGE LOGIN TEST</h1>
<form method="POST">
<input name="username" placeholder="username">
<input name="password" type="password" placeholder="password">
<button name="connexion">Se connecter</button>
</form>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Gestion des Présences</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            width:350px;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 15px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
            color:#007bff;
        }

        .input-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:5px;
            font-weight:bold;
        }

        input{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:5px;
            font-size:15px;
        }

        .btn{
            width:100%;
            padding:12px;
            background:#007bff;
            color:white;
            border:none;
            border-radius:5px;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn:hover{
            background:#0056b3;
        }
    </style>

</head>

<body>

<div class="login-box">

<h2>Connexion</h2>

<form action="dashboard.html" method="post">

<div class="input-group">
<label>Nom d'utilisateur</label>
<input type="text" name="username" required>
</div>

<div class="input-group">
<label>Mot de passe</label>
<input type="password" name="password" required>
</div>

<button type="submit" class="btn">Se connecter</button>

</form>

</div>

</body>
</html>
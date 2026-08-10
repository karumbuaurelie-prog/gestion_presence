<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<html lang="fr"> 
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width,
initial-scale=1.0">
<title>Tableau de bord</title>

</head>
     <link rel="stylesheet" href="style.css">
<body>

<!-- MENU-->
<div class="sidebar">

<h2>🎓GESTION PRESENCE</h2>

<ul> 
<li><a href="dashboard.php">⛪ Tableau de bord</a></li>
<li><a href="nouvelle_session.php">📆 Nouvelle session</a></li>
<li><a href="etudiants.php">👨‍🎓 Etudiants</a></li>
<li><a href="rapports.php"> 📊 Rapports</a></li>
<li><a href="parametres.phpl"> ⚙ paramètres</a></li>
<li><a href="projet.php"> 🚪 Deconnexion</a></li>
</ul>

</div>

<!-- CONTENU -->
<div class="content"> 

<h1> Tableau de bord</h1>

<div class="cards">

    <div class="card"> 
        <h2>24</h2>
        <p>Etudiants presents</p>
    </div>

    <div class="card">
        <h2>28</h2>
        <p> Total étudiants</p>
    </div>

    <div classe="card">
        <h2>CS101</h2>
        <p> Cours actuel</p>
    </div>

    <div class="card"
        <h2>10:30</h2>
        <p>Heure actuelle</p>
</div>

</div>

<div class="container"> 

<!-- QR CODE-->  
<div class="box"> 

<h2>Session en Cours</h2>

<p><b>cours :</b> Algorithimique et programmation</p>
<br>

<h3 style=" text-align: center;"> QR Code presence</h3>

       <div class="qr">
            📱
        </div>

<center> 

<button class="btn vert">
Rafraichir QR
</button>

<button class="btn rouge">
Terminer session
</button>

</center>

</div>

<!--TABLEAU-->
<div class="box"> 

<h2> Etudiants présents</h2>

<table>

<tr> 
<th> N°</th>
<th>Nom</th>
<th>Heure</th>
</tr>

<tr>
<td>1</td>
<td>Aurelie K.</td>
<td>10:05</td>
</tr>

<tr>
<td>2</td>
<td>Patrick M.</td>
<td>10:08</td>
</tr>

<tr>
<td>3</td>
<td>Grace B.</td>
<td>10:12</td>
</tr>

<tr>
<td>4</td>
<td>Sarah K.</td>
<td>10:20</td>
</tr>

</table>

</div> 

</div>

</div>

</body>
</html>




    

        
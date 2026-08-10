<?php
include 'connexion.php';

$sql = "SELECT
            presences.id,
            etudiants.matricule,
            etudiants.nom,
            etudiants.prenom,
            sessions.cours,
            sessions.promotion,
            sessions.salle,
            sessions.date_session,
            presences.heure_presence,
            presences.statut
        FROM presences
        INNER JOIN etudiants
            ON presences.etudiant_id = etudiants.id
        INNER JOIN sessions
            ON presences.session_id = sessions.id
        ORDER BY presences.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rapport des présences</title>

<link rel="stylesheet" href="style.css">

<style>
table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
}

table th{
    background:#0d6efd;
    color:white;
    padding:10px;
}

table td{
    padding:10px;
    text-align:center;
    border:1px solid #ddd;
}
</style>

</head>

<body>

<div class="sidebar">

<h2>🎓 GESTION PRÉSENCE</h2>

<ul>
<li><a href="dashboard.php">🏠 Tableau de bord</a></li>
<li><a href="nouvelle_session.php">📅 Nouvelle session</a></li>
<li><a href="etudiants.php">👨‍🎓 Étudiants</a></li>
<li><a href="rapports.php">📊 Rapports</a></li>
<li><a href="parametres.php">⚙️ Paramètres</a></li>
<li><a href="index.php">🚪 Déconnexion</a></li>
</ul>

</div>

<div class="content">

<h1>📊 Rapport des présences</h1>

<table>

<tr>
<th>ID</th>
<th>Matricule</th>
<th>Nom</th>
<th>Prénom</th>
<th>Cours</th>
<th>Promotion</th>
<th>Salle</th>
<th>Date</th>
<th>Heure</th>
<th>Statut</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['id']."</td>";
echo "<td>".$row['matricule']."</td>";
echo "<td>".$row['nom']."</td>";
echo "<td>".$row['prenom']."</td>";
echo "<td>".$row['cours']."</td>";
echo "<td>".$row['promotion']."</td>";
echo "<td>".$row['salle']."</td>";
echo "<td>".$row['date_session']."</td>";
echo "<td>".$row['heure_presence']."</td>";
echo "<td>".$row['statut']."</td>";

echo "</tr>";

}

?>

</table>

<br>

<a href="export_pdf.php" class="btn vert">
📄 Exporter en PDF
</a>

</div>

</body>
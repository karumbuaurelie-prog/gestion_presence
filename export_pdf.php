<?php
include 'connexion.php';

$sql = "SELECT presences.id,
               sessions.cours,
               sessions.promotion,
               sessions.salle,
               sessions.date_session,
               presences.heure_presence,
               presences.statut
        FROM presences
        INNER JOIN sessions
        ON presences.session_id = sessions.id
        ORDER BY presences.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Rapport des présences</title>

<style>

body{
    font-family: Arial, sans-serif;
    margin:40px;
}

h1{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid black;
}

th{
    background:#28a745;
    color:white;
}

th,td{
    padding:10px;
    text-align:center;
}

button{
    margin-top:20px;
    padding:10px 20px;
    background:#007bff;
    color:white;
    border:none;
    cursor:pointer;
    border-radius:5px;
}

@media print{
button{
display:none;
}
}

</style>

</head>

<body>

<h1>Rapport des présences</h1>

<table>

<tr>
<th>ID</th>
<th>Cours</th>
<th>Promotion</th>
<th>Salle</th>
<th>Date</th>
<th>Heure de présence</th>
<th>Statut</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['id']."</td>";
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

<button onclick="window.print()">
🖨️ Imprimer / Enregistrer en PDF
</button>

</body>
</html>
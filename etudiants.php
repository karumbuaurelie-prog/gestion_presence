<?php
include 'connexion.php';

if(isset($_POST['ajouter'])){

    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $promotion = $_POST['promotion'];

    $sql = "INSERT INTO etudiants(matricule, nom, prenom, sexe, promotion)
            VALUES('$matricule','$nom','$prenom','$sexe','$promotion')";

    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Étudiant ajouté avec succès !');</script>";
    }else{
        echo "<script>alert('Erreur lors de l\\'ajout !');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Étudiants</title>
<link rel="stylesheet" href="style.css">
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

<h1>👨‍🎓 Gestion des étudiants</h1>

<div class="box">

<form method="POST">

<label>Matricule</label><br>
<input type="text" name="matricule" required><br><br>

<label>Nom</label><br>
<input type="text" name="nom" required><br><br>

<label>Prénom</label><br>
<input type="text" name="prenom" required><br><br>

<label>Sexe</label><br>
<select name="sexe" required>
<option value="">Choisir</option>
<option value="Masculin">Masculin</option>
<option value="Féminin">Féminin</option>
</select><br><br>

<label>Promotion</label><br>
<input type="text" name="promotion" required><br><br>

<button type="submit" name="ajouter" class="btn vert">
➕ Ajouter l'étudiant
</button>

</form>

<hr>

<h2>📋 Liste des étudiants</h2>

<table border="1" cellpadding="10" cellspacing="0" width="100%">

<tr style="background:#0d6efd;color:white;">
<th>ID</th>
<th>Matricule</th>
<th>Nom</th>
<th>Prénom</th>
<th>Sexe</th>
<th>Promotion</th>
</tr>

<?php

$result = mysqli_query($conn,"SELECT * FROM etudiants ORDER BY id DESC");

while($row=mysqli_fetch_assoc($result)){

echo "<tr>";

echo "<td>".$row['id']."</td>";
echo "<td>".$row['matricule']."</td>";
echo "<td>".$row['nom']."</td>";
echo "<td>".$row['prenom']."</td>";
echo "<td>".$row['sexe']."</td>";
echo "<td>".$row['promotion']."</td>";

echo "</tr>";

}

?>

</table>

</div>

</div>

</body>
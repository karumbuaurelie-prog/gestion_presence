<?php
include 'connexion.php';

$qr = "";
$qr_code = "";
$lien = "";

if (isset($_POST['creer'])) {

    $cours = $_POST['cours'];
    $promotion = $_POST['promotion'];
    $date = $_POST['date_session'];
    $heure = $_POST['heure_debut'];
    $salle = $_POST['salle'];

    // Générer un code unique pour la session
    $qr_code = uniqid("QR_");

    // Expiration après 3 minutes
    $expiration = date("Y-m-d H:i:s", strtotime("+3 minutes"));

    // Enregistrer la session
    $sql = "INSERT INTO sessions
            (cours, promotion, salle, date_session, heure_debut, qr_code, expiration, statut)
            VALUES
            ('$cours','$promotion','$salle','$date','$heure','$qr_code','$expiration','Active')";

    if (mysqli_query($conn, $sql)) {

        /*
        ==========================================
        DÉTECTION DE L'ADRESSE IP DU PC
        ==========================================
        */

        $ip = $_SERVER['SERVER_ADDR'];

        // Si Apache retourne localhost
        if ($ip == "::1" || $ip == "127.0.0.1") {

            $ip = gethostbyname(gethostname());
        }

        /*
        ==========================================
        LIEN COMPLET POUR L'ÉTUDIANT
        ==========================================
        */

        $lien = "http://" . $ip .
                "/gestion_presence/scanner.php?code=" .
                urlencode($qr_code);

        /*
        ==========================================
        GÉNÉRATION DU QR CODE
        ==========================================
        */

        $qr = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data="
             . urlencode($lien);

        echo "<script>
                alert('Session créée avec succès !');
              </script>";

    } else {

        echo "<script>
                alert('Erreur lors de la création de la session !');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Nouvelle Session</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="sidebar">

<h2>🎓 GESTION PRÉSENCE</h2>

<ul>

<li>
<a href="dashboard.php">
🏠 Tableau de bord
</a>
</li>

<li>
<a href="nouvelle_session.php">
📅 Nouvelle session
</a>
</li>

<li>
<a href="etudiants.php">
👨‍🎓 Étudiants
</a>
</li>

<li>
<a href="rapports.php">
📊 Rapports
</a>
</li>

<li>
<a href="parametres.php">
⚙️ Paramètres
</a>
</li>

<li>
<a href="index.php">
🚪 Déconnexion
</a>
</li>

</ul>

</div>


<div class="content">

<h1>📅 Nouvelle Session</h1>

<div class="box">

<form method="POST">

<label>Nom du cours</label>

<br>

<input
type="text"
name="cours"
required
>

<br><br>


<label>Promotion</label>

<br>

<input
type="text"
name="promotion"
required
>

<br><br>


<label>Date</label>

<br>

<input
type="date"
name="date_session"
required
>

<br><br>


<label>Heure de début</label>

<br>

<input
type="time"
name="heure_debut"
required
>

<br><br>


<label>Salle</label>

<br>

<input
type="text"
name="salle"
required
>

<br><br>


<button
class="btn vert"
type="submit"
name="creer"
>

✅ Créer la session

</button>


<button
class="btn rouge"
type="reset"
>

❌ Annuler

</button>

</form>


<?php if ($qr != "") { ?>

<hr>

<h2 style="color:green;">

✅ Session créée avec succès

</h2>


<p>

<strong>Code de la session :</strong>

<?php echo htmlspecialchars($qr_code); ?>

</p>


<p>

<strong>Lien pour l'étudiant :</strong>

</p>


<a
href="<?php echo htmlspecialchars($lien); ?>"
target="_blank"
>

<?php echo htmlspecialchars($lien); ?>

</a>


<br><br>


<img
src="<?php echo htmlspecialchars($qr); ?>"
width="300"
height="300"
alt="QR Code"
>


<br><br>


<p style="color:#666;">

📱 L'étudiant doit être connecté au même réseau
que l'ordinateur pour ouvrir ce lien.

</p>


<?php } ?>

</div>

</div>

</body>

</html>
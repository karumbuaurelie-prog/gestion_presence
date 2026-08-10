<?php
include 'connexion.php';

$message = "";
$type_message = "";

$session = null;

/* Vérifier qu'un code de session est présent */
if (!isset($_GET['code']) && !isset($_POST['code'])) {
    die("<h2 style='color:red;text-align:center;'>❌ Aucun code de session reçu.</h2>");
}

/* Récupérer le code */
$code = isset($_POST['code']) ? $_POST['code'] : $_GET['code'];

/* Rechercher la session */
$stmt = mysqli_prepare($conn, "
    SELECT *
    FROM sessions
    WHERE qr_code = ?
    AND statut = 'Active'
    AND expiration >= NOW()
");

mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {

    die("
    <div style='
        font-family:Arial;
        text-align:center;
        margin-top:80px;
    '>
        <h2 style='color:red;'>❌ QR Code expiré ou invalide</h2>
        <p>La session n'est plus disponible.</p>
    </div>
    ");

}

$session = mysqli_fetch_assoc($result);
$session_id = $session['id'];


/* ==============================
   ENREGISTREMENT DE LA PRÉSENCE
   ============================== */

if (isset($_POST['enregistrer'])) {

    $matricule = trim($_POST['matricule']);

    if ($matricule == "") {

        $message = "⚠️ Veuillez saisir votre matricule.";
        $type_message = "error";

    } else {

        /* Rechercher l'étudiant avec son matricule */
        $stmt_etudiant = mysqli_prepare($conn, "
            SELECT id, matricule, nom, prenom
            FROM etudiants
            WHERE matricule = ?
            LIMIT 1
        ");

        mysqli_stmt_bind_param(
            $stmt_etudiant,
            "s",
            $matricule
        );

        mysqli_stmt_execute($stmt_etudiant);

        $result_etudiant = mysqli_stmt_get_result($stmt_etudiant);

        if (mysqli_num_rows($result_etudiant) == 0) {

            $message = "❌ Aucun étudiant trouvé avec ce matricule.";
            $type_message = "error";

        } else {

            $etudiant = mysqli_fetch_assoc($result_etudiant);

            $etudiant_id = $etudiant['id'];

            /* Vérifier si l'étudiant est déjà présent */
            $stmt_verif = mysqli_prepare($conn, "
                SELECT id
                FROM presences
                WHERE etudiant_id = ?
                AND session_id = ?
                LIMIT 1
            ");

            mysqli_stmt_bind_param(
                $stmt_verif,
                "ii",
                $etudiant_id,
                $session_id
            );

            mysqli_stmt_execute($stmt_verif);

            $result_verif = mysqli_stmt_get_result($stmt_verif);

            if (mysqli_num_rows($result_verif) > 0) {

                $message = "⚠️ Votre présence a déjà été enregistrée.";
                $type_message = "warning";

            } else {

                /* Enregistrer la présence */
                $statut = "Présent";

                $stmt_insert = mysqli_prepare($conn, "
                    INSERT INTO presences
                    (etudiant_id, session_id, heure_presence, statut)
                    VALUES (?, ?, NOW(), ?)
                ");

                mysqli_stmt_bind_param(
                    $stmt_insert,
                    "iis",
                    $etudiant_id,
                    $session_id,
                    $statut
                );

                if (mysqli_stmt_execute($stmt_insert)) {

                    $message = "✅ Présence enregistrée avec succès !";
                    $type_message = "success";

                } else {

                    $message = "❌ Erreur lors de l'enregistrement.";
                    $type_message = "error";
                }

                mysqli_stmt_close($stmt_insert);
            }

            mysqli_stmt_close($stmt_verif);
        }

        mysqli_stmt_close($stmt_etudiant);
    }
}

mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Enregistrement de présence</title>

<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    padding:0;
    font-family:Arial, sans-serif;
    background:#f1f5f9;
}

.container{
    width:90%;
    max-width:500px;
    margin:60px auto;
}

.box{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

h1{
    text-align:center;
    color:#0d6efd;
    margin-bottom:10px;
}

.subtitle{
    text-align:center;
    color:#666;
    margin-bottom:25px;
}

.info{
    background:#eef5ff;
    padding:15px;
    border-radius:10px;
    margin-bottom:25px;
}

.info p{
    margin:8px 0;
}

label{
    display:block;
    font-weight:bold;
    margin-bottom:8px;
}

input{
    width:100%;
    padding:13px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:16px;
    margin-bottom:20px;
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:8px;
    background:#198754;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#157347;
}

.success{
    background:#d1e7dd;
    color:#0f5132;
    padding:15px;
    border-radius:8px;
    text-align:center;
    margin-bottom:20px;
}

.error{
    background:#f8d7da;
    color:#842029;
    padding:15px;
    border-radius:8px;
    text-align:center;
    margin-bottom:20px;
}

.warning{
    background:#fff3cd;
    color:#664d03;
    padding:15px;
    border-radius:8px;
    text-align:center;
    margin-bottom:20px;
}

.footer{
    text-align:center;
    margin-top:20px;
    color:#777;
    font-size:13px;
}

</style>

</head>

<body>

<div class="container">

<div class="box">

<h1>📋 Présence</h1>

<p class="subtitle">
Enregistrement de la présence étudiant
</p>


<?php if ($message != ""): ?>

<div class="<?php echo $type_message; ?>">

<?php echo htmlspecialchars($message); ?>

</div>

<?php endif; ?>


<div class="info">

<p>
<strong>📚 Cours :</strong>
<?php echo htmlspecialchars($session['cours']); ?>
</p>

<p>
<strong>🎓 Promotion :</strong>
<?php echo htmlspecialchars($session['promotion']); ?>
</p>

<p>
<strong>🏫 Salle :</strong>
<?php echo htmlspecialchars($session['salle']); ?>
</p>

<p>
<strong>📅 Date :</strong>
<?php echo htmlspecialchars($session['date_session']); ?>
</p>

</div>


<?php if ($type_message != "success" && $type_message != "warning"): ?>

<form method="POST" action="">

<input
    type="hidden"
    name="code"
    value="<?php echo htmlspecialchars($code); ?>"
>


<label for="matricule">
Matricule
</label>

<input
    type="text"
    id="matricule"
    name="matricule"
    placeholder="Exemple : 2026001"
    required
>


<button
    type="submit"
    name="enregistrer"
>
    ✅ Enregistrer la présence
</button>

</form>

<?php endif; ?>


<?php if ($type_message == "success"): ?>

<div style="text-align:center;">

<h2 style="color:#198754;">
🎉 Présence enregistrée avec succès !
</h2>

<p>
Votre présence a bien été enregistrée.
</p>

<p>
<strong>Étudiant :</strong>
<?php echo htmlspecialchars($etudiant['nom'] . " " . $etudiant['prenom']); ?>
</p>

<p>
<strong>Matricule :</strong>
<?php echo htmlspecialchars($etudiant['matricule']); ?>
</p>

<p>
<strong>Statut :</strong> Présent
</p>

</div>

<?php endif; ?>


<div class="footer">

Gestion des présences — Projet PHP & MySQL

</div>

</div>

</div>

</body>

</html>
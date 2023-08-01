<?php
require_once __DIR__ . '/vendor/autoload.php';
require('session_header.php');
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accueil</title>
</head>

<body>

    <h1 class="animate__animated animate__rubberBand">Battle</h1>
    <audio id="fight-song" src="fight.mp3"></audio>

    <form id='formFight' action="#" method="post">
        <input type="submit" name="start" value="commencer la partie">
    </form>


    <?php

    if (isset($_POST['start'])) {

        header("location:joueur_formulaire.php");
    }

    ?>

</body>

</html>
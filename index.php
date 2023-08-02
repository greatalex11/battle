<?php
require_once __DIR__ . '/vendor/autoload.php';
require('session_header.php');


if (isset($_POST['start'])) {
    header("location:joueur_formulaire.php");
};

dump($_SESSION);
$counter = $_SESSION["counter"] ?? null;

$pertes = $_SESSION["Pertes"] ?? null;
$looser = $_SESSION["looserName"] ?? null;

$byeBye = $_SESSION['close'];

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accueil</title>
</head>

<body>

    <h1 class="animate__animated animate__rubberBand ">Battle</h1>

    <?php if ($byeBye == true) { ?>
        <p> alert(<? echo $byeBye ?>)</p>
    <?php } ?>

    <audio id="fight-song" src="fight.mp3"></audio>

    <form id='formFight' action="#" method="post">
        <?php if ($counter != null || $byeBye != true) { ?>
            <input type="submit" name="start" value="continuer la partie">
        <?php } else { ?>
            <input type="submit" name="start" value="commencer la partie">
        <?php } ?>
    </form>

    <?php if (isset($_SESSION["winnerName"])) { ?>
        <div>
            <span>And the winner is : <?php echo $_SESSION["winnerName"]; ?> </span>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION["verdict"])) { ?>
        <div>
            <span>Verdict : <?php echo $_SESSION["verdict"]; ?> </span>
        </div>
    <?php } ?>


    <?php if (isset($_SESSION["winnerName"])) { ?>
        <div id="playerscrean" class="flex row h-100 justify-content-center align-items-center">
            <img id="player" width="250" src="https://api.dicebear.com/6.x/lorelei/svg?flip=false&seed=<?php echo $_SESSION["winnerName"] ?>" alt="Avatar" class="avatar float-end">
        </div>

        <div> Perte de <span class="badge bg-secondary"> <?php echo $pertes ?> pour <?php echo $looser ?> </span> </div>

    <?php } ?>

    </div>






</body>

</html>
<?php
require_once __DIR__ . '/vendor/autoload.php';
require('session_header.php');
dump($_POST);

$player = $_SESSION["player"] ?? null;
$adversaire  = $_SESSION["adversaire"] ?? null;
$counter  = $_SESSION["counter"] ?? 1;

?>


<html lang="fr">

<head>
   <title>Battle</title>
   <link rel="stylesheet" href="public/bootstrap.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />



</head>

<body>
   <div class="container">
      <audio id="fight-song" src="fight.mp3"></audio>
      <audio id="hadoudken-song" src="Haduken.mp3"></audio>
      <audio id="fatality-song" src="fatality.mp3"></audio>
      <h1 class="animate__animated animate__rubberBand">Battle #<?php echo $counter; ?></h1>
      <?php if (!$player || !$adversaire) { ?>
         <div id="prematch">
            <form id='formFight' action="session_dataBattle.php" method="post">
               <div>
                  Joueur <br>
                  <div class="row">
                     <div class="col-6">
                        <label class="form-label">Name</label>
                        <input required type="text" class="form-control" name="player[name]" maxlength="20">

                     </div>
                     <div class=" col-6">
                        <label class="form-label">Attaque</label>
                        <input required type="number" class="form-control" value="40" name="player[attaque]" min="10" step="10" max="40">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Mana</label>
                        <input required type="number" class="form-control" value="100" name="player[mana]" min="50" step="50" max="300">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Santé</label>
                        <input required type="number" class="form-control" value="100" name="player[sante]" min="10" step="5" max="100">
                     </div>
                  </div>
               </div>
               <hr>
               <div>
                  Adversaire <br>
                  <div class="row">
                     <div class="col-6">
                        <label class="form-label">Name</label>
                        <input required type="text" class="form-control" name="adversaire[name]" maxlength="20">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Attaque</label>
                        <input required type="number" class="form-control" value="40" name="adversaire[attaque]" min="10" step="10" max="40">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Mana</label>
                        <input required type="number" class="form-control" value="100" name="adversaire[mana]" min="50" step="50" max="300">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Santé</label>
                        <input required type="number" class="form-control" value="100" name="adversaire[sante]" min="10" step="5" max="100">
                     </div>
                  </div>
               </div>
               <div class="row mt-2">
                  <div class="d-flex justify-content-center">
                     <input id="fight" type="submit" name="fight" value="FIGHT">
                  </div>
               </div>
            </form>
         </div>
      <?php } else { ?>
         <div id="match">
            <form action="session_dataBattle.php" method="post">
               <div class="row">
                  <div class="col-6">
                     <div class="position-relative float-end">
                        <img id="player" src="https://api.dicebear.com/6.x/lorelei/svg?flip=false&seed=test" alt="Avatar" class="avatar float-end">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                           <?php echo $player["sante"] ?>
                           <input type="hidden" value='<?php echo $player["sante"] ?>' name="player[sante]">
                        </span>
                     </div>
                     <ul>
                        <li>Nom : <?php echo $player["name"] ?> <input type="hidden" value='<?php echo $player["name"] ?>' name="player[name]"></li>
                        <li>Attaque : <input type="number" name="player[attaque]" value="40" name="player[attaque]" min="10" step="10" max="40"></li>
                        <li>Mana : <input type="number" name="player[mana]" value="<?php echo $_SESSION["player"]["mana"] ?>" min="50" step="50" max="300"></li>

                        <li>Berret : <select name="player[berret]" class="mh-10">
                              <option value="vert">vert</option>
                              <option value="noir">noir</option>
                           </select>
                     </ul>
                  </div>
                  <div class="col-6" id="adversaire">
                     <div class="position-relative float-start">
                        <img src="https://api.dicebear.com/6.x/lorelei/svg?flip=true&seed=test2" alt="Avatar" class="avatar">
                        <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                           <?php echo $adversaire["sante"] ?>
                           <input type="hidden" value='<?php echo $adversaire["sante"] ?>' name="adversaire[sante]">
                        </span>
                     </div>
                     <ul>
                        <li>Nom : <?php echo $adversaire["name"] ?> <input type="hidden" value='<?php echo $adversaire["name"] ?>' name="adversaire[name]"></li>
                        <li>Attaque : <input type="number" name="adversaire[attaque]" value="40" min="10" step="10" max="40"></li>
                        <li>Mana : <input type="number" name="adversaire[mana]" value="<?php echo $_SESSION["adversaire"]["mana"] ?>" min="50" step="50" max="300"></li>

                        <li>Berret : <select name="adversaire[berret]">
                              <option value="vert">vert</option>
                              <option value="noir">noir</option>
                           </select>
                        </li>
                     </ul>
                  </div>
               </div>
               <input type="submit" value="param's changed -> fight">
            </form>
         </div>
      <?php } ?>




      <script>
         document.addEventListener("DOMContentLoaded", function() {
            let submitFight = document.querySelector("#fight");
            if (submitFight) {
               submitFight.addEventListener("click", function(event) {
                  event.preventDefault();
                  submitFight.classList.add("animate__animated");
                  submitFight.classList.add("animate__rubberBand");
                  setTimeout(function() {
                     submitFight.classList.remove("animate__rubberBand");
                  }, 1000);
                  let fight_song = document.getElementById("fight-song");
                  fight_song.play();
                  setTimeout(function() {
                     document.forms["formFight"].submit();
                  }, 500);
               })
            }

            let submitAttaque = document.querySelector("#attaque");
            let alreadyPlaySong = false;
            if (submitAttaque) {
               submitAttaque.addEventListener("click", function(event) {
                  if (alreadyPlaySong)
                     return true;
                  event.preventDefault();
                  let player = document.querySelector("#player")
                  player.classList.add("animate__animated");
                  player.classList.add("animate__rubberBand");
                  submitAttaque.classList.add("animate__animated");
                  submitAttaque.classList.add("animate__rubberBand");
                  setTimeout(function() {
                     submitAttaque.classList.remove("animate__rubberBand");
                     player.classList.remove("animate__rubberBand");
                  }, 1000);
                  let hadouken_song = document.getElementById("hadoudken-song");
                  hadouken_song.play();
                  alreadyPlaySong = true;
                  setTimeout(function() {
                     submitAttaque.click();
                  }, 1000);
               })
            }

            let submitRestart = document.querySelector("#restart");
            let alreadyPlaySongRestart = false;
            if (submitRestart) {
               submitRestart.addEventListener("click", function(event) {
                  if (alreadyPlaySongRestart)
                     return true;
                  event.preventDefault();
                  let fatality_song = document.getElementById("fatality-song");
                  fatality_song.play();
                  alreadyPlaySongRestart = true;
                  setTimeout(function() {
                     submitRestart.click();
                  }, 2000);
               })
            }
         });
      </script>
</body>
<style>
   .avatar {
      vertical-align: middle;
      width: 100px;
      border-radius: 50%;
   }
</style>

</html>
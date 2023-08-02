<?php
require_once __DIR__ . '/vendor/autoload.php';
require('session_header.php');

$_SESSION['player'] = $_POST['player'] ?? [];
$_SESSION['adversaire'] = $_POST['adversaire'] ?? [];
$_SESSION['counter'] = ($_SESSION['counter'] ?? 1) + 1;

$_SESSION['Pertes'];

$_SESSION['looserName'];



function calculAttack(array $player, array $adversaire): array
{
   $produitPlayer = $_SESSION['player']['attaque'] * $_SESSION['player']['mana'] * $_SESSION['player']['sante'];
   $produitAdversaire = $_SESSION['adversaire']['attaque'] * $_SESSION['adversaire']['mana'] * $_SESSION['adversaire']['sante'];

   return ["produitPlayer" => $produitPlayer, "produitAdversaire" => $produitAdversaire];
}
$resultat = calculAttack($_SESSION['player'], $_SESSION['adversaire']);


function analyseAttack(array $resultat)
{
   if ($resultat['produitPlayer'] > $resultat['produitAdversaire']) {

      $verdict  = "player gagnant";
      $_SESSION["winnerName"] = $_SESSION['player']['name'];
      $_SESSION["looserName"] =  $_SESSION['adversaire']['name'];
   } elseif ($resultat['produitPlayer'] == $resultat['produitAdversaire']) {

      $verdict = "match null";
   } else {
      $verdict = "adversaire gagnant ";
      $_SESSION["winnerName"] = $_SESSION['adversaire']['name'];
      $_SESSION["looserName"] =  $_SESSION['player']['name'];
   };

   return $verdict;
};

$verdict = analyseAttack($resultat);



function affichageResult($verdict)
{
   if ($verdict !== "") {
      $_SESSION["verdict"] = $verdict;
      header("location:index.php");
   }
};

affichageResult($verdict);

function rules($resultat, $verdict)
{
   $deltaPoint = abs($resultat['produitPlayer'] - $resultat['produitAdversaire']);
   $deltaPoint = substr($deltaPoint, 0, 2);
   $_SESSION["Pertes"] = $deltaPoint;

   if ($verdict = "adversaire gagnant") {

      $_SESSION['pertePlayer'] = ['player', $deltaPoint];
      $_SESSION['player']['mana'] = $_SESSION['player']['mana'] - $deltaPoint;
   } elseif ($verdict = "player gagnant") {

      $_SESSION['perteadversaire'] = ['adversaire', $deltaPoint];
      $_SESSION['adversaire']['mana'] = $_SESSION['adversaire']['mana'] - $deltaPoint;
   }
   var_dump($_SESSION['adversaire']['mana']);

   return $deltaPoint;
}
$mafonction = rules($resultat, $verdict);
dump($mafonction);

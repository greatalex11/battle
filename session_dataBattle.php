<?php
require_once __DIR__ . '/vendor/autoload.php';
require('session_header.php');

$_SESSION['player'] = $_POST['player'] ?? [];
$_SESSION['adversaire'] = $_POST['adversaire'] ?? [];

dump($_SESSION);

function calculAttack(array $player, array $adversaire): array
{

   $produitPlayer = $_SESSION['player']['attaque'] * $_SESSION['player']['mana'] * $_SESSION['player']['sante'];
   $produitAdversaire = $_SESSION['adversaire']['attaque'] * $_SESSION['adversaire']['mana'] * $_SESSION['adversaire']['sante'];

   return ["produitPlayer" => $produitPlayer, "produitAdversaire" => $produitAdversaire];
}


function analyseAttack(int $adversaire, int $player): string
{



   /*if (($_SESSION['adversaire']['mana']) < ($_SESSION['player']['mana'])) 
   {
       echo 'the winer is' . $_SESSION['adversaire']['name'];
   }else{
      echo ($_SESSION['player']['name']) . "loose";
   }
   $resut= return "winn or loose";
   */
};



function affichageResult($result)
{
   "affiche pannel loose or win + resultat + bande son";
};


function gestionDesSoins($form): int
{
   $_SESSION['player']['sante'];
   $_SESSION['player']['mana'];
   $_SESSION['adversaire']['sante'];
   $_SESSION['adversaire']['mana'];
};

?>

<script>
   let sante = <?php echo $_SESSION['adversaire']['sante'] ?>;
</script>
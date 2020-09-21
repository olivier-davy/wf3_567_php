<?php

// Fonction debug()
function debug($var) {
   echo '<pre>';
       print_r($var);
   echo '</pre>';
}

// Variable d'affichage 
$contenu = '';


// Connection
$pdo = new PDO('mysql:host=localhost;dbname=immobilier', 
                'root', 
                '', 
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
                )              
);

// Pour vérifier que je reçois qq chose
//debug($_GET);

if (isset($_GET['id_logement'])) { // si id_contact est dans l'URL c'est que l'on a demandé le détail du contact   

   // Echappement des données :
   $_GET['id_logement'] = htmlspecialchars($_GET['id_logement'], ENT_QUOTES); // pour se prémunir des risques XSS et CSS (chevrons transformés en HTML) 

   // Requête préparée car le GET vient de l'internaute
   $resultat = $pdo->prepare("SELECT * FROM logement WHERE id_logement = :id_logement"); // marqueur vide

   $resultat->execute(array(':id_logement' => $_GET['id_logement'])); 

   $fiche = $resultat->fetch(PDO::FETCH_ASSOC);  

  //debug($resultat);   
}

?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Détail fiche</title>

</head>

<body>

<!-- Autre version d'affichage avec BT -->

<div class="col mt-4">

<?php

if (empty($fiche)) {

echo '<div class="alert alert-danger">Le contact n\'existe pas</div>';


} else {

echo '<div><img class="img-fluid" style="width:80px" src="'.  $fiche['photo'] .'"> </div>';
echo '<h1>' .  $fiche['titre']. '</h1>';
echo '<h2>Type de fiche : ' .  $fiche['type'] . '</h2>';
echo '<h2>Adresse : ' .  $fiche['adresse'] . '</h2>'; 
echo '<h2>Ville : ' .  $fiche['ville'] . '</h2>'; 
echo '<p>CP : ' .  $fiche['cp'] . '</p>'; 
echo '<p>Surface : ' .  $fiche['surface'] . '<p>'; 
echo '<p>Prix : ' .  $fiche['prix'] . ' €' . '<p>'; 
echo '<p>Description : ' .  $fiche['description'] . '<p>'; 

echo '<div class="card">';
echo '<img class="card-img-top" style="width:200px" src="'.  $fiche['photo'] .'" alt="Card image cap">';
echo '<div class="card-body">';
echo '<h2 class="card-title">'.  $fiche['titre'].'</h2>';
echo '<h4>Type de fiche : ' .  $fiche['type'] . '</h4>';
echo '<h4>Adresse : ' .  $fiche['adresse'] . '</h4>'; 
echo '<h4>Ville : ' .  $fiche['ville'] . '</h4>';
echo '<p>CP : ' .  $fiche['cp'] . '</p>'; 
echo '<p>Surface : ' .  $fiche['surface'] . '<p>'; 
echo '<p>Prix : ' .  $fiche['prix'] . ' €' .'<p>'; 
echo '<p>Description : ' .  $fiche['description'] . '<p>';
echo '<a href="liste_fiche.php" class="btn btn-primary">Retour liste</a>';
echo '</div>';
echo '</div>';

}

?>

</div>

</body>

</html>

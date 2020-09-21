<?php
/*
   1- Vous affichez le détail complet du contact demandé, y compris la photo. Si le contact n'existe pas, vous laissez un message. 

*/
function debug($var) {
   echo '<pre>';
       print_r($var);
   echo '</pre>';
}
// Variable d'affichage 
$contenu = '';


// Connection
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 
                'root', 
                '', 
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
                )              
);

// Pour vérifier que je reçois qq chose
//debug($_GET);

if (isset($_GET['id_contact'])) { // si id_contact est dans l'URL c'est que l'on a demandé le détail du contact   

   // Echappement des données :
   $_GET['id_contact'] = htmlspecialchars($_GET['id_contact'], ENT_QUOTES); // pour se prémunir des risques XSS et CSS (chevrons transformés en HTML) 

   // Requête préparée car le GET vient de l'internaute
   $resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact"); // marqueur vide

   $resultat->execute(array(':id_contact' => $_GET['id_contact'])); // on associe le marqueur à la valeur qui passe par l'URL donc dans $_GET

   $contact = $resultat->fetch(PDO::FETCH_ASSOC);  // on "fetch" $resultat pour aller chercher les données du contact dans l'objet qui s'y trouvent

  // debug($contact);   
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Detail contacts</title>
</head>

<body>

<?php

if (empty($contact)) {

   echo '<div class="alert alert-danger">Le contact n\'existe pas</div>';

} else {

   echo '<div><img class="img-fluid" style="width:80px" src="'. $contact['photo'] .'"> </div>';
   echo '<h1>' . $contact['prenom'] . ' ' .$contact['nom'] . '</h1>'; 
   echo '<h2>Téléphone : ' . $contact['telephone'] . '</h2>'; 
   echo '<h2>email : ' . $contact['email'] . '</h2>'; 
   echo '<div>Type de contact : ' . $contact['type_contact'] . '</div>';

}

?>

</body>

</html>

<?php
//-----------------------
// La superglobale $_GET
//-----------------------
// $_GET représente l'information qui transite dans l'URL. Il s'agit d'une superglobale et donc, comme toutes les superglobales, d'un ARRAY. Par ailleurs, superglobale signifie que cette variable ets disponible dans tous les contextes du script, y compris dans l'espace local des fonctions sans avoir besoin de faire "global $_GET".

// Pour faire simple, on utilise GET pour obtenir des données, et POST pour transmettre des données,

// Les informations transitent dans l'URL selon la syntaxe suivante :
// page.php?indice1=valeur1&indiceN=valeurN

// La superglobale $_GET réceptionne les informations dans un tableau : 
// $_GET = array("indice1" => "valeur1");    

// Vérifier que l'on reçoit de l'information depuis l'url /
echo '<pre>';
    print_r($_GET);
echo '</pre>';

if (isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET['prix']) ) { // isset teste si une variable existe. Nous allons nous en servir pour afficher un message spécifique, si le article et couleur et  prix sont absents.
    echo '<h1>' . $_GET['article'] . '</h1>';
    echo '<p>Couleur : ' . $_GET['couleur'] . '</p>'; 
    echo '<p>Prix : ' . $_GET['prix'] . ' €</p>'; 
} else {
    echo '<p>Veuillez choisir un produit <a href="page1.php">ici</a></p>';
}


//En réalité nous passons l'identifiant du produit dans l'URL afin d'en selectionner les informations dans la BDD.
<?php

echo '<pre>'; // balise de préformatage
    print_r($_POST); // pour vérifier que le formulaire envoie bien des données
echo '</pre>';

if (!empty($_POST)) { 

    echo '<p>Ville :' . $_POST['ville'] . '</p>';
    echo '<p>Code Postal :' . $_POST['cp'] . '</p>';
    echo '<p>Description :' . $_POST['description']  . '</p>';
    //---------------------------
    // Ecrire dans un fichier txt
    //---------------------------
    // On va écrire les adresses des internautes dans un fichier texte créé dynamiquement sur le serveur (en l'absence de BDD).

    $file = fopen('adresses.txt', 'a'); // fopen() en mode "a" créer le fichier s'il n'existe pas encore sinon l'ouvre.

    $adresse =  $_POST['description'] . ' - ' . $_POST['cp'] . ' - ' . $_POST['ville'] . "\n"; // on concatène l'adresse de l'internaute avec un saut de ligne à la fin ("\").
    
    fwrite($file, $adresse); // fwrite() écrit le contenu de la variale $adresse dans le fichier représenté par $file.

    fclose($file); // puis on ferme le fichier pour libérer de la ressource.

} // fin de notre condition
<?php
//--------------------------
// La superglobale $_Cookie
//--------------------------
// Un cookie est un petit fichier (4 ko max) déposé par le serveur du site dans le navigateur de l'internaute et qui peut contenir des informations. Les cookies sont automatiquement renvoyés au serveur web par le navigateur quand l'internaute navigue dans les pages concernées par le cookie. PHP permet de récupérer très facilement les données contenues dans un cookie : ses informations sont stockés dans la superglobale $_COOKIE.

// Précaution à prendre avec les cookies : étant sauvegardé sur le poste de l'internaute, le cookie peut-être volé ou modifié. On y met donc pas d'informations sensibles (prix de panier, CB, mdp ...) mais des préférences ou des traces de visites par exemple.


// Application : Nous allons stocker la langue sélectionnée par l'internaute dans un cookie.

// 2- On détermine la langue d'affichage pour l'internaute :
if (isset($_GET['langue'])) {  // si on a cliqué sur 1 langue, l'indice "langue" est pasé dans l'url donc se trouve dans $_GET
    $langue = $_GET['langue']; // on affecte alors la valeur de la langue à la variable ("fr" ou "es" ou ...)
} elseif (isset($_COOKIE['langue'])){ // sinon si on a reçu un cookie appelé "langue"
    $langue = $_COOKIE['langue']; // on affecte la valeur stockée dans le cookie. L'indice "langue" correspond au NOM du cookie.
} else {
    $langue = 'fr'; // Par défaut, si on a pas cliqué et qu'aucun cookie n'existe, la langue sera "fr".
}

// 3- On envoie le cookie :

$un_an = time() +  (60 * 60 * 24 * 365); // time() retourne le timestamps de l'instant présent auquel on ajoute 1 an exprimé en secondes. Pour mémoire : timetamp = nombre de secondes coulées depuis le 01/1/1970.

setcookie('langue', $langue, $un_an); // on envoie un cookie appelé "langue" avec la valeur celle qui est dans $langue et pour date d'expiration $un_an.

// 4- On affiche la langue :

echo "<h2>Langue du site : $langue </h2>";

// setcookie() permet de créer un cookie. Cependant il n'y a pas de fonction prédéfinie permettant de le supprimer. Pour cela, on le met à jour avec une date périmée, ou à zéro, ou encore juste en mettant le nom du cookie sans les autres arguments.

// setcookie ($langue);

// 1- Le HTML

?>
<h1>langues</h1>

<ul>

    <li><a href="?langue=fr">français</li>
    <li><a href="?langue=es">espagnol</li>
    <li><a href="?langue=en">anglais</li>
    <li><a href="?langue=it">italien</li>
    <li><a href="?langue=dr">allemand</li>
  
</ul>

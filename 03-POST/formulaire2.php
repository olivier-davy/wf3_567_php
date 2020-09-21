<?php
// Exercice :
// Créer un formulaire avec les champs "ville", code postal" et une zone de texte "adresse" dans cette page <formulaire2.php
// - Afficher les données saisies par l'internaute dans la page foirmulaire2-traitement.php.



?>

<h1>Formulaire Exercice</h1>

<form method="post" action="formulaire2-traitement.php"></a> <!-- ../ pour remonter au dossier parent -->

    <div><label for="ville">Ville :</label></div>
    <div><input type="text" name="ville" id="ville"></div> 

    <div><label for="cp"></label>Code Postal :</div>
    <div><input type="cp" name="cp" id="cp"></div>

    <div><label for="description">Adresse :</label></div> 
    <div><textarea name="description" id="description"></textarea></div>

    <div><input type="submit" value="envoyer"></div>

</form>
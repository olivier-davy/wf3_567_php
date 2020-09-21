<?php
// Exercice
/*

1- Seul l'administrateur doit avoir accès à cette page. Les autres sont redirigés vers la page de connexion

2- Afficher tous les membres inscrits dans une table HTML avec toutes les infos du membre SAUF son mot de passe. Vous ajoutez une colonne "action"
3- Afficher le nombre de membres inscrits
4- Dans la colonne "action", ajoutez un lien "supprimer" pour supprimer un membre inscrit, SAUF vous même qui êtes connecté
5- Bonus : dans la colonne "action", ajoutez un lien pour pouvoir modifier le statut des membres pour en faire un admin ou un membre, sauf vous même qui êtes connecté



*/

require_once '../inc/init.php';
//-------------------TRAITEMENT PHP ------------------
// 1- restriction d'accès aux administrateurs
if (!estAdmin()){ // si membre non admin ou non connecté, on le renvoie vers connexion.php
    header('location:../connexion.php'); // attention au ../
    exit();
}

$resultat = executeRequete("SELECT nom, prenom, email FROM membre");

$contenu.= '<p>Nombre de membres inscrits : '. $resultat -> rowCount() . '</p>';

// Affichage de la ligne d'entête 

$contenu.= '<table class="table">';
    $contenu.= '<tr>';
    $contenu.= '<th>Nom</th>';
    $contenu.= '<th>Prénom</th>';
    $contenu.= '<th>email</th>';
    $contenu.= '<th>action</th>';
    
    while ($membre = $resultat->fetch(PDO::FETCH_ASSOC)) {  // à chaque tour de boucle de while, fetch() va chercher la ligne suivante qui correspond à 1 employé et retourne ses informations sous forme de tableau associatif. Comme il s'agit d'un tableau, nous faisons ensuite une boucle foreach pour le parcourir :
        //debug($produit); 

        $contenu.= '<tr>';
        foreach ($membre as $indice => $info) { // cette boucle parcourt les informations du tableau $produit

           
                $contenu .= '<td>'. $info . '</td>';
            }
            
        }
    
    $contenu.= '</tr>';

//--------------------AFFICHAGE----------------------
require_once '../inc/header.php';









echo $contenu;

require_once '../inc/footer.php';
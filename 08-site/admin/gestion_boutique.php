<?php

require_once '../inc/init.php';
//-------------------TRAITEMENT PHP ------------------
// 1- restriction d'accès aux administrateurs
if (!estAdmin()){ // si membre non admin ou non connecté, on le renvoie vers connexion.php
    header('location:../connexion.php'); // attention au ../
    exit();
}

// 7- Suppression du produit
// on se positionne avant l'affichage du tableau <table> pour que celui-ci soit à jour sans le produit supprimé
if (isset($_GET['id_produit'])) { // si existe "id_produit" dans l'URL c'est qu'on a demandé sa suppression

    $resultat = executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array 
    (':id_produit' => $_GET['id_produit'])); // l'identifiant vient de l'URL

    if ($resultat) { // si le DELETE retourne 1 objet PDOStatement évalué à true c'est que la requête a marché
        $contenu .= '<div class="alert alert-success">Le produit a bien été supprimé.</div>';
    } else { // dans le cas contraire on a reçu false
        $contenu .= '<div class="alert alert-danger">Erreur lors de la suppression</div>';
    }

}

// 6- Affichage des produits en back-office :

?>

<style>

table,th,tr,td {
    border: 1px solid;
}

table {
    border-collapse: collapse;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}


</style>
<?php

$resultat = executeRequete("SELECT * FROM produit");

$contenu.= '<p>Nombre de produits dans la boutique : '. $resultat -> rowCount() . '</p>';

// Affichage de la ligne d'entête 

$contenu.= '<table class="table">';
    $contenu.= '<tr>';
    $contenu.= '<th>ID</th>';
    $contenu.= '<th>Référence</th>';
    $contenu.= '<th>Catégorie</th>';
    $contenu.= '<th>Titre</th>';
    $contenu.= '<th>Description</th>';
    $contenu.= '<th>Couleur</th>';
    $contenu.= '<th>Taille</th>';
    $contenu.= '<th>Public</th>';
    $contenu.= '<th>Photo</th>';
    $contenu.= '<th>Prix</th>';
    $contenu.= '<th>Stock</th>';
    $contenu.= '<th>Action</th>'; // colonne pour les lignes modifier et supprimer
    $contenu.= '</tr>';

    //debug($resultat);    
    // Les lignes du tableaux :

    // Affichez un produit par ligne avec dans la colonne "photo" la photo du produit en 90px de large
     

    // Affichage des lignes :
    while ($produit = $resultat->fetch(PDO::FETCH_ASSOC)) {  // à chaque tour de boucle de while, fetch() va chercher la ligne suivante qui correspond à 1 employé et retourne ses informations sous forme de tableau associatif. Comme il s'agit d'un tableau, nous faisons ensuite une boucle foreach pour le parcourir :
        //debug($produit); 

        $contenu.= '<tr>';
        foreach ($produit as $indice => $info) { // cette boucle parcourt les informations du tableau $produit

            if ($indice == 'photo') { // si je suis sur la colonne photo je mets une balise <img>

                $contenu .= '<td><img src="../'. $info .'" style="width:90px"></td>';
            }else { // pas de balise img pour les autres colonnes
                $contenu .= '<td>'. $info . '</td>';
            }
            
        }
        $contenu.= '<td>
                        <a href="formulaire_produit.php?id_produit='. $produit['id_produit'].'"> modifier </a>
                        <a href="gestion_boutique.php?id_produit='. $produit['id_produit'].'" onclick="return confirm(\'Etes-vous certain de vouloir supprimer ce produit ?\')">supprimer </a>
        
                    </td>'; // nous ajoutons les liens modifier et supprimer sur chaque ligne d eproduit (nous sommes à l'intérieur du <tr>). Nous passons dans l'URL l'identifiant du produit contenu dans la variable $produit['id_produit'] (cf debug($produit))


        $contenu.= '</tr>';
    }

$contenu.= '</table>';

//--------------------AFFICHAGE----------------------
require_once '../inc/header.php';

// 2- liens de navigation
?>
<h1 class="mt-4">Gestion boutique</h1>



<ul class="nav nav-tabs">

    <li><a href="gestion_boutique.php" class="nav-link active">Affichage des produits</a></li>
    <li><a href="formulaire_produit.php" class="nav-link">Formulaire produit</a></li>


</ul>




<?php
echo $contenu;


require_once '../inc/footer.php';
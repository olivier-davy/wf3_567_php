<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

*/
function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//---------------------TRAITEMENT PHP ----------------------------
// Variable d'affichage 
$contenu = '';

$photo_bdd = '';

?>
<!-- Formatage du tableau en CSS -->
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

// Connection BDD
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 
                'root', 
                '', 
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
                )              
);

// --- Suppression d'un contact
if (isset($_GET['id_contact']) && $_GET['action']=='supprimer_contact'){// si existe "id_produit dans l'url c'est qu'on a demandé la suppression
	
	$resultat_supp = $pdo->prepare("DELETE FROM contact WHERE id_contact=:id_contact");
  $resultat_supp -> execute(array(':id_contact' => $_GET['id_contact']));

  if ($resultat_supp){
    $contenu.= '<div class="alert alert-success">Le contact a bien été supprimé</div>';

  } else{
    $contenu.= '<div class="alert alert-danger">Erreur lors de la suppression</div>';
    }
	
}

$resultat = $pdo->query("SELECT id_contact, Nom, Prenom, telephone, email, type_contact, photo FROM contact");

$contenu.= '<p>Nombre de contacts dans mon répertoire : '. $resultat -> rowCount() . '</p>';

// Affichage de la ligne d'entête 
$contenu.= '<table>';
  $contenu.= '<tr>';
  
      $contenu.= '<th>id_contact</th>';
      $contenu.= '<th>Nom</th>';
      $contenu.= '<th>Prénom</th>';
      $contenu.= '<th>Téléphone</th>';
      $contenu.= '<th>email</th>';
      $contenu.= '<th>Type contact</th>';    
      $contenu.= '<th>Photo</th>';  
      $contenu.= '<th>Voir</th>';
      $contenu.= '<th>Action</th>';
		    
    $contenu.= '</tr>';      
    
    while ($ligne_contact = $resultat->fetch(PDO::FETCH_ASSOC)) {  

        $contenu.= '<tr>';
			foreach ($ligne_contact as $indice => $info) { 

				if ($indice == 'photo') { 

				$contenu .= '<td><img class="img-fluid" style="width:80px" alt="" src="'. $info .'"></td>';
				}else { 
					$contenu .= '<td>'. $info .'</td>';
				} 			
			} 	
			
			$contenu .=  '<td>';
			
					$contenu .=  '<div><a href="detail_contact.php?id_contact='.$ligne_contact['id_contact'] .'"> Afficher détails </a></div>';
					
			$contenu .=  '</td>';

			$contenu .=  '<td>';
					$contenu .=  '<div><a href="?action=supprimer_contact&id_contact=' . $ligne_contact['id_contact'] . '" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce contact?\'));"> supprimer contact</a></div>';

          
          $contenu .=  '<div><a href="ajout_contact.php?action=modifier_contact&id_contact=' . $ligne_contact['id_contact'] .'"> modifier contact </a></div>';
				$contenu .=  '</td>';
      
        $contenu.= '</tr>';
    }

$contenu.= '</table>';



//----------------------------AFFICHAGE----------------------------
echo $contenu;


?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Ajouter un contact</title>

</head>

<body>
<hr>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>


</body>
</html>



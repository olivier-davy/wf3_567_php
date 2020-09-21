<?php

// Fonction debug()
function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//debug pour vérifier les paramêtres du formulaire
//debug($_POST); 

//---------------------TRAITEMENT PHP ----------------------
// Variables d'affichage 
$contenu = '';
$photo_bdd = '';

$pdo = new PDO('mysql:host=localhost;dbname=immobilier', 
                'root', 
                '', 
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
                )              
);

if (!empty($_POST)) { // si le formulaire a été envoyé     

    // titre
    if (!isset($_POST['titre']) || strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 50)  {
    
        $contenu .= '<div class="alert alert-danger">Le titre doit contenir entre 2 et 50 caractères</div>';
    }

     // adresse
    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 3 || strlen($_POST['adresse']) > 50)  {

        $contenu .= '<div class="alert alert-danger">L\'adresse doit contenir entre 2 et 50 caractères</div>';
    }  

      // cp
      if (!isset($_POST['cp']) || !preg_match("#^[0-9]{5}$#",$_POST['cp']))  {
        
        $contenu .= '<div class="alert alert-danger">Le code postal n\'est pas conforme</div>';
    } 

    // prix
      if (empty($_POST['prix'])) {

        $contenu .= '<div class="alert alert-danger">Le prix doit être saisi</div>';
    }

    // surface
    if (empty($_POST['surface'])) {

        $contenu .= '<div class="alert alert-danger">La surface doit être saisi</div>';
    }

    // photo
      
    
    // type d'annonce
    if (!isset($_POST['type']) || ($_POST['type'] != 'vente' && $_POST['type'] != 'location')) {
        $contenu .= '<div class="alert alert-danger">Le type de contact n\'est pas valide.</div>';
        }  

// ---------- inscription en BDD    
    
    if (empty($contenu)){ // si la variable est vide, c'est qu'il n'y a pas de message d'errreur 

        //debug($_FILES);

        if  (!empty($_FILES['photo']['name'])){ // si il y a un fichier en cours d'upload
            
            $photo_bdd='photos/'."logement".time();
            //$photo_bdd= 'photos/'. $_FILES['photo']['name']; 

            copy($_FILES['photo']['tmp_name'],$photo_bdd); 
        }  
        
        // Echappement des données du formulaire
        $_POST['titre'] = htmlspecialchars($_POST['titre'], ENT_QUOTES); 
        $_POST['adresse'] = htmlspecialchars($_POST['adresse'], ENT_QUOTES);
        $_POST['ville'] = htmlspecialchars($_POST['ville'], ENT_QUOTES);
        $_POST['cp'] = htmlspecialchars($_POST['cp'], ENT_QUOTES);
        $_POST['surface'] = htmlspecialchars($_POST['surface'], ENT_QUOTES);
        $_POST['prix'] = htmlspecialchars($_POST['prix'], ENT_QUOTES);
        $_POST['type'] = htmlspecialchars($_POST['type'], ENT_QUOTES);
        $_POST['description'] = htmlspecialchars($_POST['description'], ENT_QUOTES);
        
          
           
            $resultat = $pdo->prepare("INSERT INTO logement (titre, adresse, ville, cp, surface, prix,  photo, type, description) VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)"); 
            
            $succes = $resultat->execute(array( // on affecte les marqueurs aux valeurs
                     
                     ':titre'        => $_POST ['titre'],
                     ':adresse'      => $_POST ['adresse'],
                     ':ville'        => $_POST ['ville'],
                     ':cp'           => $_POST ['cp'], 
                     ':surface'      => $_POST ['surface'], 
                     ':prix'         => $_POST ['prix'], 
                     ':photo'        => $photo_bdd, 
                     ':type'         => $_POST ['type'],  
                     ':description'  => $_POST ['description']
                                
            ));
           
            if ($succes) { 
                $contenu .='<div class="alert alert-success">Le contact a été enregistré</div>';

            } else {
                $contenu .='<div class="alert alert-danger">Erreur lors de l\'enregistrement</div>';
            }
        }     // fin if empty $contenu
} // fin du if (!empty($_POST))

//--------------------------AFFICHAGE -------------------------

?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Ajouter une fiche</title>

</head>

<body>

<div class="col mt-4">

<h1>Ajouter une fiche :</h1> 

<?php
// Affichage $contenu dans le Body (W3C) . 
echo $contenu;
?>                           

<form action="" method="post" enctype="multipart/form-data"> <!-- enctype pour que le formulaire puisse envoyer les données du fichier uploadé -->
 
    <div><label for="titre"><strong>Titre :</strong></label></div>
    <div><input type="text" name="titre" id="titre" value="<?php echo $contact['titre']?? '';?>"></div>

    <div><label for="adresse">Adresse :</label></div>
    <div><input type="text" name="adresse" id="adresse" ></div>

    <div><label for="ville">Ville :</label></div>
    <div><input type="text" name="ville" id="ville"  value=""></div> 

    <div><label for="cp">Code Postal :</label></div>
    <div><input type="text" name="cp" id="cp" value=""></div>

    <div><label for="surface">Surface :</label></div>
    <div><input type="number" name="surface" id="surface" value=""></div>
    
    <div><label for="prix">Prix :</label></div>
    <div><input type="number" name="prix" id="prix" value=""></div>
    
    <div><label for="photo">Photo :</label></div>
    <input type="file" name="photo" id="photo"> 

    <div><label for="type">Type de fiche :</label></div>
    <div>
        <select name="type" id="type">
            <option value="vente">Vente</option>
            <option value="location">Location</option>            
        </select>
    </div>  
    
    <div><label for="description">Description :</label></div>
    <div><textarea name="description" id="description" cols="30" rows="7"></textarea></div>   
    
    <br><br>

    <div><input type="submit" value="Enregistrer" class="btn btn-primary"></div>
           

</form>

</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
<?php
/* 1- Créer une base de données "repertoire" avec une table "contact" :
	  id_contact PK AI INT
	  nom VARCHAR(50)
	  prenom VARCHAR(50)
	  telephone VARCHAR(10)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')
	  photo VARCHAR(255)

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. 
	   Le champ type_contact doit être géré via un "select option".
	   On doit pouvoir uploader une photo par le formulaire. 
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les infos du contact dans la BDD et afficher un message en cas de succès ou en cas d'échec.
	5- Si une photo est uploadée, ajouter la photo du contact en BDD et uploader le fichier sur le serveur de votre site.

*/
// Création de la fonction debug()
function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

// faire un debug pour vérifier les paramêtres du formulaire
debug($_POST); 


//---------------------TRAITEMENT PHP ----------------------
// Variable d'affichage 
$contenu = '';
$photo_bdd = '';

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 
                'root', 
                '', 
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
                )              
);

if (!empty($_POST)) { // si le formulaire a été envoyé     

    // --- Vérifications

    // nom
    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50)  {
    
        $contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 50 caractères</div>';
    }

     // prénom
    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 3 || strlen($_POST['nom']) > 50)  {

        $contenu .= '<div class="alert alert-danger">Le prénom doit contenir entre 2 et 50 caractères</div>';
    }  
    // telephone
    if (!isset($_POST['telephone']) /*Si le champ n'existe pas */|| !preg_match('#^[0-9]{10}$#',$_POST['telephone']) )  {

        $contenu .= '<div class="alert alert-danger">Le téléphone est incorrect</div>';
    } 
    // type de contact
    if (!isset($_POST['type_contact']) || ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre')) {
        $contenu .= '<div class="alert alert-danger">Le type de contact n\'est pas valide.</div>';
        }

    // email    
    if (!isset($_POST['email']) || !filter_var /*permet de valider l'email*/ ($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 255) { 
        $contenu .= '<div class="alert alert-danger">L\'email n\'est pas valide.</div>';

        }

// ---------- inscription en BDD    
    
    if (empty($contenu)){ // si la variable est vide, c'est qu'il n'y a pas de message d'errreur 
        // Traitement photo
        // Je traite la photo uniquement s'il n'y a pas d'erreur sur le formulaire :
        debug($_FILES); // La variable superglobale $_FILES est un tableau associatif des valeurs téléchargées au script courant via le protocole HTTP et la méthode POST.

        if  (!empty($_FILES['photo']['name'])){ // si il y a un fichier en cours d'upload
            $photo_bdd= 'photos/'. $_FILES['photo']['name']; // chemin + nom du fichier de la photo que l'on met en BDD. NE pas oublier de créer le dossier "photos".

            copy($_FILES['photo']['tmp_name'],$photo_bdd); //copie la photo qui est temporairement dans $_FILES['photo']['tmp_name'] vers l'emplacment défini par $photo_bdd 
        }  
        
        // Echappement des données du formulaire
        $_POST['nom'] = htmlspecialchars($_POST['nom'], ENT_QUOTES); // transforme les chevrons en entités HTML pour éviter les risques XSS et CSS. ENT_QUOTES pour ajouter les guillements à transformer en entités HTML     
        $_POST['prenom'] = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
        $_POST['telephone'] = htmlspecialchars($_POST['telephone'], ENT_QUOTES);
        $_POST['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
        $_POST['type_contact'] = htmlspecialchars($_POST['type_contact'], ENT_QUOTES);
        
        // ou alors avec une foreach

        //foreach ($_POST as $indice => $valeur){
        //    $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
        //}      
           
            $resultat = $pdo->prepare("REPLACE INTO contact (nom, prenom, telephone, email, type_contact, photo) VALUES (:nom, :prenom, :telephone, :email, :type_contact, :photo)"); 
            
            $succes = $resultat->execute(array( // on affecte les marqueurs aux valeurs
                     
                     ':nom'          => $_POST ['nom'],
                     ':prenom'       => $_POST ['prenom'],
                     ':email'        => $_POST ['email'],
                     ':telephone'    => $_POST ['telephone'],                     
                     ':type_contact' => $_POST ['type_contact'],  
                     ':photo'        => $photo_bdd // attention l photo ne provient pas de $_POST mais de $_FILES que l'on traite à part de $_POST ci-dessus.             
            ));
           
            if ($succes) { // si la variable contient true (retourné par la méthode execute()) c'est que la requête a marché
                $contenu .='<div class="alert alert-success">Le contact a été enregistré</div>';

            } else {
                $contenu .='<div class="alert alert-danger">Erreur lors de l\'enregistrement</div>';
            }
    } // fin if empty $contenu
} // fin du if (!empty($_POST))

// --- Modification contact
if (isset($_GET['id_contact']) && $_GET['action']=='modifier_contact') {
    $resultat_modif = $pdo->prepare("SELECT * FROM contact WHERE id_contact=:id_contact", array(':id_contact' => $_GET['id_contact']));
    $resultat_modif->execute(array(':id_contact' => $_GET['id_contact']));
    $contact = $resultat_modif->fetch(PDO::FETCH_ASSOC);

}

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

    <title>Ajouter ou modifier un contact</title>

</head>

<body>

<div class="col mt-4">

<h1>Ajouter ou modifier un contact :</h1> 

<?php
// Affichage $contenu dans le Body (W3C) . 
echo $contenu;
?>                           

<form action="" method="post" enctype="multipart/form-data"> <!-- enctype pour que le formulaire puisse envoyer les données du fichier uploadé -->
 
    <input type="hidden" name="id_contact" value="<?php echo $contact['id_contact']?? 0;?>">

    <div><label for="nom">Nom :</label></div>
    <div><input type="text" name="nom" id="nom" ></div>

    <div><label for="prenom">Prenom :</label></div>
    <div><input type="text" name="prenom" id="prenom" value="<?php echo $contact['prenom']?? '';?>"></div>

    <div><label for="telephone">Téléphone :</label></div>
    <div><input type="text" name="telephone" id="telephone"  value="<?php echo $contact['telephone'] ?? ''; ?>"></div> <!--pattern="^0[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" -->

    <div><label for="email">email :</label></div>
    <div><input type="text" name="email" id="email" value="<?php echo $contact['email']?? '';?>"></div>

    <div><label for="type_contact">Type de contact :</label></div>
    <div>
        <select name="type_contact" id="type_contact">
            <option value="ami"<?php if (isset($contact['type_contact']) && $contact['type_contact']=='ami') echo 'selected';?>>Amis</option>
            <option value="famille"<?php if (isset($contact['type_contact']) && $contact['type_contact']=='famille') echo 'selected';?>>Famille</option>
            <option value="professionnel"<?php if (isset($contact['type_contact']) && $contact['type_contact']=='professionnel') echo 'selected';?>>Professionnel</option>
            <option value="autre"<?php if (isset($contact['type_contact']) && $contact['type_contact']=='autre') echo 'selected';?>>Autre</option>
        </select>
    </div>

    <div><label for="photo">Photo :</label></div>
    <input type="file" name="photo" id="photo"> 
   
    
    <br><br>

    <?php
    if(isset($contact['photo'])){// si nous sommes en train de modifier le produit, nous affichons la photo actuellement en BDD
        echo '<p>Photo actuelle du contact</p>';
        echo '<img src="'.$contact['photo'].'" style="width:90px">';
        echo '<input type="hidden" name="photo_actuelle" value="'. $contact['photo'].'">';
    }
    ?>

    <div><input type="submit" value="Enregistrer" class="btn btn-primary"></div>    
    <br>
    <a href="liste_contact.php" target="_blank"> <input type="button" value="liste contacts" class="btn btn-secondary"></a>
    

</form>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>
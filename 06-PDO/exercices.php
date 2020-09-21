<h1> Les commerciaux et leurs salaires</h1>

<?php
// Exercice :
// 1- affichez dans une liste <ul><li> le prenom, le nom et le salaire des commerciaux (1 commercial par <li>). Pour cela, vous faites une requête préparée.
// 2- Affichez le nombre de commerciaux.


//-----correction

// 1- Connection à la BDD

$pdo = new PDO('mysql:host=localhost;dbname=entreprise',  
                'root', 
                '', 
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
                    )                  
                  
);

// 2- Requête

$service = 'Commercial';

$resultat = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service" );

$resultat->bindParam(':service', $service);

$resultat->execute();

$service = $resultat->fetchAll(PDO::FETCH_ASSOC);

// correction alternative

/*echo '<ul>';
while($employe = $resultat->fetch(PDO::FETCH_ASSOC);
    echo '<li>' . $employe['prenom'] . ' ' . $employe['nom']  . ' ' . $employe['salaire'] .'€</li>';
}

echo '</ul><hr>';*/

echo '<ul>';

foreach ($service as $indice => $employe) {
    
echo '<li>' . $employe['prenom'] . ' ' . $employe['nom']  . ' ' . $employe['salaire'] .'€</li>';
}

echo '</ul><hr>';



echo "Nombre de commerciaux : " . $resultat->rowCount() . '<br>';



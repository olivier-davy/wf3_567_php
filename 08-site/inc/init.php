<?php
/* Le fichier init.php sera inclus dans tous les scripts (hors inclusions) pour initialiser :
- la connexion à la BDD
- la création ou l'ouverture de la session
- la définition du chemin du site sur le serveur
- l'inclusion du fichier functions.php
*/

// init contient les éléments fondamentaux au fonctionnement du site

// Connexion à la BDD

$pdo = new PDO('mysql:host=localhost;dbname=site_commerce', // driver mysql, serveur de la BDD (host), nom de la BDD (dbname) à changer
                'root', 
                '', 
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // si erreur, afficher une syntaxe d'erreur compréhensible.
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'                     
                )              
);

// Création ou ouverture de session
session_start();

// Chemin du site
define('RACINE_SITE', '/PHP/08-site/'); // on indique ici les dossiers dans lesquels se situe le site à partir de "localhost". Cela permet de créer des chemins absolus à partir de "localhost" (caractérisés par le / au début). Ils sont utilisés notamment dans header.php qui peut-être inclus dans des fichiers appartenant à des dossiers ou des sous dossiers différents :  par conséquent les chemins relatifs vers les sources changeraient, alors que les chemins absolus sont les mêmes.

// Variable d'affichage
$contenu = '';

// Inclusion des fonctions
require_once 'functions.php'; // inclusion une seule fois du fichier spécifié.



<style>
    h2 {
        border-top: 1px solid navy;
        border-bottom: 4px solid navy;
        color: navy;
    }

   td {
        border: 1px solid black;
        padding: 5px;
    }

    table {
        border-collapse: collapse;
    }
</style>

<?php 

//--------------------------------
echo '<h2> Les balises PHP </h2>';
//--------------------------------

?>

<?php
// pour ouvrir un passage en PHP on utilise la balise précédente (ligne 18)
// pour fermer un passage en PHP on utilise la balise : ?>

<p>Ici je suis en HTML<p>
<!-- en dehors de balises d'ouverture et de fermeture de PHP, nous pouvons écrire du HTML quand on est dans un fichier ayant l'extension PHP   -->

<?php
// On est pas obligé de fermer un passage PHP en FIN de script.

// pour faire 1 ligne de commentaires
#  pour faire 1 ligne de commentaires

/*
   pour faire x lignes de 
   commentaires
*/

//---------------------------
echo '<h2> Affichage </h2>';
//---------------------------

echo 'Bonjour <br>'; // echo permet d'effectuer un affichage dans le navigateur. Nous pouvons y mettre des balises HTML sous forme de string (chaine de caractères). Notez que toutes les instructions se terminent par un ";".

print 'Nous sommes ici <br>'; // autre insruction d'affichage danbs le navigateur.

// Autres instructions d'affichage que nous verrons plus loin :
print_r('code');
echo '<br>';
var_dump('code');

//---------------------------
echo '<h2> Variables </h2>';
//---------------------------

// Une variable est un espace mémoire qui porte un nom et qui permet de conserver une valeur.
// En PHP, on représente une variable avec le signe $.

$a = 127; // on déclare la variable a et lui affecte la valeur 127.
echo gettype($a); // gettype() est une fonction prédéfinie qui permet de voir le type d'une variable. Ici il s'agit d'un INTEGER (entier).
echo '<br>';

$a = 1.5;
echo gettype($a); // ici nous avons un double = FLOAT (nombre à virgule)
echo '<br>';

$a = 'une chaine de caractères';
echo gettype($a); // ici nous avons un STRING
echo '<br>';

$a = '127'; // un nombre écrit dans des quotes ou des "" est interprété comme un STRING.

$a = true; // ou false
echo gettype($a); // ici nous avons un BOOLEAN
echo '<br>';

// Par convention, un nom de variable comence par une minuscule puis on met une majuscule à chaque mot (camelCase). Il peut contenir des chiffres (jamais au début) ou un "_" (pas au début ni à la fin). Exemple : $maVariable1 ou $ma_variable1

//--------------------------------------
echo '<h2> Guillements et quotes </h2>';
//--------------------------------------

$message = "aujourd'hui"; // ou bien :
$message = 'aujourd\'hui'; // on échappe l'appostrophe dans les quotes simples

$prenom = 'John';
echo "Bonjour $prenom <br>"; // quand on écrit une variable dans des guillemets, elle est évaluée : c'est son contenu qui est affiché. Ici "John".
echo 'Bonjour $prenom <br>'; // dans des quotes simples, tout est du texte brut : c'est le nom de la variable qui est affichée.


//------------------------------
echo '<h2> Concaténation </h2>';
//------------------------------

// En PHP on concatène les éléments avec le "."

$x = 'Bonjour';
$y = ' tout le monde';
echo $x . $y . '<br>'; // Concaténation de variables et d'un string. On peut traduire le point de concaténation par "suivi de ..."

//--------
// Concaténation lors de l'affectation avec l'opérateur .=
$message = '<p>Erreur sur le champ email</p>';
$message .= '<p>Erreur sur le champ téléphone</p>'; // avec l'opérateur combiné .= on ajoute la nouvelle valeur SANS remplacer la valeur précédente dans la variable $message.


echo $message; // on affiche donc les 2 messages.

//--------------------------
echo '<h2> Constante </h2>';
//--------------------------

// Une constante permet de conserver une valeur sauf que celle-ci ne peut pas changer. C'est à dire qu'on ne pourra pas la modifier durant l'exécution du scrit. Utile pour conserver par exemple les paramêtres de connexion à la BDD.

define('CAPITALE_FRANCE', 'Paris'); // définit la constante appelée CAPITAL_FRANCE à laquelle on donne la valeur Paris. Par convention, le nom des constantes est toujours en majuscules.

echo CAPITALE_FRANCE . '<br>'; // affiche Paris

// Autre façon de déclarer une constante :
CONST TAUX_CONVERSION = 6.55957; // définit la contante TAUX_CONVERSION
echo TAUX_CONVERSION . '<br>'; // affiche 6.55957

// Quelques constantes magiques :
echo __DIR__ . '<br>'; // contient le chemin complet vers notre dossier
echo __FILE__ . '<br>'; // contient le chemin complet vers notre fichier

// ------------------------------------
// Exercice : afficher Bleu-Blanc-Rouge en mettant le texte de chaque couleur dans une variable.

$bleu = 'Bleu';
$blanc = 'Blanc';
$rouge = 'Rouge';

echo $bleu .'-'. $blanc .'-'. $rouge. '<br>';
echo "$bleu-$blanc-$rouge";

//---------------------------------------------
echo '<h2> Les opérateurs arithmétiques </h2>';
//---------------------------------------------

$a = 10;
$b = 2;

echo $a + $b . '<br>'; // affiche 12
echo $a - $b . '<br>'; // affiche 8
echo $a * $b . '<br>'; // affiche 20
echo $a / $b . '<br>'; // affiche 5
echo $a % $b . '<br>'; // affiche 0 modulo = reste de la division entière. Exemple : 3%2 = 1 car si on a 3 billes on les répartit sur 2 joueurs, il nous en reste 1.

//----------------------------------------
// Les opérateurs arithmétiques combinés :

$a += $b; // équivaut à $a = $a + $b. soit $a = 10 + 2. $a vaut donc à la fin 12.
echo $a .  '<br>';

$a -= $b; // équivaut à $a = $a - $b, soit $a = 12 - 2. $a vaut donc à la fin 10
$a *= $b; // équivaut à $a = $a * $b, soit $a = 10 * 2. $a vaut donc à la fin 20
$a /= $b; // équivaut à $a = $a / $b, soit $a = 20 / 2. $a vaut donc à la fin 10
$a %= $b; // équivaut à $a = $a % $b, soit $a = 10 / 2. $a vaut donc à la fin 0

// On utilisera le += et le -= dans les paniers d'achat.

//-----------------------------
// Incrémenter et décrémenter :

$i = 0;

$i++; // incrémentation de $i par "pas" de 1 : $i vaut donc à la fin 1
$i--; // décrémentation de $i par "pas" de 1 : $i vaut donc à la fin 0

//--------------------------------------------
echo '<h2> Structures conditionnelles </h2>';
//--------------------------------------------
$a = 10;
$b = 5;
$c = 2;

// if ... else :
if ($a > $b) { // si la condition est vraie, c'est-à-dire que $a est bien supérieur $b, alors on entre dans les accolades qui suivent
    echo '$a est supérieur à $b <br>';
} else { // sinon, on exécute le else
    echo 'Non, c\'est $b qui est supérieur ou égal à $a <br>';
}


// L'opérateur AND qui s'écrit && :
if ($a > $b && $b > $c) {  // si $a est supérieur $b et dans le même temps $b est supérieur à $c, alors on entre dans les les accolades
    echo 'Vrai pour les 2 conditions <br>';
}

// TRUE && TRUE   => TRUE
// FALSE && FALSE => FALSE
// TRUE && FALSE  => FALSE

// L'opérateur OR qui s'écrit || :
if ($a == 9 || $b > $c){ // si $a est égal (==) à 9 ou alors $b > $c, dans ce cas on entre dans les accolades qui suivent.
    echo 'vrai pour au moins une des 2 conditions <br>';
} else {
    echo 'Les 2 conditions sont fausses';
}      

// TRUE || TRUE => TRUE
// FALSE || FALSE => FALSE
// TRUE || FALSE => TRUE

//-----------------------
// if ... elseif ... else

$a = 10;
$b = 5;
$c = 2;

if ($a == 8) { // si $a est égal à 8 on entre dans les accolades qui suivent
    echo 'reponse 1 : $a est égal à 8';
} elseif ($a != 10) { // sinon si $a est différent de 10 on entre ds les accolades qui suivent
    echo 'reponse 2 : $a est différent de 10';
} else { // si je n'entre pas dans le if ni dans le elseif, alors j'arrive dans le else
    echo 'reponse 3 : $a est égal à 10 <br>';
}

// Note : les ELSE ne sont pas obligatoires (on ne le met pas quand on n'en a pas beoin). ELSE n'est jamais suivi d'une condition.


//--------------------------------
// l'opérateur XOR pour exclusif :
    $question1 = 'mineur';
    $question2 = 'je vote'; // exemple d'un questionnaire

// les réponses de l'internaute n'étant pas cohérentes, on lui met un message :

if ($question1 == 'mineur' XOR $question2 == 'je vote') { // XOR = ou exclusif. Seulement une des 2 conditions doit être valide pour entrer dans le if. 
    echo 'Vos réponses sont cohérentes <br>';
} else {
    echo 'Vos réponses NE sont PAS cohérentes <br>';
}

// TRUE XOR TRUE => FALSE  
// FALSE XOR FALSE => FALSE
// TRUE XOR FALSE => TRUE

//---- Forme dite ternaire de la condition (autre syntaxe du if):
$a = 10;

echo ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>'; // le "?" remplace if, et le ":" remplace else. On affiche le premier string si la condition est vraie, sinon le second.

//-----------------------
// Comparaison == ou == :

$varA = 1; // integer
$varB = '1'; // string

if ($varA == $varB) { // avec le == on compare uniquement la valeur
    echo '$varA est = à $varB en valeur <br>';
}

if ($varA === $varB) { // avec le === on compare la valeur et le type
    echo '$varA est = à $varB en valeur et en type <br>';
} else {
    echo '$varA est != à $varB en valeur ou en type <br>';                       
}

// Rappel : le simple = est le signe d'affectation.


//---------------------
// isset() et empty() :
// empty() : vérifie si la variable est vide, cad 0, '', NULL, FALSE, non définie
// isset() : vérifie si la variable existe et a une variable non NULL.

$var1 = 0;
$var2 = '';

if (empty($var1)) echo '$var1 contient 0, string vide, NULL, FLASE ou n\'est pas définie <br>';
// VRAI car la variable contient 0

if (isset($var2)) echo 'La variable existe et est non NULL <br>'; 
// VRAI car la variable existe bien et ne contient pas NULL

// Contexte : empty pour vérifier les champs de formulaire, isset pour vérifier l'existence d'un indice dans un tableau avant d'y accéder.

//----------------------------------
// L'opérateur NOT qui s'écrit "!" :
$var3 = 'quelque chose';
if (!empty($var3)){ // on entre dans la condition QUE si elle est VRAI. Le ! correspond à une négation : il intervertit le sens du booléen : !true devient false et !false devient true. Ici cela signifie "$var3 n'est pas vide".
    echo 'La variable n\'est pas vide <br>';
}

//----------------------------------------
// L'opérateur ?? appelé "NULL Coalescent":

echo $variable_inconnue ?? 'valeur par défaut <br>';

//-----------------------
echo '<h2> Switch </h2>';
//------------------------
// La condition switch est une autre syntaxe pour écrire un if, elseif, else quand on veut comparer une variable à une multitude de valeurs.

$langue = 'Finnois';

switch ($langue) {
    case 'français': // on compare $langue à la valeur des "case" et exécute le code qui suit si elle correspond :
        echo 'Bonjour ! <br>';
    break;  // obligatoire pour quitter le switch une fois un "case exécuté  
    case 'italien':
        echo 'Buongiorno ! <br>';
    break;  
    case 'espagnol':
        echo 'holla ! <br>';
    break;    
    default : // cas par défaut qui est exécuté si on entre pas dans l'un des "case"
        echo 'hello ! <br>';
    break;
}

// seules les instructions prennent des ";" à a fin mais pas les structures.

// Exercice : Réécrire le switch sous forme de condition if pour obtenir exactement le même résultat.

$langue = 'chinois';

if ($langue == 'français') {
    echo 'Bonjour !';
} elseif ($langue == 'italien') {
    echo 'Buongiorno !';
} elseif ($langue == 'espagnol') {
    echo 'hola !';
} else {
    echo 'hello !';
}

//--------------------------------------
echo '<h2> Fonction utilisateurs </h2>';
//--------------------------------------

//DRY : Do not Repeat Yourself

// Une fonction est un morceau de code encapsulé dans des accolades qui porte un nom. On appelle cette fonction au besoin pour exécuter le code qui s'y trouve. Le fait de définir des fonctions pour ne pas se répéter s'appelle "factoriser" son code.

// On défini puis on exécute une fonction :

function separation (){ // déclaration d'une fonction prévue pour ne pas recevoir d'arguments
    echo '<hr>';
}

separation (); // on appelle notre fonction par son nom suivi de ()

//------------------------------------
// Fonction avec paramêtres et return :

function bonjour ($prenom, $nom/*parametres*/){ /*paramêtres de la fonction. Ils permettent de recevoir une valeur car il s'agit de variables de réception.*/
    return 'Bonjour ' . $prenom . ' ' . $nom .' ! <br>'; // return renvoie la chaîne de caractère "Bonjour..." à l'endroit où la fonction est appelée.

    echo 'Cette ligne ne sera pas exécutée'; // car, après un return on quitte la fonction
}

echo bonjour ('John', 'Doe'/*arguments*/);// si la fonction attend des valeurs, il faut les lui envoyer dans le même ordre que les paramêtres de réception. Les valeurs envoyées s'appellent "arguments". Quand on souhaite afficher le résultats et qu'il n'y a pas echo dans la fonction, il faut le faire en même temps que l'appel de la fonction.

//------
$prenom = 'Pierre';
$nom = 'Quiroule';
echo bonjour($prenom, $nom); // on peut mettre des variables à la place des valeurs dans l'appel d'une fonction (exemple : quand on voudra récupérer les valeurs d'un formulaire.)

//-----------
// Exercice :
// - Ecrivez la fonction factureEssence() qui calcule le coût total de votre facture en fonction du nombre de litre d'essence que vous indiquez lors de l'appel de la fonction. Cette fonction (return) retourne la phrase "Votre facture est de x euros pour y litres d'essence." où x et y sont des variables. Pour cela, on vous donne une fonction prixLitre() qui vous retourne le prix du litre d'essence. Vous l'utilisez donc pour calculer le total de la facture.

function prixLitre(){
    return rand(100, 200)/100;
}

// Correction :
function factureEssence($litre){
    $total = $litre * prixLitre();
    return 'Votre facture est de ' . $total . ' euros pour' . ' ' . $litre . ' ' . 'litres d\'essence' . '<br>';
}

$litre = 50;

echo factureEssence($litre, /*prixLitre()*/);

//---------------------------------------------------------------------------
// EN PHP7 on peut préciser le type des valeurs entrantes dans une fonction :
function identite(string $nom, int $age) { // array, bool, float, int, string
    echo gettype($nom) . '<br>'; // string
    echo gettype($age) . '<br>'; // integer
    echo $nom . ' a ' . $age . 'ans <br>';
}

identite('Asterix', 60); // le type attendu dans la fonction est respecté, il n'y a pas d'erreur.

identite('Asterix', '60'); // ici il n'y a pas d'erreur, cependant  le string '60' a été casté en integer (Note : Si nous étions en mode de codage "stricte", il y aurait une erreur.)

//declare (strict_types=1); // pour déclarer un mode "stricte"

// identite('Asterix', 'soixante'); tatal error car on passe un string qui ne peut être transformé en integer. On commente don cla ligne pour poursuivre.

// PHP7 on peut aussi préciser la valeur de retour que dois sortir la fonction:

function adulte(int $age) : bool {/*le type de ce qui sort*/ // array

    if ($age >= 18) {
        return true;
    }else{
        return false;
    }
}

var_dump(adulte(10)); // equivalent de consol.log. La fonction nous retourne bien un booléen, il n'y a donc pas d'erreur. Nous faisons un var_dump car il permet d'afficher le false que retourne la fonction, 'echo false" n'affichant rien.
  

//------------------------------------
// Variable locale et variable globale

// De l'espace local vers l'espace global :

function jourSemaine(){
    $jour = 'vendredi'; // variable locale
    return $jour;
}

// echo $jour; // ne fonctionne pas car cette variable n'est connue qu'à l'intérieur de la fonction
echo '<br>' . jourSemaine(); // on affiche ce que retourne la fonction grâce à son return

// De l'espace globale vers l'espace local :

$pays = 'France'; // variable globale

function affichePays(){
    global $pays; // le mot clé global permet de récupérer une variable globale au sein de l'espace local de la fonction. On peut donc l'afficher :
    echo '<br>' . $pays;
}

affichePays();

//--------------------------------------------------------
echo '<h2> Les structures itératives : les boucles </h2>';
//--------------------------------------------------------
// Les boucles sont destinées à répéter des lignes de code de façon automatique.


// Boucle while :
$i = 0;  // on initialise une variable qui sert de compteur

while ($i < 3){ // tant que $i est inférieur à 3 nous entrons dans la boucle
    echo $i . '<br>';
    $i++; // on incrémente $i de 1 à chaque tour de boucle. Afin de ne pas avoir une boucle infinie  : à 3, la condition étant fausse, on quitte la boucle).
}
/*********************/
//point de départ, condition d'entrée (si la condition est sophistiquée, on utilise plutôt while que for), variation de la variable

// Exercice : à l'aide d'une boucle while, afficher un sélecteur avec les années depuis 1920 à 2020.
// rappel :
echo '<select>';
    echo '<option>valeur1</option>';
    echo '<option>valeur2</option>';
    echo '<option>valeur...</option>';

echo '</select>';

// correction

$annee = 1970;  
echo '<select>';

while ($annee <= date('Y')){ // la fonction DATE retourne la date d'aujourd'hui
    echo "<option>$annee</option>";
    $annee++; }
        
echo '</select>' . '<br>';

//---------------------
// La boucle do while :
// La boucle do while a la particularité de s'exécuter au moins 1 fois, puis tant que la condition de fin est vraie.

$j = 0;

do {
    
    $j++;
    echo "je fais 1 tour <br>";

} while ($j > 10); // la condition est false et pourtant la boucle a tourné 1 fois.

echo '<br>';

//----------------
// La boucle for :
// La boucle for est une autre syntaxe de la boucle while.

for ($i = 0; $i < 3; $i++) { // nous trouvons dans les () de for : la valeur de départ; la condition d'entrée dans la boucle; la variation de $i
    echo $i . '<br>';
}

echo '<br>';

for ($i = 10; $i > 0; $i--) { 
    echo $i . '<br>';

}

echo '<br>';

// Exercice : afficher les mois de 1 à 12 dans un selecteur à l'aide d'une boucle for.

echo '<select>';

for ($mois = 1; $mois <= 12; $mois++) { 
    echo "<option>$mois</option>";
}
       
echo '</select>' . '<br>';

echo '<br>';

//----------------------------------
// Il existe aussi la boucle foreach que nous verrons un peu plus loin. Elle sert à parcourir les tableaux ou les objets.


//----------------------------
// Exercice : faire une boucle for qui affiche les chiffres 0 à 9 dans une table HTML sur une seule ligne. Vous faites du CSS dans la balise <style> pour mettre une bordure sur ce tableau.


echo '<table>';

    echo '<tr>';      

        for ($chiffre = 1; $chiffre <= 9; $chiffre++) { 
            echo '<td>' . $chiffre . '</td>';
        }

    echo '</tr>';

echo '</table>';

echo '<br>';

// Exercice : faires une boucle qui affiche les chiffres 0 à 9 sur la même ligne. Cette ligne se répète 10 fois, le tout dans une page HTML.


// correction: principe de la boucle imbriquée. Une boucle dans une autre boucle.
echo '<table>';

    for ($ligne = 1; $ligne <= 10; $ligne++) { 
        echo '<tr>';         

        for ($colonne = 0; $colonne <= 9; $colonne++) { // 10 tours de colonne pour 1 tour de ligne
            echo '<td>' . $colonne . '</td>';
        }
        echo '</tr>';

    }

echo '</table>';

//-----------------------------------------------
echo '<h2> Quelques fonctions prédéfinies </h2>';
//-----------------------------------------------
// Une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le langage PHP.

// strlen
$phrase = 'mettez une phrase ici';
echo strlen($phrase) . '<br>'; // affiche le nombre d'octet occupés par ce string.
// 1 caractère correspond à 1 octet. 1 caractère accentué correspond à 2 octets

// substr
$texte = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci ad aspernatur soluta cupiditate ipsam id suscipit mollitia blanditiis iusto corrupti earum voluptas delectus, architecto similique deleniti fugiat corporis non exercitationem!';

echo substr($texte, 0, 20) . '.............<a href="">lire la suite</a>'. '<br>'; // coupe le texte de la position 0 et sur 20 caractères.

// strtolower, strtoupper, trim :
$message = '              Hello WorLd !                ';
echo strtolower($message) . '<br>'; // affiche tout en minuscule
echo strtoupper($message) . '<br>'; // affiche tout en majuscule

echo strlen($message) . '<br>'; // on compte la longueur y compris les espaces
echo strlen(trim($message)) . '<br>'; // trim() supprime les espaces au début et à la fin de la chaine de caractères. Ici, on compte le résultat sans les espaces.


// La documentation PHP en ligne

// https://www.php.net/

//---------------------------------
echo '<h2> Tableau (arrays) </h2>';
//---------------------------------
// Un tableau() ou encore array en anglais) est déclaré comme une variable améliorée dans laquelle on stocke une multitude de valeurs. Ces valeurs peuvent être de n'importe quel type et possèder un indice par défaut dont la numérotation commence à 0. 

// Utilisation : Souvent, quand on récupère des informations de la BDD, on les retrouve sous forme de tableau. 

// Déclarer un tableau (méthode 1) :

$liste = array('Grégoire', 'Nadège', 'Emilie', 'François', 'Georges');

echo gettype($liste) . '<br>';

echo $liste; // "Notice: Array to string conversion in C:\xampp\htdocs\PHP\01-bases\bases.php on line 600". On ne peut pas afficher directement un tableau en PHP au contraire du JS.

 echo 'var_dump et print_r :';
 
echo '<pre>';
    var_dump($liste); // Affiche le contenu du tableau avec le type des valeurs
echo '</pre>';

echo '<pre>';
    print_r($liste); // Affiche le contenu du tableau sans le type des valeurs
echo '</pre>'; // la balise <pre> permet de formater l'affichage du print_r ou du var_dump

// Délaration de notre fonction d'affichage :

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

debug($liste);

// Autre méthode pour déclarer un tableau (méthode 2):

$tab = ['France', 'Italie', 'Espagne', 'Portugal'];

debug($tab);

echo $tab[1] . '<br>'; // pour afficher "Italie", on écrit le nom du tableau $tab suivi de l'indice de "Italie" écrit entre []

// -------------------------------------------------
// Ajouter une valeur à la fin de notre tablau $tab :
$tab[]= 'Suisse'; // les [] vides permettent d'ajouter une valeur à la fin du tableau
debug ($tab); 


//--------------------------------------------------
// Tableau associatif :
// Dans un tableau associatif, on peut choisir les indices.
$couleur = array(
    'j' => 'jaune',
    'b' => 'bleu',
    'v' => 'vert',

);

// pour afficher un élément du tableau associatif :
echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>'; // affiche "bleu"  

echo "La seconde couleur de notre tableau est le $couleur[b] <br>"; // un tableau associatif écrit dans des guillemets perd les quotes autour de son indice.

//---------------------------------------------------
// Mesurer le nombre d'éléments dans un tableau :

echo 'Taille du tableau : ' . count($couleur) .'<br>'; //  compte le nombre d'éléments dans le tableau, ici 3.

echo 'Taille du tableau : ' . sizeof($couleur) .'<br>'; // sizeof() fait la même chose que count() dont il est un alias 

//-------------------------------
echo '<h2> Boucle foreach </h2>';
//-------------------------------
// foreach est un moyen simple de parcourir un tableau de façon automatique. Cette boucle fonctionne uniquement sur les tableaux et les objets. Elle retourne une erreur si vous l'utilisez sur une variable d'un autre type ou non initialisée.

debug($tab);

foreach ($tab as $pays) { // la variable $pays vient parcourir la colonne des valeurs : elle prend chaque valeur successivement à chaque tour de boucle. Le mot "as" est obligatoire et fait partie de la syntaxe.
    echo $pays . '<br>'; // affiche successivement les valeurs du tableau
}

foreach ($tab as $indice => $pays){ // quand il y a 2 variables, celle qui est à gauche de la => parcours la colonne des indices et celle de droite parcours la colonne des valeurs
    echo $indice . ' correspond à ' . $pays . '<br>';
}

//-----------------------------------
// Exercice :
// - Ecrivez un tableau associatif avec les indices prenom, nom, email et telephone auquels vous associez des valeurs pour 1 contact.
// - Puis avec une boucle foreach, afficher les valeurs dans des <p>, sauf le prénom qui doit être dans un <h3>.


$exercice = array(
    'prenom' => 'Patrick',
    'nom' => 'Chirac',
    'email' => 'patrick.chirac@gmail.com',
    'telephone' => '07 77 77 77 77'
);

debug ($exercice);

foreach ($exercice as $indice => $contact){ 

    if ($indice == 'prenom'){
        echo '<h3>' . $contact . '</h3>';
    } else {
    echo '<p>' . $contact . '</p>';   
    }
}

//------------------------------------------
echo '<h2> Tableau multidimensionnel </h2>';
//------------------------------------------
// Nous parlons de tableaux multidimensionnels quand un tableau est contenu dans un autre tableau. CHaque tableau représente une dimension.

//  Déclaration d'un tableau multidimensionnel :
$tab_multi = array(
    array(
        'prenom' => 'Julien',
        'nom' => 'Dupont',
        'telephone' => '01 42 45 78 63'
    ),
    array(
        'prenom' => 'Nicolas',
        'nom' => 'Durand',
        'telephone' => '01 54 45 78 99'
    ),
    array(
        'prenom' => 'Pierre',
        'nom' => 'Dulac',
    ),


); // il est possible de choisir le nom des indices dans un tablau multidimensionnel.

debug($tab_multi);

// Afficher la valeur "Julien" 

echo $tab_multi[0]['prenom'] . '<br>'. '<br>'; // pour afficher "Julien" nous entrons d'abord dans le tableau  $tab_multi, puis nous allons à son indice [0], dans lequel nous allons à l'indice ['prénom'] (les crochets sont successifs).

// Parcourir le tableau multidimensionnel avec une boucle for :
    for ($i = 0; $i < sizeof($tab_multi); $i++){ // tant que $i est inférieur au nombre d'éléments du tableau $tab_multi (ici .), on entre dans la boucle  
        echo $tab_multi[$i]['prenom'] . '<br>'; // on passe succesivement par 0, 1 et 2 pour afficher les 3 prénoms
    }

    echo '<hr>';

// --------------------------------------------------------
// Exercice : afficher les 3 prénoms avec une boucle foreach

    foreach ($tab_multi as $contact){ 
        //debug($contact); // on voit que $contact est un array qui contient l'indice "prenom". On accède donc aux prénoms en mettant cet indice dans des [] : 

        echo $contact['prenom'] . '<br>';
        //foreach ($liste_contact as $indice => $contact)
        //echo $contact . '<br>';
       
    }
    echo '<hr>';

    // Autre version :

    foreach ($tab_multi as $indice => $contact){
      
        echo $tab_multi[$indice]['prenom'] . '<br>';
    }    

    echo '<hr>';
//----------------------------
// Exercice (option) : Vous déclarer un tableau contenant les tailles S, M, L et XL.Puis vous les affichez dans un menue déroulant (select/option) à l'aide d'une boucle foreach.

$vetements = ['taille S', 'taille M', 'taille L', 'taille XL'];

echo '<select>';

    foreach ($vetements as $tailles){   
        echo "<option>$tailles</option>";     
    }
       
echo '</select>' . '<br>';

//---------------------------------------
echo '<h2> Inclusions de fichiers </h2>';
//---------------------------------------

echo 'premiere inclusion :';
include 'exemple.inc.php'; // le fichier est inclus, c'est à dire que son code s'exécute ici. En cas d'erreur lors de l'excution, include génère une erreur de type "warning" et continue l'exécution du script.

echo '<br> Seconde inclusion :';
include_once 'exemple.inc.php'; // le "once" est là pour vérifier si le fichier a déjà été inclus, auquel car, il ne le ré-inclut pas.

echo '<br> Troisième inclusion :'; 
require 'exemple.inc.php'; // le fichier est "requis", donc obligatoire : en cas d'erreur lors de l'inclusion, require génère une erreur de type 'fatal error" qui stoppe l'exécution du code.

echo '<br> Quatrième inclusion :'; 
require_once 'exemple.inc.php';

echo  '<br>' . $inclusion; // comme le fichier exemple.inc.php est inclus, on accède aux éléments qui sont déclarés à l'intérieur de celui-ci, comme les variables, les fonctions. 

// La mention 'inc" dans le nom du fichier précise aux développeurs qu'il s'agit d'un fichier d'inclusion et non pas d'une page à part entière.

//----------------------------------------
echo '<h2> Introduction aux objets </h2>';
//----------------------------------------
// Un objet est un autre type de données (objet en anglais). Il représente un objet réel (par exemple voiture, membre, panier d'achat, produit ...) auquel on peut associer des variables, appelées PROPRIETES, et des fonctions appelées METHODES.

// Pour créer des objets, il nous faut un "plan de construction" : c'est le rôle de la classe.
// nous créons ici une classe pour faire des objets "meubles" :

class Meuble { // avec une majuscule

    public $marque = 'ikea'; // $marque est une propriété. "public" précise qu'elle sera accessible partout.

    public function prix(){ // prix() est une méthode.
    return rand(50, 200) ." €";
    }
}

//------------------

$table = new Meuble(); // new est un mot clé qui permet d'instancier la classe pour en faire un objet. L'intérêt est que notre $table bénéficie de la propriété "Ikéa et la méthode prix() définis dans la classe.

debug($table); // nous observons le type object, le nom de sa class "Meuble" et sa propriété "marque".
    
echo 'Marque du meuble : ' . $table -> marque .'<br>';   // pour accéder à la propriété d'un objet, on écrit cet objet suivi de la flèche -> puis du nom de la propriété sans le $.

echo 'Prix du meuble : ' . $table -> prix() .'<br>'; // pour accéder à la méthode d'un objet, on l'écrit après la flèche -> à laquelle on ajoute des ().


//********************************  FIN  ********************************/




    
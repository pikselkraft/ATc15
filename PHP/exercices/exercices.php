<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Formulaire html 5</title>
	<link href="stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" /> 
</head>
<body>
	
    <?php

/* exo1*/
$chaine =  htmlentities("<a href='test'>Test</a>"); 
echo $chaine;

echo '<br>';
echo '<br>';
$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
echo $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;

echo '<br>';
echo '<br>';
echo htmlspecialchars_decode($new);


//Écrivez une expression conditionnelle utilisant les variables $age et $sexe dans une instruction if pour sélectionner une personne de sexe féminin dont l’âge est compris entre 21 et 40 ans et afficher un message de bienvenue approprié.

echo '<br>';
echo '<br>';
$age=42;
$sexe="M";

/* exo 2*/

  $hi = fopen('php://stdin', "r");
  $ho = fopen('php://stdout', "w");
 
  $nom="Salmon";
  $prenom="Derek";
  $montantFacture=100;	
 
  echo "Facture au nom de $nom $prenom d'un montant de $montantFacture \$ (en dollars) <br />";
 
 
  fclose($ho);
  fclose($hi);
 
/*exo3*/

$nb_test=7;

if($nb_test%3==0 and $nb_test%9==0)
{
    echo "c'est un multiple de 3 et 9 <br />";
}
else 
{
    echo "ce n'est pas un multiple de 3 et 9 <br />";
}

/*exo4*/
    ?>
    
<label for="prenom">Prénom :</label>
<input type="text" name ="prenom" id="prenom" placeholder="Votre prénom" autocomplete="on" required/>

    <?php 

if($sexe=="F")
{
    echo "vous êtes pas une femme";
    echo '<br>';
    echo '<br>';
    
    if ($age>21 && $age<40)
    {
        echo "bienvenue";
        echo '<br>';
        echo '<br>';
    }
    else
    {
        echo "votre âge ne correspond pas";
        echo '<br>';
        echo '<br>';
    }
}
else 
{
    echo "désolé bonhomme";
    echo '<br>';
    echo '<br>';
}

/*exo 5: Effectuez une suite de tirages de nombres aléatoires (compris entre 1 et 100) jusqu’à obtenir une suite composée d’un nombre pair suivi de deux nombres impairs.*/

/*exo 6: Choisissez un nombre de trois chiffres. Effectuez ensuite des tirages aléatoires, et comptez le nombre de tirages nécessaire pour obtenir le nombre initial. Arrêtez les tirages, et affichez le nombre de coups réalisés. Réalisez ce script d’abord avec l’instruction while puis avec l’instruction for.*/



?>
    
    
</body>
    
</html>
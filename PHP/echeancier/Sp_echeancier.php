<?php

include_once('nel.php');

//Exercice individuel (à déposer sur Dropbox) : échéancier.
//Exercice Echéancier.

//Partie A:
//Réalisez un script PHP dans lequel on définit les variables montant, acompte et nombre de mensualités. Calculez alors l'échéance, puis les dates d'échéances. Représentez le tout sous forme d'un tableau HTML. Déposez l'exercice sur Dropbox.
//N.B.: vous utiliserez notamment la fonction strtotime() dans une boucle for. La commande echo permet d'écrire la syntaxe HTML d'une ligne de tableau, d'une cellule, etc..

//Partie B:
//Créez le formulaire pour saisir le montant, l'acompte, le nombre de mensualité. Les réponses du formulaire sont traitées par un scrip PHP qui affichera pour rappel les données (montant, acompte, nombre mensualités), lues de la variable globale $_POST, puis dans un tableau, le numéro d'ordre de la mensualité, la date de l'échéance, l'échéance en euro, puis l'échéance en toutes lettres.
//Vous utiliserez la classe nel(). Des exemples d'instance de cette classe (utilisation de cette classe) sont disponibles ici. La seule limitation est qu'elle ne gère pas les nombres à virgule. Vous devez donc décomposer un réel en sa partie entière et sa partie décimale pour appliquer indépendamment la classe nel().

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Echeancier PHP</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="css/foundation.css">
     <link rel="stylesheet" href="css/normalize.css">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body>

 <div id="content"> 
    <div id="elements">
    <h1>Echéancier</h1>	
    
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
		<fieldset>
			<legend>Votre emprunt</legend>
			<label for="montant_initial">Montant emprunté</label>
			<input type="text" name="montant_initial" id="montant">
			<label for="acompte">Acompte</label>
			<input type="number" name="acompte" id="acompte">
			<label for="nb_mensualites">Nombre de mensualités</label>
			<input type="number" name="nb_mensualites" id="mensualites" value="2" max="20" min="1" step="1">  
			<br>
			<input type="submit" name="submit" value="Valider">

		</fieldset>
	</form>
    
    
    
<?php
    /* test submit et déclaration variables*/

        function secInput($data) 
        {
            $data = stripslashes($data); // Supprime les antislashs d'une chaîne
            $data = strip_tags($data); //strip_tags() tente de retourner la chaîne str après avoir supprimé tous les octets nuls, toutes les balises PHP et HTML du code. Elle génère des alertes si les balises sont incomplètes ou erronées.
          
            $data = trim($data); // trim() retourne la chaîne str, après avoir supprimé les caractères invisibles en début et fin de chaîne. Si le second paramètre charlist est omis, trim() supprimera les caractères suivants.
            $data = htmlentities($data); // empêche les caractères html > htmlentities.
          
          return $data;
        }
/* uniquement pour limiter la taille du tableau ou des calculs de sommes trop importantes -> information de la limitation pour l'utilisateur*/
 if (isset($_POST['submit']) && isset($_POST['montant_initial']) && isset($_POST['acompte']) && isset($_POST['nb_mensualites'])) // vérification de la présence des éléments
            {
                // récupère les inputs en les sécurisant et on calcule les variables nécessaires.
                $montant_initial = secInput($_POST['montant_initial']); 
                $acompte = secInput($_POST['acompte']);
                $nb_mensualites = secInput($_POST['nb_mensualites']);
            
                $solde = $montant_initial - $acompte; 
            
                $montant_mensualites = round($solde/$nb_mensualites, 2); // coût d'une mensualité avec un arrondi
                //echo $montant_mensualites;
                $mensualites_enlettres= enlettres($montant_mensualites); 

                if($montant_initial>=1000000 && $nb_mensualites<20) // test pour limiter le calcul de mensualités
                {
                        echo "<h3>Vous avez les moyens de vous payer un comptable ^^</h3>";
                }
                else
                {
                        if($nb_mensualites>=20)
                        {
                             echo "<h3>Pour des soucis de lisibilité, nous avons limité le nombre de mensualités</h3>";
                        }
                        else
                        {
           
        
                            /* récapitulatif des entrées */
                        echo '<div id="liste"> <ul>';
                            echo "<li> Le montant à régler est de " . $montant_initial . " euros </li>";
                            echo "<li> Votre acompte est de " . $acompte . " euros";
                            echo "<li> Vous voulez régler en " . $nb_mensualites . " mensualité </li>";  
                            echo "<li> Votre solde après déduction de l'acompte " . $solde . " euros </li>";  
                            echo "<li> Le montant de vos mensualités " . $montant_mensualites . " euros </li>";
                        echo '<ul></div>';
                    
                    date_default_timezone_set('Europe/Paris'); // définition de la UTC -> Paris -> utilise pour la gestiond des heures d'été (à régler avec php.ini)
                    $date = date("Y-m-d");  // date du jours courant
                    //echo "<br />".$date;
                   
                    $date_interval = strtotime($date); // créer un timestamp pour permettre un calcul (+1 mois)
                    //echo "<br />".$date_interval;
        
                    ?>
                    <table>
                                <thead>
                                    <tr>
                                        <th>Mensualité</th>
                                        <th>Echéance</th>
                                        <th>Reste</th>
                                        <th>Reste (lettres)</th>
                                        <th>Payé</th> 
                                    </tr>
                                </thead>
                                <tbody>
                     
                    <?php 
        
                    for ($i=0;$i<=$nb_mensualites;$i++) // loop initinialise le nombre de mensualités
                    {
                        $date_mensualites = date("Y-m-d", strtotime("+".$i." month", $date_interval)); // +1 mois à la date en fonction de $i
                        $reste = round($solde - ($montant_mensualites*$i)); // arrondie de la somme à l'entier supérieur (système administratif)
                        $reste_lettre=enlettres($reste); // ecriture en lettres du reste
                        $num_echeance = $i +1;
                       echo "<tr>";
                            echo "<td style='text-align: center;'>" . $num_echeance . "</td>"; // numéro de lignes
                            echo "<td style='text-align: center;'>" .  $date_mensualites . "</td>";
                            echo "<td style='text-align: center;'>" . $reste . "</td>"; // gestion acompte
                            echo "<td>" . $reste_lettre . "&euro;<br /><br />"; // gestion reste en lettre   
                            echo "<td>" . $montant_mensualites*$i . "&euro;<br /><br />"; // gestion reste      
                         echo "</tr>";                                                                     
                    }
                
                    if($reste==0)
                    {
                        echo "<h3> Vous pouvez faire un nouvel emprunt houhou </h3><br />";
                    }
                    else
                    {
                        echo "<h3> Erreur dans le calcul, il reste " . $reste . "euros à payer </h3>";
                    }

                    } // fin else test nb_mensualites 
            } // fin else limitation importance des sommes et mensualités
    }  // fin if isset
                    ?>
			</tbody>
     </table>
    
     <p>Derek Salmon exercice PHP_échéancier</p>
     
    </div>   
</div>
    
    
   
		

</body>
</html>

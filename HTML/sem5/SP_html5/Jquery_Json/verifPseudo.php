<?php 
if (!isset($_GET['pseudo'])) {
    $reponse = "{'error': 'Paramètre pseudo non présent'}";
} else {
    // Récupération des paramètres GET
    $pseudo = $_GET['pseudo'];
    
    // On simule l'existence de pseudos en base de données
    $pseudoExistants = array('bob34', 'bibest', 'kevin-the-king', 'roby67');
    
    // Test de la disponibilité du pseudo
    $isDispo = !in_array($pseudo, $pseudoExistants) ? 'true' : 'false';
    
    // Construction de la réponse JSON
    $reponse = '{"pseudoDispo": '.$isDispo.'}';
}

// Envoi de la réponse en prenant soin de préciser son format JSON dans la
// réponse HTTP
header("Content-Type: application/json");
echo $reponse;
?>
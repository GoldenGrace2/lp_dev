<?php
    require 'config.inc.php'; 
    require 'header.php';


	$email=$_POST['email'];
	$mdp=$_POST['mdp'];
	$BDD=connexionBD();
	$req='SELECT * FROM User WHERE user_email LIKE "'.$email.'"';

	//echo '<p>'.$req.'</p>';
	// on lance la requête

	$resultat=$BDD->query($req);

	// on calcule le nombre de lignes renvoyées
	$lignes_resultat=$resultat->rowCount();

	if ($lignes_resultat>0) { // y a-t-il des résultats ?
        // oui : pour chaque résultat : afficher

        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
        if (password_verify($mdp, $ligne['user_mdp'])) {
            //echo '<p>OK...</p>';
            $_SESSION['prenom_client'] = $ligne['user_prenom'];
            $_SESSION['email_client'] = $ligne['user_email'];
            $_SESSION['numero_client'] = $ligne['user_id'];
            $_SESSION['nom_client'] = $ligne['user_nom'];
            $_SESSION['adresse_client'] = $ligne['user_adresse'];

            header('location:calendrier.php');
        }

        else {

            //echo '<p>KO...</p>';
            // Le mot de passe est incorrect

            $_SESSION['erreur'] = '<h1 class="erreur">Le mot de passe saisi est incorrect.</h1>';
            header('location:index.php');
        }

    }
    else {
        $_SESSION['erreur'] ='<h1 class="erreur">L\'adresse email saisi est incorrect.</h1>';
        header('location:index.php');
    }

	deconnexionBD($BDD);
?>
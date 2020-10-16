<?php    require 'config.inc.php'; ?>

<?php    require 'header.php'; ?>

        <?php

        /* On recherche le bon code */

	    $code = $_POST['hiddenCode'];	
	    $mdp = $_POST['pwd'];	
	    $mdp_valid = $_POST['validate-pwd'];	
        $password_hashed = password_hash($mdp,PASSWORD_BCRYPT);

        $bdd = connexionBD();

        /* On recherche le bon code */

        $requete = "SELECT * FROM User WHERE user_mdpOublie = '".$code."'";
        
        $exe = $bdd->query($requete);
        $monCode = $exe->fetch();


        if ($code == $monCode['user_mdpOublie'] && $mdp_valid = $mdp) {

            echo 'OK';

            $requete2 = 'UPDATE User

                  SET user_mdpOublie ="0", user_mdp = "'.$password_hashed.'"
                  
                  WHERE user_mdpOublie = "'.$code.'"
                    
                  ';

            $bdd->query($requete2); 

            header('location:index.php');      


        } /* fermeture du if */

        else {
            echo 'NOT OK';

            header('location:index.php');      

        } 

        deconnexionBD($bdd);
        ?>

</body>
</html>


<?php    require 'config.inc.php'; ?>

<?php    require 'header.php'; ?>

        <?php

        /* On recherche le bon code */

	    $code = $_GET['code'];	

        $bdd = connexionBD();

        /* On recherche le bon code */

        $requete = "SELECT * FROM User WHERE user_validation = '".$code."'";
        
        $exe = $bdd->query($requete);
        $monCode = $exe->fetch();


        if ($code == $monCode['user_validation']) {

            echo 'OK';

            $requete2 = 'UPDATE User

                  SET user_validation ="OK"
                  
                  WHERE user_validation = "'.$code.'"
                  
                  
                  ';

            $bdd->query($requete2); 
            header('location:index.php');      


        } /* fermeture du if */

        else {
            echo 'NOT OK';
        } 

        deconnexionBD($bdd);
        ?>

</body>
</html>


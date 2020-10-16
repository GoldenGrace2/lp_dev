<?php    require 'config.inc.php'; ?>

<?php    require 'header.php'; ?>

        <?php

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adressemail = $_POST['adresse_email'];
        $mdp = $_POST['mdp'];
        $adresse = $_POST['adresse'];
        $mdp_valid = $_POST['mdp_valid'];
        $password_hashed = password_hash($mdp,PASSWORD_BCRYPT);
        $valid = 0;
        $length = 10;    
        $code =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);

        $url_valid = "149.91.81.101/webot/valid_compte.php?code=".$code;
        $pseudo = ' '.$nom;
        $bdd = connexionBD();

        $req='SELECT * FROM User WHERE user_email LIKE "'.$adressemail.'"';

        //echo '<p>'.$req.'</p>';
        // on lance la requête
    
        $exe = $bdd->query($req);

        $noMoreDouble = $exe->fetch();

        
        if ($_POST['mdp'] == $_POST['mdp_valid'] && $noMoreDouble['user_email']!= $adressemail) {


            $requete = 'INSERT INTO User (user_prenom,user_nom,user_mdp,user_email,user_adresse,user_validation, user_mdpOublie) VALUES ("'.$prenom.'","'.$nom.'","'.$password_hashed.'","'.$adressemail.'","'.$adresse.'","'.$code.'",'.$valid.');';
           

            $resultat = $bdd->query($requete);            
             
            $_SESSION['prenom_client'] = $ligne['user_prenom'];
            $_SESSION['email_client'] = $ligne['user_email'];
            $_SESSION['numero_client'] = $ligne['user_id'];
            $_SESSION['nom_client'] = $ligne['user_nom'];
            $_SESSION['adresse_client'] = $ligne['user_adresse'];


            // use wordwrap() if lines are longer than 70 characters
            $to = $adressemail;
            $subject = "Confirmer votre compte Mairie de Rosières-près-Troyes";

            $message = "
            <html>
            <head>
            </head>
            <body>
            </body>
            </html>Bonjour".$pseudo.",<br><br>
            
            Veuillez cliquer sur le lien ci-dessous pour valider votre compte. <br><br>
            <a rel='nofollow' href='".$url_valid."'>Confirmer votre compte </a> <br><br>
         
            Vos identifiants de connexion : <br><br>Email :
            ".$adressemail."<br> Mot de passe : celui que vous avez entrer lors de l'inscription <br><br>
            
            Cordialement,<br>
            L'équipe Webot.
  
            </body></html> 
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <Webot@gmail.com>' . "\r\n";

            mail($to,$subject,$message,$headers);


            $_SESSION['erreur']='<h1 class="erreur">Un mail vient de vous être envoyés pour valider votre compte. </h1>';
            header('location:index.php');      


        } /* fermeture du if */

        else {

            $_SESSION['erreur']='<h1 class="erreur"> Vos mots de passe ne sont pas identiques, où bien l\'adresse mail est déjà utilisée. </h1>';


            header('location:index.php');
        } /* fermeture du else */

        deconnexionBD($bdd);
        ?>

</body>
</html>


<?php    require 'config.inc.php'; ?>

<?php    require 'header.php'; ?>

        <?php

        $email = $_POST['email'];

        $length = 10;    
        $code =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
        $url_valid = "149.91.81.101/webot/oubli_valid.php?code=".$code;
        $bdd = connexionBD();
       
        $requete = 'UPDATE User

                  SET user_mdpOublie="'.$code.'" WHERE user_email ="'.$email.'";';

        //echo '<p>'.$req.'</p>';
        // on lance la requête

        $bdd->query($requete);

            // use wordwrap() if lines are longer than 70 characters
            $to = $email;
            $subject = "Oubli de mot de passe Mairie de Rosières-près-Troyes";

            $message = "
            <html>
            <head>
            </head>
            <body>
            </body>
            </html>Bonjour,<br><br>
            
            Suite à votre demande de mot de passe oublié, veuillez cliquer sur le lien ci-dessous pour changer votre mot de passe. <br><br>
            <a href='".$url_valid."'>Changer votre mot de passe</a> <br><br>
            
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

        deconnexionBD($bdd);
        
        header('location:index.php');      

        ?>


</body>
</html>


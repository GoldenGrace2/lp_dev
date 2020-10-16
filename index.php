<?php    require 'config.inc.php'; ?>

<?php    require 'header.php'; ?>


<div class="limiter">

        <?php 
        
        if (!empty($_SESSION['ErreurNonCo'])) {
		echo $_SESSION['ErreurNonCo'];
		unset ($_SESSION['ErreurNonCo']);
		} 

		elseif (!empty($_SESSION['erreur'])) {
		echo $_SESSION['erreur'];
		unset ($_SESSION['erreur']);
        }
        
        elseif (!empty($_SESSION['pasValide'])) {
        echo $_SESSION['pasValide'];
        unset ($_SESSION['pasValide']);
        }
	?>
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
	<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form inscription" action="inscription_valid.php" method="POST">
					<span class="login100-form-title" style=" height: 100px; background: url('images/logo.svg'); background-position: center;background-repeat: no-repeat;">
					</span>
					<span class="login100-form-title p-b-49">
						Inscription
					</span>
					<div class="wrap-input100 m-b-23">
						<span class="label-input100">Prenom</span>
						<input class="input100" type="text" name="prenom" placeholder="Votre prénom">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 m-b-23">
						<span class="label-input100">Nom</span>
						<input class="input100" type="text" name="nom" placeholder="Votre nom">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Votre email est requis">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="adresse_email" placeholder="Votre email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input  m-b-23" data-validate="Votre mot de passe est requis">
						<span class="label-input100">Mot de passe</span>
						<input class="input100" type="password" name="mdp" placeholder="Votre mot de passe">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input  m-b-23" data-validate="La confirmation de votre mot de passe est requise">
						<span class="label-input100">Confirmation du mot de passe</span>
						<input class="input100" type="password" name="mdp_valid" placeholder="Confirmez votre mot de passe">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 m-b-23">
						<span class="label-input100">Adresse</span>
						<input class="input100" type="text" name="adresse" placeholder="Votre adresse">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Inscription
							</button>
						</div>
					</div>
				</form>
			</div>

			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form connexion" action="connexion_verif.php" method="POST">
					<span class="login100-form-title" style=" height: 100px; background: url('images/logo.svg'); background-position: center;background-repeat: no-repeat;">
					</span>
					<span class="login100-form-title p-b-49">
						Connexion
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Votre email est requis">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Ecrivez votre email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Votre mot de passe est requis">
						<span class="label-input100">Mot de passe</span>
						<input class="input100" type="password" name="mdp" placeholder="Ecrivez votre mot de passe">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="text-right p-t-8 p-b-31">
						<a href="oubli.php">
							Mot de passe oublié ?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Connexion
							</button>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

   <!-- <form method="POST" action="inscription_valid.php" class="inscription" style="display: flex; width: 100%; flex-wrap: wrap; align-content: center; flex-direction: column;">

            Nom : <input type="text" name="nom" class="form-control">
            Prénom :  <input type="text" name="prenom" class="form-control">
            Adresse email :	 <input type="text" name="adresse_email" class="form-control" placeholder="email@example.com">
            Mot de passe :	<input type="password" name="mdp" class="form-control" required="required">
            Retapez votre mot de passe :	<input type="password" name="mdp_valid" class="form-control" required="required">
            Adresse :	<input type="text" name="adresse" class="form-control">
        

            <br/>

            <button class="btn btn-primary" id="insb">Valider</button>

    </form>


    <h1>Connexion</h1>

    <form action="connexion_verif.php" method="post">

        <p>Merci de vous connectez pour accéder à tout le site : </p> </br></br>

        <label>Adresse e-mail : </label>
            <input type="text" class="form-control" name="email"><br />
        <label><P>Mot de passe :</label>   
            <input type="password" class="form-control" style="width:20%;" name="mdp"><br /></br>
                        
        <button type="submit" class="btn btn-primary">Envoyer</button>

    </form>

    -->
</body>
</html>


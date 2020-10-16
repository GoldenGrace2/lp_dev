
<?php require 'config.inc.php'; ?>

<?php require 'header.php'; ?>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
	<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form inscription" method="POST" action="mdp_oubli.php">
					<span class="login100-form-title" style=" height: 100px; background: url('images/logo.svg'); background-position: center;background-repeat: no-repeat;">
					</span>
					<span class="login100-form-title p-b-49">
						Renseignez votre nouveau mot de passe
					</span>

					<div class="wrap-input100 validate-input  m-b-23" data-validate="Votre nouveau mot de passe est requis">
						<span class="label-input100">Nouveau mot de passe</span>
						<input class="input100" type="password" name="pwd" placeholder="Votre nouveau mot de passe">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input  m-b-23" data-validate="La confirmation de votre nouveau mot de passe est requise">
						<span class="label-input100">Confirmation du mot de passe</span>
						<input class="input100" type="password" name="validate-pwd" placeholder="Confirmez votre nouveau mot de passe">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<input class="input100" type="hidden" name="hiddenCode" value="<?php echo $_GET['code'] ?>">


					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Envoyer
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

</body>
</html>

<?php require 'config.inc.php'; ?>

<?php require 'header.php'; ?>
	
<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
	<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form method="POST" class="login100-form validate-form inscription" action="email_recup.php">
					<span class="login100-form-title" style=" height: 100px; background: url('images/logo.svg'); background-position: center;background-repeat: no-repeat;">
					</span>
					<span class="login100-form-title p-b-49">
						Récupération de votre compte
					</span>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Votre email est requis">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Quel est votre email ?">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

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
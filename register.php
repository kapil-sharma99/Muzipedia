<?php

include("includes/config.php");
include("includes/Classes/Account.php");
include("includes/Classes/Constants.php");
$account = new Account($con);
include("includes/Handlers/register-handler.php");
include("includes/Handlers/login-handler.php");

function getInputValue($name) {
	if(isset($_POST[$name])) {
		echo $_POST[$name];
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Muzipedia Registration</title>
	<link rel="stylesheet" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php 
	
	if(isset($_POST['registerButton'])) {
		echo '
			<script>
			$(document).ready(function() {
				$("#loginForm").hide();
				$("#registerForm").show();
			});
		</script>
		';
	} else {
			echo '
				<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>
			';
	}
	
	?>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form method="POST" action="register.php" id="loginForm">
					<h2>Login to your <span class="loginHeading">Muzipedia</span> account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed) ?>
						<label for="loginUsername">Username</label>
						<input type="text" name="loginUsername" id="loginUsername" value="<?php getInputValue('loginUsername') ?>" placeholder="Your Username" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input type="password" name="loginPassword" id="loginPassword" placeholder="Your Password" required>
					</p>

					<button name="loginButton" type="submit">LOGIN</button>

					<div id="hasAccountText">
						<span id="hideLogin">Don't have an account yet? <a style="text-decoration: none" href="#"><span class="loginHeading">SIGNUP</span></a> here</span>
					</div>
				</form>

				<form method="POST" action="register.php" id="registerForm">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters) ?>
						<?php echo $account->getError(Constants::$usernameTaken) ?>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" placeholder="Your Username" value="<?php getInputValue('username') ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters) ?>
						<label for="firstName">First Name</label>
						<input type="text" name="firstName" id="firstName" placeholder="Your First Name" value="<?php getInputValue('firstName') ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters) ?>
						<label for="lastName">Last Name</label>
						<input type="text" name="lastName" id="lastName" placeholder="Your Last Name" value="<?php getInputValue('lastName') ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch) ?>
						<?php echo $account->getError(Constants::$emailInvalid) ?>
						<?php echo $account->getError(Constants::$emailTaken) ?>
						<label for="email">Your E-mail</label>
						<input type="email" name="email" id="email" placeholder="Your E-mail address" value="<?php getInputValue('email') ?>" required>
					</p>
					<p>
						<label for="email2">Confirm E-mail</label>
						<input type="email" name="email2" id="email2" placeholder="Confirm your E-mail address" value="<?php getInputValue('email2') ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$passwordsDoNotMatch) ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric) ?>
						<?php echo $account->getError(Constants::$passowordCharacters) ?>
						<label for="password">Password</label>
						<input type="password" name="password" id="password" placeholder="Your Password" required>
					</p>
					<p>
						<label for="password2">Confirm Password</label>
						<input type="password" name="password2" id="password2" placeholder="Your Password" required>
					</p>

					<button name="registerButton" type="submit">Sign up</button>
					<div id="hasAccountText">
						<span id="hideRegister">Already have an account? <a style="text-decoration: none" href="#"><span class="loginHeading">LOGIN</span></a> here.</span>
					</div>
				</form>
			</div>
			<div id="loginText">
				<h1>Get great music, right now</h1>
				<h2>Listen to loads of songs for free</h2>

				<ul>
					<li>Discover music you'll fall in love with.</li>
					<li>Create your own playlist.</li>
					<li>Follow artists to keep up to date.</li>
				</ul>
			</div>
		</div>
	</div>  
</body>
</html>
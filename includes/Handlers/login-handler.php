<?php

if(isset($_POST['loginButton'])) {
	//login Button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];

	//Login Function
	$result = $account->login($username, $password);
	if($result == true) {
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}
}

?>
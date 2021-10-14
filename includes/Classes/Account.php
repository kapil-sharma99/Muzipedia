<?php 

class Account {

	private $con;
	private $errorArray;

  public function __construct($con) {
		$this->errorArray = array();
		$this->con = $con;
  }

	public function login($un, $pw) {
		$pw = md5($pw);
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");

		if(mysqli_num_rows($query) == 1) {
			return true;
		} else {
			array_push($this->errorArray, Constants::$loginFailed);
			return false;
		}
	}

  public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
		$this->validateUsername($un);
		$this->validateFirstName($fn);
		$this->validateLastName($ln);
		$this->validateEmail($em, $em2);
		$this->validatePassword($pw, $pw2);

		if(empty($this->errorArray)) {
			//insert to Database
			return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
		} else {
			return false;
		}
  }

	public function getError($error) {
		if(!in_array($error, $this->errorArray)) {
			$error = "";
		}
		return "<span class='errorMessage'>$error</span>";
	}

	private function insertUserDetails($un, $fn, $ln, $em, $pw) {
		$encryptedPw = md5($pw);
		$profilePic = "assets/images/profile-pic/head_emerald.png";
		$date = date("Y-m-d");

		$result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
		return $result;
	}

  private function validateUsername($un) {
		if(strlen($un) > 25 || strlen($un) < 5) {
			array_push($this->errorArray, Constants::$usernameCharacters);
			return;
		}

		//TODO: Check if username exist....
		$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
		if(mysqli_num_rows($checkUsernameQuery)) {
			array_push($this->errorArray, Constants::$usernameTaken);
		}
  }
    
  private function validateFirstName($fn) {
    if(strlen($fn) > 25 || strlen($fn) < 2) {
			array_push($this->errorArray, Constants::$firstNameCharacters);
			return;
		}
  }
    
  private function validateLastName($ln) {
    if(strlen($ln) > 25 || strlen($ln) < 2) {
			array_push($this->errorArray, Constants::$lastNameCharacters);
			return;
		}
  }
    
  private function validateEmail($em, $em2) {
    if($em != $em2) {
			array_push($this->errorArray, Constants::$emailsDoNotMatch);
			return;
		}

		if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
			array_push($this->errorArray, Constants::$emailInvalid);
			return;
		}

		//TODO: Check email has been already used..
		$checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
		if(mysqli_num_rows($checkEmailQuery)) {
			array_push($this->errorArray, Constants::$emailTaken);
		}
  }
    
  private function validatePassword($pw, $pw2) {
    if($pw != $pw2) {
			array_push($this->errorArray, Constants::$passwordsDoNotMatch);
			return;
		}

		if(preg_match('/[^A-Za-z0-9]/', $pw)) {
			array_push($this->errorArray, Constants::$passwordNotAlphanumeric);;
			return;
		}

		if(strlen($pw) > 30 || strlen($pw) < 5) {
			array_push($this->errorArray, Constants::$passowordCharacters);
			return;
		}
  }
}

?>
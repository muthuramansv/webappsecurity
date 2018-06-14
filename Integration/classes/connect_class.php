<?php
/* Still one Warning left over. This suppresses the Warning.
 */
error_reporting(E_ERROR | E_PARSE);

/*
Class for connecting to the Database Webshop.
Providing two Functions.
1: connect() -> returns variable $conn. (Connection variable, necessary for Prepared Statement).
2: get_tbl_items() -> returns $array of values from database.
3: Just include("connect_class.php"); to use functions of class.
 */


/**
 * Class SimpleConnectDB
 */
class SimpleConnectDB
{

	  // Connection function for connecting to database. Called from get_tbl_items().

	/**
	 * @return mysqli
	 */
	public function connect()
	{

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "webshop";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	  		 //echo "Connected successfully to Database Webshop"."<br>";


		//$conn->close();
		return $conn;
	}


	/**
	 * @return mixed
	 */
	public function get_tbl_items()
	{

		$con = $this->connect();

		if ($stmt = $con->prepare("SELECT id,name,price  FROM tbl_items ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			return $array;

		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}


	/**
	 * @return mixed
	 */
	public function get_tbl_user_login()
	{

		$con = $this->connect();

		if ($stmt = $con->prepare("SELECT firstname, pass, mail  FROM tbl_user ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			return $array;

		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}

	public function get_tbl_user_login_with_token()
	{

		$con = $this->connect();

		if ($stmt = $con->prepare("SELECT firstname, pass, mail, token  FROM tbl_user ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			return $array;

		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}

	/**
	 * @return mixed
	 */
	public function get_tbl_basket()
	{

		$con = $this->connect();

		if ($stmt = $con->prepare("SELECT * FROM tbl_basket ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			return $array;




		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}


	/**
	 * @return mixed
	 */
	public function get_tbl_orders()
	{

		$con = $this->connect();

		if ($stmt = $con->prepare("SELECT * FROM tbl_orders ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			return $array;




		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}

	/**
	 * @param $cookie_user_
	 * @param $id_items_
	 * @param $amount_
	 */
	public function set_tbl_basket($cookie_user_, $id_items_, $amount_)
	{

		$con = $this->connect();
		$query = "INSERT INTO tbl_basket(`cookie_user`,`id_items`, `amount`) VALUES ((?),(?),(?));";

		if ($stmt = $con->prepare($query)) {



			if (!$stmt->bind_param("sii", $cookie_user, $id_items, $amount)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
				echo "bind";


			}
			$cookie_user = $cookie_user_;
			$id_items = $id_items_;
			$amount = $amount_;
			echo $cookie_user_ . "<br>" . $id_items_ . "<br>" . $amount_ . "<br>" . "Done" . "<br>";

			if (!($query_result = $stmt->execute())) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				echo "execute" . "<br>";
			}

			echo $cookie_user . "<br>" . $id_items . "<br>" . $amount . "<br>" . "Done" . "<br>";


		} else {

			$error = $con->errno . ' ' . $con->error;
			echo "else";
			echo $error;

		}


		$stmt->close();
		$con->close();

	}

	/**
	 * @param $firstname_
	 * @param $lastname_
	 * @param $address_
	 * @param $mail_
	 * @param $pass_
	 */


	public function set_tbl_user($firstname_, $lastname_, $address_, $mail_, $pass_, $token_)
	{

		$con = $this->connect();
		$query = "INSERT INTO tbl_user (`firstname`, `lastname`, `address`, `mail`, `pass`, `token`) VALUES ((?), (?), (?), (?), (?), (?));";

		if ($stmt = $con->prepare($query)) {

			if (!$stmt->bind_param("ssssss", $firstname, $lastname, $address, $mail, $pass, $token)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}

			$firstname = $firstname_;
			$lastname = $lastname_;
			$address = $address_;
			$mail = $mail_;
			$pass = password_hash($pass_, PASSWORD_DEFAULT, ['cost' => 11]);
			$token = $token_;



			echo $firstname_ . "<br>" . $lastname_ . "<br>" . $address_ . "<br>" . $mail_ . "<br>" . $pass_ . "<br>" . "Done" . "<br>";

			if (!($query_result = $stmt->execute())) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				echo "execute" . "<br>";
			}

			echo $firstname . "<br>" . $lastname . "<br>" . $address . "<br>" . $mail . "<br>" . $pass . "<br>" . "Done" . "<br>";

		} else {
			$error = $con->errno . ' ' . $con->error;
			echo "else";
			echo $error;
		}

		$stmt->close();
		$con->close();
	}

	public function set_tbl_user_without_token($firstname_, $lastname_, $address_, $mail_, $pass_)
	{

		$con = $this->connect();
		$query = "INSERT INTO tbl_user (`firstname`, `lastname`, `address`, `mail`, `pass`) VALUES ((?), (?), (?), (?), (?));";

		if ($stmt = $con->prepare($query)) {

			if (!$stmt->bind_param("sssss", $firstname, $lastname, $address, $mail, $pass)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}

			$firstname = $firstname_;
			$lastname = $lastname_;
			$address = $address_;
			$mail = $mail_;
			$pass = password_hash($pass_, PASSWORD_DEFAULT, ['cost' => 11]);




			echo $firstname_ . "<br>" . $lastname_ . "<br>" . $address_ . "<br>" . $mail_ . "<br>" . $pass_ . "<br>" . "Done" . "<br>";

			if (!($query_result = $stmt->execute())) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				echo "execute" . "<br>";
			}

			echo $firstname . "<br>" . $lastname . "<br>" . $address . "<br>" . $mail . "<br>" . $pass . "<br>" . "Done" . "<br>";

		} else {
			$error = $con->errno . ' ' . $con->error;
			echo "else";
			echo $error;
		}

		$stmt->close();
		$con->close();
	}

// Check User 1.1


	public function checkUSER($checkmail)
	{




		$con = $this->connect();

		$checkmail_ = mysqli_real_escape_string($con, $checkmail);




		if ($stmt = $con->prepare("SELECT `mail` FROM tbl_user WHERE `mail` = '$checkmail_' ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			if ($array) {

				echo "User already exists !";

				return 1;
			} else {

				echo "Usermail free";
				return 0;
			}


		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}

	public function checkLoginCredentials($checkmail, $checkpassword)
	{


		$con = $this->connect();
		$sql = "SELECT mail, pass FROM tbl_user WHERE mail = ?";

		if ($stmt = mysqli_prepare($con, $sql)) {
				// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $mail);
		
				// Set parameters
			$mail = $checkmail;
				
				// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
					// Store result
				mysqli_stmt_store_result($stmt);
					
					// Check if username exists, if yes then verify password
				if (mysqli_stmt_num_rows($stmt) == 1) {                    
						// Bind result variables
					mysqli_stmt_bind_result($stmt, $checkmail, $hashed_password);
					if (mysqli_stmt_fetch($stmt)) {
						if (password_verify($checkpassword, $hashed_password)) {
								/* Password is correct, so start a new session and
								save the username to the session */
							echo 'login success';
						} else {
								// Display an error message if password is not valid
							echo 'The password you entered was not valid.';
						}
					}
				} else {
						// Display an error message if username doesn't exist
					echo 'No account found with that username.';
				}
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}
		}

		mysqli_stmt_close($stmt);
			// Close connection
		mysqli_close($con);
	}

	public function checkUSER_All($checkmail, $checkpassword)
	{




		$con = $this->connect();

		$checkmail_ = mysqli_real_escape_string($con, $checkmail);
		$checkpassword_ = mysqli_real_escape_string($con, $checkpassword);


		if ($stmt = $con->prepare("SELECT * FROM tbl_user WHERE `mail` = '$checkmail_' AND `pass` = '$checkpassword_' ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			if ($array) {

				echo "User already exists !";

				return 1;
			} else {

				echo "Usermail free";
				return 0;
			}


		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}


	public function alterTokenFromUser($user, $password, $newToken)
	{


		$con = $this->connect();



		$query = "SELECT  `pass` , `mail` FROM tbl_user  ";


		$stmt = $con->prepare($query);

		$stmt->execute();

		$res = $stmt->get_result();


		$array = $res->fetch_all();


		foreach ($array as $item) {

			$testpw = password_verify($password, $item[0]);

			if ($testpw) {

				echo "Password found, token changed";

				$query2 = "UPDATE tbl_user SET `token`='$newToken' WHERE `mail`='$user' ";

				$stmt = $con->prepare($query2);

				$stmt->execute();


				return true;

			} else {

				echo "False";
				return false;
			}

		}


		$stmt->close();
		$con->close();

	}


	public function removeToken($token)
	{

		$con = $this->connect();

		$token_ = mysqli_real_escape_string($con, $token);

		if ($stmt = $con->prepare("UPDATE tbl_user SET `token` = null WHERE `token`='$token' ")) {

			$stmt->execute();





			echo "Token DELETED !";

			return 1;
		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}

	public function getUserToken($checktoken)
	{

		$con = $this->connect();

		$checktoken_ = mysqli_real_escape_string($con, $checktoken);

		if ($stmt = $con->prepare("SELECT `mail`, `address`,`firstname`,`lastname`  FROM tbl_user WHERE `token` = '$checktoken_' ")) {

			$stmt->execute();

			$res = $stmt->get_result();

			$array = $res->fetch_all();

			if ($array) {

				echo "Token already exists !";

				return $array;
			} else {

				echo "Token does not exists";
				return 0;
			}


		} else {

			$error = $con->errno . ' ' . $con->error;
			echo $error;

		}

		$stmt->close();
		$con->close();

	}

	/**
	 * @param $id_user_
	 * @param $id_items_
	 * @param $amount_
	 * @param $price_
	 * @param $amountprice_
	 * @param $orderdate_
	 */
	public function set_tbl_orders($id_user_, $id_items_, $amount_, $price_, $amountprice_, $orderdate_)
	{

		$con = $this->connect();
		$query = "INSERT INTO tbl_orders (`id_user`, `id_items`, `amount`, `price`, `amountprice`, `orderdate`) VALUES ((?), (?), (?), (?), (?), (?));";

		if ($stmt = $con->prepare($query)) {

			if (!$stmt->bind_param("iiidds", $id_user, $id_items, $amount, $price, $amountprice, $orderdate)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}

			$id_user = $id_user_;
			$id_items = $id_items_;
			$amount = $amount_;
			$price = $price_;
			$amountprice = $amountprice_;
			$orderdate = $orderdate_;

			echo $id_user_ . "<br>" . $id_items_ . "<br>" . $amount_ . "<br>" . $price_ . "<br>" . $amountprice_ . "<br>" . $orderdate_ . "Done" . "<br>";

			if (!($query_result = $stmt->execute())) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				echo "execute" . "<br>";
			}

			echo $id_user . "<br>" . $id_items . "<br>" . $amount . "<br>" . $price . "<br>" . $amountprice . "<br>" . $orderdate . "Done" . "<br>";

		} else {
			$error = $con->errno . ' ' . $cnn->error;
			echo "else";
			echo $error;
		}

		$stmt->close();
		$con->close();
	}

}

?>

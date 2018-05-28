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

class SimpleConnectDB
{

	  // Connection function for connecting to database. Called from get_tbl_items().
	  public function connect () {

	 	   $servername = "localhost";
	  	   $username = "root";
	  	   $password = "";
	  	   $dbname = "webshop";

	  	   $conn = new mysqli($servername, $username, $password, $dbname);

	  	   if ($conn->connect_error) {
	  	   		die("Connection failed: " . $conn->connect_error);
	  	   		}
	  		// echo "Connected successfully to Database Webshop"."<br>";


		//$conn->close();
		return $conn;
	  }

	   // Returns id,name and price from tbl_items by Prepared Statement. Return value is array.
	   public function get_tbl_items()  {

		$con = $this->connect();

		if($stmt = $con->prepare("SELECT id,name,price  FROM tbl_items "))
		{

		$stmt->execute();

		$res = $stmt->get_result();

		$array = $res->fetch_all();

		return $array;

		}else {

		$error = $conn->errno . ' ' . $conn->error;
		    echo $error;

		}

		$stmt->close();
		$con->close();

		}
		public function get_tbl_user_login()  {

		$con = $this->connect();

		if($stmt = $con->prepare("SELECT firstname, pass  FROM tbl_user "))
		{

		$stmt->execute();

		$res = $stmt->get_result();

		$array = $res->fetch_all();

		return $array;

		}else {

		$error = $conn->errno . ' ' . $conn->error;
		    echo $error;

		}

		$stmt->close();
		$con->close();

		}
		
		public function get_tbl_basket()  {

		$con = $this->connect();

		if($stmt = $con->prepare("SELECT * FROM tbl_basket "))
		{

		$stmt->execute();

		$res = $stmt->get_result();

		$array = $res->fetch_all();

		return $array;
		
		
		

		}else {

		$error = $conn->errno . ' ' . $conn->error;
		    echo $error;

		}

		$stmt->close();
		$con->close();

		}
		
		
		public function get_tbl_orders()  {

		$con = $this->connect();

		if($stmt = $con->prepare("SELECT * FROM tbl_orders "))
		{

		$stmt->execute();

		$res = $stmt->get_result();

		$array = $res->fetch_all();

		return $array;
		
		
		

		}else {

		$error = $conn->errno . ' ' . $conn->error;
		    echo $error;

		}

		$stmt->close();
		$con->close();

		}
		
		
		
}

?>

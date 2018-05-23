<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
error_reporting(E_ERROR | E_PARSE);


class SimpleConnectDB
{

    public function connectDB() {


	   $servername = "localhost";
	   $username = "root";
	   $password = "";
	   $dbname = "webshop";

	   $conn = new mysqli($servername, $username, $password, $dbname);

	   if ($conn->connect_error) {
	   		die("Connection failed: " . $conn->connect_error);
	   		}
		echo "Connected successfully Test Neu Neu"."<br>";




		if($stmt = $conn->prepare("SELECT name, price FROM tbl_items where name=?"))
		{
		
		$stmt->bind_param('s', $name);
		$name = "The Web Application Hacker's Handbook";
		
		$stmt->execute();


		$res = $stmt->get_result();

		//var_dump($res->fetch_all());

		while($row = $res->fetch_assoc()) {

		echo "  ----- Name:      ". $row["name"]."<br>";
		echo "  ----- Price:      ". $row["price"]."<br>";


		}

		}else {

		$error = $conn->errno . ' ' . $conn->error;
		    echo $error;

		}


		$stmt->close();



		$conn->close();

		}
		
		
		/* Prepared Statements for Items / GET
		
		$conn->prepare("SELECT name FROM tbl_items where name=?")
		$conn->prepare("SELECT name, price FROM tbl_items where name=?"))
		$conn->prepare("SELECT name, price, description, stock FROM tbl_items where name=?"))
		$conn->prepare("SELECT * FROM tbl_items where name=?"))
		
		*/
		
		/* Prepared Statements for User / GET firstname	lastname	address	mail
		
		$conn->prepare("SELECT firstname FROM tbl_user where firstname=?")
		$conn->prepare("SELECT firstname, lastname FROM tbl_user where lastname=?"))
		$conn->prepare("SELECT firstname, lastname FROM tbl_user where firstname=?"))
		$conn->prepare("SELECT firstname, lastname, address	,mail FROM tbl_user where lastname=?"))
		$conn->prepare("SELECT * FROM tbl_user where lastname=?"))
		$conn->prepare("SELECT * FROM tbl_user where id=?"))
		
		*/

}

?>



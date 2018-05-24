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
		echo "Connected successfully Test Neu"."<br>";




		if($stmt = $conn->prepare("SELECT name FROM tbl_items where name=?"))
		{
		$stmt->bind_param('s', $name);

		$name = "The Web Application Hacker's Handbook";
		$stmt->execute();


		$res = $stmt->get_result();

		// var_dump($res->fetch_all());

		while($row = $res->fetch_assoc()) {

		echo "  ----- Name:      ". $row["name"]."<br>";


		}




		}else {

		$error = $conn->errno . ' ' . $conn->error;
		    echo $error;

		}


		//$stmt->close();



		$conn->close();

		}

}

?>

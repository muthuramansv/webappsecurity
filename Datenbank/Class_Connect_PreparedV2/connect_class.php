<?php

error_reporting(E_ERROR | E_PARSE);

class SimpleConnectDB
{



	  public function connect () {

	 	   $servername = "localhost";
	  	   $username = "root";
	  	   $password = "";
	  	   $dbname = "webshop";

	  	   $conn = new mysqli($servername, $username, $password, $dbname);

	  	   if ($conn->connect_error) {
	  	   		die("Connection failed: " . $conn->connect_error);
	  	   		}
	  		echo "Connected successfully Test Neu Neu"."<br>";


		 //$conn->close();
		return $conn;
	  }


	   public function Get_tbl_items($name_)  {


		$con = $this->connect();


		if($stmt = $con->prepare("SELECT *  FROM tbl_items "))
		{

		$stmt->bind_param('s', $name);
		$name = $name_;

		$stmt->execute();


		$res = $stmt->get_result();

		$array = $res->fetch_all();


		return $array;


		}else {

		$error = $conn->errno . ' ' . $conn->error;
		    echo $error;

		}


		$stmt->close();


		}

}

?>



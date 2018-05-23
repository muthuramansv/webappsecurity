<?php
/* Still one Warning left over. This suppresses the Warning.
*/
error_reporting(E_ERROR | E_PARSE);

/*
Class for connecting to the Database Webshop. 
Providing two Functions.
1: connect() -> returns $conn. (Connection variable, necessary for Prepared Statement. ).
2: get_tbl_items() -> returns $array of values.
*/
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
	  		echo "Connected successfully "."<br>";


		 //$conn->close();
		return $conn;
	  }


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


		}

}

?>



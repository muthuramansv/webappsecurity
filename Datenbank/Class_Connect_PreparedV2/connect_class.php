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
		$conn->prepare("SELECT * FROM tbl_user where pass=?"))
		$conn->prepare("SELECT firstname, lastname FROM tbl_user where pass=? and mail=?"))
		$conn->prepare("INSERT INTO tbl_user (firstname, lastname, address,mail,pass) VALUES (?, ?, ?,?,?,?)");
		
		*/
		
		
		/* Prepared Statements for Orders / GET  id	id_user	id_items	amount	price		orderdate
		
		$conn->prepare("SELECT * FROM tbl_orders where id=?")
		$conn->prepare("SELECT * FROM tbl_orders where id_user=?")
		$conn->prepare("SELECT * FROM tbl_orders where id_items=?")
		$conn->prepare("SELECT * FROM tbl_orders where orderdate=?")
		$conn->prepare("SELECT * FROM tbl_orders where amount=?")
		$conn->prepare("SELECT id_user FROM tbl_orders where id_user=?")
		$conn->prepare("SELECT id_user FROM tbl_orders where id_items=?")
		
		
		$conn->prepare("INSERT INTO tbl_orders (id_user, id_items, amount,price,orderdate) VALUES (?, ?, ?,?,?)");
		
		*/
		
		/* Prepared Statements for Basket / GET  id	cookie_user	id_items	amount

		
		$conn->prepare("SELECT * FROM tbl_basket where id=?")
		$conn->prepare("SELECT * FROM tbl_basket where id_items=?")
		$conn->prepare("SELECT * FROM tbl_basket where cookie_user=?")
		$conn->prepare("SELECT * FROM tbl_basket where amount=?")
		$conn->prepare("INSERT INTO tbl_basket (cookie_user, id_items, amount) VALUES (?, ?, ?)");
		
		*/
		
			
		/* Prepared Statements for Cookie / GET  cookie_user	id_user	logged_in	login_expire

		
		$conn->prepare("SELECT * FROM tbl_cookie where id=?")
		$conn->prepare("SELECT * FROM tbl_cookie where id_user=?")
		$conn->prepare("SELECT * FROM tbl_cookie where cookie_user=?")
		$conn->prepare("SELECT * FROM tbl_cookie where logged_in=?")
		$conn->prepare("SELECT * FROM tbl_cookie where login_expire=?")
		$conn->prepare("INSERT INTO tbl_cookie (cookie_user, id_user, logged_in,login_expire) VALUES (?, ?, ?,?)");
		
		*/

}

?>









<?php
class SimpleConnectDB
{
    // Connection Variables
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "webshop";
	private $sql = "SELECT id, name, price, description FROM tbl_items";
	private $conn = new mysqli($servername, $username, $password, $dbname);
	private $result = $conn->query($sql);
	
	

    // Deklaration einer Methode
    public function connectDB() {
		
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
		echo "Connected successfully"."<br>";
		
		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
        echo " - Id:       " . $row["id"]. " ----- Name:      ". $row["name"]." ----- Price:      ". $row["price"]."<br>"." ----- Description:      ". $row["description"]."<br>";
		}
		} else {
			echo "0 results";
}
		$conn->close();
	
		}
		
		
		
		
}
?>
<?php

/*session_start();
// Create a new CSRF token.
if (! isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = md5(openssl_random_pseudo_bytes(32));
}

if($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("Das Token ist Invalide");

// Check a POST is valid.
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

   echo 	"Das CSRF-TOKEN ist valide!!!";
   echo "             ";
   print 	$_SESSION['csrf_token'];
}
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"."<br>";

$sql = "SELECT id, name, price, description FROM tbl_items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " - Id:       " . $row["id"]. " ----- Name:      ". $row["name"]." ----- Price:      ". $row["price"]."<br>"." ----- Description:      ". $row["description"]."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Websecurity</title>


</head>
<body>
    <form action="index.php" method="post" accept-charset="utf-8">
        <input type="text" name="test" />
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
        <input type="submit" value="Senden" />
    </form>



</body>
</html>
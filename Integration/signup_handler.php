<?php
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

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$mail = $_POST['email'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];
$address = $_POST['address'];
$password = md5($password_1);

$sql = "INSERT INTO tbl_user (firstname, lastname, mail, address, pass)
VALUES ('$firstname', '$lastname','$mail','$address', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

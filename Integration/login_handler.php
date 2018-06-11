
<?php

//Should be in Connect Class

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

echo "muthu db is success!!";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    //Bad! Exposes SQL Query if nothing is entered in Sign in!!!
    $email = $_POST['username'];
    $password1 = $_POST['password'];
    $password2 = md5($password1);
    $sql = "SELECT * FROM tbl_user WHERE  mail = '$email' AND pass = '$password2'";
    $result = $conn->query($sql);
$get_total_rows = $result->fetch_row();
    if($get_total_rows >= 1) {
        echo "Muthu is Success!!!";
        header('Location: index.php');
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();

?>


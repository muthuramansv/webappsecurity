<?
include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
include 'classes/session.php';
include 'classes/pageBuilder.php';


$username="";
$password_1="";
$password_2="";
$email="";
$firstname="";
$lastname="";
$address="";
$errors= array();

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
$arrayTest = $connectToDb->get_tbl_items();

if(isset($POST['register'])){
    $username = mysqli_real_escape_string($_POST['username']);
    $firstname = mysqli_real_escape_string($_POST['firstname']);
    $lastname = mysqli_real_escape_string($_POST['lastname']);
    $email = mysqli_real_escape_string($_POST['email']);
    $password_1 = mysqli_real_escape_string($_POST['password_1']);
    $password_2 = mysqli_real_escape_string($_POST['password_2']);
    $address = mysqli_real_escape_string($_POST['address']);

    if(empty($username)){
        $array_push($errors, "Username is required");
        }
        if(empty($password_1)){
        $array_push($errors,"Password is required");
        }
        if(empty($password_2)){
        $array_push($errors,"Password is required");
        }
        if(empty($firstname)){
        $array_push($errors,"First name is required");
        }
        if(empty($lastname)){
        $array_push($errors,"Last name is required");
        }
        if(empty($address)){
        $array_push($errors,"Address is required");
        }
        if(empty($email)){
        $array_push($errors,"Email is required");
        }
        if(empty($address)){
        $array_push($errors,"Address is required");
        }
        if(password_1 != password_2){
        $array_push($errors,"Passwords do not match");
        }

        if(count($errors)== 0){
        $password = md5($password_1);
        $sql = "INSERt INTO users (username, email, password, address,fisrtname, lastname)
                              VALUES ('$username', '$email', '$password_1','$address','$firstname','$lastname')";
        mysqli_query($db, $sql);
        }
    }
?>


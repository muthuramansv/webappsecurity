<?
include 'classes/pageBuilder.php';
include 'classes/connect_class.php';



$username="";
$password_1="";
$password_2="";
$email="";
$firstname="";
$lastname="";
$address="";
$errors= array();

if(isset($POST['register'])){
    $username = isset($_POST['username']);
    $firstname = isset($_POST['firstname']);
    $lastname = isset($_POST['lastname']);
    $mail = isset($_POST['email']);
    $password_1 = isset($_POST['password_1']);
    $password_2 = isset($_POST['password_2']);
    $address = isset($_POST['address']);

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

        $password = md5($password_1);
    $connectToDb = new SimpleConnectDB();
    $connectToDb->set_tbl_user($firstname, $lastname, $address, $email, $password);
        }
    }
?>


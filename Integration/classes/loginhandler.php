<?
include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
include 'classes/session.php';
include 'classes/pageBuilder.php';


$username="";
$password="";
$email="";
$errors= array();

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
$arrayTest = $connectToDb->get_tbl_items();

if(isset($POST['Login'])){
    $username = mysqli_real_escape_string($_POST['username']);
    $email = mysqli_real_escape_string($_POST['email']);
    $password = mysqli_real_escape_string($_POST['password_1']);

    if(empty($username || $password || $email )){
        $array_push($errors, "Username or password is incorrect!");
    }

    if(count($errors)== 0){
        
        mysqli_query($arrayTest, $sql);

    }
}
?>

$arrayTest = $connectToDb->get_tbl_items();

if(isset($_POST["submit"])){

if(!empty($_POST['username']) && !empty($_POST['password'])) {
$name=$_POST['username'];
$pass=$_POST['password'];


if($_POST!=0)
{
while($connectToDb = new SimpleConnectDB())
{
    $arrayTest = $connectToDb->get_tbl_user_login;
    $username=$row['username'];
    $password=$row['password'];
}

if($username == $name && $password == $pass)
{

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);

/* Redirect browser */
header("res/index.php");
}
} else if($password_err ) {
echo "Invalid username or password!";
}

} else {
echo "All fields are required!";
}
}
?>


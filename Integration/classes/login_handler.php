

<?
include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
include 'classes/session.php';

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
    $name=$row['username'];
    $pass=$row['password'];
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


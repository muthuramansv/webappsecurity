<?
include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
include 'classes/session.php';

$arrayTest = $connectToDb->get_tbl_items();
$username_err = $cnfpassword_err = $password_err = $email_err = '';
$pass = $username = $fname = $lname = $email = $name = $pass = '';
if(isset($_POST["submit"])){

    if(!empty($_POST['username']) &&
        !empty($_POST['password']) &&
            !empty($_POST['F.Name']) &&
                !empty($_POST['L.Name']) &&
                    !empty($_POST['E-Mail']) &&
                        !empty($_POST['confirm_password'])){
        $name=$_POST['username'];
        $pass=$_POST['password'];
        $fname=$POST['F.Name'];
        $lname=$POST['L.Name'];
        $email=$POST['E-Mail'];
        $cnfpassword=$POST['confirm_password'];


        if($_POST!=0)
        {
            while($connectToDb = new SimpleConnectDB())
            {
                $arrayTest = $connectToDb->get_tbl_user_login;
                $name=$row['username'];
                $email=$row['email'];
            }

            if($username == $name  || $email == $email )
            {

                echo "User already exists! Please Continue to login!";

                /* Redirect browser */
                header("res/login.php");
            }
        } else if($password_err )
        {
            echo "Please enter a valid password!";
        }
        else if($username_err ) {
            echo "Please enter a valid password!";
        }
        else if($cnfpassword_err ){
            echo "Entered password did match!";
        }
        else if($email_err )
        {
            echo "Please Enter a valid email";
        }

    } else {
        echo "All fields are required!";
    }
}
?>
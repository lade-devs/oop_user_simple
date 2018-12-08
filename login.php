<?php require "config/config.php";
include "config/main.php";

$deter = new main();
$logged = $deter->check_session();
if($logged){
    header("location:backend.php");
}
else{
    if(isset($_POST['login'])){
        extract($_POST);
        $login = $deter->login($user_info,$user_pass);
        if($login){
            $deter->redirect_login();
        }
        else{
            $error = 'Username or Email does not exists';
            echo $error;
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | OOP PHP AUTHENTICATION</title>
    <meta name="author" content="Olayinka Olumayokun">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container-fluid login-outer">
    <div class="row">
        <div class="col-md-12">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-5 form">
            <h3 class="text-center">Adjacent</h3>
            <form class="login_form" action="" method="post">

                <div class="form-group"><input class="col-md-12 text-center" type="text" placeholder="Your Username or Email" name="user_info" required></div>
                <div class="form-group"><input class="col-md-12 text-center" type="password" placeholder="Your Password" name="user_pass" required></div>
                <div class="form-group">
                    <center>
                            <button type="submit" name="login">Sign In</button>
                    </center>
                </div>

            </form>
            <p class="text-right">  <strong><a href="register.php">Not yet registered ?</a></strong></p>
            <p><a href="index.php">Return back to site</a></p>
        </div>
        <div class="col-5"></div>
    </div>
    </div>
    </div>
</div>


<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php } ?>
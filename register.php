<?php require "config/config.php";
include "config/main.php";

$deter = new main();
$deter = $deter->check_session();
if($deter){
    header("location:backend.php");
}
else{

$reg = new main();
if(isset($_POST['signup'])){
    extract($_POST);
    $register =  $reg->register($user_name,$user_email,$user_pass);
    if($register){
        $reg->redirect_reg();
    }
    else{
        $error = 'Username or Email exists';
        echo $error;
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp | OOP PHP AUTHENTICATION</title>
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
                        <div class="form-group"><input class="col-md-12 text-center" type="text" placeholder="Enter Username" name="user_name" required></div>
                        <div class="form-group"><input class="col-md-12 text-center" type="text" placeholder="Enter Email" name="user_email" required></div>
                        <div class="form-group"><input class="col-md-12 text-center" type="password" placeholder="Enter Password" name="user_pass" required></div>
                        <div class="form-group">
                            <center>
                                <button type="submit" name="signup">Sign Up</button>
                            </center>
                        </div>

                    </form>
                    <p class="text-right">  <strong><a href="login.php">Already registered ?</a></strong></p>
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
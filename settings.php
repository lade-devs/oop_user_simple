<?php require "config/config.php";
include "config/main.php";

$deter = new main();
$logged_user =  $_SESSION['auth_user'];
$logged = $deter->check_session();
if(!$logged){
    header("location:login.php");
}
else{

    if(isset($_GET['logout'])){
        $deter->end_session();
    }
    if(isset($_POST['update'])){
         extract($_POST);
        $username;
        $email;
        $pass;

        if($username == '' and $email=='' and $pass==''){
            echo "No Settings Updated";
        }
        else{
           $deter->update_profile($username,$email,$pass,$logged_user);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Back-end</title>
    <meta name="author" content="Olayinka Olumayokun">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div id="backend" class="container-fluid" style="background-color: ">
    <div>
        <div class="row">
            <div class="col backend">
                <h3 class="text-center"> Account Details, <?php  $deter->get_username($logged_user);   ?></h3>
                <p class="text-center"><a href="backend.php">Back to Dashboard</a></p>
                <h5 class="text-center"><a href="settings.php?logout">Logout</a> </h5>

                <form class="s_form" action="" method="post">
                    <strong>Click details to update: Please note after any you will be logged out.</strong>
                    <table border="0px">
                        <tr>
                            <th>Username</th>
                            <td width="100%"><input class="col-md-3" type="text" value="" placeholder="<?php $deter->get_username($logged_user); ?>" name="username"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input class="col-md-3" type="text" value="" placeholder="<?php $deter->get_email($logged_user); ?>" name="email"></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input class="col-md-3" type="password" placeholder="Type new password to change" name="pass"></td>
                        </tr>
                    </table>
                    <button type="submit" name="update">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>




<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php } ?>

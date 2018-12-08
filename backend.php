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



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back-end</title>
    <meta name="author" content="Olayinka Olumayokun">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div id="backend" class="container-fluid" style="background-color: ">
    <div>
        <div class="row">
            <div class="col backend">
                <p class="text-center">Dashboard</p>
                <h3 class="text-center"> Welcome, <?php  $deter->get_username($logged_user);   ?></h3>
                <p class="text-center"><a href="settings.php">Settings</a></p>
                <h5 class="text-center"><a href="backend.php?logout">Logout</a> </h5>
            </div>
        </div>
    </div>
</div>




<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php } ?>
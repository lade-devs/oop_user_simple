<?php
error_reporting(0);

session_start();

class main extends config {

        protected  $confirm;
        protected $run;
    // USER FUNCTIONS
    function register($username,$email,$password){
    $username = strip_tags(mysqli_real_escape_string($this->db_connection(),$username));
    $email = strip_tags(mysqli_real_escape_string($this->db_connection(),$email));
    $password = strip_tags(mysqli_real_escape_string($this->db_connection(),$password));
    $password = md5($password);

    $check = " SELECT * FROM `users` WHERE `username`='$username' OR `email`='$email'";
    $this->run =$this->db_connection()->query($check);
    $vav = $this->run->num_rows;

    if($vav==0) {

        $insert = " INSERT INTO `users`(`username`,`email`,`password`) VALUES('$username','$email','$password') ";
        $this->confirm = $this->db_connection()->query($insert);


        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = $username;
        return true;
    }
    else{
        return false;
    }

    }
    function login($user_info,$user_pass){

        $user_info = strip_tags(mysqli_real_escape_string($this->db_connection(),$user_info));
        $password = strip_tags(mysqli_real_escape_string($this->db_connection(),$user_pass));

        $password = md5($password);

        $this->run = " SELECT * FROM `users` WHERE `username`='$user_info' and `password`='$password' or `email`='$user_info' and `password`='$password'  ";
        $this->confirm =$this->db_connection()->query($this->run);
        $username = $this->confirm->fetch_array(MYSQLI_ASSOC);
        $user_logged = $username['username'];
        $vav = $this->confirm->num_rows;
        if($vav == 1){
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = $user_logged;
            return true;
        }
        else{
            return false;
        }

    }
    function update_profile($username,$email,$pass,$logged_user){
        $username = strip_tags(mysqli_real_escape_string($this->db_connection(),$username));
        $email = strip_tags(mysqli_real_escape_string($this->db_connection(),$email));
        $pass = strip_tags(mysqli_real_escape_string($this->db_connection(),$pass));


        $this->run = " SELECT * FROM `users` WHERE `username`='$logged_user' ";
        $this->confirm = $this->db_connection()->query($this->run);
        $get_old = $this->confirm->fetch_array(MYSQLI_ASSOC);
        $old_user = $get_old['username'];
        $old_email = $get_old['email'];


        if($username == ''){$user_name = $old_user;}else{$user_name = $username;}
        if($email == ''){$user_email = $old_email;}else{$user_email = $email;}
        if($pass == ''){

            $this->run = " UPDATE `users` SET `username`='$user_name',`email`='$user_email' WHERE `username`='$logged_user'";
            $this->confirm = $this->db_connection()->query($this->run);
            if(!$this->confirm){
                echo "error";
            }
            else{
                $this->end_session();
            }

        }else{
            $pass = md5($pass);
            $user_pass = $pass;
            $this->run = " UPDATE `users` SET `username`='$user_name',`email`='$user_email',`password`='$user_pass' WHERE `username`='$logged_user'";
            $this->confirm = $this->db_connection()->query($this->run);
            if(!$this->confirm){
                echo "error";
            }
            else{
                $this->end_session();
            }
        }







    }
    function get_username($logged_user){

        $this->run = " SELECT * FROM `users` WHERE `username`='$logged_user' ";
        $this->confirm = $this->db_connection()->query($this->run);
        $username = $this->confirm->fetch_array(MYSQLI_ASSOC);
        echo $username['username'];
    }
    function get_email($logged_user){
        $this->run = " SELECT * FROM `users` WHERE `username`='$logged_user' ";
        $this->confirm = $this->db_connection()->query($this->run);
        $email= $this->confirm->fetch_array(MYSQLI_ASSOC);
        echo $email['email'];
    }

    // SESSION FUNCTIONS
    function set_session(){
        return $_SESSION['auth'];
    }
    function check_session(){
        if($this->set_session()== true){
            return true;
        }
        else{
            return false;
        }

    }
    function end_session(){
        $_SESSION =  session_destroy();
        header('Location: index.php');
        return $_SESSION ;
    }

    // REDIRECTION FUNCTIONS
    function redirect_reg(){
        header("location:backend.php");

    }
    function redirect_login(){
        header("location:backend.php");
    }




}


?>
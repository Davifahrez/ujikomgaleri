<?php
    require "../../config/conn.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $user_name_email = $_POST['user_name_email'];
        $user_pwd = $_POST['user_pwd'];
        $query = $conn->query("select * from users where user_name = '$user_name_email' OR user_email = '$user_name_email'");
        if($query->num_rows > 0){
            $q = $query->fetch_assoc();
            if(password_verify($user_pwd, $q['user_pwd'])){
                session_start();
                $_SESSION['user_name'] = $q['user_name'];
                $_SESSION['user_id'] = $q['id'];
                $_SESSION['user_email'] = $q['user_email'];
                header('location:../../index.php?page');
            }else{
                session_start();
                $_SESSION['pwderror'] = 'true';
                header("location: login.php");
            }
        }else{
            session_start();
            $_SESSION['usererror'] = 'true';
            header("location: login.php");
        }
    }else{
        header("location: login.php?nouserfound");
}
?>
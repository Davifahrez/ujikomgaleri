<?php
    require '../../config/conn.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_name = $_POST['user_name'];
        $user_pwd = password_hash($_POST['user_pwd'], PASSWORD_BCRYPT);
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_fullname = $_POST['user_fullname'];

        $query = $conn->query("insert into users (user_name,user_pwd,user_email,user_address,user_fullname) values ('$user_name','$user_pwd','$user_email','$user_address','$user_fullname')");
        if ($query){
            header("location: login.php?registerberhasil");
            exit();
        }
        else{
            echo "Error.";
        }
    }
?>
<?php
    require '../../../config/conn.php';
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $album_name = $_POST['album_name'];
        $album_desc = $_POST['album_desc'];
        $album_users = $_SESSION['user_id'];

        $query = "insert into albums (album_name, album_desc, users_id) values ('$album_name', '$album_desc', '$album_users')";
        $result = $conn->query($query);
        if($result){
            header("location:../../../index.php?page=albums");
        }
    }

?>
<?php
require '../../../config/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $photoTitle = $_POST['photo_title'];
    $photoDesc  = $_POST['photo_desc'];
    $userId     = $_SESSION['user_id'];
    $albumId = $_POST['album_id'];

    $photoFile     = $_FILES['photo_file'];
    $photoFileName = $photoFile['name'];

    $targetDir = '../../../galeri/';

    if(!is_dir($targetDir)){
        mkdir($targetDir);
    }

    move_uploaded_file($photoFile['tmp_name'], $targetDir . $photoFileName);

    $query = "INSERT INTO photos (photo_file, photo_title, photo_desc, users_id, albums_id, created_at)
              VALUES ('$photoFileName', '$photoTitle', '$photoDesc', '$userId', '$albumId', NOW())";

    $result = $conn->query($query);

    if ($result) {
        header("Location: ../../../index.php?page=photos");
    } else {
        echo "Error inserting photo: " . $conn->error;
    }
}
?>

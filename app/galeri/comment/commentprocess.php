<?php
require '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $photos_id = (int)$_POST['photos_id'];
    $user_id = (int)$_SESSION['user_id']; 

    $query = "INSERT INTO comments (comment, photos_id, users_id) VALUES ('$comment', $photos_id, $user_id)";
    
    if ($conn->query($query)) {
        header("Location: ../../../index.php?page=photos&status=success&photos_id=" . $photos_id);
    } else {
        header("Location: ../../../index.php?page=photos");
    }
    exit();
}
?>
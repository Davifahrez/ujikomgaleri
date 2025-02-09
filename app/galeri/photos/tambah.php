<?php
session_start();

require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    if (
        isset($_POST['photoFile'], $_POST['photoTitle'], $_POST['photoDesc'], $_POST['albumId']) &&
        !empty(trim($_POST['photoFile'])) &&
        !empty(trim($_POST['photoTitle'])) &&
        !empty(trim($_POST['photoDesc'])) &&
        !empty(trim($_POST['albumId']))
    ) {
        // Sanitize and assign variables.
        $photoFile  = $conn->real_escape_string(trim($_POST['photoFile']));
        $photoTitle = $conn->real_escape_string(trim($_POST['photoTitle']));
        $photoDesc  = $conn->real_escape_string(trim($_POST['photoDesc']));
        $albumId    = intval($_POST['albumId']);
        $userId     = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
        
        // If the user is not logged in, redirect them to the login page.
        if ($userId === 0) {
            header("Location: ../../login.php");
            exit;
        }

        // Prepare the INSERT query.
        // This assumes your `photos` table has the columns:
        // photo_file, photo_title, photo_desc, albums_id, users_id, created_at.
        $query = "INSERT INTO photos (photo_file, photo_title, photo_desc, albums_id, users_id, created_at)
                  VALUES ('$photoFile', '$photoTitle', '$photoDesc', '$albumId', '$userId', NOW())";

        // Execute the query.
        if ($conn->query($query)) {
            // On success, redirect back to the main page or gallery.
            header("Location: ../../index.php");
            exit;
        } else {
            // If there is an error, display it.
            echo "Error inserting photo: " . $conn->error;
        }
    } else {
        // If required fields are missing, show an error message.
        echo "All fields are required.";
    }
} else {
    // If not a POST request, redirect to the main page.
    header("Location: ../../index.php");
    exit;
}
?>

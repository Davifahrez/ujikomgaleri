<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
        require 'config/conn.php';
        session_start();
        if(!$_SESSION['user_name']){
            header("location:app/login/login.php");
        }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#">Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="?page=photos">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=albums">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=create">Create</a>
                    </li>
                    <li class="navbar-item">
                        <a class="btn btn-danger" href="?page=logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if($_GET['page'] == 'photos'){
        include 'app/galeri/photos/index.php';
    }else if($_GET['page'] == 'albums'){
        include 'app/galeri/albums/index.php';
    }else if($_GET['page'] == 'logout'){
        include 'app/login/logout.php';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
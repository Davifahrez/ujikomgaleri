<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="process.php" method="POST">
        <div class="container m-5 m-auto">
            <h1>Login to Galeri</h1>
            <div class="row">
                <div class="col mb-3">
                    <label for="Username-email" class="form-label">Username/Email</label>
                    <input type="text" name="user_name_email" class="form-control" required>
                </div> 
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="Username-email" class="form-label">Password</label>
                    <input type="password" name="user_pwd" class="form-control" required>
                </div>
            </div>
            Belum Punya akun? <a href="register.php">Register</a>
            <div class="row">
                <div class="col">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> 
            </div>
        </div>
    </form>
    <?php
        session_start();
        if(isset($_SESSION['pwderror'])){
            echo "<script>alert('Salah Password!');</script>";
            unset($_SESSION['pwderror']);
        }elseif(isset($_SESSION['usererror'])){
            echo "<script>alert('Salah Username!')</script>";
        }
        session_destroy();
    ?>

</body>
</html>
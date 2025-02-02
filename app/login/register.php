<?php
    require '../../config/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="process-reg.php" method="POST">
        <div class="container">
            <h1>Register to galeri</h1>
            <div class="row">
                <div class="col">
                    <label for="nameemail" class="label-control">Username</label>
                    <input type="text" class="form-control" name="user_name" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="user_pwd" class="label-control">Password</label>
                    <input type="password" class="form-control" name="user_pwd" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="user_email" class="label-control">Email</label>
                    <input type="email" class="form-control" name="user_email" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="user_fullname" class="label-control">User Fullname</label>
                    <input type="text" class="form-control" name="user_fullname" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="user_address" class="label-control">Address</label>
                    <input type="text" class="form-control" name="user_address" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a class="btn btn-danger mt-3" href="login.php">Back</a>
                    <button class="btn btn-primary mt-3" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
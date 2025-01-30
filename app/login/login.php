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
            <h1>Login to galeri</h1>
            <div class="mb-3">
                <label for="Username-email" class="form-label">Username/Email</label>
                <input type="text" name = "user_name_email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="Username-email" class="form-label">Password</label>
                <input type="password" name = "user_pwd" class="form-control">
            </div>
            <button class="btn btn-danger">Reset</button>
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>
</html>
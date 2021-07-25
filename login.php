<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/login.css">
    <title>Basic</title>
</head>

<body>
    <div class="center card">
        <form action="login.php" class="" method="POST">
            <?php
            session_start();
            $valUsername = "user";
            $valPassword = "123";
            if (isset($_POST["username"]) && isset($_POST["password"])) {
                if (trim($_POST["username"]) == $valUsername && trim($_POST["password"] == $valPassword)) {
                    $_SESSION["logged"]= true;
                    echo "logged";
                    header("location: index.php");
                    exit;
                } else {
                    $_SESSION["logged"]= false;
                    echo '<div class="alert alert-danger row justify-content-sm-center" role="alert"> Wrong password or username. </div>';
                }
            }
            ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="row justify-content-sm-center">
                    <input type="text" name="username" class="form-control" required />
                </div>
            </div>
            <label for="password" class="form-label">Password</label>
            <div class="row justify-content-sm-center">
                <input type="password" name="password" class="form-control" required />
            </div>
            <br>
            <!-- basename($_SERVER('PHP_SELF')) -->
            <div class="row justify-content-sm-center">
                <input type="submit" class="btn btn-warning" value="Login">
            </div>
        </form>
    </div>
    <script type="text/javascript">
    </script>
</body>

</html>
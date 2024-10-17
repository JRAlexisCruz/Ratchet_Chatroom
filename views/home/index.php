<?php
    $usernameError = "";
    $passwordError = "";
    $username= "";
    session_start();
    if(isset($_SESSION['usernameError'])){
        $usernameError = $_SESSION['usernameError'];
        unset($_SESSION['usernameError']);
    }
    if(isset($_SESSION['passwordError'])){
        $passwordError = $_SESSION['passwordError'];
        $username=$_SESSION['username'];
        unset($_SESSION['passwordError']);
        unset($_SESSION['username']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <title>Login</title>
</head>

<body class="d-flex flex-column align-items-center">
    <main class="d-flex flex-column">
        <form action="action.php" id="login" class="mt-3" method="post">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-6">
                    <h1>Login</h1>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-6">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" id="username" type="text" class="form-control md-6" value="<?=$username?>">
                    <label for="username" id="username-error" class="error"><?=$usernameError?></label>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-1">
                <div class="col-6">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" id="password" type="password" class="form-control">
                    <label for="password" id="password-error" class="error"><?=$passwordError?></label>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-3">
                <input type="hidden" name="action" value="login">
                <button type="submit" class="btn btn-primary submitButton">Login</button>
            </div>
        </form>
        <p class="mt-1 align-self-center">Don't have an account? Go to <a href="register.php">register</a></p>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="../js/formValidation.js"></script>
</body>

</html>
<?php
    session_start();
    $username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <title>Home</title>
</head>
<body class="d-flex flex-column align-items-center">
    <main class="d-flex flex-column">
        <h1 class="align-self-center">Welcome <?=$username?></h1>
        <h2 id="active-users" class="align-self-start"></h2>
        <div id="chat-messages" class="d-flex flex-column">
            
        </div>
        <form action="" method="post" id="message-form">
            <div class="input-group">
                <textarea class="form-control" placeholder="Enter your message" id="user-message"></textarea>
                <input type="hidden" name="username" id="username" value="<?=$username?>">
                <button type="submit" id="send" class="btn btn-primary submitButton">Send</button>
            </div>
        </form>
    </main>     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="../js/messageSending.js"></script>
</body>
</html>

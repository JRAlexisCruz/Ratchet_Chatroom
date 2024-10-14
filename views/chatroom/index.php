<?php
include_once '../../utils/functions.php';
$data=data_submitted();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php if($_SESSION['loginStatus']): ?>
        <h1>Welcome <?=$_SESSION['username']?></h1>
        <div id="chat_messages">

        </div>
        <form action="" method="post" id="message_form">
            <label for="user_message">Enter your message</label>
            <input type="text" name="user_message" id="user_message">
            <input type="hidden" name="username" id="username" value="<?=$_SESSION['username']?>">
            <button type="submit" id="send">Send</button>
        </form>
    <?php else: ?>
        <h1>Error</h1>
        <p><?=$_SESSION['message']?></p>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="../js/messageSending.js"></script>
</body>
</html>

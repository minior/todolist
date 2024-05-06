<?php
session_start(); 
//defining variables: username, 
if (isset($_SESSION['username'])) {
    $username=' '.$_SESSION['username'];
} else {
    $username="";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>minior's To-Do List</title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width">
        <!-- css style sheet -->
    </head>
<body>
    <?= '<h1> Welcome'. $username.'! </h1>' ?>
    <p> Start your productivity session, or <a href="login.php">Log In</a> to access your saved lists </p>
</body>
</html>

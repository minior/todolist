<?php
require_once "pdo.php";
require_once "php-accounthandling.php";
require_once "php-formhandling.php";
require_once "php-messagedisplay.php";

//redir if logged in
if(isset($_SESSION['user_id'])) {
    $_SESSION['errormsg'] = 'Already logged in.';
    header('location: index.php'. $_SESSION['user_id']);
    exit;
}

session_start();
//validate and insert form data
if (isset($_POST['create'])) {
    accountCreate($pdo, $_POST['username'], $_POST['email'], $_POST['pw'], $_POST['cfmpw']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Account Creation </title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width">
    <!-- css style sheet -->
</head>
<body>
    <h1> Create an account to store your tasks! </h1>
    <p> Please enter your user details </p>
    <?php displayMessage(); ?>
    <form method = "POST">
        <label for='username'> Username </label>
        <input type='text' name='username' id='username'>
        <label for='email'> Email Address </label>
        <input type='text' name='email' id='email'>
        <label for='pw'> Password </label>
        <input type='password' name='pw' id='pw'>
        <label for='cfmpw'> Confirm Password </label>
        <input type='password' name='cfmpw' id='cfmpw'>
        <input type='submit' name='create' value='Create' onclick='return createValidate();'>
        <input type='submit' name='cancel' value='Cancel'>
    </form>
<script src="js-accounthandling.js"></script>
</body>
</html>
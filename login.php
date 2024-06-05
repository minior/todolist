<?php
require_once "pdo.php";
require_once "php-formhandling.php";
require_once "php-messagedisplay.php";

//check if cancel button is pressed
if(isset($_POST['cancel'])) {
    header('Location: index.php');
    exit;
}
session_start();
//if logged in, redir to index
if(isset($_SESSION['user_id'])) {
    header("location: index.php". $_SESSION['user_id']);
    exit;
}
//validate user info (require & call fn)
if(isset($_POST['login'])) {
    loginValidate($pdo, $_POST['username'] ?? '', $_POST['pw'] ?? '');
}
//check for match  (maybe in loginValidate function)
?>
<!DOCTYPE html>
<html>
    <head>
    <title> Login Page </title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width">
        <!-- css style sheet -->
    </head>     
<body>
    <h1> Enter Login Details </h1>
<?php displayMessage(); ?>
<form method = "POST">
    <label for ='username'> Username </label>
    <input type ='text' name='username' id='username'> </br>
    <label for ='pw'> Password </label>
    <input type ='password' name='pw' id='pw'> </br>
    <input type='submit' name='login' value='Log In' onclick='return loginValidate();'>
    <input type='submit' name='cancel' value='Cancel'>
</form>
    <p> Don't have an account? <a href="accountcreate.php">Create one!</a> </p> 
<script src="js-formvalidation.js"></script>
<script>
    // show password
</script>
</body>
</html>

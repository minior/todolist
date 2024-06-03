<?php
require_once "pdo.php";
require_once "php-formhandling.php";

//check if cancel button is pressed
if(isset($_POST['cancel'])) {
    header('Location: index.php');
    exit;
}
session_start();
//NOT DONE if logged in, redir to index (add user_id GET info)
if(isset($_SESSION['user_id'])) {
    header("location: index.php");
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
<?php
if (isset($_SESSION['errormsg'])) {
    echo ("<p style='color:red;'><strong>" . htmlentities($_SESSION['errormsg'])."</strong></p>\n");
    unset($_SESSION['errormsg']);
}
?>
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

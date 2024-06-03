<?php
require_once "pdo.php";
require_once "accounthandling.php";
require_once "fn-formhandling.php";

//redir if logged in
if(isset($_SESSION['user_id']))

session_start();
//insert user info (require & call) 
if (isset($_POST['create'])) {
    accountCreate($pdo, $_POST['username'], $_POST['email'], $_POST['pw']);
}


//edit / delete  (require and call) (diff pages)
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
    <form method = "POST">
        <label for='username'> Username </label>
        <input type='text' name='username' id='username'>
        <label for='email'> Email Address </label>
        <input type='text' name='email' id='email'>
        <label for='pw'> Password </label>
        <input type='password' name='pw' id='pw'>
        <label for='cfmpw'> Confirm Password </label>
        <input type='password' name='cfmpw' id='cfmpw'>
        <input type='submit' name='create' value='Create'>
        <input type='submit' name='cancel' value='Cancel'>
    </form>
<script>
    // js validation + show password
</script>
</body>
</html>
<?php
require_once "pdo.php";

//check if cancel button is pressed
if(isset($_POST['cancel'])) {
    header('Location = index.php');
    return;
}

session_start();
//if logged in, redir to index 
if(isset($_SESSION['username'])) {
    header("location: index.php");
    return;
}

//validate user info (require & call fn)

//insert user info (require & call)


//edit / delete / create user (require and call)
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
}
?>
<form method = "POST">
    <label for ='username'> Username </label>
    <input type ='text' name='username' id='username'> </br>
    <label for ='pw'> Password </label>
    <input type ='text' name='pw' id='pw'> </br>
    <input type='submit' value='Log In' onclick='return loginValidate();'>
    <input type='submit' name='cancel' value='Cancel'>
</form>
    <p> Don't have an account? <a href="accountcreate.php">Create one!</a> </p> 
<script src="js-formvalidation.js"></script>
<script>
    // show password
</script>
</body>
</html>

<?php
require_once "pdo.php";

//check if cancel button is pressed
session_start();
//if logged in, redir to index 
if(isset($_SESSION['username'])) {
    header("location: index.php");
    return;
}

//insert user info


//edit / delete / create user
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
</form>
    <p> Don't have an account? <a href="accountcreate.php">Create one!</a> </p> 
<script>
    // show password
</script>
</body>
</html>

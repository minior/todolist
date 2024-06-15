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
    header("location: index.php?user_id=". $_SESSION['user_id']);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <style>
        body {
            text-align:center;
            margin-top: 100px;
            color:#1c1c1c;
            font-family: "Varela Round", sans-serif;
            font-weight: 400;
            font-style: normal;
            line-height:200%;
        }
        h1 {
            color:#2e2e2e
        }
        .container {
            border: solid #250c66 2px;
            border-radius: 40px;
            display: inline-block;
            padding: 10px 30px 40px 30px;
            box-shadow: 10px 10px 20px #160347;
            background-color:#f1f0ff;
        }
        a {
            color: blue;
            text-decoration: none;
        }
        a:hover {
            color:blue;
            text-decoration: wavy underline;
        }
        .inputs {
            float:right;
            width: 50%;
            margin-right: 25px;
            margin-top: 3px;
        }
        .labels {
            float:left;
            margin-left: 25px;
        }
    </style>    
</head>     
<body>
<div class = 'container'>
    <h1> Enter Login Details </h1>
<?php displayMessage(); ?>
<form method = "POST">
    <label class='labels' for ='username'> Username </label>
    <input class='inputs' type ='text' name='username' id='username'> </br>
    <label class='labels' for ='pw'> Password </label>
    <input class='inputs' type ='password' name='pw' id='pw'> </br>
    <input type='submit' name='login' value='Log In' onclick='return loginValidate();'>
    <input type='submit' name='cancel' value='Cancel'>
</form>
    <p> Don't have an account? <a href="accountcreate.php">Create one!</a> </p> 
</div>
<script src="js-formvalidation.js"></script>
<script>
    // show password
</script>
</body>
</html>

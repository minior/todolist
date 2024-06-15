<?php
require_once "pdo.php";
require_once "php-accounthandling.php";
require_once "php-formhandling.php";
require_once "php-messagedisplay.php";

session_start();
//redir if logged in
if(isset($_SESSION['user_id'])) {
    $_SESSION['errormsg'] = 'Already logged in.';
    header('location: index.php?user_id='. $_SESSION['user_id']);
    exit;
}

//check if cancel button is pressed
if(isset($_POST['cancel'])) {
    header('Location: index.php');
    exit;
}

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
            margin-top: 3px;
        }
        .labels {
            float:left;
        }
    </style>
</head>
<body>
<div class='container'>
    <h1> Create an account </br>to store your tasks! </h1>
    <p> Please enter your user details: </p>
    <?php displayMessage(); ?>
    <form method = "POST">
        <label class='labels' for='username'> Username </label>
        <input class='inputs' type='text' name='username' id='username'> </br>
        <label class='labels' for='email'> Email Address </label>
        <input class='inputs' type='text' name='email' id='email'> </br>
        <label class='labels' for='pw'> Password </label>
        <input class='inputs' type='password' name='pw' id='pw'> </br>
        <label class='labels' for='cfmpw'> Confirm Password </label>
        <input class='inputs' type='password' name='cfmpw' id='cfmpw'> </br>
        <input type='submit' name='create' value='Create' onclick='return createValidate();'> </br>
        <input type='submit' name='cancel' value='Cancel'>
    </form>
</div>
<script src="js-accounthandling.js"></script>
</body>
</html>
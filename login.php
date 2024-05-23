<?php
require_once "pdo.php";

//check if cancel button is pressed
session_start();
//if logged in, redir to index
if(isset($_SESSION['username'])) {
    header('location: index.php');
    return;
}

//insert user info

//edit / delete / create user
?>
<!DOCTYPE html>
<html>
<head>
  
</head>
<body>
  
</body>
</html>

<?php
require_once "pdo.php";
require_once "php-messagedisplay.php";

session_start(); 
//check if logout button is pressed
if (isset($_SESSION['logout'])) {
    session_unset();
    $_SESSION['successmsg'] = 'logout successful';
    header('Location: index.php');
    exit;
}
//defining variables: username, user_id?
if (isset($_SESSION['user_id'])) {
    $username=' '.$_SESSION['username'];
} else {
    $username="";
}
//retrieve database entries (taskid, task, status, deadline, uid tagged to task)
if (isset($_SESSION['username'])) {
    $stmt = $pdo->prepare('SELECT * FROM users JOIN tasks ON users.user_id=tasks.user_id WHERE user_id=:uid');
    $stmt->execute(array(':uid' => $_SESSION['user_id']));
    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
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
<?= '<h1> Welcome'. htmlentities($username).'! </h1>' ?>
<?php displayMessage(); ?>
<p> Start your productivity session, or <a href="login.php">Log In</a> to access your saved lists </p>
<!-- javascript buttons etc. for populating task field . see coursera courses 9 & 10 -->
<!-- logout -->
</body>
</html>

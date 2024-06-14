<?php
require_once "pdo.php";
require_once "php-messagedisplay.php";

session_start(); 
//check if logout button is pressed
if (isset($_POST['logout'])) {
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
//NOT DONE submit new task data
if (isset($_POST['save'])) {
    echo 'save button working';
}
//retrieve database entries (taskid, task, status, deadline, uid tagged to task)
if (isset($_SESSION['username'])) {
    $stmt = $pdo->prepare('SELECT * FROM users JOIN tasks ON users.user_id=tasks.user_id WHERE users.user_id=:uid');
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
<?php 
    displayMessage(); 
    if (!isset($_SESSION['username'])) {
        echo ("<p> Start your productivity session, or <a href='login.php'>Log In</a> to access your saved lists </p>");
    } else {
        echo ("Continue your productivity sessions!");
    }
    echo ("<form method='POST'>");
    if (isset($_SESSION['username'])) {
        echo ("<input type='submit' name='logout' value='Logout'>");
    }
?>
    <input type='submit' name='save' value='Save'>
    <input type='button' id='addtask' value='+'>
    <div id='taskfield'>
<?php
//iterate task rows
if (isset ($_SESSION['username'])) {
    $taskcount = 1;
    foreach($rows as $row) {
        //NOT DONE deadline sorting
        if ($row['status'] == '1') {$checked = "checked";} else {$checked = '';}
        echo("<div id='task" . $taskcount . "'>");
        echo("<input type='checkbox' name='status" . $taskcount . "' $checked >");
        echo("<input type='text' name='task" . $taskcount . "' value='" . $row['task'] . "'>");
        echo("<input type='date' name='deadline" . $taskcount . "' value='" . $row['deadline'] . "'>");
        echo('<input type="button" value="-" onclick="document.getElementById(\'task' . $taskcount . '\').remove()">');
        echo("</div>");
        $taskcount++;
    }
}
echo("</div>");
if ($taskcount > 2) {
    error_log('user '.$_SESSION['username'].' has submitted a total of '. $taskcount .' tasks!');
}
?>
</form>
<!-- javascript buttons etc. for populating task field . see coursera courses 9 & 10 -->
<script>
    let taskcount = <?=$taskcount?>;
</script>
<script src="js-addtask.js"></script>
<script> console.log('task counter:'+(taskcount-1));</script>
<!-- logout -->
</body>
</html>

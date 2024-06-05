<?php
//pass $pw and $username of variables to be defined
function loginValidate($pdo, $username, $pw) {
    if(( strlen($pw) < 1 ) || ( strlen($username) < 1 )) {
        $_SESSION['errormsg'] = 'Please fill out both fields.';
        header ('location: login.php');
        return;
    } else {
        //check for database match
        $pwcheck = password_hash($pw, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('SELECT user_id, username FROM users WHERE username=:un AND password = :pw');
        $stmt -> execute(array( ':un' => $username, ':pw' => $pwcheck));
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        if ( $row === false ) {
            error_log("login failed" . $username . $pwcheck);
            $_SESSION['errormsg'] = 'Incorrect username or password.';
            header ('location: login.php');
            return;
        } else {
            error_log("login success" . $username . $pwcheck);
            $_SESSION['successmsg'] = 'Welcome back!';
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            header ('location:index.php'. $_SESSION['user_id']);
            return;
        }
    }
}
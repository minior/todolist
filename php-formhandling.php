<?php
//pass $pw and $username of variables to be defined
function loginValidate($pdo, $username, $pw) {
    if(( strlen($pw) < 1 ) || ( strlen($username) < 1 )) {
        $_SESSION['errormsg'] = 'Please fill out both fields.';
        header ('location: login.php');
        exit;
    } else {
        //check for database match (check username first)
        $stmt = $pdo->prepare('SELECT user_id, username, password FROM users WHERE username=:un');
        $stmt -> execute(array( ':un' => $username ));
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        if ( $row === false ) {
            error_log("login failed, attempted username:" . $username );
            $_SESSION['errormsg'] = "Username not registered. <a href='accountcreate.php'>Create</a> an account now!";
            header ('location: login.php');
            exit;
        } else {
            $pwhashed = $row['password'];
            $pwcheck = password_verify($pw, $pwhashed);
            if ($pwcheck === false) {
                error_log("login failed, wrong password:" . $username . $pw);
                $_SESSION['errormsg'] = "Incorrect password, perhaps try <a href='https://bitwarden.com/'>Bitwarden</a>!";
                header ('location: login.php');
                exit;
            } else {
            error_log("login success" . $username . $pw);
            $_SESSION['successmsg'] = 'Welcome back!';
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            header ('location:index.php?user_id='. $_SESSION['user_id']);
            exit;
            }   
        }
    }
}
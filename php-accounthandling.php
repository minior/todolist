<?php
function accountCreate($pdo, $username, $email, $pw, $cfmpw) {
    //username & email validate
    if(( strlen($username) < 1 ) || ( strlen($email) < 1 ) || ( strlen($pw) < 1 )) {
        $_SESSION['errormsg'] = 'Please fill out all fields. Is this not obvious?';
        header ('location: accountcreate.php');
        exit;
    } elseif (!ctype_alnum(str_replace('_', '', $username))) {
        $_SESSION['errormsg'] = 'Username can only contain alphanumeric characters, or underscores. No spaces too!';
        header ('location: accountcreate.php');
        exit;
    } elseif ( !((str_contains($email, '@')) && ( (str_contains($email, '.co')) || (str_contains($email, '.net')) || (str_contains($email, '.edu')) || (str_contains($email, '.org')) ) )) {
        $_SESSION['errormsg'] = 'Check if email address is valid.';
        header ('location: accountcreate.php');
        exit;
    } else {
    //check for match from database (email, then username)
        $stmt = $pdo->prepare('SELECT email FROM users where email=:em');
        $stmt->execute(array(':em'=>$email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            $_SESSION['errormsg'] = 'Email address is already registered. I\'m hurt you don\'t remember.';
            header('location: accountcreate.php');
            exit;
        } else {
            $stmt = $pdo->prepare('SELECT username FROM users where username=:un');
            $stmt->execute(array(':un'=>$username));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                $_SESSION['errormsg'] = 'Username is taken. You are not so special after all.';
                header('location: accountcreate.php');
                exit;
            } else {
                //pw validation (at least 1 letter and at least 1 digit) & pw match w cfmpw
                if (!(preg_match('/[A-Z]/i', $pw) && preg_match('/[0-9]/i', $pw)) || strlen($pw < 8)) {
                    $_SESSION['errormsg'] = 'Password must contain at least one letter and one digit, & be at least 8 characters long';
                    header ('location: accountcreate.php');
                    exit;
                } elseif ($pw !== $cfmpw) {
                    $_SESSION['errormsg'] = 'Passwords do not match. Are dyslexic you?';
                    header ('location: accountcreate.php');
                    exit;
                } else {
                //else insert w pw hashing
                $pwhashed = password_hash($pw, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES ( :un, :em, :pw )');
                $stmt -> execute(array(':un'=>$username, ':em'=>$email, ':pw'=>$pwhashed));
                $_SESSION['user_id'] = $pdo->lastinsertid();
                $_SESSION['username'] = $username;
                $_SESSION['successmsg'] = 'Account successfully created. Enjoy!';
                //add concatenate with user_id to have task info
                header('location: index.php?user_id='. $_SESSION['user_id']);
                exit;
                }
            }
        }
    }
}
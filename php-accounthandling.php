<?php
function accountCreate($pdo, $username, $email, $pw) {
    //validate
    if(( strlen($username) < 1 ) || ( strlen($email) < 1 ) || ( strlen($pw))) {
        $_SESSION['errormsg'] = 'Please fill out both fields.';
        header ('location: accountcreate.php');
        return;
    } elseif ( !(str_contains($email, '@')) && ( (str_contains($username, '.co')) || (str_contains($username, '.net')) || (str_contains($username, '.edu')) || (str_contains($username, '.org')) ) ) {
        $_SESSION['errormsg'] = 'Check if email address is valid.';
        header ('location: accountcreate.php');
        return;
    } else {
    //check for match from database
        $stmt = $pdo->prepare('SELECT username, email FROM users where username=:un OR email=:em');
        $stmt->execute(array(':un'=>$username, ':em'=>$email));
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($row !== false) {
            if ($row['email'] = $email) {
                $_SESSION['errormsg'] = 'Email address is already registered.';
                header('location: accountcreate.php');
                return;
            } elseif ($row['username'] = $username) {
                $_SESSION['errormsg'] = 'Username is taken.';
                header('location: accountcreate.php');
                return;
            }
        } else {
            //NOT DONE else insert (add pw hashing)
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES ( :un, :em, :pw )');
            $stmt -> execute(array(':un'=>$username, ':em'=>$email, ':pw'=>$pw));
            $_SESSION['user_id'] = $pdo->lastinsertid();
            $_SESSION['username'] = $username;
            $_SESSION['successmsg'] = 'Account successfully created. Enjoy!';
            //NOT DONE add concatenate with user_id to have task info
            header('location: index.php');
            exit;
        }
    }
}
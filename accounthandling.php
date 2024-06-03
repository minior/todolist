<?php
function accountCreate($pdo, $username, $email, $pw) {
    //validate
    if(( strlen($username) < 1 ) || ( strlen($email) < 1 ) || ( strlen($pw))) {
        $_SESSION['errormsg'] = 'Please fill out both fields.';
        header ('location: login.php');
        return;
    } elseif ( !(str_contains($email, '@')) && ( (str_contains($username, '.co')) || (str_contains($username, '.net')) || (str_contains($username, '.edu')) || (str_contains($username, '.org')) ) ) {
        $_SESSION['errormsg'] = 'Check if email address is valid.';
        header ('location: login.php');
        return;
    } else {
    //insert
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES ( :un, :em, :pw )');
    $stmt -> execute(array(':un'=>$username, ':em'=>$email, ':pw'=>$pw));
    }
}
<?php
//ensure 1. @ is present in email and 2. contains .com/.edu etc.
function loginValidate() {
    $pw = $_POST['pw'];
    $username = $_POST['username'];
    if( ! isset($pw) || ( ! isset($username))) {
        $_SESSION['errormsg'] = 'Please fill out both fields.';
    } elseif {
        //TODO (2)
    }
}
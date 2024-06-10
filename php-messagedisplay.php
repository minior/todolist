<?php
function displayMessage() {
    if (isset($_SESSION['errormsg'])) {
        echo ("<p style='color:red;'><strong>" . ($_SESSION['errormsg'])."</strong></p>\n");
        unset($_SESSION['errormsg']);
    }
    if (isset($_SESSION['successmsg'])) {
        echo ("<p style='color:green;'><strong>" . ($_SESSION['successmsg']) . "</strong></p>\n");
        unset($_SESSION['successmsg']);
    }
}
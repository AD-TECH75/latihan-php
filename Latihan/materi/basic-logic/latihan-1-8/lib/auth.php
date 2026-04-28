<?php
$timeout = 900;

if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $timeout) {
    session_unset();
    session_destroy();
    header('location: /index.php');
    exit();
}
$_SESSION['last_activity'] = time();

function require_auth() {
    if (empty($_SESSION['auth'])) {
        header('loacation: /index.php');
        exit();
    }
}

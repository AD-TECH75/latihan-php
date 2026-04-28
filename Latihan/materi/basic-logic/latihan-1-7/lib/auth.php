<?php
function require_login() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['flash'] = 'you are not login';
        header('location: index.php');
        exit();
    }
}

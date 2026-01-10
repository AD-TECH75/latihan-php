<?php
session_start();
include 'koneksi.php';

function showMessage($type, $message){
    $_SESSION['message'] = [
        'type' => $type,
        'text' => $message,
    ];

}

function getMessage() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return null;
}

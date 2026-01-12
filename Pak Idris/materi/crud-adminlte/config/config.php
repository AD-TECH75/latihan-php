<?php
session_start();
include 'koneksi.php';

function showMessage($type, $message)
{
    $_SESSION['message'] = [
        'type' => $type,
        'text' => $message,
    ];
}

function getMessage()
{
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return null;
}

// membuat base url untuk memudahkan pengelolaan link
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$baseurl = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
define('BASE_URL', $protocol . '://' . $host . $baseurl);

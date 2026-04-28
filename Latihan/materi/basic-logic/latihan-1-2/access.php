<?php

function checkAccess() {
    // mengambil data atau get dari sebelum nya
    $token = $_GET['token'] ?? '';
    $role = $_GET['role'] ?? '';

    // Verification
    if ($token === "admin123" && $role === "admin") {
        return true;
    }

    return false;
} 

if (!checkAccess()) {
    header("location: index.php?log=error");
    exit();
}
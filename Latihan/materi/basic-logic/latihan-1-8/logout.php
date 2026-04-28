<?php
require_once __DIR__ . '/config/security_headers.php';

session_start();
session_unset();
session_destroy();

header('location: /index.php');
exit();
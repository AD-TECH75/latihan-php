<?php

require 'connection.php';

//? membuat base url untuk memudahkan pengelolaan link
// menentukan protocol dengan benar
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';

// root server (htdocs / public_html)
$documentRoot = rtrim(realpath($_SERVER['DOCUMENT_ROOT']), '/\\');

// root project (latihan-php)
$projectRoot = rtrim(realpath(dirname(__DIR__)), '/\\');

// ambil nama folder project
$projectFolder = trim(str_replace($documentRoot, '', $projectRoot), '/');

//! Define BASE_URL
define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . '/' . $projectFolder . '/');
//! Define BASE_PATH
define('BASE_PATH', $projectRoot . '/');
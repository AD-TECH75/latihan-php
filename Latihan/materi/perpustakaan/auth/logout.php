<?php 
session_start();

// menghapus semua session
session_unset();
session_destroy();

// menghapus cookie remember me 
setcookie("username", "", time() - 3600, "/", "", false, true);
setcookie("password", "", time() - 3600, "/", "", false, true);

header('location: ../index.php');
exit();
?>
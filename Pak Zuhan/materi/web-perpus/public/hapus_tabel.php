<?php
require_once "../includes/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table_name'];
    $key_col = $_POST['key_col'];
    $key_val = mysqli_real_escape_string($conn, $_POST['key_val']);

    $sql = "DELETE FROM $table WHERE `$key_col` = '$key_val'";
    mysqli_query($conn, $sql);
}

header("Location: admin.php");
exit;
?>

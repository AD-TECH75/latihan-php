<?php
require_once "../includes/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table_name'];
    $fields = $_POST['fields'];

    $columns = [];
    $values = [];

    foreach ($fields as $col => $val) {
        if ($val !== "") {
            $columns[] = "`$col`";
            $values[] = "'" . mysqli_real_escape_string($conn, $val) . "'";
        }
    }

    if (!empty($columns)) {
        $sql = "INSERT INTO $table (" . implode(",", $columns) . ") VALUES (" . implode(",", $values) . ")";
        mysqli_query($conn, $sql);
    }
}

header("Location: admin.php");
exit;
?>

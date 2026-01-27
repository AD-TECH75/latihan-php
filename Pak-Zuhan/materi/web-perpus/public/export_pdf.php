<?php
require_once "../includes/koneksi.php";
require_once "../fpdf186/fpdf.php";

$tabel = $_GET["tabel"];
$data = mysqli_query($conn, "SELECT * FROM $tabel");

$pdf = new FPDF("L", "mm", "A4");
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 14);
$pdf->Cell(0, 10, "Data dari tabel $tabel", 0, 1, "C");

$pdf->SetFont("Arial", "B", 10);
$fields = mysqli_fetch_fields($data);
foreach ($fields as $f) {
    $pdf->Cell(40, 10, $f->name, 1);
}
$pdf->Ln();

$pdf->SetFont("Arial", "", 10);
while ($r = mysqli_fetch_assoc($data)) {
    foreach ($r as $v) {
        $pdf->Cell(40, 10, $v, 1);
    }
    $pdf->Ln();
}

$pdf->Output("I", "data_$tabel.pdf");
?>

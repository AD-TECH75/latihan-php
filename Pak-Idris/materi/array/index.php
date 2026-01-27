<h3>Perulangan array</h3>

<?php 
    $buah = ["Mangga", "Apel", "Pisang", "Jeruk"];
    for ($i = 0; $i < count($buah); $i++) {
        echo "Saya mempunyai buah " . $buah[$i] . "<br>";
    }

    echo "<br>";

    $siswa = [
        "nik" => "902307203970",
        "nama" => "sahroni",
        "alamat" => "jl. merdeka no.45",
    ];
    
    foreach ($siswa as $key => $datasiswa) {
        echo $key . ": " . $datasiswa . "<br>";
    }

?>
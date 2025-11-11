<?php
    function hitungLuasPersegiPanjang($panjang, $lebar) {
        $luas = $panjang * $lebar;
        return $luas;
    };

    function hitungLuasPersegi() {
        $sisi = 4;
        $luas = $sisi * $sisi;
        return $luas;
    }

    function hitungLuasSegitiga($alas, $tinggi) {
        $luas = 0.5 * $alas * $tinggi;
        echo "Luas Segitiga: " . $luas . "<br>";
    }

    $hasilLuas = hitungLuasPersegiPanjang(10, 5);
    echo "Luas Persegi Panjang: " . $hasilLuas . "<br>";
    $hasilLuasPersegi = hitungLuasPersegi();
    echo "Luas Persegi: " . $hasilLuasPersegi . "<br>";
    hitungLuasSegitiga(6, 8);

    echo "<br>";

    function buatsandwich($roti, $isi, $saus) {
        return "Sandwich dengan roti " . $roti . ", isi " . $isi . ", dan saus " . $saus . ".<br>";
    }

    echo buatsandwich("Tawar", "Ayam", "Mayones");
    echo buatsandwich("Gandum", "Keju", "Sambal");
?>

<?php
    $sekolah = "SMA Negeri 1"; //variabel global

    function tampilkanDataSiswa($nama) {
        $kelas = "XII RPL"; //variabel lokal

        //menampilkan data siswa
        echo "<br>";
        echo "Nama Siswa: " . $nama . "<br>";
        echo "kelas: $kelas<br>";
        global $sekolah;
        echo "Sekolah: " . $sekolah . "<br>";
    }

    tampilkanDataSiswa("Budi");
?>
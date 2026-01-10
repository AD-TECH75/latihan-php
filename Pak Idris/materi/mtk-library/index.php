<?php
// 📚 LIBRARY FUNGSI MATEMATIKA UNTUK SISWA SMK

/**
 * Menghitung luas persegi
 */

function hitungLuasPersegi($sisi) {
    return $sisi * $sisi;
}   

/**
 * Menghitung keliling persegi
 */
function hitungKelilingPersegi($sisi) {
    return 4 * $sisi;
}

/**
 * Menghitung luas persegi panjang
 */
function hitungLuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

/**
 * Menghitung keliling persegi panjang
 */
function hitungKelilingPersegiPanjang($panjang, $lebar) {
    return 2 * ($panjang + $lebar);
}

/**
 * Menghitung luas segitiga
 */
function hitungLuasSegitiga($alas, $tinggi) {
    return 0.5 * $alas * $tinggi;
}

/**
 * Menghitung luas lingkaran
 */
function hitungLuasLingkaran($jariJari) {
    return 3.14 * pow($jariJari, 2);
}

/**
 * Menghitung keliling lingkaran
 */
function hitungKelilingLingkaran($jariJari) {
    return 2 * 3.14* $jariJari;
}

/**
 * Menghitung volume kubus
 */
function hitungVolumeKubus($sisi) {
    return pow($sisi, 3);
}

/**
 * Konversi Celcius ke Fahrenheit
 */
function celciusToFahrenheit($celcius) {
    return ($celcius * 9/5) + 32;
}

/**
 * Konversi Fahrenheit ke Celcius
 */
function fahrenheitToCelcius($fahrenheit) {
    return ($fahrenheit - 32) * 5/9;
}

/**
 * Menghitung BMI
 */
function hitungBMI($berat, $tinggi) {
    // tinggi dalam cm diubah ke meter
    $tinggiMeter = $tinggi / 100;
    $bmi = $berat / ($tinggiMeter * $tinggiMeter);
    return $bmi;
}

/**
 * Kategori BMI
 */
function kategoriBMI($bmi) {
    if ($bmi < 18.5) {
        return ["underweight", "#3498db", "💪"];
    } elseif ($bmi < 25) {
        return ["Normal", "#2ecc71", "👍"];
    } elseif ($bmi < 30) {
        return ["Gemuk", "#f39c12", "⚠️"];
    } else {
        return ["Obesitas", "red", "🚨"];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📐 Library matematika SMK</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <!-- demo bangun datar -->
    <div class="container">
        <h1>📐 Library Fungsi Matematika SMK</h1>

        <div class="card">
            <h2>📏 Bangun Datar</h2>
            <div class="grid">
                <div class="result">
                    <strong>Persegi (sisi = 5)</strong> <br>
                    Luas: <?= hitungLuasPersegi(5); ?> <br>
                    keliling: <?= hitungKelilingPersegi(5); ?> <br>
                </div>
                <div class="result">
                    <strong>persegi Panjang (4x6)</strong> <br>
                    Luas: <?= hitungLuasPersegiPanjang(4, 6); ?> <br>
                    keliling: <?= hitungKelilingPersegiPanjang(4, 6); ?> <br>
                </div>
                <div class="result">
                    <strong>Segitiga (alas = 8, tinggi = 5)</strong> <br>
                    Luas: <?= hitungLuasSegitiga(8, 5); ?> <br>
                </div>
                <div class="result">
                    <strong>Lingkaran (r = 7)</strong> <br>
                    Luas: <?= hitungLuasLingkaran(7); ?> <br>
                    keliling: <?= hitungKelilingLingkaran(7); ?> <br>
                </div>
            </div>
        </div>

        <!-- demo bangun ruang -->
        <div class="card">
            <h2>🧊 Bangun Ruang</h2>
            <div class="result">
                <strong>Kubus (sisi = 3)</strong> <br>
                Volume: <?= hitungVolumeKubus(3); ?> <br>
            </div>
        </div>

        <!-- demo konveksi suhu -->
        <div class="card">
            <h2>🌡️ Konversi Suhu</h2>
            <div class="grid">
                <div class="result">
                    <strong>25deg;C → Fahrenheit</strong> <br>
                    <?= round(celciusToFahrenheit(25), 2) ?>deg;F
                </div>
                <div class="result">
                    <strong>77deg;F → Celcius</strong> <br>
                    <?= round(fahrenheitToCelcius(77), 2) ?>deg;C
                </div>
            </div>
        </div>

        <!-- demo bmi calculator -->
        <div class="card">
            <h2>⚖️ BMI Calculator</h2>
            <div class="result">
                <?php
                $berat = 70; // dalam kg
                $tinggi = 175; // dalam cm 
                $bmi= hitungBMI($berat, $tinggi);
                list($kategori, $warna, $icon) = kategoriBMI($bmi);
                ?>

                <div class="result">
                    <strong>Data : <?= $berat; ?> kg, <?= $tinggi; ?> cm</strong> <br>
                    BMI: <?= round($bmi, 2); ?> <br>
                    <strong style="color : <?= $warna ?>"><?= $icon; $kategori; ?></strong>
                </div>
            </div>
        </div>
</body>

</html>
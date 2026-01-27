<h3>Fungsi matematika</h3>
<ol>
    <li><?= sqrt(25);?></li>
    <li><?= "pembulatan " . round(56.23)?></li>
    <li><?= "random " . rand(1, 100)?></li>
    <li><?= "nilai absolut " . abs(-90)?></li>
</ol>

<h3>Fungsi string</h3>
<?php $teks = "Smk Negeri Mojoagung" ?>
<ol>
    <li><?= "panjang teks " . strlen($teks)?></li>
    <li><?= "uppercase " . strtoupper($teks)?></li>
    <li><?= "lowercase " . strtolower($teks)?></li>
    <li><?= "kapital di awal kata " . ucwords($teks)?></li>
    <li><?= "replace " . str_replace("Negeri" , "N", $teks)?></li>
</ol>
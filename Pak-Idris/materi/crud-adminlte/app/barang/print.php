<?php
// print_simple.php
include 'config.php';
include 'fungsi.php';
// Ambil parameter pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';
// Ambil data
$result = getBarang($keyword, $kategori_filter);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Barang</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin-bottom: 5px;
        }

        .info {
            margin-bottom: 20px;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {

            font-weight: bold;
            background-color: #e8f4ff;
        }

        /* .no-print {
display: none;
} */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                padding: 0;
                margin: 0;
            }

            @page {
                size: portrait;
                margin: 1cm;
            }
        }
    </style>
</head>

<body>
    <!-- Tombol print hanya untuk browser -->
    <div class="no-print" style="margin-bottom: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff;
color: white; border: none; border-radius: 5px; cursor: pointer;">
            ️ Cetak Halaman
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background:
#6c757d; color: white; border: none; border-radius: 5px; cursor: pointer;">
            ✖️ Tutup
        </button>
    </div>
    <div class="header">
        <h1>LAPORAN DATA BARANG</h1>
        <p>Tanggal Cetak: <?php echo date('d/m/Y H:i:s'); ?></p>
    </div>
    <div class="info">
        <p><strong>Filter:</strong>
            <?php
            if (!empty($keyword)) echo ' Kata kunci: "' . htmlspecialchars($keyword) . '"';
            if (!empty($kategori_filter) && $kategori_filter != 'semua') echo ' Kategori: ' .
                htmlspecialchars($kategori_filter);
            ?>
        </p>
        <p><strong>Total Data:</strong> <?php echo mysqli_num_rows($result); ?>
            barang</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            $total_harga = 0;
            $total_stok = 0;
            while ($row = mysqli_fetch_assoc($result)):
                $total_harga += $row['harga'] * $row['stok'];
                $total_stok += $row['stok'];
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></td>
                </tr>
            <?php endwhile; ?>
            <!-- Total -->
            <tr class="total">
                <td colspan="3">TOTAL</td>
                <td>Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                <td><?php echo $total_stok; ?></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <p><strong>Ringkasan:</strong></p>
        <p>Total Data: <?php echo ($no - 1); ?> barang</p>
        <p>Total Nilai Barang: Rp <?php echo number_format($total_harga, 0, ',', '.'); ?>
        </p>
        <p>Rata-rata Harga: Rp <?php echo number_format(($no > 1) ? $total_harga /
                                    ($no - 1) : 0, 0, ',', '.'); ?></p>
    </div>
    <script>
        // Auto print saat halaman dimuat
        window.onload = function() {
            // Jika parameter auto_print ada, langsung print
            if (window.location.search.indexOf('auto_print') !== -1) {
                window.print();
            }
        };
    </script>
</body>

</html>
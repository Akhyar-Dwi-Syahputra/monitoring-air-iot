<?php
include "koneksi.php";

// Jika parameter 'hapus' diterima dari URL
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];

    // Query untuk menghapus data berdasarkan ID
    $query_hapus = mysqli_query($koneksi, "DELETE FROM tbmonitor WHERE id = '$id_hapus'");

    // Mengecek apakah query hapus berhasil dieksekusi
    if ($query_hapus) {
        // Redirect kembali ke halaman ini setelah menghapus
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        // Menampilkan pesan kesalahan jika query hapus gagal dieksekusi
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Query untuk mengambil semua data dari tabel tbmonitor
$query = mysqli_query($koneksi, "SELECT * FROM tbmonitor");

// Mengecek apakah query berhasil dieksekusi
if ($query) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keseluruhan Data Monitoring</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('air3.png');
            background-size: cover;
            background-repeat: no-repeat;
            color: blue;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: black;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .btn-back {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #008CBA; /* Warna biru */
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #007B9E; /* Warna biru lebih gelap */
        }

        .btn-hapus {
            padding: 6px 12px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-hapus:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>KESELURUHAN DATA MONITORING</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Waktu</th>
                <th>Nilai Turbidity</th>
                <th>Nilai Salinitas</th>
                <th>Nilai pH</th>
                <th>Aksi</th>
            </tr>
            <?php
            // Mengambil hasil query dan menampilkannya dalam bentuk tabel
            $query = mysqli_query($koneksi, "SELECT * FROM tbmonitor");
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['kekeruhan'] . "</td>";
                echo "<td>" . $row['garam'] . "</td>";
                echo "<td>" . $row['keasaman'] . "</td>";
                // Menambahkan tombol hapus dengan mengirimkan ID data
                echo "<td><button onclick='hapusData(" . $row['id'] . ")' class='btn-hapus'>Hapus</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="home.php" class="btn-back">Kembali</a>
    </div>

    <script>
        function hapusData(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "?hapus=" + id;
            }
        }
    </script>

</body>

</html>

<?php
} else {
    // Menampilkan pesan kesalahan jika query gagal dieksekusi
    echo "Error: " . mysqli_error($koneksi);
}
?>

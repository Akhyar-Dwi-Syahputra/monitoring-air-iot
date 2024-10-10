<?php
include "koneksi.php";

// Query untuk mengambil semua data dari tabel tbmonitor
$query = mysqli_query($koneksi, "SELECT * FROM tbmonitor");

// Mengecek apakah query berhasil dieksekusi
if ($query) {
    $dates = [];
    $turbidity_values = [];
    $salinity_values = [];
    $ph_values = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $dates[] = $row['tanggal'];
        $turbidity_values[] = $row['kekeruhan'];
        $salinity_values[] = $row['garam'];
        $ph_values[] = $row['keasaman'];
    }
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

        .chart-container {
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-back {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #45a049;
        }
    </style>
    <!-- Tambahkan link ke library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <h2>GRAFIK KESELURUHAN DATA MONITORING</h2>
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
        <a href="home.php" class="btn-back">Kembali</a>
    </div>

    <script>
        // Data untuk grafik
        const dates = <?php echo json_encode($dates); ?>;
        const turbidityValues = <?php echo json_encode($turbidity_values); ?>;
        const salinityValues = <?php echo json_encode($salinity_values); ?>;
        const phValues = <?php echo json_encode($ph_values); ?>;

        // Menggambar grafik menggunakan Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Nilai Turbidity',
                    data: turbidityValues,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Nilai Salinitas',
                    data: salinityValues,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Nilai pH',
                    data: phValues,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>

<?php
} else {
    // Menampilkan pesan kesalahan jika query gagal dieksekusi
    echo "Error: " . mysqli_error($koneksi);
}
?>
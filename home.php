<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Kualitas Air</title>
    <style>
        /* CSS */
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

        h1,
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
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #45a049;
        }

        .btn-detail, .btn-grafik {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #008CBA;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-detail:hover, .btn-grafik:hover {
            background-color: #007B9E;
        }

        /* Menambahkan gaya untuk status */
        .normal {
            color: green;
        }

        .warning {
            color: red;
        }

        /* Atur tanggal di tengah */
        .tanggal {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>MONITORING KUALITAS AIR</h1>

        <?php
        include "koneksi.php";

        $query = mysqli_query($koneksi, "SELECT * FROM tbmonitor ORDER BY id DESC LIMIT 1");
        if ($data = mysqli_fetch_array($query)) {
        ?>

            <!-- At
            <!-- Atur tanggal di tengah -->
            <p class="tanggal">Tanggal: <?php echo $data['tanggal']; ?></p>

            <table>
                <tr>
                    <th>Parameter</th>
                    <th>Nilai</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>Nilai Turbidity</td>
                    <td><?php echo $data['kekeruhan']; ?></td>
                    <td><?php echo ($data['kekeruhan'] <= 25) ? '<span class="normal">Sesuai Standar</span>' : '<span class="warning">Tidak Sesuai Standar</span>'; ?></td>
                </tr>
                <tr>
                    <td>Nilai Salinitas</td>
                    <td><?php echo $data['garam']; ?></td>
                    <td><?php echo ($data['garam'] <= 0.5) ? '<span class="normal">Sesuai Standar</span>' : '<span class="warning">Tidak Sesuai Standar</span>'; ?></td>
                </tr>
                <tr>
                    <td>Nilai pH</td>
                    <td><?php echo $data['keasaman']; ?></td>
                    <td><?php echo ($data['keasaman'] >= 6.5 && $data['keasaman'] <= 8.5) ? '<span class="normal">Sesuai Standar</span>' : '<span class="warning">Tidak Sesuai Standar</span>'; ?></td>
                </tr>
            </table>

            <?php
            // Menentukan apakah air layak dikonsumsi
            $layak_dikonsumsi = ($data['kekeruhan'] <= 25) && ($data['garam'] <= 0.5) && ($data['keasaman'] >= 6.5 && $data['keasaman'] <= 8.5);
            $status_konsumsi = $layak_dikonsumsi ? '<span class="normal">Layak Dikonsumsi</span>' : '<span class="warning">Tidak Layak Dikonsumsi</span>';
            ?>

            <p style="text-align: center; font-size: 18px; font-weight: bold;">Keterangan: <?php echo $status_konsumsi; ?></p>

            <a href="detail.php?id=<?php echo $data['id']; ?>" class="btn-detail">Detail</a>
            <a href="grafik.php" class="btn-grafik">Grafik</a>
        <?php
        } else {
            echo "<p class='tanggal'>Data belum tersedia</p>";
            echo "<table>
                <tr>
                    <th>Parameter</th>
                    <th>Nilai</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td colspan='3' style='text-align: center;'>Tidak ada data</td>
                </tr>
            </table>";
            echo "<a href='detail.php' class='btn-detail'>Detail</a>";
            echo "<a href='grafik.php' class='btn-grafik'>Grafik</a>";
        }
        ?>
    </div>

</body>

</html>

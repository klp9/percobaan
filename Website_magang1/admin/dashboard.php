<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../config/database.php';

/* ================= STATISTIK ================= */
$total = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM buku_tamu")
)['total'];

$hari = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM buku_tamu WHERE DATE(created_at)=CURDATE()")
)['total'];

$bulan = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM buku_tamu WHERE MONTH(created_at)=MONTH(CURDATE())")
)['total'];

/* ================= GRAFIK ================= */

/* Harian */
$q1 = mysqli_query($conn, "
    SELECT DATE(created_at) tgl, COUNT(*) total
    FROM buku_tamu
    GROUP BY DATE(created_at)
    ORDER BY tgl
");
$lh = $dh = [];
while ($r = mysqli_fetch_assoc($q1)) {
    $lh[] = $r['tgl'];
    $dh[] = $r['total'];
}

/* PIE DIAMANKAN (tanpa instansi) */
$li = ['Data'];
$di = [$total];

/* Bulanan */
$q3 = mysqli_query($conn, "
    SELECT MONTH(created_at) bln, COUNT(*) total
    FROM buku_tamu
    GROUP BY MONTH(created_at)
");
$lb = $db = [];
while ($r = mysqli_fetch_assoc($q3)) {
    $lb[] = 'Bulan ' . $r['bln'];
    $db[] = $r['total'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | DPRD</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            background:
                linear-gradient(rgba(238, 242, 247, .92), rgba(238, 242, 247, .92)),
                url('../assets/img/dpr.jpeg') center/cover no-repeat fixed;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #0a2540, #144272);
            color: #fff;
            padding: 32px 22px;
            box-shadow: 4px 0 25px rgba(0, 0, 0, .25);
        }

        .sidebar h2 {
            text-align: center;
            letter-spacing: 3px;
            margin-bottom: 50px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #e3f2fd;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 14px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: rgba(255, 255, 255, .18);
        }

        .icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* MAIN */
        .main {
            margin-left: 260px;
            padding: 36px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 36px;
            padding: 26px 30px;
            border-radius: 18px;
            background:
                linear-gradient(90deg,
                    rgba(10, 37, 64, .85),
                    rgba(10, 37, 64, .6),
                    rgba(10, 37, 64, .85)),
                url('../assets/img/dpr.jpeg') center/cover no-repeat;
            color: #fff;
        }

        .logout {
            background: #c62828;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        /* STAT */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 26px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: #fff;
            border-radius: 18px;
            padding: 28px;
            position: relative;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .08);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 6px;
            height: 100%;
            background: #144272;
            border-radius: 18px 0 0 18px;
        }

        .stat-card h4 {
            font-size: 14px;
            color: #666;
        }

        .stat-card p {
            font-size: 38px;
            margin: 10px 0;
            color: #0a2540;
        }

        /* SECTION */
        .section-title {
            font-size: 20px;
            color: #0a2540;
            margin-bottom: 18px;
            border-left: 5px solid #144272;
            padding-left: 12px;
        }

        /* CHART */
        .charts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            gap: 32px;
        }

        .chart-box {
            background: #fff;
            border-radius: 18px;
            padding: 26px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .08);
        }

        .chart-box h5 {
            margin-bottom: 16px;
            font-size: 15px;
            color: #444;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>DPRD</h2>
        <a class="active">
            <div class="icon">🏠</div>Dashboard
        </a>
        <a href="buku_tamu.php">
            <div class="icon">📋</div>Data Buku Tamu
        </a>
    </div>

    <div class="main">

        <div class="header">
            <h1>Dashboard Admin</h1>
            <a href="logout.php" class="logout">Logout</a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h4>Total Pengunjung</h4>
                <p><?= $total ?></p>
            </div>
            <div class="stat-card">
                <h4>Hari Ini</h4>
                <p><?= $hari ?></p>
            </div>
            <div class="stat-card">
                <h4>Bulan Ini</h4>
                <p><?= $bulan ?></p>
            </div>
        </div>

        <div class="section-title">Statistik Kunjungan</div>

        <div class="charts">
            <div class="chart-box">
                <h5>Bar Chart (Harian)</h5><canvas id="bar"></canvas>
            </div>
            <div class="chart-box">
                <h5>Pie Chart</h5><canvas id="pie"></canvas>
            </div>
            <div class="chart-box">
                <h5>Line Chart</h5><canvas id="line"></canvas>
            </div>
            <div class="chart-box">
                <h5>Column Chart (Bulanan)</h5><canvas id="col"></canvas>
            </div>
        </div>

    </div>

    <script>
        new Chart(bar, {
            type: 'bar',
            data: {
                labels: <?= json_encode($lh) ?>,
                datasets: [{
                    data: <?= json_encode($dh) ?>
                }]
            }
        })
        new Chart(pie, {
            type: 'pie',
            data: {
                labels: <?= json_encode($li) ?>,
                datasets: [{
                    data: <?= json_encode($di) ?>
                }]
            }
        })
        new Chart(line, {
            type: 'line',
            data: {
                labels: <?= json_encode($lh) ?>,
                datasets: [{
                    data: <?= json_encode($dh) ?>,
                    fill: false,
                    tension: .4
                }]
            }
        })
        new Chart(col, {
            type: 'bar',
            data: {
                labels: <?= json_encode($lb) ?>,
                datasets: [{
                    data: <?= json_encode($db) ?>
                }]
            }
        })
    </script>

</body>

</html>
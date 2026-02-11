<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../config/database.php';

/* ================= HAPUS DATA ================= */
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM buku_tamu WHERE id='$id'");
    echo "<script>alert('Data berhasil dihapus');location='buku_tamu.php';</script>";
    exit;
}

/* ================= DATA ================= */
$data = mysqli_query(
    $conn,
    "SELECT id, nama_instansi, tanggal_kunjungan
     FROM buku_tamu
     ORDER BY tanggal_kunjungan DESC"
);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Buku Tamu | DPRD Kabupaten Sumenep</title>

    <style>
        /* ================= BASE ================= */
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif
        }

        body {
            margin: 0;
            background:
                linear-gradient(rgba(238, 242, 247, .92), rgba(238, 242, 247, .92)),
                url('../assets/img/dpr.jpeg') center/cover no-repeat fixed;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #0a2540, #144272);
            color: #fff;
            padding: 32px 22px;
            box-shadow: 4px 0 25px rgba(0, 0, 0, .25)
        }

        .sidebar h2 {
            text-align: center;
            letter-spacing: 3px;
            margin-bottom: 50px
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
            transition: .25s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, .18)
        }

        .icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center
        }

        /* ================= MAIN ================= */
        .main {
            margin-left: 260px;
            padding: 36px
        }

        /* ================= HEADER ================= */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 26px 30px;
            border-radius: 18px;
            background:
                linear-gradient(90deg, rgba(10, 37, 64, .85), rgba(10, 37, 64, .6), rgba(10, 37, 64, .85)),
                url('../assets/img/dpr.jpeg') center/cover no-repeat;
            color: #fff
        }

        .logout {
            background: #c62828;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: .25s;
        }

        .logout:hover {
            opacity: .85
        }

        /* ================= SEARCH ================= */
        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 320px;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: .25s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #144272;
            box-shadow: 0 0 0 3px rgba(20, 66, 114, .15);
        }

        /* ================= CONTAINER ================= */
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .08)
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #0a2540;
            color: #fff
        }

        th,
        td {
            padding: 14px 16px;
            font-size: 14px;
            text-align: left;
        }

        th {
            text-transform: uppercase;
            font-size: 13px
        }

        tbody tr {
            animation: fadeIn .5s ease both;
            transition: .25s;
        }

        tbody tr:hover {
            background: #f0f6ff;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* ================= BUTTON ================= */
        .btn-edit {
            background: #1976d2;
            color: #fff;
            padding: 7px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            transition: .25s;
        }

        .btn-edit:hover {
            background: #155aa8;
            transform: scale(1.05);
        }

        .btn-hapus {
            background: #d32f2f;
            color: #fff;
            padding: 7px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            transition: .25s;
        }

        .btn-hapus:hover {
            background: #b71c1c;
            transform: scale(1.05);
        }

        /* ================= FOOTER ================= */
        .footer-dprd {
            margin-top: 80px;
            color: #fff;
            background: url('../assets/img/dpr.jpeg') center/cover no-repeat
        }

        .footer-inner {
            display: grid;
            grid-template-columns: 1.3fr 1.4fr 1.6fr;
            gap: 70px;
            padding: 80px 90px 55px
        }

        .footer-bottom {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #ccc;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>DPRD</h2>
        <a href="dashboard.php">
            <div class="icon">🏠</div>Dashboard
        </a>
        <a href="buku_tamu.php" class="active">
            <div class="icon">📋</div>Data Buku Tamu
        </a>
    </div>

    <div class="main">

        <div class="header">
            <h1>Data Buku Tamu</h1>
            <a href="logout.php" class="logout">Logout</a>
        </div>

        <div class="container">

            <!-- SEARCH -->
            <div class="search-box">
                <input type="text" id="search" placeholder="Cari nama instansi...">
            </div>

            <table id="tabel">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Nama Instansi</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($d = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td>
                                <a href="detail_buku_tamu.php?id=<?= $d['id'] ?>" class="btn-edit">Detail</a>
                            </td>
                            <td><?= htmlspecialchars($d['nama_instansi']) ?></td>
                            <td><?= htmlspecialchars($d['tanggal_kunjungan']) ?></td>
                            <td>
                                <a href="?hapus=<?= $d['id'] ?>" class="btn-hapus"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        /* ================= SEARCH REALTIME ================= */
        const search = document.getElementById('search');
        const rows = document.querySelectorAll('#tabel tbody tr');

        search.addEventListener('keyup', () => {
            const key = search.value.toLowerCase();
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(key) ? '' : 'none';
            });
        });
    </script>

</body>

</html>
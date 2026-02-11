<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../config/database.php';

$id = intval($_GET['id']);
$d = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM buku_tamu WHERE id='$id'")
);

if (!$d) {
    echo "Data tidak ditemukan";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Buku Tamu</title>

    <style>
        /* ================= ROOT ================= */
        :root {
            --primary: #0a2540;
            --secondary: #144272;
            --accent: #1a73e8;
            --bg: #eef2f7;
            --text: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        /* ================= RESET ================= */
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            background:
                radial-gradient(circle at top left, #f8fafc, transparent 60%),
                linear-gradient(120deg, #eef2f7, #f9fafb);
            padding: 60px 30px;
            color: var(--text);
        }

        /* ================= WRAPPER ================= */
        .wrapper {
            max-width: 1100px;
            margin: auto;
        }

        /* ================= CARD ================= */
        .card {
            background: rgba(255, 255, 255, .75);
            backdrop-filter: blur(14px);
            border-radius: 26px;
            padding: 48px 56px;
            box-shadow:
                0 30px 70px rgba(0, 0, 0, .15),
                inset 0 0 0 1px rgba(255, 255, 255, .6);
            animation: fadeUp .7s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ================= HEADER ================= */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 30px;
            margin: 0;
            color: var(--primary);
        }

        .header span {
            font-size: 14px;
            color: var(--muted);
        }

        /* ================= GRID DETAIL ================= */
        .detail-grid {
            display: grid;
            grid-template-columns: 240px 1fr;
            row-gap: 22px;
            column-gap: 32px;
        }

        .label {
            font-weight: 600;
            color: var(--muted);
        }

        .value {
            font-weight: 500;
        }

        /* ================= DIVIDER ================= */
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
            margin: 40px 0;
        }

        /* ================= FILES ================= */
        .files {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .file {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 14px;
            background: linear-gradient(135deg, #f8fafc, #eef2f7);
            border: 1px solid var(--border);
            text-decoration: none;
            color: var(--accent);
            font-size: 14px;
            font-weight: 600;
            transition: .25s;
        }

        .file:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
        }

        /* ================= FOOTER ACTION ================= */
        .actions {
            margin-top: 45px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back {
            padding: 14px 30px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: .3s;
        }

        .back:hover {
            opacity: .9;
            transform: translateY(-2px);
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width: 900px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="card">

            <div class="header">
                <h1><?= htmlspecialchars($d['nama_instansi']) ?></h1>
                <span>Detail Buku Tamu DPRD</span>
            </div>

            <div class="detail-grid">
                <div class="label">Nama Hotel</div>
                <div class="value"><?= $d['nama_hotel'] ?: '-' ?></div>

                <div class="label">Alat Kelengkapan</div>
                <div class="value"><?= $d['alat_kelengkapan'] ?></div>

                <div class="label">Jumlah Rombongan</div>
                <div class="value"><?= $d['jumlah_rombongan'] ?> Orang</div>

                <div class="label">Tanggal Kunjungan</div>
                <div class="value"><?= $d['tanggal_kunjungan'] ?></div>

                <div class="label">Contact Person</div>
                <div class="value"><?= $d['nama_contact_person'] ?></div>

                <div class="label">Nomor Contact</div>
                <div class="value"><?= $d['nomor_contact_person'] ?></div>
            </div>

            <div class="divider"></div>

            <div class="files">
                <?php if ($d['surat_permohonan']) { ?>
                    <a href="../uploads/<?= $d['surat_permohonan'] ?>" target="_blank" class="file">📄 Surat Permohonan</a>
                <?php } ?>
                <?php if ($d['surat_tugas']) { ?>
                    <a href="../uploads/<?= $d['surat_tugas'] ?>" target="_blank" class="file">📄 Surat Tugas</a>
                <?php } ?>
                <?php if ($d['surat_lainnya']) { ?>
                    <a href="../uploads/<?= $d['surat_lainnya'] ?>" target="_blank" class="file">📄 Surat Lainnya</a>
                <?php } ?>
            </div>

            <div class="actions">
                <a href="buku_tamu.php" class="back">← Kembali ke Data Buku Tamu</a>
            </div>

        </div>
    </div>

</body>

</html>
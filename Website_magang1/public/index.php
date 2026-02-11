<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buku Tamu DPRD</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            background: #f1f3f6;
            overflow: hidden;
        }

        /* ================= PANEL KIRI ================= */
        .left {
            flex: 1;
            background:
                linear-gradient(rgba(0, 0, 0, .55), rgba(0, 0, 0, .55)),
                url('../assets/img/public.jpeg') center/cover no-repeat;
            color: #fff;
            padding: 60px;
        }

        .left .content {
            max-width: 520px;
        }

        .left img {
            height: 60px;
            margin-bottom: 30px;
        }

        .left h1 {
            font-size: 36px;
            margin-bottom: 14px;
        }

        .left p {
            font-size: 14px;
            line-height: 1.7;
            opacity: .9;
        }

        /* ================= PANEL KANAN ================= */
        .right {
            width: 520px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* ================= CARD FORM ================= */
        .card {
            width: 100%;
            max-width: 420px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 35px 40px;
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, .15);
            background: #fff;
        }

        .judul-form {
            text-align: center;
            color: #003366;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .subjudul-form {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 28px;
        }

        /* ================= FORM ================= */
        form input,
        form textarea {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 16px;
            border-radius: 10px;
            border: 1px solid #d0d0d0;
            font-size: 14px;
        }

        form textarea {
            min-height: 90px;
        }

        form input:focus,
        form textarea:focus {
            border-color: #003366;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 51, 102, 0.25);
        }

        /* ================= CHECKBOX (PASTI LURUS) ================= */
        .label-form {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
            color: #333;
        }

        .checkbox-vertical {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            /* KUNCI LURUS */
        }

        .checkbox-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin: 0;
            margin-right: 12px;
            accent-color: #003366;
            flex-shrink: 0;
        }

        .checkbox-item label {
            font-size: 14px;
            color: #333;
            line-height: 1;
            cursor: pointer;
        }

        /* ================= BUTTON ================= */
        form button {
            width: 100%;
            padding: 15px;
            background: #003366;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        form button:hover {
            background: #0059b3;
        }

        .footer {
            margin-top: 28px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:900px) {
            body {
                flex-direction: column;
                overflow: auto;
            }

            .left {
                display: none;
            }

            .right {
                width: 100%;
            }

            .card {
                max-height: none;
            }
        }
    </style>
</head>

<body>

    <!-- PANEL KIRI -->
    <div class="left">
        <div class="content">
            <img src="../assets/img/dprd1.png">
            <h1>SELAMAT DATANG<br>Website Buku Tamu</h1>
            <p>
                Website Buku Tamu digunakan untuk mempermudahkan pengunjung
                saat ingin berkunjung ke DPRD Sumenep.
            </p>
        </div>
    </div>

    <!-- PANEL KANAN -->
    <div class="right">
        <div class="card">

            <h2 class="judul-form">Buku Tamu DPRD</h2>
            <p class="subjudul-form">
                Silakan isi data kunjungan Anda dengan benar
            </p>

            <form method="post" action="simpan.php" enctype="multipart/form-data">

                <input type="text" name="nama_instansi" placeholder="Nama DPRD / Instansi" required>

                <input type="text" name="nama_hotel" placeholder="Nama Hotel Menginap (Jika Ada)">

                <span class="label-form">Alat Kelengkapan yang Berkunjung</span>

                <div class="checkbox-vertical">
                    <div class="checkbox-item">
                        <input type="checkbox" id="pimpinan" name="alat_kelengkapan[]" value="Pimpinan">
                        <label for="pimpinan">Pimpinan</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="komisi" name="alat_kelengkapan[]" value="Komisi">
                        <label for="komisi">Komisi</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="bapemperda" name="alat_kelengkapan[]" value="Bapemperda">
                        <label for="bapemperda">Bapemperda</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="anggaran" name="alat_kelengkapan[]" value="Badan Anggaran">
                        <label for="anggaran">Badan Anggaran</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="sekretariat" name="alat_kelengkapan[]" value="Sekretariat DPRD">
                        <label for="sekretariat">Sekretariat DPRD</label>
                    </div>
                </div>

                <input type="number" name="jumlah_rombongan" placeholder="Jumlah Rombongan" required>

                <input type="date" name="tanggal_kunjungan" required>

                <input type="text" name="nama_contact_person" placeholder="Nama Contact Person" required>

                <input type="text" name="nomor_contact_person" placeholder="Nomor Contact Person" required>

                <label class="label-form">Surat Permohonan (PDF)</label>
                <input type="file" name="surat_permohonan" accept=".pdf" required>

                <label class="label-form">Surat Tugas (PDF)</label>
                <input type="file" name="surat_tugas" accept=".pdf" required>

                <label class="label-form">Surat Lainnya (PDF)</label>
                <input type="file" name="surat_lainnya" accept=".pdf">

                <button type="submit">Simpan Buku Tamu</button>
            </form>

            <div class="footer">
                © <?= date('Y'); ?> DPRD • Buku Tamu Digital
            </div>

        </div>
    </div>

</body>

</html>
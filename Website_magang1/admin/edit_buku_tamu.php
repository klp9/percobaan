<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../config/database.php';

$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM buku_tamu WHERE id='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $keperluan = $_POST['keperluan'];

    mysqli_query($conn, "
        UPDATE buku_tamu SET
        nama='$nama',
        instansi='$instansi',
        keperluan='$keperluan'
        WHERE id='$id'
    ");

    echo "<script>
        alert('Data berhasil diperbarui');
        window.location='buku_tamu.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Buku Tamu</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #eef2f7;
            padding: 40px;
        }

        .form-box {
            max-width: 500px;
            background: #fff;
            padding: 30px;
            margin: auto;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .1);
        }

        .form-box h2 {
            margin-bottom: 20px;
            color: #0a2540;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background: #0a2540;
            color: #fff;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #144272
        }

        a {
            display: inline-block;
            margin-top: 15px;
            color: #555;
            text-decoration: none
        }
    </style>
</head>

<body>

    <div class="form-box">
        <h2>Edit Buku Tamu</h2>

        <form method="post">
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
            <input type="text" name="instansi" value="<?= htmlspecialchars($data['instansi']) ?>" required>
            <textarea name="keperluan" required><?= htmlspecialchars($data['keperluan']) ?></textarea>

            <button type="submit" name="update">Simpan Perubahan</button>
        </form>

        <a href="buku_tamu.php">← Kembali</a>
    </div>

</body>

</html>
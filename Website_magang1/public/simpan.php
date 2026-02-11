<?php
include '../config/database.php';

/* ================= AMBIL DATA FORM ================= */
$nama_instansi        = $_POST['nama_instansi'];
$nama_hotel           = $_POST['nama_hotel'];
$jumlah_rombongan     = $_POST['jumlah_rombongan'];
$tanggal_kunjungan    = $_POST['tanggal_kunjungan'];
$nama_cp              = $_POST['nama_contact_person'];
$nomor_cp             = $_POST['nomor_contact_person'];

/* checkbox (array → string) */
$alat_kelengkapan = isset($_POST['alat_kelengkapan'])
    ? implode(', ', $_POST['alat_kelengkapan'])
    : '';

/* ================= UPLOAD FILE ================= */
$upload_dir = "../uploads/";

/* pastikan folder ada */
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

/* fungsi upload */
function uploadFile($file, $dir)
{
    if ($file['error'] == 0) {
        $nama_file = time() . '_' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $dir . $nama_file);
        return $nama_file;
    }
    return '';
}

$surat_permohonan = uploadFile($_FILES['surat_permohonan'], $upload_dir);
$surat_tugas      = uploadFile($_FILES['surat_tugas'], $upload_dir);
$surat_lainnya    = uploadFile($_FILES['surat_lainnya'], $upload_dir);

/* ================= SIMPAN KE DATABASE ================= */
$query = mysqli_query($conn, "
    INSERT INTO buku_tamu 
    (nama_instansi, nama_hotel, alat_kelengkapan, jumlah_rombongan,
     tanggal_kunjungan, nama_contact_person, nomor_contact_person,
     surat_permohonan, surat_tugas, surat_lainnya, created_at)
    VALUES (
        '$nama_instansi',
        '$nama_hotel',
        '$alat_kelengkapan',
        '$jumlah_rombongan',
        '$tanggal_kunjungan',
        '$nama_cp',
        '$nomor_cp',
        '$surat_permohonan',
        '$surat_tugas',
        '$surat_lainnya',
        NOW()
    )
");

/* ================= FEEDBACK ================= */
if ($query) {
    echo "<script>
        alert('Terima kasih, data buku tamu berhasil dikirim.');
        window.location='index.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menyimpan data!');
        history.back();
    </script>";
}

<?php
session_start();
include '../config/database.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM admin 
     WHERE username='$username' 
     AND password='$password'"
);

if (mysqli_num_rows($query) > 0) {
    $_SESSION['admin'] = $username;
    header('Location: dashboard.php');
    exit;
} else {
    echo "<script>
        alert('Username atau password salah');
        window.location='login.php';
    </script>";
}

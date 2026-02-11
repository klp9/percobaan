<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin | DPRD</title>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Buku Tamu DPRD</title>
        <link rel="stylesheet" href="../assets/css/login.css">
    </head>

<body></body>
</head>

<body>

    <div class="wrapper">

        <div class="left-panel">
            <h1>Welcome to Website</h1>
            <p>
                Sistem Informasi Buku Tamu DPRD Kabupaten.
                Silakan login untuk mengelola data kunjungan
                secara aman dan profesional.
            </p>

            <div class="shape one"></div>
            <div class="shape two"></div>
            <div class="shape three"></div>
        </div>

        <div class="right-panel">
            <h3>USER LOGIN</h3>

            <form method="post" action="proses_login.php">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="options">
                    <label>
                        <input type="checkbox"> Remember
                    </label>
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit">LOGIN</button>
            </form>

            <div class="footer-text">
                © <?= date('Y'); ?> DPRD • Sistem Informasi
            </div>
        </div>

    </div>

</body>

</html>
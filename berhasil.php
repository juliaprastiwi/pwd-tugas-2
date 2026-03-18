<?php
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }

    if (!isset($_SESSION["pesanan"])) {
        header("Location: formPemesanan.php");
        exit();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan Berhasil</title>
 
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
 
    <link rel="stylesheet" href="style.css" />
  </head>
 
  <body class="berhasil">
    <div class="card">
      <h3>Pemesanan Tiket Berhasil 🎉</h3>
      <p>
        Tiket selanjutnya akan dikirimkan melalui email. Cek email secara berkala!
      </p>
      <a href="invoice.php" class="btn-detail">Detail Pemesanan</a>
    </div>
  </body>
</html>
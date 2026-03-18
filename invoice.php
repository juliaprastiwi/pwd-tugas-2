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

$pesanan = $_SESSION["pesanan"];
$nama    = $pesanan["nama"];
$email   = $pesanan["email"];
$film    = $pesanan["film"];
$jumlah  = $pesanan["jumlah"];
$kursi   = $pesanan["kursi"];
$bayar   = $pesanan["bayar"];

$hargaFilm = [
    "Goat"                       => 80000,
    "Sore: Istri dari Masa Depan" => 65000,
    "Five Nights at Freddy's 2"  => 70000,
    "Jumbo"                      => 60000,
    "Rangga & Cinta"             => 70000,
];

if (isset($hargaFilm[$film])) {
    $hargaPerTiket = $hargaFilm[$film];
} else {
    $hargaPerTiket = 0;
}

$totalBayar = $hargaPerTiket * $jumlah;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Pemesanan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
  </head>

  <body class="invoice">
    <nav class="navbar fixed-top">
      <a href="#" class="brand" style="text-decoration: none">hellocine.</a>
      <div class="user-info">
        <span style="color: white; font-size: 14px;">
          <?php echo $email; ?>
        </span>
        <ion-icon name="person-circle-outline"></ion-icon>
      </div>
    </nav>

    <div class="invoice-wrapper">
      <h2>Invoice Pemesanan Tiket</h2>

      <table class="invoice-table">
        <tr>
          <td>Nama</td>
          <td><?php echo $nama; ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?php echo $email; ?></td>
        </tr>
        <tr>
          <td>Film</td>
          <td><?php echo $film; ?></td>
        </tr>
        <tr>
          <td>Jumlah Tiket</td>
          <td><?php echo $jumlah; ?></td>
        </tr>
        <tr>
          <td>Kursi</td>
          <td><?php echo $kursi; ?></td>
        </tr>
        <tr>
          <td>Metode Pembayaran</td>
          <td><?php echo $bayar; ?></td>
        </tr>
        <tr>
          <td>Harga per Tiket</td>
          <td>Rp <?php echo number_format($hargaPerTiket, 0, ',', '.'); ?></td>
        </tr>
        <!-- baris total - dibedain warna merah -->
        <tr class="total-row">
          <td>Total Bayar</td>
          <td>Rp <?php echo number_format($totalBayar, 0, ',', '.'); ?></td>
        </tr>
      </table>

      <a href="formPesan.php" class="btn-pesan-lagi">Pesan Lagi</a>
    </div>

  </body>
</html>
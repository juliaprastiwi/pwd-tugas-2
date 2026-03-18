<?php
    session_start();

    if (!isset($_SESSION["email"])) {
      header("Location: login.php");
      exit();
    }

    $email = $_SESSION["email"];

$films = [
    [
        "judul"    => "Goat",
        "genre"    => "Animasi / Komedi / Keluarga / Olahraga",
        "durasi"   => "100",
        "jam"      => "14.30",
        "sinopsis" => "Kisah Will, seekor kambing kecil dengan mimpi besar menjadi pemain profesional \"roarball\" - olahraga penuh aksi di dunia binatang antropomorfik - yang harus membuktikan dirinya di tengah rintangan dan penolakan.",
        "harga"    => 80000,
        "img"      => "assets/goat.jpg"
    ],
    [
        "judul"    => "Sore: Istri dari Masa Depan",
        "genre"    => "Romantis / Drama / Fantasi",
        "durasi"   => "105",
        "jam"      => "19.00",
        "sinopsis" => "Seorang wanita misterius datang dari masa depan dan mengaku sebagai istri seorang pria yang hidupnya berantakan. Ia berusaha mengubah takdir dengan memperbaiki kebiasaan dan pilihan hidup sang pria sebelum semuanya terlambat.",
        "harga"    => 65000,
        "img"      => "assets/sore.jpg"
    ],
    [
        "judul"    => "Five Nights at Freddy's 2",
        "genre"    => "Horror / Thriller",
        "durasi"   => "110",
        "jam"      => "21.00",
        "sinopsis" => "Teror animatronik kembali menghantui penjaga malam dengan misteri yang lebih gelap dan mematikan. Sekuel ini menghadirkan ketegangan lebih intens dari film pertamanya.",
        "harga"    => 70000,
        "img"      => "assets/fivenight.jpeg"
    ],
    [
        "judul"    => "Jumbo",
        "genre"    => "Animasi / Keluarga / Petualangan",
        "durasi"   => "102",
        "jam"      => "11.00",
        "sinopsis" => "Don, anak bertubuh besar yang sering diremehkan, ingin membuktikan kemampuannya melalui pertunjukan bakat. Film ini menyuguhkan cerita hangat tentang kepercayaan diri dan persahabatan.",
        "harga"    => 60000,
        "img"      => "assets/jumbo2.jpg"
    ],
    [
        "judul"    => "Rangga & Cinta",
        "genre"    => "Romantis / Musikal / Remaja",
        "durasi"   => "119",
        "jam"      => "15.45",
        "sinopsis" => "Versi musikal dari kisah legendaris remaja SMA yang penuh puisi dan konflik perasaan. Nostalgia dipadukan dengan aransemen musik modern.",
        "harga"    => 70000,
        "img"      => "assets/ranggacinta.jpg"
    ],
];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <!-- gugel font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- css -->
    <link rel="stylesheet" href="style.css" />

    <!-- butstrep -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

  <body class="dashboard">
    <!-- navbar -->
    <nav class="navbar fixed-top">
      <a href="#" class="brand" style="text-decoration: none">hellocine.</a>
      <div class="user-info">
        <span style="color: white; font-size: 14px;">
          <?php echo $email; ?>
        </span>
        <ion-icon name="person-circle-outline"></ion-icon>
      </div>
    </nav>

    <header class="hero">
      <h1>
        NIKMATI <br />
        <span class="highlight">FILM</span> <br />
        FAVORITMU
      </h1>
      <p class="deskripsi">
        Di balik layar yang menyala, selalu ada kisah yang siap menginspirasi,
        menghibur, dan menggetarkan hati. Melalui layanan ini, kami menghadirkan
        kemudahan bagi Anda untuk memesan tiket dan menjadi bagian dari setiap
        momen tak terlupakan di bioskop.
      </p>
      <hr class="batas" />
      <p class="now-playing">Now Playing</p>
    </header>

    <main class="movie-grid">

      <?php
      // PERULANGAN - foreach buat nampilin setiap film di $films satu per satu
      foreach ($films as $film) {
      ?>

        <div class="movie-card">
          <img src="<?php echo $film["img"]; ?>" alt="<?php echo $film["judul"]; ?>" />
          <div class="movie-info">
            <h3><?php echo $film["judul"]; ?></h3>
            <p class="genre"><?php echo $film["genre"]; ?></p>
            <p class="waktu">
              ± <?php echo $film["durasi"]; ?> menit | Tayang pukul <?php echo $film["jam"]; ?> WIB
            </p>
            <p class="sinopsis"><?php echo $film["sinopsis"]; ?></p>

            <?php
            // PERCABANGAN - kasih label harga sesuai range harga filmnya
            if ($film["harga"] >= 80000) {
                $labelHarga = "Premium";
            } elseif ($film["harga"] >= 70000) {
                $labelHarga = "Regular";
            } else {
                $labelHarga = "Hemat";
            }
            ?>

            <div class="harga">
              Rp <?php echo number_format($film["harga"], 0, ',', '.'); ?>
              <small style="color: var(--merah-utama); margin-left:6px;"><?php echo $labelHarga; ?></small>
            </div>
          </div>
        </div>

      <?php } // tutup foreach ?>

    </main>

    <footer class="footer-action">
      <a href="formPesan.php" class="btn-pesan-besar">Pesan Sekarang</a>
    </footer>
    
    <!-- icon -->
     <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>

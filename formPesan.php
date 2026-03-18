<?php
    session_start();

    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit();
    }

    $email= $_SESSION["email"];

    $daftarFilm = [
        "Goat", "Sore: Istri dari Masa Depan", 
        "Five Nights at Freddy's 2", "Jumbo", "Rangga & Cinta"
    ];

    $daftarKursi = ["A1", "A2","A3","B1","B2","B3","C1","C2","C3","D1","D2","D3"];

    $error = "";

    //cek apakah form udh disubmit
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nama = $_POST["nama"];
        $inputEmail = $_POST["email"];
        $film = $_POST["film"];
        $jumlah    = $_POST["jumlah"];
        $kursiArray = $_POST["kursi"] ?? [];
        $kursi     = implode(", ", $kursiArray);
        $bayar     = $_POST["bayar"];

        if(empty($nama) || empty($inputEmail) || empty($film) || empty($jumlah) || empty($kursi) || empty($bayar)){
            $error = "Field tidak boleh kosong!";
        }elseif($jumlah < 1){
            $error = "Pilihan tidak valid!";
        }else{
            $_SESSION["pesanan"]=[
                "nama" => $nama,
                "email" => $inputEmail,
                "film" => $film,
                "jumlah" => $jumlah,
                "kursi"  => $kursi,
                "bayar"  => $bayar,
            ];

            header("Location: berhasil.php");
            exit();
        }
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body class="form-pesan">
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

     <div class="form-wrapper">
      <form action="formPesan.php" method="POST">
        <h2>Form Pemesanan</h2>
 
        <div class="input-row">
          <div class="input-box">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Nama lengkap" required />
          </div>
          <div class="input-box">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email kamu" required />
          </div>
        </div>
 
        <div class="form-group">
          <label>Film yang ingin dipesan:</label>
          <?php foreach ($daftarFilm as $namaFilm) { ?>
            <div style="margin: 6px 0; display:flex; align-items:center; gap:8px;">
              <input type="radio" name="film" value="<?php echo $namaFilm; ?>" required />
              <span style="font-size:0.9rem;"><?php echo $namaFilm; ?></span>
            </div>
          <?php } ?>
        </div>
 
        <!-- <div class="input-row">
          <div class="input-box">
            <label>Jumlah Tiket</label>
            <input type="number" name="jumlah" placeholder="Jumlah" min="1" required />
          </div>
          <div class="input-box">
            <label>Pilih Kursi</label>
            <select name="kursi" required>
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div> -->

        <div class="form-group">
          <label>Jumlah Tiket</label>
          <input type="number" id="jumlah" name="jumlah" placeholder="Masukkan jumlah tiket" min="1" required />
        </div>
 
        <!-- pilih kursi - sesuai jumlah tiket -->
        <div class="form-group" id="kursi-wrapper" style="display:none;">
          <label>Pilih Kursi</label>
          <div id="kursi-container"></div>
          <small style="color:var(--abu-abu); font-size:0.75rem;">Pilih kursi sesuai jumlah tiket</small>
        </div>
 
        <div class="form-group">
          <label>Metode Pembayaran:</label>
          <div class="radio-row">
            <label><input type="radio" name="bayar" value="Cash" required /> Cash</label>
            <label><input type="radio" name="bayar" value="QRIS" required /> QRIS</label>
          </div>
        </div>
 
        <button type="submit">Pesan</button>
        <button type="reset">Muat Ulang</button>
      </form>
    </div>
 
    <script>
      <?php if ($error != "") { ?>
        Swal.fire({
          icon: "error",
          title: "Oops!",
          text: "<?php echo $error; ?>",
          width: "350px",
        });
      <?php } ?>
    </script>

    <script>
      const daftarKursi = <?php echo json_encode($daftarKursi); ?>;
 
      document.getElementById("jumlah").addEventListener("input", function () {
        const jumlah = parseInt(this.value);
        const container = document.getElementById("kursi-container");
        const wrapper = document.getElementById("kursi-wrapper");
 
        container.innerHTML = ""; // reset dulu setiap kali angka berubah
 
        if (jumlah >= 1) {
          wrapper.style.display = "block";
 
          for (let i = 1; i <= jumlah; i++) {
            const select = document.createElement("select");
            select.name = "kursi[]"; 
            select.required = true;
            select.style.marginBottom = "8px";
 
            select.innerHTML = `<option value="">Kursi ke-${i}</option>`;
 
            // isi opsi kursi dari array
            daftarKursi.forEach(function(k) {
              select.innerHTML += `<option value="${k}">${k}</option>`;
            });
 
            container.appendChild(select);
          }
        } else {
          wrapper.style.display = "none";
        }
      });
 
      // reset button bersihin kursi juga
      document.querySelector("button[type='reset']").addEventListener("click", function () {
        document.getElementById("kursi-container").innerHTML = "";
        document.getElementById("kursi-wrapper").style.display = "none";
      });
    </script>
  </body>
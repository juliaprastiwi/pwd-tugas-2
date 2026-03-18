<?php
    session_start();

    //assosiative array
    $users = [
        ["email" => "julia@gmail.com",  "password" => "halomok"],
        ["email" => "mbggratis@gmail.com",  "password" => "duabelas12"],
        ["email" => "whenyh@gmail.com", "password" => "maret123"],
    ];

    // variabel cek blm diinisiasi/blm diisi value nya, karena fungsi variabel cek ini
    // utk nampung pesan validasi kebenaran email/pass. jadi, kondisi awal harus kosong dulu
    // krna kondisi awal wicis baru landing di halaman pertama, user blm isi apa2
    $cek = "";

    // 01. cek methodnya wajib pake post, soalnya ini login
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["pass"];

        $loginBerhasil = false;

        // 02. cek lagi, konfirmasi kebenaran email dan pass nya
        /* 
            == //menyamakan nilai
            === // sama nilai dan sama tipe data
        */
        foreach($users as $user){
            if($user["email"] === $email && $user["password"] === $password){
                $loginBerhasil=true;
                $_SESSION["email"] = $email;
                break;
            }
        }

        if($loginBerhasil){
            $_SESSION["email"] = $email;
            header("Location: dashboard.php");
            exit();
        }else{
            $cek = "email atau password salah!";
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <!-- gugel font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- css -->
    <link rel="stylesheet" href="style.css" />

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>


  <body class="login">
    <div class="login-box">
      <form action="login.php" method="POST">
        <h2>Login</h2>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" name="email" required />
          <label name="email">Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="pass" required />
          <label>Password</label>
        </div>

        <!-- remember forgot -->
        <div class="remember-forgot">
          <label><input type="checkbox" />Remember me</label>
          <a href="#">Forgot Password?</a>
        </div>

        <button type="submit">Login</button>
        <div class="register-link">
          <p>Dont have an account? <a href="#">Register</a></p>
        </div>
      </form>
    </div>
    
    <!-- icon -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
    
    <script>
        //kl cek ga kosong = var cek udh ada valuenya = user udh melakukan input email dan pass
        // bakal muncul pesan eror dehh
        // kl cek masih kosong brti ga munculin apa2, cek blm dipake, dan blok if yg ini ga jalan
        <?php if ($cek != "") { ?>
        Swal.fire({
            icon: "error",
            title: "Login Gagal",
            width: "450px",
            padding: "1rem",
            text: "<?php echo $cek; ?>",
        });
    <?php } ?>
    </script>
  </body>
</html>

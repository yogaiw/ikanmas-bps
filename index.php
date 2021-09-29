<?php 

    session_start();
    require "koneksi.php";

    if(isset($_SESSION["login"])) {
        header("Location:dashboard.php");
        exit();
    }

    if(isset($_POST['masuk'])) { // Jika tombol masuk ditekan

        $nip = strtolower(stripslashes($_POST["nip"]));
		$password = mysqli_real_escape_string($conn, $_POST['password']);

        // Melakuka retrieve tabel pegawai
		$cek_login = $conn->query("SELECT * FROM pegawai WHERE nip = '$nip'");
		$ktm_login = $cek_login->num_rows;
		$data_login = $cek_login->fetch_assoc();

        // Pengecekan kecocokan password dengan database
		if($ktm_login === 1) {
			if(password_verify($password,$data_login['password'])){
				$_SESSION["login"] = true; // Menandakan bahwa session sedang terisi
				$_SESSION['current_user'] = $data_login['id_pegawai']; // Menyimpan id pegawai ke dalam session
                $_SESSION['isAdmin'] = $data_login['isAdmin'];
				header("Location:dashboard.php"); // redirect ke dashboard setelah login berhasil
				exit;
			}
		}
    }

?>

<html>
    <head>

        <title>BPS Kabupaten Banyumas</title>

        <!-- Bootstrap v5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/style1.css">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
        
    </head>
    <body>
        <div class="container">
            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-sm-8 col-md-6 col-lg-4 bg-white rounded p-4 shadow">
                        <!-- Logo -->
                    <div class="d-flex justify-content-center" style="display: block;">
                            <img src="assets/img/logo-bps.png" alt="" width="300px">
                    </div>
                    <div class="mb-5"></div>
                        <!-- End of Logo -->

                        <!-- Form Login -->
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" placeholder="NIP" aria-label="NIP"  name="nip" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password"  name="password" required>
                    </div>

                    <a href="dashboard.php">
                        <div class="d-grid gap-2">
                            <button type="submit" name="masuk" class="btn btn-primary">Masuk</button>
                        </div>
                    </a>
                </form>
                <!-- End of Form Login -->
                </div>
            </div>

        </div>
    </body>
</html>
<?php 

    session_start();
    require "koneksi.php";

    if(isset($_SESSION["login"])) {
        header("Location:dashboard.php");
        exit();
    }

    if(isset($_POST['masuk'])) {

        $nip = strtolower(stripslashes($_POST["nip"]));
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		$cek_login = $conn->query("SELECT * FROM pegawai WHERE nip = '$nip'");
		$ktm_login = $cek_login->num_rows;
		$data_login = $cek_login->fetch_assoc();

		if($ktm_login === 1) {
			if(password_verify($password,$data_login['password'])){
				$_SESSION["login"] = true;
				$_SESSION['current_user'] = $data_login['id_pegawai'];
				header("Location:dashboard.php");
				exit;
			}
		}
    }

?>

<html>
    <head>
        <title>BPS Kabupaten Banyumas</title>
        <link 
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
            crossorigin="anonymous">
        <link 
            rel="stylesheet"
            href="assets/css/style1.css">
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </head>
    <body>
        <div class="row">
            <div class="login-form">
                <!-- Logo -->
                <div class="d-flex justify-content-center" style="display: block;">
                    <img src="assets/img/logo-bps.png" alt="" width="300px">
                </div>
                <div class="mb-5"></div>
                <!-- End of Logo -->

                <div class="alert alert-danger" role="alert">
                    This is a danger alert—check it out!
                </div>

                <!-- Form Login -->
                <form action="" method="POST">
                    <label class="sr-only" for="inlineFormInputGroupNip">NIP</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupNip" name="nip" placeholder="NIP" required>
                    </div>

                    <label class="sr-only" for="inlineFormInputGroupPassword">Password</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                        </div>
                        <input type="password" class="form-control" id="inlineFormInputGroupPassword" name="password" placeholder="Password" required>
                    </div>

                    <a href="dashboard.php"><button type="submit" name="masuk" class="btn btn-primary btn-block">Masuk</button></a>
                </form>
                <!-- End of Form Login -->
            </div>
        </div>
    </body>
</html>
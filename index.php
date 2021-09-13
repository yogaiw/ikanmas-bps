<?php 

    session_start();
    require "koneksi.php";

    if(isset($_SESSION["login"])) {
        header("Location:dashboard.php");
        exit();
    }

    if(isset($_POST['masuk'])) {

        $nip = strtolower(stripslashes($_POST["nip"]));
		$password = mysqli_real_escape_string($conn, $_POST['nip']);

		$cek_login = $conn->query("SELECT * FROM pegawai WHERE nip = '$nip'");
		$ktm_login = $cek_login->num_rows;
		$data_login = $cek_login->fetch_assoc();

		if($ktm_login === 1) {
			if(password_verify($password,$data_login['password'])){
				$_SESSION["login"] = true;
				$_SESSION['current_user'] = $data_login['pegawai_id'];
				header("Location:dashboard.php");
				exit;
			}
		}
    }

?>

<html>
    <head>
        <title></title>
        <link 
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
            crossorigin="anonymous">
        <link 
            rel="stylesheet"
            href="style.css">
        <link rel="stylesheet" src="node_modules/fontawesome/css/all.css">        
    </head>
    <body>
        <div class="login-form">
            <div class="d-flex justify-content-center" style="display: block;">
                <img src="images/logo-bps.png" alt="" width="300px">
            </div>
            <div class="mb-5"></div>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="nip" aria-describedby="emailHelp" placeholder="NIP" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <a href="dashboard.php"><button type="submit" name="masuk" class="btn btn-primary d-flex">Masuk</button></a>
            </form>
        </div>
    </body>
</html>
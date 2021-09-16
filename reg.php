<?php 
    
    require "koneksi.php";

    if(isset($_POST["reg"])) {
        $nip = strtolower(stripslashes($_POST["nip"]));
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $qdaftar = "INSERT INTO pegawai VALUES('', '$nip','$hashed_password', '" .$_POST['nama']. "',1)";
        $isExist = $conn->query("SELECT nip FROM pegawai WHERE nip = '$nip'")->fetch_assoc();

        if($isExist) {
            echo "<script>alert('User sudah ada')</script>";
        } else {
            if($conn->query($qdaftar)===TRUE) {
                $conn->close();
                header("location:index.php");
                exit;
            }
            else {
                echo"Error:".$sql."<br>".$conn->error;
                $conn->close();
                exit;
            }
        }
    }
?>


<html>
    <head>
        <title>Registrasi Pegawai</title>
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
                <div class="mb-4"></div>
                <!-- End of Logo -->

                <!-- Judul & Alert -->
                <div class="text-center mb-4">
                    <h4>Registrasi Pegawai</h4>
                </div>

                <div class="alert alert-success" role="alert">
                    This is a danger alert—check it out!
                </div>
                <!-- End of Judul & Alert -->

                <!-- Form Pendaftaran -->
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

                    <label class="sr-only" for="inlineFormInputGroupNama">Nama</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupNama" name="nama" placeholder="Nama" required>
                    </div>

                    <a href="dashboard.php"><button type="submit" name="reg" class="btn btn-primary btn-block">Daftar</button></a>                    
                </form>
                <!-- End of Pendaftaran -->
            </div>
        </div>
    </body>
</html>
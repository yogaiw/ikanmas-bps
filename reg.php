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
        <link rel="stylesheet" src="node_modules/fontawesome/css/all.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </head>
    <body>
        <div class="row">
            <div class="login-form">
                <div class="d-flex justify-content-center" style="display: block;">
                    <img src="assets/img/logo-bps.png" alt="" width="300px">
                </div>
                <div class="mb-4"></div>
                <div class="text-center mb-4">
                    <h4>Registrasi Pegawai</h4>
                </div>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nip" placeholder="NIP" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                    </div>

                    <a href="dashboard.php"><button type="submit" name="reg" class="btn btn-primary btn-block">Daftar</button></a>                    
                </form>
            </div>
        </div>
    </body>
</html>
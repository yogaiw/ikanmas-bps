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
    <body>
        <form action="" method="POST">
            <input type="text" name="nip" placeholder="NIP">
            <input type="password" name="password" placeholder="Passoerd">
            <input type="text" name="nama" placeholder="Nama">
            <button type="submit" name="reg">REG</button>
        </form>
    </body>
</html>
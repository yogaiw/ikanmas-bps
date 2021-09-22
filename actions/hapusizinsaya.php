<?php 
    session_start();
    require '../koneksi.php';

    $qDel = "DELETE FROM izin WHERE id_izin = ".$_GET['id_izin'];
    $checkUser = $conn->query("SELECT * FROM izin WHERE id_izin = ".$_GET['id_izin'])->fetch_assoc();

    if($_SESSION['current_user'] != $checkUser['id_pegawai'] ) {
        header("Location:../dashboard.php");
        $conn->close();
        exit;
    } else {
        $conn->query($qDel);
        $conn->close();
        header("Location:../dashboard.php");
    }

?>
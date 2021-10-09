<?php 
    session_start();
    require '../koneksi.php';

    $qAcc = "UPDATE pegawai SET isAdmin = 1 WHERE id_pegawai = ".$_GET['id_pegawai'];

    if($_SESSION['isAdmin'] != 2) {
        header("Location:../alluser.php");
        $conn->close();
        exit;
    } else {
        $conn->query($qAcc);
        $conn->close();
        header("Location:../alluser.php");
    }
<?php 
    session_start();
    require '../koneksi.php';

    $qAcc = "UPDATE izin SET isAccepted = 2 WHERE id_izin = ".$_GET['id_izin'];

    if($_SESSION['isAdmin'] != 2) {
        header("Location:../dashboard.php");
        $conn->close();
        exit;
    } else {
        $conn->query($qAcc);
        $conn->close();
        header("Location:../admin.php");
    }
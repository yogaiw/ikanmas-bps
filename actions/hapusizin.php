<?php 
    session_start();
    require '../koneksi.php';

    $qAcc = "DELETE FROM izin WHERE id_izin = ".$_GET['id_izin'];

    if($_SESSION['isAdmin'] != 2) {
        header("Location:../admin.php");
        $conn->close();
        exit;
    } else {
        $conn->query($qAcc);
        $conn->close();
        header("Location:../admin.php");
    }

?>
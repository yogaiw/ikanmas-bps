<?php 
    session_start();
    require 'koneksi.php';

    $qAcc = "UPDATE izin SET isAccepted = 2 WHERE id_izin = ".$_GET['id_izin'];
    $conn->query($qAcc);
    $conn->close();
    header("Location:admin.php");
?>
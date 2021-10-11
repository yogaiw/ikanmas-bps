<?php 

require_once dirname( __DIR__ ).'../koneksi.php';

class User {
    public function setIzinSaya($tglKeluar, $tglKembali, $jamKeluar, $jamKembali, $keperluan, $createdBy) {
        global $conn;
        $qKirimIzin = "
            INSERT INTO izin
            VALUES (
                '',
                '$createdBy',
                '$tglKeluar',
                '$jamKeluar',
                '$tglKembali',
                '$jamKembali',
                1,
                '$keperluan'
            );
        ";

        $conn->query($qKirimIzin);
    }

    public function getIzinSaya() {
        global $conn;
        $qShowIzinSaya = "SELECT * FROM izin WHERE id_pegawai = ".$_SESSION['current_user'];
        return $conn->query($qShowIzinSaya);
    }
}
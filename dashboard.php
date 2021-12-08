<?php 

    session_start();
    require 'koneksi.php';
    include_once 'classes/User.php';
    $pegawai = new User;

    if(!isset($_SESSION["login"])) { // Jika user belum login maka tidak bisa mengakses halaman ini
        header("Location:index.php");
        exit();
    }

    $getCurrentUser = $conn->query("SELECT * FROM pegawai WHERE id_pegawai = ".$_SESSION['current_user']);
    $currentUser = $getCurrentUser->fetch_assoc();

    // Proses Input Izin
    if(isset($_POST['kirim'])) {
        $tglKeluar = $_POST['tglKeluar'];
        $tglKembali = $_POST['tglKembali'];
        $jamKeluar = $_POST['jamKeluar'];
        $jamKembali = $_POST['jamKembali'];
        $keperluan = $_POST['keperluan'];
        $createdBy = $currentUser['id_pegawai'];

        $pegawai->setIzinSaya($tglKeluar, $tglKembali, $jamKeluar, $jamKembali, $keperluan, $createdBy);
    }

    $showIzinSaya = $pegawai->getIzinSaya();
?>

<!DOCTYPE html>
<html lang="id-id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BPS Kab. Banyumas</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php"><img src="assets/img/logo-bps.png" width="170px" alt=""></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="changepass.php">Ubah Password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Sidenav -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="admin.php" id="admin-link">
                                <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                                    Admin
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <p><?= $currentUser['nama_pegawai'] ?></p>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Dashboard</h1>
                        <div class="row">
                            <div class="col-xl-4 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-input me-1"></i>
                                        Input Izin Baru
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" placeholder="<?= $currentUser['nip'] ?>" disabled>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control"  placeholder="<?= $currentUser['nama_pegawai'] ?>" disabled>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <input type="text" name="tglKeluar" class="form-control" onfocus="(this.type='date')" id="date" placeholder="Tanggal Keluar" required>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <input type="text" name="tglKembali" class="form-control" onfocus="(this.type='date')" id="date" placeholder="Tanggal Kembali" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <input type="text" name="jamKeluar" class="form-control" onfocus="(this.type='time')" placeholder="Jam Keluar">
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <input type="text" name="jamKembali" class="form-control" onfocus="(this.type='time')" placeholder="Jam Kembali">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                    <textarea class="form-control" name="keperluan" placeholder="Keperluan" rows="5" required></textarea>
                                            </div>
                                            <a href="dashboard.php"><button type="submit" name="kirim" class="btn btn-primary d-flex fa-pull-right">Kirim</button></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Permintaan izin Anda
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal keluar</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Keperluan</th>
                                                    <th>Tanggal keluar</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                    foreach($showIzinSaya as $index=>$value): ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $value['keperluan'] ?></td>
                                                        <td><?= date("d-m-Y", strtotime($value['tanggal_keluar']))." pukul ".$value['jam_keluar'] ?></td>
                                                        <td><?= date("d-m-Y", strtotime($value['tanggal_kembali']))." pukul ".$value['jam_kembali'] ?></td>
                                                        <td>
                                                            <?php if($value['isAccepted'] == 2) { ?>
                                                                    <div class='text-center'>
                                                                        <a href="actions/cetak.php?id_izin=<?= $value['id_izin'] ?>">
                                                                            <button type="button" class="btn btn-primary btn-sm mt-1 mb-1"><i class="fas fa-print"></i></button>
                                                                        </a>
                                                                        <a href="actions/hapusizinsaya.php?id_izin=<?= $value['id_izin'] ?>">
                                                                            <button type="button" class="btn btn-danger btn-sm mt-1 mb-1"><i class="fas fa-trash-alt"></i></button>
                                                                        </a>
                                                                    </div>
                                                            <?php } else { ?>
                                                                    <div class='text-center'>
                                                                        <button class='btn btn-warning btn-sm mt-1 mb-1' disabled><i class="fas fa-clock"></i></button>
                                                                        <a href="actions/hapusizinsaya.php?id_izin=<?= $value['id_izin'] ?>">
                                                                            <button type="button" class="btn btn-danger btn-sm mt-1 mb-1"><i class="fas fa-trash-alt"></i></button>
                                                                        </a>
                                                                    </div>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Badan Pusat Statistik Kab. Banyumas</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php 
            // Jika parameter isAdmin = 2 maka menandakan user ini terdaftar sebagai Admin dan tombol Admin muncul
            if($_SESSION["isAdmin"] != 2) {
                echo "<script type=\"text/javascript\">
                    document.getElementById(\"admin-link\").href = '#';
                    document.getElementById(\"admin-link\").style.color='grey';
                </script>";
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="assets/js/datatables-simple-demo.js"></script>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
    </body>
</html>

<?php 

    session_start();
    require "koneksi.php";

    if(!isset($_SESSION["login"])) { // Jika user belum login maka tidak bisa mengakses halaman ini
        header("Location:index.php");
        exit();
    }

    $getCurrentUser = $conn->query("SELECT * FROM pegawai WHERE id_pegawai = ".$_SESSION['current_user']);
    $currentUser = $getCurrentUser->fetch_assoc();

    if($currentUser['isAdmin'] != 2) {
        header("Location:dashboard.php");
        exit;
    }

    $showAllPegawai = $conn->query(
        "SELECT * FROM pegawai"
    );

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
            <a class="navbar-brand ps-3" href="index.html"><img src="assets/img/logo-bps.png" width="170px" alt=""></a>
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
                        <li><a class="dropdown-item" href="#!">Ubah Password</a></li>
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
                            <a class="nav-link" href="" id="admin-link">
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
                        <h1 class="mt-4 mb-4">Semua Pegawai</h1>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Daftar Pegawai
                                        <a href="admin.php"><button class="btn btn-primary" style="float: right;">Lihat Daftar Izin</button></a>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th width="5">No.</th>
                                                    <th>NIP</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>NIP</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                    foreach($showAllPegawai as $index => $value): ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?= $value['nip'] ?></td>
                                                        <td><?= $value['nama_pegawai'] ?></td>
                                                        <td>
                                                            <?php if($_SESSION['current_user'] == $value['id_pegawai']) { ?>
                                                                <p>&nbsp;</p>
                                                            <?php } else if($value['isAdmin'] != 2) { ?>
                                                                <a href="actions/actionpromote.php?id_pegawai=<?= $value['id_pegawai'] ?>">
                                                                    <div class="text-center">
                                                                        <button type="button" class="btn btn-success btn-sm btn-">Jadikan Admin</button>
                                                                    </div>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="actions/actiondemote.php?id_pegawai=<?= $value['id_pegawai'] ?>">
                                                                    <div class="text-center"><button type="button" class="btn btn-danger btn-sm btn-block">Cabut Admin</button></div>
                                                                </a>
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
            if($currentUser["isAdmin"] != 2) {
                echo "<script type=\"text/javascript\">
                document.getElementById(\"admin-link\").style.display = \"none\";
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

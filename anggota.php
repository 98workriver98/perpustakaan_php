<?php
session_start();
include 'config/config.php';
if (!isset($_SESSION['nama_user'])) {
    header("location:index.php?notif=login-gagal");
}

$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include 'inc/head.php';
    ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include 'inc/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include 'inc/navbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Anggota</h1>
                    <div align="right">
                        <a href="tambah-anggota.php" class="btn btn-primary mb-3">Tambah Anggota</a>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-bordered" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor Hp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($dataAnggota = mysqli_fetch_assoc($queryAnggota)) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?> </td>
                                        <td><?php echo $dataAnggota['nama_anggota'] ?></td>
                                        <td><?php echo $dataAnggota['email'] ?></td>
                                        <td><?php echo $dataAnggota['no_hp'] ?></td>
                                        <td>
                                            <a href="tambah-anggota.php?edit=<?php echo $dataAnggota['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" href="tambah-anggota.php?delete=<?php echo $dataAnggota['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            @include 'inc/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
    @include 'inc/modal.php';
    ?>

    <!-- Bootstrap core JavaScript-->
    <?php
    @include 'inc/js.php';
    ?>


</body>

</html>
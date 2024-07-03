<?php
session_start();
include 'config/config.php';
if (!isset($_SESSION['nama_user'])) {
    header("location:index.php?notif=login-gagal");
}

$queryBuku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'inc/head.php'; ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'inc/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'inc/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Buku</h1>
                    <div align="right">
                        <a href="tambah-buku.php" class="btn btn-primary mb-3">Tambah Buku</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Buku</th>
                                    <th>Penerbit</th>
                                    <th>Penulis</th>
                                    <th>Jenis</th>
                                    <th>Deskripsi</th>
                                    <th>Qty</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($dataBuku = mysqli_fetch_assoc($queryBuku)) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?> </td>
                                        <td><?php echo $dataBuku['nama_buku'] ?></td>
                                        <td><?php echo $dataBuku['penerbit'] ?></td>
                                        <td><?php echo $dataBuku['penulis'] ?></td>
                                        <td><?php echo $dataBuku['jenis'] ?></td>
                                        <td><?php echo $dataBuku['deskripsi'] ?></td>
                                        <td><?php echo $dataBuku['qty'] ?></td>
                                        <td>
                                            <a href="tambah-buku.php?edit=<?php echo $dataBuku['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" href="tambah-buku.php?delete=<?php echo $dataBuku['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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
            <?php include 'inc/footer.php'; ?>
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
    <?php include 'inc/modal.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <?php include 'inc/js.php'; ?>

</body>

</html>
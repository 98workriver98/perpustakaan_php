<?php
session_start();
include 'config/config.php';

if (isset($_POST['simpan'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $penulis = $_POST['penulis'];
    $jenis = $_POST['jenis'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];

    $insertBuku = mysqli_query($koneksi, "INSERT INTO buku (nama_buku, penerbit, penulis, jenis, deskripsi, qty) VALUES('$nama_buku','$penerbit','$penulis','$jenis','$deskripsi','$qty')");
    header("location:buku.php?notif=tambah-success");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");
    header('location:buku.php?notif=delete-success');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
    $dataEdit  = mysqli_fetch_assoc($queryEdit);
}

if (isset($_POST['edit'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $penulis = $_POST['penulis'];
    $jenis = $_POST['jenis'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];

    $id = $_GET['edit'];

    $edit = mysqli_query($koneksi, "UPDATE buku SET nama_buku='$nama_buku', penerbit='$penerbit', penulis='$penulis', jenis='$jenis', deskripsi='$deskripsi', qty='$qty' WHERE id = '$id'");
    header('location:buku.php?notif=update-success');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    @include 'inc/head.php';
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
                    <?php if (isset($_GET['edit'])) { ?>
                        <h1 class="h3 mb-4 text-gray-800">Edit Buku</h1>
                    <?php } else { ?>
                        <h1 class="h3 mb-4 text-gray-800">Tambah Buku</h1>
                    <?php } ?>

                    <?php if (isset($_GET['edit'])) { ?>
                        <div class="card">
                            <div class="card-header">Edit Buku</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="">Nama Buku</label>
                                        <input value="<?php echo $dataEdit['nama_buku'] ?>" type="text" class="form-control" name="nama_buku" placeholder="Masukkan Nama Buku Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Penerbit</label>
                                        <input value="<?php echo $dataEdit['penerbit'] ?>" type="text" class="form-control" name="penerbit" placeholder="Masukkan Nama Penerbit Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Penulis</label>
                                        <input value="<?php echo $dataEdit['penulis'] ?>" type="text" class="form-control" name="penulis" placeholder="Masukkan Nama Penulis Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Jenis</label>
                                        <input value="<?php echo $dataEdit['jenis'] ?>" type="text" class="form-control" name="jenis" placeholder="Masukkan Jenis Buku Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Deskripsi</label>
                                        <input value="<?php echo $dataEdit['deskripsi'] ?>" type="text" class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Buku Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Qty</label>
                                        <input value="<?php echo $dataEdit['qty'] ?>" type="number" class="form-control" name="qty" placeholder="Masukkan Qty Buku Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="edit" value="Ubah">
                                        <a href="buku.php" class="btn btn-danger">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card">
                            <div class="card-header">Tambah Buku</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <label for="">Nama Buku</label>
                                    <input type="text" class="form-control" name="nama_buku" placeholder="Masukkan Nama Buku Anda..">
                                    <div class="mb-3">
                                        <label for="">Penerbit</label>
                                        <input type="text" class="form-control" name="penerbit" placeholder="Masukkan Nama Penerbit Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Penulis</label>
                                        <input type="text" class="form-control" name="penulis" placeholder="Masukkan Nama Penulis Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Jenis</label>
                                        <input type="text" class="form-control" name="jenis" placeholder="Masukkan Jenis Buku Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Deskripsi</label>
                                        <input type="text" class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Buku Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty" placeholder="Masukkan Qty Buku Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                                        <a href="buku.php" class="btn btn-danger">Kembali</a>
                                    </div>
                            </div>
                            </form>
                        </div>
                </div>

            <?php } ?>

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
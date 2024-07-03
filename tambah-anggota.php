<?php
session_start();
include 'config/config.php';

if (isset($_POST['simpan'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $insertAnggota = mysqli_query($koneksi, "INSERT INTO anggota (nama_anggota, email, no_hp) VALUES('$nama_anggota','$email','$no_hp')");
    header("location:anggota.php?notif=tambah-success");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM anggota WHERE id='$id'");
    header('location:anggota.php?notif=delete-success');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $queryEdit = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id='$id' ");
    $dataEdit  = mysqli_fetch_assoc($queryEdit);
}

if (isset($_POST['edit'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "UPDATE anggota SET nama_anggota='$nama_anggota', email='$email', no_hp='$no_hp' WHERE id='$id' ");
    header('location:anggota.php?notif=update-success');
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
                include 'inc/navbar.php'
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php if (isset($_GET['edit'])) { ?>
                        <h1 class="h3 mb-4 text-gray-800">Edit Anggota</h1>
                    <?php } else { ?>
                        <h1 class="h3 mb-4 text-gray-800">Tambah Anggota</h1>
                    <?php } ?>

                    <?php if (isset($_GET['edit'])) { ?>
                        <div class="card">
                            <div class="card-header">Edit Anggota</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="">Nama Anggota</label>
                                        <input value="<?php echo $dataEdit['nama_anggota'] ?>" type="text" class="form-control" name="nama_anggota" placeholder="Masukkan Nama Anggota Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Email </label>
                                        <input value="<?php echo $dataEdit['email'] ?>" type="email" class="form-control" name="email" placeholder="Masukkan Email Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Nomor Hp</label>
                                        <input value="<?php echo $dataEdit['no_hp'] ?>" type="number" class="form-control" name="no_hp" placeholder="Masukkan Nomor Hp Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="edit" value="edit">
                                        <a href="anggota.php" class="btn btn-danger">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card">
                            <div class="card-header">Tambah Anggota</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="">Nama Anggota</label>
                                        <input type="text" class="form-control" name="nama_anggota" placeholder="Masukkan Nama Anggota Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Email </label>
                                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Nomor Hp</label>
                                        <input type="number" class="form-control" name="no_hp" placeholder="Masukkan Nomor Hp Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="simpan" value="simpan">
                                        <a href="anggota.php" class="btn btn-danger">Kembali</a>
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
            @include 'inc/footer.php'
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
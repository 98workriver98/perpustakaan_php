<?php
session_start();
include 'config/config.php';

if (isset($_POST['simpan'])) {
    $nama_user = $_POST['nama_user'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $id_level = $_POST['id_level'];
    $insertUser = mysqli_query($koneksi, "INSERT INTO user (nama_user, email, password, id_level) VALUES('$nama_user','$email','$password','$id_level')");
    header("location:user.php?notif=tambah-success");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
    header('location:user.php?notif=delete-success');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id' ");
    $dataEdit  = mysqli_fetch_assoc($queryEdit);
}

if (isset($_POST['edit'])) {
    $nama_user = $_POST['nama_user'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "UPDATE user SET nama_user='$nama_user', email='$email', password='$password' WHERE id='$id' ");
    header('location:user.php?notif=update-success');
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
                        <h1 class="h3 mb-4 text-gray-800">Edit User</h1>
                    <?php } else { ?>
                        <h1 class="h3 mb-4 text-gray-800">Tambah User</h1>
                    <?php } ?>

                    <?php if (isset($_GET['edit'])) { ?>
                        <div class="card">
                            <div class="card-header">Edit User</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="">Nama User</label>
                                        <input value="<?php echo $dataEdit['nama_user'] ?>" type="text" class="form-control" name="nama_user" placeholder="Masukkan Nama User Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Email </label>
                                        <input value="<?php echo $dataEdit['email'] ?>" type="email" class="form-control" name="email" placeholder="Masukkan Email Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Password</label>
                                        <input value="<?php echo $dataEdit['password'] ?>" type="password" class="form-control" name="password" placeholder="Masukkan Password Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="edit" value="edit">
                                        <a href="user.php" class="btn btn-danger">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card">
                            <div class="card-header">Tambah User</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="">Nama User</label>
                                        <input type="text" class="form-control" name="nama_user" placeholder="Masukkan Nama User Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Email </label>
                                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Level</label>
                                        <select name="id_level" id="" class="form-control">
                                            <option value="">Pilih Level</option>
                                            <?php $queryLevel = mysqli_query($koneksi, "SELECT * FROM level"); ?>
                                            <?php while ($dataLevel = mysqli_fetch_assoc($queryLevel)) { ?>
                                                <option value="<?php echo $dataLevel['id']; ?>"><?php echo $dataLevel['nama_level'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="simpan" value="simpan">
                                        <a href="user.php" class="btn btn-danger">Kembali</a>
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
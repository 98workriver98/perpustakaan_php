<?php
session_start();
include 'config/config.php';

if (isset($_POST['simpan'])) {
    $id_anggota = $_POST['id_anggota'];
    $no_transaksi = $_POST['no_transaksi'];
    $insertPeminjam = mysqli_query($koneksi, "INSERT INTO peminjam (id_anggota, no_transaksi) VALUES('$id_anggota','$no_transaksi')");
    header("location:peminjam.php?notif=tambah-success");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM peminjam WHERE id='$id'");
    header('location:peminjam.php?notif=delete-success');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $queryEdit = mysqli_query($koneksi, "SELECT * FROM peminjam WHERE id='$id' ");
    $dataEdit  = mysqli_fetch_assoc($queryEdit);
}

if (isset($_POST['edit'])) {
    $id_anggota = $_POST['id_anggota'];
    $no_transaksi = $_POST['no_transaksi'];

    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "UPDATE peminjam SET id_anggota='$id_anggota', no_transaksi='$no_transaksi' WHERE id='$id' ");
    header('location:peminjam.php?notif=update-success');
}

// INI UNTUK RELASI ANTARA TABEL "peminjam" DENGAN TABEL "anggota" 
$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
// END

// INI UNTUK QUERY TABEL "detail_peminjam" YANG AKAN DI INPUT DI NOMOR TRANSAKSI
$no_transaksi = mysqli_query($koneksi, "SELECT max(id) AS kode FROM peminjam");
$data = mysqli_fetch_assoc($no_transaksi);
$huruf = "transaksi";
$urutan = $data['kode'];
$urutan++;
$kode_transaksi = $huruf . date("dmy") . sprintf("%03s", $urutan);
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
                        <h1 class="h3 mb-4 text-gray-800">Edit Peminjam</h1>
                    <?php } else { ?>
                        <h1 class="h3 mb-4 text-gray-800">Tambah Peminjam</h1>
                    <?php } ?>

                    <?php if (isset($_GET['edit'])) { ?>
                        <div class="card">
                            <div class="card-header">Edit Peminjam</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="">Nomor Transaksi </label>
                                        <input value="<?php echo $dataEdit['no_transaksi'] ?>" type="number" class="form-control" name="no_transaksi" placeholder="Masukkan Nomor Transaksi Anda..">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="edit" value="edit">
                                        <a href="peminjam.php" class="btn btn-danger">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="card">
                            <div class="card-header">Tambah Peminjam</div>
                            <div class="card-body">
                                <form action="" method="post">

                                    <!-- INI UNTUK MEMBUAT PEMBAGIAN KOLOM PADA TABLE -->
                                    <!-- KOLOM KE 1 -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            <label for="">Nama Anggota</label>
                                            <select name="id_anggota" id="" class="form-control">
                                                <option value="">Pilih Anggota</option>
                                                <?php while ($rowAnggota = mysqli_fetch_assoc($queryAnggota)) : ?>
                                                    <option value="<?php echo $rowAnggota['id'] ?>"><?php echo $rowAnggota['nama_anggota'] ?></option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>

                                        <!-- KOLOM KE 2 -->
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-success btn-sm">Tambah Anggota Baru</button>
                                        </div>
                                    </div>

                                    <!-- KOLOM KE 1 -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            <label for="">Nomor Transaksi</label>
                                            <input value="<?php echo $kode_transaksi ?>" type="text" readonly name="no_transaksi" class="form-control" value="">
                                        </div>
                                    </div>

                                    <br><br>

                                    <div class="table-transaction">
                                        <div align="right" class="mb-3">
                                            <button type="button" class="btn btn-primary btn-sm btn-add">Tambah</button>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Buku</th>
                                                    <th>Keterangan</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Tanggal Pengembalian</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="id_buku" id="" class="id_buku[]">
                                                            <option value="">Pilih Buku</option>
                                                            <option value=""></option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="keterangan[]" class="form-control"></td>
                                                    <td><input type="date" name="tanggal_pinjam[]" class="form-control"></td>
                                                    <td><input type="date" name="tanggal_pengembalian[]" class="form-control"></td>
                                                    <td>Hapus</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <br><br>

                                    <!-- KOLOM KE 1 -->
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="simpan" value="simpan">
                                        <a href="peminjam.php" class="btn btn-danger">Kembali</a>
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

    <script>
        $('.btn-add').click(function() {
            alert('duar');
        });
    </script>

</body>

</html>
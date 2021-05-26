<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page1 = "datajabatan";
    $page = "Data Jabatan";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['iduser'];
        $nama = $_POST['nama_jabatan'];

        $cekuser = mysqli_query($conn, "SELECT * FROM jabatan WHERE username='$nama'");

        if ($conn->connect_error) {
            echo '<script>
				setTimeout(function() {
					swal({
						title: "Username sudah digunakan",
						text: "Username sudah digunakan, gunakan username lain!",
						icon: "error"
						});
					}, 500);
			</script>';
        } else {
            $add = mysqli_query($conn, "UPDATE jabatan SET nama_jabatan='$nama' WHERE id='$id'");
            echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Jabatan telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
        }
    }

    if (isset($_POST['submit2'])) {
        $nama = $_POST['nama_jabatan'];

        $cekuser = mysqli_query($conn, "SELECT * FROM jabatan WHERE username='$nama'");
        if ($conn->connect_error) {
            echo '<script>
				setTimeout(function() {
					swal({
						title: "Username sudah digunakan",
						text: "Username sudah digunakan, gunakan username lain!",
						icon: "error"
						});
					}, 500);
			</script>';
        } else {
            $add = mysqli_query($conn, "INSERT INTO jabatan (nama_jabatan) VALUES ('$nama')");
            echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Jabatan telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
        }
    }
    ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <?php
            include 'atoms/navbar.php';
            include 'atoms/sidebar.php';
            ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Administrasi</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?php echo $page; ?></h4>
                                        <div class="card-header-action">
                                            <a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah Jabatan</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Nama Jabatan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM jabatan");
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo ucwords($row['nama_jabatan']); ?></td>
                                        </div>
                                        </td>
                                        <td>
                                            <span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_jabatan']; ?>">
                                                <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                            </span>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'admin/delete.php?type=jabatan&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
                                        </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="addUser">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="needs-validation" novalidate="">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Jabatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_jabatan" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="editUser">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="needs-validation" novalidate="">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Jabatan</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="iduser" required="" id="getId">
                                    <input type="text" class="form-control" name="nama_jabatan" required="" id="getNama">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include "atoms/all_js.php"; ?>

    <script>
        $('#editUser').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var nama = button.data('nama')
            var id = button.data('id')
            var modal = $(this)
            modal.find('#getId').val(id)
            modal.find('#getNama').val(nama)
        })
    </script>
</body>

</html>
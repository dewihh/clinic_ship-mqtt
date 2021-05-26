<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page1 = "poli";
    $page = "Catatan Data Poli";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['iduser'];
        $nama = $_POST['nama_poli'];
        $user = $_POST['ruangan_poli'];

        $cekuser = mysqli_query($conn, "SELECT * FROM poli WHERE username='$nama'");

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
            $add = mysqli_query($conn, "UPDATE poli SET nama_poli='$nama', ruangan_poli='$user' WHERE id='$id'");
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
        $nama = $_POST['nama_poli'];
        $user = $_POST['ruangan_poli'];

        $cekuser = mysqli_query($conn, "SELECT * FROM poli WHERE username='$nama'");
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
            $add = mysqli_query($conn, "INSERT INTO poli (nama_poli,ruangan_poli) VALUES ('$nama', '$user')");
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
                                        <h4>Data Poli</h4>
                                        <div class="card-header-action">
                                            <a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah Poli</a>
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
                                                        <th>Nama Poli</th>
                                                        <th>Ruangan Poli</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM poli");
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo ucwords($row['nama_poli']); ?></td>
                                                            <td><?php echo ucwords($row['ruangan_poli']); ?></td>
                                        </div>
                                        </td>
                                        <td>
                                            <span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_poli']; ?>" data-user="<?php echo $row['ruangan_poli']; ?>">
                                                <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                            </span>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'admin/delete.php?type=poli&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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
                        <h5 class="modal-title">Tambah Poli</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="needs-validation" novalidate="">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Poli</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_poli" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ruangan Poli</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ruangan_poli" required="">
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
                                <label class="col-sm-3 col-form-label">Nama Poli</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="iduser" required="" id="getId">
                                    <input type="text" class="form-control" name="nama_poli" required="" id="getNama">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ruangan Poli</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ruangan_poli" required="" id="getUser">
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
            var user = button.data('user')
            var id = button.data('id')
            var modal = $(this)
            modal.find('#getId').val(id)
            modal.find('#getNama').val(nama)
            modal.find('#getUser').val(user)
        })
    </script>
</body>

</html>
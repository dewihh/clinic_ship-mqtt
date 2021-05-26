<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page1 = "jadwal";
    $page = "Jadwal Praktek Dokter";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['iduser'];
        $nama = $_POST['nama_dokter'];
        $user = $_POST['hari'];
        $gend = $_POST['mulai'];
        $izin = $_POST['selesai'];
        $poli = $_POST['poli'];

        $cekuser = mysqli_query($conn, "SELECT * FROM jadwal WHERE username='$nama'");

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
            $add = mysqli_query($conn, "UPDATE jadwal SET nama_dokter='$nama', hari='$user', mulai='$gend', selesai='$izin', poli='$poli' WHERE id='$id'");
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
        $nama = $_POST['nama_dokter'];
        $user = $_POST['hari'];
        $gend = $_POST['mulai'];
        $izin = $_POST['selesai'];
        $poli = $_POST['poli'];

        $cekuser = mysqli_query($conn, "SELECT * FROM jadwal WHERE username='$nama'");
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
            $add = mysqli_query($conn, "INSERT INTO jadwal (nama_dokter,hari,mulai,selesai,poli) VALUES ('$nama', '$user', '$gend', '$izin', '$poli')");
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
                                            <a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah Jadwal</a>
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
                                                        <th>Nama Dokter</th>
                                                        <th>Hari</th>
                                                        <th>Jam Mulai</th>
                                                        <th>Jam Selesai</th>
                                                        <th>Poli</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM jadwal");
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo ucwords($row['nama_dokter']); ?></td>
                                                            <td><?php echo ucwords($row['hari']); ?></td>
                                                            <td><?php echo ucwords($row['mulai']); ?></td>?>
                                                            <td><?php echo ucwords($row['selesai']); ?></td>
                                                            <td><?php echo ucwords($row['poli']); ?></td>

                                        </div>
                                        </td>
                                        <td>
                                            <span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_dokter']; ?>" data-user="<?php echo $row['hari']; ?>" data-gend="<?php echo $row['mulai']; ?>" data-izin="<?php echo $row['selesai']; ?>" data-poli="<?php echo $row['poli']; ?>">
                                                <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                            </span>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'admin/delete.php?type=jadwal&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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
                        <h5 class="modal-title">Tambah Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="needs-validation" novalidate="">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Dokter</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_dokter" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="hari" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jam Mulai</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mulai" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jam Selesai</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="selesai" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Poli</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="poli" required="">
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
                                <label class="col-sm-3 col-form-label">Nama Dokter</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="iduser" required="" id="getId">
                                    <input type="text" class="form-control" name="nama_dokter" required="" id="getNama">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="hari" required="" id="getUser">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jam Mulai</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mulai" required="" id="getUser">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jam Selesai</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="selesai" required="" id="getIzin">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Poli</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="poli" required="" id="getPoli">
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
            var gend = button.data('gend')
            var izin = button.data('izin')
            var poli = button.data('poli')
            var id = button.data('id')
            var modal = $(this)
            modal.find('#getId').val(id)
            modal.find('#getNama').val(nama)
            modal.find('#getUser').val(user)
            modal.find('#getGend').val(gend)
            modal.find('#getIzin').val(izin)
            modal.find('#getPoli').val(poli)
        })
    </script>
</body>

</html>
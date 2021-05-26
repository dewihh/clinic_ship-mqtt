<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page1 = "data";
    $page = "Catatan Data Paramedik";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";
    include "atoms/tgl_ind.php";
    include "atoms/umur.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['iduser'];
        $nama = $_POST['kode_paramedik'];
        $user = $_POST['nama_paramedik'];
        $gend = $_POST['kelamin'];
        $sipp = $_POST['sipp'];
        $tgl = $_POST['tgl_lahir'];
        $poli = $_POST['poli'];

        $cekuser = mysqli_query($conn, "SELECT * FROM paramedik WHERE username='$nama'");

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
            $add = mysqli_query($conn, "UPDATE paramedik SET kode_paramedik='$nama', nama_paramedik='$user', sipp='$sipp', kelamin='$gend', tgl_lahir='$tgl', poli='$poli' WHERE id='$id'");
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
        $nama = $_POST['kode_paramedik'];
        $user = $_POST['nama_paramedik'];
        $gend = $_POST['kelamin'];
        $sipp = $_POST['sipp'];
        $tgl = $_POST['tgl_lahir'];
        $poli = $_POST['poli'];

        $cekuser = mysqli_query($conn, "SELECT * FROM paramedik WHERE username='$nama'");
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
            $add = mysqli_query($conn, "INSERT INTO paramedik (kode_paramedik,nama_paramedik,kelamin,sipp,tgl_lahir,poli) VALUES ('$nama', '$user', '$gend', '$sipp', '$tgl', '$poli')");
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
                        <h1>Adiministrasi</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Paramedik</h4>
                                        <div class="card-header-action">
                                            <a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah Paramedik</a>
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
                                                        <th>Kode Paramedik</th>
                                                        <th>Nama Paramedik</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>SIPP</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Usia</th>
                                                        <th>Poli</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM paramedik");
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo ucwords($row['kode_paramedik']); ?></td>
                                                            <td><?php echo ucwords($row['nama_paramedik']); ?></td>
                                                            <td><?php
                                                                if ($row['kelamin'] == '1') {
                                                                    echo '<div class="badge badge-pill badge-primary mb-1">Laki-Laki';
                                                                } else {
                                                                    echo '<div class="badge badge-pill badge-success mb-1">Perempuan';
                                                                } ?></td>
                                                            <td><?php echo ucwords($row['sipp']); ?></td>
                                                            <td><?php if ($row['tgl_lahir'] == "") {
                                                                    echo "-";
                                                                } else {
                                                                    echo tgl_indo($row['tgl_lahir']);
                                                                } ?></td>
                                                            <td><?php if ($row['tgl_lahir'] == "") {
                                                                    echo "-";
                                                                } else {
                                                                    umur($row['tgl_lahir']);
                                                                } ?></td>
                                                            <td><?php echo ucwords($row['poli']); ?></td>

                                        </div>
                                        </td>
                                        <td>
                                            <span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['kode_paramedik']; ?>" data-user="<?php echo $row['nama_paramedik']; ?>" data-gend="<?php echo $row['kelamin']; ?>" data-sipp="<?php echo $row['sipp']; ?>" data-tgl="<?php echo $row['tgl_lahir']; ?>" data-poli="<?php echo $row['poli']; ?>">
                                                <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                            </span>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'admin/delete.php?type=paramedik&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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
                        <h5 class="modal-title">Tambah Paramedik</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="needs-validation" novalidate="">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode Paramedik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kode_paramedik" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Paramedik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_paramedik" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control selectric" name="kelamin">
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">SIPP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="sipp" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                                <div class="form-group col-sm-9">
                                    <input type="text" class="form-control datepicker" id="getTgl" name="tgl_lahir">
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
                                <label class="col-sm-3 col-form-label">Kode Paramedik</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="iduser" required="" id="getId">
                                    <input type="text" class="form-control" name="kode_paramedik" required="" id="getNama">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Paramedik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_paramedik" required="" id="getUser">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control selectric" name="kelamin" id="getGend">
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">SIPP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="sipp" required="" id="getIzin">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                                <div class="form-group col-sm-9">
                                    <input type="text" class="form-control datepicker" id="getTgl" name="tgl_lahir" id="getTgl">
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
            var sipp = button.data('sipp')
            var tgl = button.data('tgl')
            var poli = button.data('poli')
            var id = button.data('id')
            var modal = $(this)
            modal.find('#getId').val(id)
            modal.find('#getNama').val(nama)
            modal.find('#getUser').val(user)
            modal.find('#getGend').val(gend)
            modal.find('#getSIPP').val(sipp)
            modal.find('#getTgl').val(tgl)
            modal.find('#getPoli').val(poli)
        })
    </script>
</body>

</html>
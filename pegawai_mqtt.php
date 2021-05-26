<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page1 = "Data Pegawai";
    $page = "Data Pegawai";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";
    include "atoms/umur.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['iduser'];
        $kode = $_POST['id_pegawai'];
        $nama = $_POST['nama'];
        $gend = $_POST['kelamin'];
        $npwp = $_POST['npwp'];
        $tgl = $_POST['tgl_lahir'];
        $user = $_POST['username'];
        $mail  = $_POST['email'];
        $alam = $_POST['alamat'];
        $job = $_POST['pekerjaan'];
        $old_pass = $_POST['old_password'];
        $new_pass = $_POST['new_password'];

        if ($old_pass == "" && $new_pass == "") {
            $up1 = mysqli_query($conn, "UPDATE pegawai_mqtt SET id_pegawai='$kode', nama_pegawai='$nama', kelamin='$gend', npwp='$npwp', tgl_lahir='$tgl', username='$user', email='$mail', pekerjaan='$job',alamat='$alam' WHERE id='$id'");
            echo '<script>
			setTimeout(function() {
				swal({
					title: "Data Diubah",
					text: "Data berhasil diubah!",
					icon: "success"
					});
					}, 500);
					</script>';
        } elseif ($old_pass != "" && $new_pass != "") {
            $cekpass = mysqli_query($conn, "SELECT * FROM pegawai_mqtt WHERE id='$id' AND password='" . md5($old_pass) . "'");
            $cekada = mysqli_num_rows($cekpass);
            if ($cekada == 0) {
                echo '<script>
						setTimeout(function() {
							swal({
								title: "Password salah",
								text: "Password salah, cek kembali form password anda!",
								icon: "error"
								});
								}, 500);
								</script>';
            } else {
                $up2 = mysqli_query($conn, "UPDATE pegawai_mqtt SET id_pegawai='$kode', nama_pegawai='$nama', kelamin='$gend', npwp='$npwp', tgl_lahir='$tgl', username='$user', email='$mail', password='" . md5($new_pass) . "', pekerjaan='$job',alamat='$alam' WHERE id='$id'");
                echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data atau Password berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
            }
        }
    }

    if (isset($_POST['submit2'])) {
        $kode = $_POST['id_pegawai'];
        $nama = $_POST['nama'];
        $gend = $_POST['kelamin'];
        $npwp = $_POST['npwp'];
        $tgl = $_POST['tgl_lahir'];
        $user = $_POST['username'];
        $mail  = $_POST['email'];
        $alam = $_POST['alamat'];
        $pass = $_POST['password'];
        $job = $_POST['pekerjaan'];

        $cekuser = mysqli_query($conn, "SELECT * FROM pegawai_mqtt WHERE username='$user'");
        $baris = mysqli_num_rows($cekuser);
        if ($baris >= 1) {
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
            $add = mysqli_query($conn, "INSERT INTO pegawai_mqtt (username, email, password, id_pegawai, nama_pegawai, kelamin, npwp, tgl_lahir, alamat, pekerjaan) VALUES ('$user', '$mail', '" . md5($pass) . "', '$kode', '$nama', '$gend', $npwp, '$tgl', '$alam', '$job')");
            echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Pegawai telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
        }
    }
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <script src="jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
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
                                            <a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah Pegawai</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            No
                                                        </th>
                                                        <th>ID Pegawai</th>
                                                        <th>Nama Pegawai</th>
                                                        <th>Alamat</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>NPWP</th>
                                                        <th>Umur</th>
                                                        <th>Pekerjaan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM pegawai_mqtt");
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo ucwords($row['id_pegawai']); ?></td>
                                                            <td><?php echo ucwords($row['nama_pegawai']); ?></td>
                                                            <td><?php echo ucwords($row['alamat']); ?></td>
                                                            <td><?php
                                                                if ($row['kelamin'] == '1') {
                                                                    echo '<div class="badge badge-pill badge-primary mb-1">Laki-Laki';
                                                                } else {
                                                                    echo '<div class="badge badge-pill badge-success mb-1">Perempuan';
                                                                } ?></td>
                                                            <td><?php echo ucwords($row['npwp']); ?></td>
                                                            <td><?php if ($row['tgl_lahir'] == "") {
                                                                    echo "-";
                                                                } else {
                                                                    umur($row['tgl_lahir']);
                                                                } ?></td>
                                                            <td><?php
                                                                if ($row['pekerjaan'] == '1') {
                                                                    echo '<div class="badge badge-pill badge-danger mb-1">Dokter Umum';
                                                                } elseif ($row['pekerjaan'] == '2') {
                                                                    echo '<div class="badge badge-pill mb-1 bg-badge">Apoteker';
                                                                } elseif ($row['pekerjaan'] == '3') {
                                                                    echo '<div class="badge badge-pill badge-secondary mb-1">Dokter Gigi';
                                                                } elseif ($row['pekerjaan'] == '4') {
                                                                    echo '<div class="badge badge-pill badge-info mb-1 ">Dokter Gizi';
                                                                } elseif ($row['pekerjaan'] == '5') {
                                                                    echo '<div class="badge badge-pill badge-light mb-1">Dokter KIA';
                                                                } elseif ($row['pekerjaan'] == '6') {
                                                                    echo '<div class="badge badge-pill badge-dark mb-1">Staff Administrasi';
                                                                } else {
                                                                    echo '<div class="badge badge-pill badge-warning mb-1">Kasir';
                                                                }
                                                                ?>
                                        </div>
                                        </td>
                                        <td>
                                            <span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-kode="<?php echo $row['id_pegawai']; ?>" data-nama="<?php echo $row['nama_pegawai']; ?>" data-gend="<?php echo $row['kelamin']; ?>" data-npwp="<?php echo $row['npwp'] ?>" data-tgls="<?php echo $row['tgl_lahir'] ?>" data-user="<?php echo $row['username']; ?>" data-mail="<?php echo $row['email']; ?>" data-job="<?php echo $row['pekerjaan']; ?>" data-alam="<?php echo $row['alamat']; ?>">
                                                <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                            </span>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'admin/delete.php?type=pegawai&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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
                        <h5 class="modal-title">Tambah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="needs-validation" novalidate="">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Pegawai</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="id_pegawai" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" required="">
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
                                <label class="col-sm-3 col-form-label">NPWP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="npwp" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input id="tgls" type="text" class="form-control" name="tgl_lahir" data-provide="datepicker" required="">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" required="" name="alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <select class="form-control selectric" name="pekerjaan">
                                    <option value="1">Dokter Umum</option>
                                    <option value="2">Apoteker</option>
                                    <option value="3">Dokter Gigi</option>
                                    <option value="4">Dokter Gizi</option>
                                    <option value="5">Dokter KIA</option>
                                    <option value="6">Staff Administrasi</option>
                                    <option value="7">Kasir</option>
                                </select>
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
                                <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="iduser" required="" id="getId">
                                    <input type="text" class="form-control" name="nama" required="" id="getNama">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Pegawai</label>
                                <div class="col-sm-9">

                                    <input type="text" class="form-control" name="id_pegawai" required="" id="getKode">
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
                                <label class="col-sm-3 col-form-label">NPWP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="npwp" required="" id="getNPWP">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input id="tgls" type="text" class="form-control" name="tgl_lahir" required="" data-provide="datepicker" id="getTgls">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" required="" id="getUser">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" required="" id="getEmail">
                                    <div class="invalid-feedback">
                                        Mohon data diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <select class="form-control selectric" name="pekerjaan" id='getJob'>
                                    <option value="1">Dokter Umum</option>
                                    <option value="2">Apoteker</option>
                                    <option value="3">Dokter Gigi</option>
                                    <option value="4">Dokter Gizi</option>
                                    <option value="5">Dokter KIA</option>
                                    <option value="6">Staff Administrasi</option>
                                    <option value="7">Kasir</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" required="" name="alamat" id="getAddrs"></textarea>
                            </div>
                            <div class="alert alert-light text-center">
                                Jika password tidak diganti, form dibawah dikosongi saja.
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" name="old_password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" name="new_password" class="form-control">
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

    <script type="text/javascript">
        $(function() {
            $('#tgls').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            }).datepicker('update', new Date());
        });
    </script>

    <script>
        $('#editUser').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var nama = button.data('nama')
            var kode = button.data('kode')
            var gend = button.data('gend')
            var npwp = button.data('npwp')
            var tgls = button.data('tgls')
            var user = button.data('user')
            var mail = button.data('mail')
            var job = button.data('job')
            var alam = button.data('alam')
            var id = button.data('id')
            var modal = $(this)
            modal.find('#getId').val(id)
            modal.find('#getNama').val(nama)
            modal.find('#getKode').val(kode)
            modal.find('#getGend').val(gend)
            modal.find('#getNPWP').val(npwp)
            modal.find('#getTgls').val(tgls)
            modal.find('#getUser').val(user)
            modal.find('#getEmail').val(mail)
            modal.find('#getJob').val(job)
            modal.find('#getAddrs').val(alam)
        })
    </script>
</body>

</html>
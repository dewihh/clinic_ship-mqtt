<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page1 = "Obat";
    $page = "Obat";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];

        $up2 = mysqli_query($conn, "UPDATE obat SET kode='$kode', nama_obat='$nama', stok='$stok', harga='$harga' WHERE id='$id'");
        echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Obat berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
    }

    if (isset($_POST['submit2'])) {
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];

        $add = mysqli_query($conn, "INSERT INTO obat (kode, nama_obat, stok, harga) VALUES ('$kode', '$nama', '$stok', '$harga')");
        echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Obat baru telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
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
                        <h1>Farmasi</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Obat</h4>
                                        <div class="card-header-action">
                                            <a href="#" class="btn btn-primary" data-target="#addObat" data-toggle="modal">Tambahkan Obat Baru</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Kode Obat</th>
                                                        <th>Nama</th>
                                                        <th>Stok</th>
                                                        <th>Harga per unit</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM obat");
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo ucwords($row['kode']) ?></td>
                                                            <td><?php echo ucwords($row['nama_obat']) ?></td>
                                                            <td><?php echo $row['stok'] . " Unit"; ?></td>
                                                            <td>Rp. <?php echo number_format($row['harga'], 0, ".", "."); ?></td>
                                                            <td align="center">
                                                                <span data-target="#editObat" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-kode="<?php echo $row['kode']; ?>" data-nama="<?php echo $row['nama_obat']; ?>" data-harga="<?php echo $row['harga']; ?>" data-stok="<?php echo $row['stok']; ?>">
                                                                    <a class="btn btn-primary btn-action mr-1" title="Edit Data Obat" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                                                </span>
                                                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'admin/delete.php?type=obat&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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

            <div class="modal fade" tabindex="-1" role="dialog" id="addObat">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Obat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Obat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="kode" required="" id="getObat">
                                        <div class="invalid-feedback">
                                            Mohon data diisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Obat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" required="" id="getNama">
                                        <div class="invalid-feedback">
                                            Mohon data diisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Stok Obat</label>
                                    <div class="form-group col-sm-9">
                                        <input type="number" class="form-control" name="stok" required="" value="0">
                                        <div class="invalid-feedback">
                                            Mohon data diisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga per unit</label>
                                    <div class="input-group col-sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="harga" required="" value="0">
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

            <div class="modal fade" tabindex="-1" role="dialog" id="editObat">
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
                                    <label class="col-sm-3 col-form-label">Kode Obat</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="form-control" name="id" required="" id="getId">
                                        <input type="text" class="form-control" name="kode" required="" id="getObat">
                                        <div class="invalid-feedback">
                                            Mohon data diisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Obat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" required="" id="getNama">
                                        <div class="invalid-feedback">
                                            Mohon data diisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Stok Obat</label>
                                    <div class="form-group col-sm-9">
                                        <input type="number" class="form-control" name="stok" required="" id="getStok">
                                        <div class="invalid-feedback">
                                            Mohon data diisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga per unit</label>
                                    <div class="input-group col-sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="harga" required="" id="getHarga">
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
        $('#editObat').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var kode = button.data('kode')
            var nama = button.data('nama')
            var id = button.data('id')
            var stok = button.data('stok')
            var harga = button.data('harga')
            var modal = $(this)
            modal.find('#getId').val(id)
            modal.find('#getObat').val(kode)
            modal.find('#getNama').val(nama)
            modal.find('#getStok').val(stok)
            modal.find('#getHarga').val(harga)
        })
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page1 = "Data Pasien";
  $page = "Catatan Data Pasien";
  session_start();
  include 'admin/connect.php';
  include "atoms/head.php";
  include "atoms/tgl_ind.php";
  include "atoms/umur.php";

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tgl = $_POST['tgl'];

    $up2 = mysqli_query($conn, "UPDATE table_the_iot_mqtt SET name='$nama', age='$tgl', berat='$berat', tinggi='$tinggi' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Pasien berhasil diubah!",
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
            <h1>Rekam Medis</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Laporan Pemeriksaan Kesehatan</h4>
                    <div class="card-header-action">
                      <a href="rawat_jalan.php" class="btn btn-primary">Daftar pasien baru</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM table_the_iot_mqtt");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $idpasien = $row['id'];
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <th><?php echo ucwords($row['name']); ?>
                                <div class="table-links">
                                  <?php
                                  $rekam = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idpasien'");
                                  $cekrekam = mysqli_num_rows($rekam);
                                  if ($cekrekam == 0) {
                                    echo '<a>Pasien belum memiliki catatan medis</a>';
                                  } else { ?>
                                    <form method="POST" action="detail_pasien.php">
                                      <input type="hidden" name="id" value="<?php echo $row['name']; ?>">
                                      <button type="submit" id="btn-link">Pasien memiliki <?php echo $cekrekam; ?> catatan medis</button>
                                    </form>
                                  <?php }
                                  ?>
                                </div>
                              </th>
                              <td><?php if ($row['age'] == "") {
                                    echo "-";
                                  } else {
                                    echo tgl_indo($row['age']);
                                  } ?></td>
                              <td><?php if ($row['age'] == "") {
                                    echo "-";
                                  } else {
                                    umur($row['age']);
                                  } ?></td>
                              <td align="center">
                                <form method="POST" action="detail_pasien.php">
                                  <span data-target="#editPasien" data-toggle="modal" data-id="<?php echo $idpasien; ?>" data-nama="<?php echo $row['name']; ?>" data-lahir="<?php echo $row['age']; ?>" data-tinggi="<?php echo $row['tinggi']; ?>" data-berat="<?php echo $row['berat']; ?>">
                                    <a class="btn btn-primary btn-action mr-1" title="Edit Data Pasien" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                  </span>
                                  <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'admin/delete.php?type=pasien&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
                                  <input type="hidden" name="id" value="<?php echo $row['name']; ?>">
                                  <button type="submit" class="btn btn-info btn-action mr-1" title="Detail Pasien" data-toggle="tooltip" name="submit"><i class="fas fa-info-circle"></i></button>
                                </form>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="editPasien">
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
                  <label class="col-sm-3 col-form-label">Nama Pasien</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="text" class="form-control" name="nama" required="" id="getNama">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control datepicker" id="getTgl" name="tgl">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Berat Badan</label>
                  <div class="input-group col-sm-9">
                    <input type="number" class="form-control" name="berat" required="" id="getBerat">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Kg
                      </div>
                    </div>
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tinggi Badan</label>
                  <div class="col-sm-9 input-group">
                    <input type="number" class="form-control" name="tinggi" required="" id="getTinggi">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        cm
                      </div>
                    </div>
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
    $('#editPasien').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var nama = button.data('nama')
      var id = button.data('id')
      var tgl = button.data('lahir')
      var berat = button.data('berat')
      var tinggi = button.data('tinggi')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getNama').val(nama)
      modal.find('#getTgl').val(tgl)
      modal.find('#getBerat').val(berat)
      modal.find('#getTinggi').val(tinggi)
    })
  </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php


    $page1 = "uang";
    $page = "Pembayaran";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";
    include "atoms/tgl_ind.php";
    include "atoms/umur.php";
    $cek = mysqli_query($conn, "SELECT * FROM table_the_iot_mqtt ");
    $pasien = mysqli_fetch_array($cek);

    $tgl    = date("Y-m-d");

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $sta = $_POST['status'];


        $up2 = mysqli_query($conn, "UPDATE riwayat_penyakit SET status='$sta' WHERE id='$id'");
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
    <!-- <script type="text/javascript">
        var auto_refresh = setInterval(
            function() {
                $('.table-responsive').load('show.php').fadeIn("slow");
            }, 10000); // refresh setiap 10000 milliseconds
    </script> -->

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
                        <h1>Transaksi</h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Transaksi</h4>
                                        <a class="btn btn-secondary btn-action button selector" href="keuangan.php" title="Reload">Reload</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Nama Pasien</th>
                                                        <th>Tanggal Berobat</th>
                                                        <th>Biaya Pengobatan</th>
                                                        <th>Obat</th>
                                                        <th>Total Biaya</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $sql = mysqli_query($conn, "SELECT q.*,t.name as wname FROM riwayat_penyakit q INNER JOIN table_the_iot_mqtt t ON t.id = q.id_pasien WHERE q.tgl='$tgl' ORDER BY q.id DESC");
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $idpenyakit = $row['id'];
                                                        $biayaperiksa = $row['biaya_pengobatan'];
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php


                                                                echo ucwords($row['wname']); ?></td>

                                                            <td><?php echo ucwords(tgl_indo($row['tgl'])); ?></td>
                                                            <td><?php echo number_format($row['biaya_pengobatan'], 0, ".", "."); ?></td>

                                                            <td>
                                                                <?php
                                                                $obat2an = mysqli_query($conn, "SELECT * FROM riwayat_obat WHERE id_penyakit='$idpenyakit'  ORDER BY id DESC");
                                                                $jumobat = mysqli_num_rows($obat2an);
                                                                if ($jumobat == 0) {
                                                                    echo "Tidak ada obat yang diberikan";
                                                                    @$hargaobat = 0;
                                                                } else {
                                                                    $count = 0;
                                                                    @$hargaobat = 0;
                                                                    while ($showobat = mysqli_fetch_array($obat2an)) {
                                                                        $jumjumjum = $showobat['jumlah'];
                                                                        $idobat = $showobat['id_obat'];
                                                                        $obatlagi = mysqli_query($conn, "SELECT * FROM obat WHERE id='$idobat'");
                                                                        $namaobat = mysqli_fetch_array($obatlagi);
                                                                        echo $str = ucwords($showobat['jumlah']);
                                                                        $count = $count + 1;

                                                                        if ($count < $jumobat) {
                                                                            echo ", ";
                                                                        }

                                                                        @$hargaobat += $namaobat['harga'] * $jumjumjum;
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php


                                                                echo number_format(@$biayaperiksa + @$hargaobat, 0, ".", ".");
                                                                ?>
                                                            </td>
                                                            <td><?php
                                                                if ($row['status'] == '1') {
                                                                    echo '<div class="badge badge-pill badge-success mb-1">Selesai';
                                                                } else {
                                                                    echo '<div class="badge badge-pill badge-danger mb-1">Belum';
                                                                } ?></td>

                                                            <td>
                                                                <form method="POST" action="print.php" target="_blank">
                                                                    <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                                                    <input type="hidden" name="idriwayat" value="<?php echo $idpenyakit ?>">

                                                                    <div class="btn-group">
                                                                        <span data-target="#editStatus" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-sta="<?php echo $row['status']; ?>">
                                                                            <a class="btn btn-primary btn-action mr-1" title="Edit Data Pasien" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                                                        </span>
                                                                    </div>
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

            <div class="modal fade" tabindex="-1" role="dialog" id="editStatus">
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
                                <div class="form-group">
                                    <label>Status Bayar</label>
                                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                                    <select class="form-control selectric" name="status" id="getStatus">
                                        <option value="1">Selesai</option>
                                        <option value="2">Belum</option>
                                    </select>
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
        $('#editStatus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var sta = button.data('sta')
            var id = button.data('id')

            var modal = $(this)
            modal.find('#getId').val(id)
            modal.find('#getStatus').val(sta)

        })
    </script>
</body>

</html>
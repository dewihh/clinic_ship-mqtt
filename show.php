<?php
session_start();
include 'admin/connect.php';
include "atoms/head.php";
include "atoms/tgl_ind.php";
include "atoms/umur.php";
$cek = mysqli_query($conn, "SELECT * FROM table_the_iot_mqtt ");
$pasien = mysqli_fetch_array($cek);
$idid = $pasien['id'];


?>
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

        $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY id DESC");
        $i = 0;
        while ($row = mysqli_fetch_array($sql)) {
            $idpenyakit = $row['id'];
            $biayaperiksa = $row['biaya_pengobatan'];
            $i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo ucwords($pasien['name']); ?></td>
                <td><?php echo ucwords(tgl_indo($row['tgl'])); ?></td>
                <td><?php echo number_format($row['biaya_pengobatan'], 0, ".", "."); ?></td>

                <td>
                    <?php
                    $obat2an = mysqli_query($conn, "SELECT * FROM riwayat_obat WHERE id_penyakit='$idpenyakit' AND id_pasien='$idid' ORDER BY id DESC");
                    $jumobat = mysqli_num_rows($obat2an);
                    if ($jumobat == 0) {
                        echo "Tidak ada obat yang diberikan";
                        @$hargaobat = 0;
                    } else {
                        $count = 0;
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

                            @$hargaobat += $jumjumjum;
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
                            <span data-target="#editStatus" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-stat="<?php echo $row['status']; ?>">
                                <a class="btn btn-primary btn-action mr-1" title="Edit Data Pasien" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                            </span>
                            <button type="submit" class="btn btn-info" name="detail" title="Detail" data-toggle="tooltip"><i class="fas fa-info"></i></button>
                            <button type="submit" class="btn btn-primary" name="printone" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i></button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include "atoms/all_js.php"; ?>
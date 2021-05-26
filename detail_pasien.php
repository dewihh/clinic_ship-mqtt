<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $idnama = $_POST['id'];
    $page1 = "det";
    $page = "Detail Pasien : " . $idnama;
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";
    $cek = mysqli_query($conn, "SELECT * FROM table_the_iot_mqtt WHERE name='$idnama'");
    $pasien = mysqli_fetch_array($cek);
    $idid = $pasien['id'];
    ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <?php
            include 'atoms/navbar.php';
            include 'atoms/sidebar.php';
            include 'atoms/umur.php';
            include 'atoms/tgl_ind.php';
            ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Detail Pasien</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="pasien.php">Data Pasien</a></div>
                            <div class="breadcrumb-item">Detail Pasien : <?php echo ucwords($idnama); ?></div>
                        </div>
                    </div>

                    <div class="section-body">
                        <?php include 'atoms/info_pasien.php'; ?>

                        <div class="section-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Info Pasien</h4>
                                            <div class="card-header-action">
                                                <form method="POST" action="print.php" target="_blank">
                                                    <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                                    <?php
                                                    $cekrekam = mysqli_num_rows($rekam);
                                                    if ($cekrekam == 0) {
                                                        echo '';
                                                    } else {
                                                        echo '<button type="submit" class="btn btn-primary" name="printall">Print Semua</button> &emsp;';
                                                    } ?>
                                                    <a href="rawat_jalan.php" class="btn btn-primary">Rawat Jalan</a>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="gallery">
                                                <table class="table table-striped table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Nama Lengkap</th>
                                                            <td> : <?php echo ucwords($idnama); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Tanggal Lahir</th>
                                                            <td> : <?php echo tgl_indo($pasien['age']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Tinggi Badan</th>
                                                            <td> : <?php echo $pasien['tinggi'] . " cm"; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Berat Badan</th>
                                                            <td> : <?php echo $pasien['berat'] . " kg"; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nama KK</th>
                                                            <td> : <?php echo $pasien['validation_sheet']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Alamat</th>
                                                            <td> : <?php echo $pasien['adress']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nomor Telepon</th>
                                                            <td> : <?php echo $pasien['phone_numb']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Catatan Riwayat Penyakit Pasien</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="table-1">
                                                    <thead>
                                                        <tr>

                                                            <th>Tanggal Berobat</th>
                                                            <th>Penyakit</th>
                                                            <th>Diagnosa</th>
                                                            <th>Obat</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid'");
                                                        $i = 0;
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                            $idpenyakit = $row['id'];
                                                        ?>
                                                            <tr>

                                                                <td><?php echo ucwords(tgl_indo($row['tgl'])); ?></td>
                                                                <td><?php echo ucwords($row['penyakit']); ?></td>
                                                                <td><?php
                                                                    echo $row['diagnosa'] . " - ";
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $obat2an = mysqli_query($conn, "SELECT * FROM riwayat_obat WHERE id_penyakit='$idpenyakit' AND id_pasien='$idid'");
                                                                    $jumobat = mysqli_num_rows($obat2an);
                                                                    if ($jumobat == 0) {
                                                                        echo "Tidak ada obat yang diberikan";
                                                                    } else {
                                                                        $count = 0;
                                                                        while ($showobat = mysqli_fetch_array($obat2an)) {
                                                                            $idobat = $showobat['id_obat'];
                                                                            $obatlagi = mysqli_query($conn, "SELECT * FROM obat WHERE id='$idobat'");
                                                                            $namaobat = mysqli_fetch_array($obatlagi);
                                                                            echo $str = ucwords($namaobat['nama_obat']);
                                                                            $count = $count + 1;

                                                                            if ($count < $jumobat) {
                                                                                echo ", ";
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                    <form method="POST" action="print.php" target="_blank">
                                                                        <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                                                        <input type="hidden" name="idriwayat" value="<?php echo $idpenyakit ?>">
                                                                        <div class="btn-group">
                                                                            <button type="submit" class="btn btn-info" name="detail" title="Detail" data-toggle="tooltip"><i class="fas fa-info"></i></button>
                                                                            <button type="submit" class="btn btn-primary" name="printone" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i></button>
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

                </section>

            </div>
            <?php include "atoms/all_js.php"; ?>
</body>

</html>
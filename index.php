<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page = "Dashboard";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";
    include 'atoms/tgl_ind.php';

    $pegawai = mysqli_query($conn, "SELECT * FROM pegawai_mqtt WHERE pekerjaan IS NOT NULL");
    $jumlahpegawai = mysqli_num_rows($pegawai);
    $pasien = mysqli_query($conn, "SELECT * FROM table_the_iot_mqtt");
    $jumpasien = mysqli_num_rows($pasien);
    $rawat_inap = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien IS NOT NULL");
    $jumrawatinap = mysqli_num_rows($rawat_inap);
    $obat = mysqli_query($conn, "SELECT * FROM obat");
    $jumlahobat = mysqli_num_rows($obat);
    ?>
    <style>
        #link-no {
            text-decoration: none;
        }
    </style>
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
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Pegawai</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumlahpegawai; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-wheelchair"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Pasien</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumpasien; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-briefcase-medical"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Tindakan</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumrawatinap; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Obat</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumlahobat; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div style="width: 500px;margin: 0px auto;">
                        <canvas id="antrian"></canvas>
                        <?php
                        //Inisialisasi nilai variabel awal
                        $no_antrian = "";
                        $jumals = null;
                        $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                        for ($bulan = 1; $bulan < 13; $bulan++) {
                            $query = mysqli_query($conn, "SELECT queue_no,COUNT(*) as jumalah FROM queue_list where MONTH(date_created)='$bulan'");
                            $row = $query->fetch_array();
                            $jumlah_produk[] = $row['jumalah'];
                        }
                        //Query SQL
                        $sqla = "SELECT queue_no,COUNT(*) as 'tlo' FROM queue_list GROUP by queue_no";
                        $hasi = mysqli_query($conn, $sqla);

                        while ($data = mysqli_fetch_array($hasi)) {
                            //Mengambil nilai jurusan dari database
                            $antrian = $data['queue_no'];
                            $no_antrian .= "'$antrian'" . ", ";
                            //Mengambil nilai total dari database
                            $jumls = $data['tlo'];
                            $jumals .= "$jumls" . ", ";
                        }
                        ?>
                    </div>
                    <div class="flex">
                        <div style="width: 500px;margin: 0px auto;">
                            <canvas id="jenis_kel"></canvas>
                            <?php

                            $jenis_kelamin = "";
                            $jumlah = null;
                            $sql = "select gender,COUNT(*) as 'total' from table_the_iot_mqtt GROUP by gender";
                            $hasil = mysqli_query($conn, $sql);

                            while ($data = mysqli_fetch_array($hasil)) {
                                if ($data['gender'] == "Male") {
                                    $gender = "Laki-laki";
                                } else {
                                    $gender = "Perempuan";
                                }
                                $jenis_kelamin .= "'$gender'" . ", ";

                                $jum = $data['total'];
                                $jumlah .= "$jum" . ", ";
                            }
                            ?>
                        </div>

                        <div style="width: 500px;margin: 0px auto;">
                            <canvas id="penyakit"></canvas>
                            <?php
                            //Inisialisasi nilai variabel awal
                            $penyakit = "";
                            $jumal = null;
                            //Query SQL
                            $sqls = "SELECT penyakit,COUNT(*) as 'tl' FROM riwayat_penyakit GROUP by penyakit ORDER by count(*) desc LIMIT 5";
                            $hasils = mysqli_query($conn, $sqls);

                            while ($data = mysqli_fetch_array($hasils)) {
                                //Mengambil nilai jurusan dari database
                                $jur = $data['penyakit'];
                                $penyakit .= "'$jur'" . ", ";
                                //Mengambil nilai total dari database
                                $juml = $data['tl'];
                                $jumal .= "$juml" . ", ";
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

    <script>
        var ctx = document.getElementById("antrian").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($label); ?>,
                datasets: [{
                    label: 'Grafik Penjualan',
                    data: <?php echo json_encode($jumlah_produk); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('jenis_kel').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',
            // The data for our dataset
            data: {
                labels: [<?php echo $jenis_kelamin; ?>],
                datasets: [{
                    label: 'Data Pasien berdasarkan jenis kelamin',
                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)'],
                    borderColor: ['rgb(255, 99, 132)'],
                    data: [<?php echo $jumlah; ?>]
                }]
            },
            // Configuration options go here

        });
    </script>

    <script>
        var ctx = document.getElementById("penyakit").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [<?php echo $penyakit; ?>],
                datasets: [{
                    label: 'Data penyakit Populer ',
                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                    borderColor: ['rgb(255, 99, 132)'],
                    data: [<?php echo $jumal; ?>]
                }]
            },

            // Configuration options go here
            options: {
                indexAxis: 'y',
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <?php include "atoms/all_js.php"; ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $page = "Antrian";
    session_start();
    include 'admin/connect.php';
    include "atoms/head.php";
    include 'atoms/tgl_ind.php';

    $a = mysqli_query($conn, "SELECT * FROM antrian_a WHERE no_antrian='1'");
    $jumlaha = mysqli_num_rows($a);
    $b = mysqli_query($conn, "SELECT * FROM antrian_a WHERE no_antrian='2'");
    $jumlahb = mysqli_num_rows($b);
    $c = mysqli_query($conn, "SELECT * FROM antrian_a WHERE no_antrian='3'");
    $jumlahc = mysqli_num_rows($c);
    $d = mysqli_query($conn, "SELECT * FROM antrian_a WHERE no_antrian='4'");
    $jumlahd = mysqli_num_rows($d);
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
                                        <h4>Antrian Poli Umum</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumlaha; ?>
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
                                        <h4>Antrian Poli Gigi</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumlahb; ?>
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
                                        <h4>Antrian Poli KIA</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumlahc; ?>
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
                                        <h4>Antrian Poli Gizi</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $jumlahd; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4>Antrian Poli Umum</h4>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4>Antrian Poli Gigi</h4>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4>Antrian Poli KIA</h4>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4>Antrian Poli Gizi</h4>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div style="width: 800px;margin: 0px auto;">
                        <canvas id="sakit"></canvas>
                    </div>

                </section>
            </div>

        </div>
    </div>



    <?php include "atoms/all_js.php"; ?>
</body>

</html>
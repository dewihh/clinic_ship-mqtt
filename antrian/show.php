<div class="homepages__navbar">
    <div class="navbar__menu">
        <ul>
            <li>
                <a class="overlay" href="home.php"><span class="texts">PUSKESMAS TEKNOLOGI REKAYASA INTERNET</span></a>
            </li>
            <li>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                $tgl    = date("l, d-M-Y / H:i:s a");
                echo '<a class="overlay" href="service.php"><span class="texts">' . $tgl . ' </span></a>'
                ?>
            </li>
        </ul>
    </div>
</div>
<div class="cont__panggil">
    <div class="ant_panggil">
        <div class="tamp-satu">
            <h3>Nomor Antrian</h3>
        </div>
        <?php
        include "../admin/connect.php";
        $tgl    = date("Y-m-d");
        $query    = mysqli_query($conn, "SELECT * FROM queue_list WHERE status = 1  AND date(date_created) = '$tgl' ORDER BY id DESC LIMIT 1");
        while ($data    = mysqli_fetch_array($query)) {
        ?>

            <div class="tamp-dua">
                <h3><?php
                    if (mysqli_num_rows($query) == NULL) {
                        echo '<h3>0</h3>';
                    } else {
                        echo '<h3>' . $data['queue_no'] . '</h3>';
                    } ?>
                </h3>
            </div>
            <div class="tamp-tiga">
                <h3><?php
                    if ($data['transaction_id'] == 1) {
                        echo '<h3>Poli Umum</h3>';
                    } elseif ($data['transaction_id'] == 2) {
                        echo '<h3>Poli Gigi</h3>';
                    } elseif ($data['transaction_id'] == 3) {
                        echo '<h3>Poli KIA</h3>';
                    } else {
                        echo '<h3>Poli Gizi</h3>';
                    }
                    ?>
                </h3>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="ant_video">
        <h1>Videotron</h1>
    </div>
</div>
<div class="cont_antr">
    <div class="card_antr bg-umum">
        <?php
        include "../admin/connect.php";
        $tgl    = date("Y-m-d");
        $query_dua    = mysqli_query($conn, "SELECT * FROM queue_list WHERE transaction_id = 1 AND status = 0  ORDER BY id DESC LIMIT 1");
        while ($data_dua    = mysqli_fetch_array($query_dua)) {
        ?>
            <div class="card_elm">
                <h2>A - <?php echo ucwords($data_dua['queue_no']); ?></h2>
                <h3><?php
                    if ($data_dua['transaction_id'] == 1) {
                        echo '<h3>Poli Umum</h3>';
                    }
                    ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="card_antr bg-gigi">
        <?php
        include "../admin/connect.php";
        $tgl    = date("Y-m-d");
        $query_tiga   = mysqli_query($conn, "SELECT * FROM queue_list WHERE transaction_id = 2 AND status = 0  ORDER BY id DESC LIMIT 1");
        while ($data_tiga    = mysqli_fetch_array($query_tiga)) {
        ?>
            <div class="card_elm">
                <h2>B - <?php echo ucwords($data_tiga['queue_no']); ?></h2>
                <h3><?php
                    if ($data_tiga['transaction_id'] == 2) {
                        echo '<h3>Poli Gigi</h3>';
                    }
                    ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="card_antr bg-kia">
        <?php
        include "../admin/connect.php";
        $tgl    = date("Y-m-d");
        $query_empat   = mysqli_query($conn, "SELECT * FROM queue_list WHERE transaction_id = 3 AND status = 0  ORDER BY id DESC LIMIT 1");
        while ($data_empat    = mysqli_fetch_array($query_empat)) {
        ?>
            <div class="card_elm">
                <h2>C - <?php echo ucwords($data_empat['queue_no']); ?></h2>
                <h3><?php
                    if ($data_empat['transaction_id'] == 3) {
                        echo '<h3>Poli KIA</h3>';
                    }
                    ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="card_antr bg-gizi">
        <?php
        include "../admin/connect.php";
        $tgl    = date("Y-m-d");
        $query_empat   = mysqli_query($conn, "SELECT * FROM queue_list WHERE transaction_id = 4 AND status = 0  ORDER BY id DESC LIMIT 1");
        while ($data_empat    = mysqli_fetch_array($query_empat)) {
        ?>
            <div class="card_elm">
                <h2>D - <?php echo ucwords($data_empat['queue_no']); ?></h2>
                <h3><?php
                    if ($data_empat['transaction_id'] == 4) {
                        echo '<h3>Poli Gizi</h3>';
                    }
                    ?>
            </div>
    </div>
<?php
        }
?>
</div>
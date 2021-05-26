<script>
        var ctx = document.getElementById("sakit").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php $jumlah_bln = mysqli_query($conn, "SELECT  date_format(tgl,'%b') as bulan from antrian_a");
                            while ($row = mysqli_fetch_array($jumlah_bln)) {

                                echo "'" . $row["bulan"] . "',";
                            } ?>],
                datasets: [{
                    label: 'Apa ini',
                    data: [
                        <?php
                        $jumlah_teknik = mysqli_query($conn, "SELECT * from antrian_a WHERE no_antrian IS NOT NULL");
                        while ($row = mysqli_fetch_array($jumlah_teknik)) {

                            echo "'" . $row["id"] . "',";
                        } ?>

                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
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
                    label: 'Data Mahasiswa berdasarkan jenis kelamin',
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
            type: 'bar',
            data: {
                labels: ["Flu", "bab", "pusing", "mual"],
                datasets: [{
                    label: '',
                    data: [
                        <?php
                        $jumlah_teknik = mysqli_query($conn, "SELECT * from riwayat_penyakit WHERE penyakit='Flu'");
                        echo mysqli_num_rows($jumlah_teknik);
                        ?>,
                        <?php
                        $jumlah_ekonomi = mysqli_query($conn, "SELECT * from riwayat_penyakit WHERE penyakit='bab'");
                        echo mysqli_num_rows($jumlah_ekonomi);
                        ?>,
                        <?php
                        $jumlah_fisip = mysqli_query($conn, "SELECT * from riwayat_penyakit WHERE penyakit='pusing'");
                        echo mysqli_num_rows($jumlah_fisip);
                        ?>,
                        <?php
                        $jumlah_pertanian = mysqli_query($conn, "SELECT * from riwayat_penyakit WHERE penyakit='mual'");
                        echo mysqli_num_rows($jumlah_pertanian);
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
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
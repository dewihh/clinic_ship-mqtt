<?php
$judul = "aplikasi rekam medis";
$pecahjudul = explode(" ", $judul);
$acronym = "";

foreach ($pecahjudul as $w) {
    $acronym .= $w[0];
}
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.php"><?php echo $judul; ?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.php"><?php echo $acronym; ?></a>
        </div>
        <ul class="sidebar-menu">
            <li <?php echo ($page == "Dashboard") ? "class=active" : ""; ?>><a class="nav-link" href="index.php"><i class="fas fa-h-square"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Menu</li>

            <li class="dropdown <?php echo ($page1 == "datajabatan" || $page1 == "Data Pegawai" || $page1 == "data" || $page1 == "poli" || $page1 == "dokter" || $page1 == "jadwal") ? "active" : ""; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Administrasi</span></a>
                <ul class="dropdown-menu">
                    <li <?php echo (@$page1 == "datajabatan") ? "class=active" : ""; ?>><a class="nav-link" href="jabatan.php">Data Jabatan</a></li>
                    <li <?php echo (@$page1 == "Data Pegawai") ? "class=active" : ""; ?>><a class="nav-link" href="pegawai_mqtt.php">Data Pegawai</a></li>
                    <li <?php echo (@$page1 == "data") ? "class=active" : ""; ?>><a class="nav-link" href="paramedik.php">Data Paramedik</a></li>
                    <li <?php echo (@$page1 == "poli") ? "class=active" : ""; ?>><a class="nav-link" href="poli.php">Data Poli</a></li>
                    <li <?php echo (@$page1 == "jadwal") ? "class=active" : ""; ?>><a class="nav-link" href="jadwal.php">Jadwal Dokter</a></li>
                </ul>
            </li>

            <li class="dropdown <?php echo ($page1 == "Data Pasien" || $page1 == "det" || $page1 == "Rawat Jalan") ? "active" : ""; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-injured"></i> <span>Data Pasien</span></a>
                <ul class="dropdown-menu">
                    <li <?php echo (@$page1 == "Data Pasien" || @$page1 == "det") ? "class=active" : ""; ?>><a class="nav-link" href="pasien.php">Rekam Medis</a></li>
                    <li <?php echo (@$page1 == "Rawat Jalan") ? "class=active" : ""; ?>><a class="nav-link" href="rawat_jalan.php">Catatan Pasien</a></li>
                </ul>
            </li>

            <li <?php echo ($page == "Data Obat") ? "class=active" : ""; ?>><a class="nav-link" href="obat.php"><i class="fas fa-briefcase-medical"></i> <span>Farmasi</span></a></li>
            <li <?php echo ($page == "Pembayaran") ? "class=active" : ""; ?>><a class="nav-link" href="keuangan.php"><i class="fas fa-dollar-sign"></i> <span>Keuangan</span></a></li>



    </aside>
</div>
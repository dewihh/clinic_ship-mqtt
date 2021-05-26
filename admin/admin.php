<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sniglet&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Zetta&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../modules/fontawesome/css/all.min.css">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <!-- Template CSS -->
    <title>Dashboard Admin</title>

    <?php
    session_start();
    if (isset($_SESSION['id_pegawai'])) {
        header('location:../');
    } else {
        include 'connect.php';
        if (isset($_POST['submit'])) {
            @$user = mysqli_real_escape_string($conn, $_POST['username']);
            @$pass = mysqli_real_escape_string($conn, $_POST['password']);

            $login = mysqli_query($conn, "SELECT * FROM pegawai_mqtt WHERE (username='$user' or email='$user') AND password='" . md5($pass) . "'");
            $cek = mysqli_num_rows($login);
            $userid = mysqli_fetch_array($login);

            if ($cek == 0) {
                echo '
        <script>
        setTimeout(function() {
          swal({
            title: "Login Gagal",
            text: "Username atau Password Anda Salah. Mohon periksa kembali form anda!",
            icon: "error"
            });
            }, 500);
            </script>
            ';
            } else {
                header('location:../');
                $_SESSION['id_pegawai'] = $userid['id'];
            }
        }
    ?>
</head>

<body>
    <div class="homepages">
        <div class="homepages__title">
            <h1>Selamat Datang</h1>
            <p>Sistem Informasi Pelayanan Kesehatan</p>
        </div>
        <div class="homepages__login">
            <div class="login__main">
                <img src="../img/Hospital.svg">
                <div class="login__input">
                    <form method="POST" action="" class="needs-validation mrg-top-20" novalidate="" autocomplete="off">
                        <div class="form-group form-flex">
                            <label for="username" class="form-hidden">Username</label>
                            <i class="far fa-user fa-lg form-icon"></i>
                            <div class="">
                                <input id="username" type="text" placeholder="Username" class="form-control form-bord" minlength="2" name="username" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Mohon isi username anda dengan benar!
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-flex">
                            <label for="password" class="controls-label form-hidden">Password</label>
                            <i class="fas fa-key fa-lg form-icon"></i>
                            <div class="">
                                <input id="password" type="password" placeholder="Password" class="form-control form-bord" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    Mohon isi password anda!
                                </div>
                            </div>
                        </div>
                        <div class="div-syle">
                            <a href="forget.php" class="a-style">
                                <p class="text-center a-style mrg-btm-6">Forgot your password</p>
                            </a>
                        </div>
                        <div class="form-group">

                            <button class="btn-widths" type="submit" name="submit" tabindex="4">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../modules/jquery.min.js"></script>
    <script src="../modules/popper.js"></script>
    <script src="../modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../modules/tooltip.js"></script>
    <script src="../modules/moment.min.js"></script>
    <script src="../js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="../js/scripts.js"></script>
    <script src="../js/custom.js"></script>
    <!-- Sweet Alert -->
    <script src="../modules/sweetalert/sweetalert.min.js"></script>
    <script src="../js/page/modules-sweetalert.js"></script>
</body>
<?php } ?>

</html>
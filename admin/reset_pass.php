<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="../img/stisla.svg" />
    <title>Smart Care - Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../modules/fontawesome/css/all.min.css">


    <!-- Template CSS -->
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/style.css">


</head>

<body>
    <div id="app">
        <section class="login-content">
            <div class="login-container">
                <div class="login-style">
                    <div class="login-coloum pdn-btm">
                        <div class="login-brand">
                            <h1 class="clr-h1">Reset your password!</h1>
                        </div>
                        <p class="text-center">
                            <span>Please enter new password for your account,</span>
                        </p>
                        <p class="text-center">
                            <span>don't forget to write down or remember</span>
                        </p>
                        <p class="text-center">
                            <span>your latest password </span>
                        </p>
                        <?php
                        if ($_GET['key'] && $_GET['reset']) {
                            include 'connect.php';
                            $email = $_GET['key'];
                            $pass = $_GET['reset'];

                            $select = mysqli_query($conn, "SELECT email,password FROM pegawai_mqtt WHERE email='$email' AND md5(password)='$pass'");
                            if (mysqli_num_rows($select) == 1) {
                        ?>
                                <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
                                    <div class="form-group form-flex">
                                        <label for="password" class="form-hidden">Password Baru</label>
                                        <i class="fas fa-lock fa-lg form-icon"></i>
                                        <div class="form-edit">
                                            <input id="password" type="password" placeholder="New Password" class="form-control form-bord " minlength="2" name="password" tabindex="1" required autofocus>
                                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                                            <input type="hidden" name="pass" value="<?php echo $pass; ?>">
                                            <div class="invalid-feedback">
                                                Mohon isi Email anda dengan benar!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-flex">
                                        <div class="d-block">
                                            <label for="konfirmasi_password" class="control-label form-hidden">Konfirmasi Password</label>
                                        </div>
                                        <i class="fas fa-lock fa-lg  form-icon"></i>
                                        <div class="form-edit">
                                            <input id="konfirmasi_password" type="password" placeholder="Confirm Your Password" class="form-control form-bord" name="konfirmasi" tabindex="2" required>
                                            <div class="invalid-feedback">
                                                Mohon isi password anda!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-flex">
                                        <button type=" submit" name="submit_password" class="btn black btn-primary btn-lg btn-block btn-width" tabindex="4">
                                            Send
                                        </button>
                                    </div>
                                </form>
                        <?php
                            } else {
                                echo "Data Tidak Ditemukan";
                            }
                        }
                        ?>
                        <?php
                        if (isset($_POST['submit_password'])) {
                            include 'connect.php';
                            $email = $_POST['email'];
                            $pass = $_POST['password'];

                            $select = mysqli_query($conn, "UPDATE pegawai_mqtt SET password='" . md5($pass) . "' WHERE email='$email'");
                            if ($select) {
                                echo "<script> alert('Berhasil'); window.location = 'admin.php'; </script>";
                            } else {
                                echo '
      <script>
      setTimeout(function() {
        swal({
          title: "Reset Gagal",
          text: "Password tidak sesuai!",
          icon: "error"
          });
          }, 500);
          </script>
          ';
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
    </div>
    </section>
    </div>

    <!-- General JS Scripts -->
    <script src="../modules/jquery.min.js"></script>
    <script src="../modules/popper.js"></script>
    <script src="../modules/tooltip.js"></script>
    <script src="../modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../modules/moment.min.js"></script>
    <script src="../js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="../js/scripts.js"></script>
    <script src="../js/custom.js"></script>
    <!-- Sweet Alert -->
    <script src="../modules/sweetalert/sweetalert.min.js"></script>
    <script src="../js/page/modules-sweetalert.js"></script>
</body>

</html>
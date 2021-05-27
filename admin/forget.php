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

    <?php

    if (isset($_POST['submit_email'])) {

        include 'connect.php';
        $email = $_POST['email'];

        $select = mysqli_query($conn, "SELECT email,password FROM pegawai_mqtt WHERE email='$email'");
        if (mysqli_num_rows($select) == 1) {
            while ($row = mysqli_fetch_array($select)) {
                $email = $row['email'];
                $pass = md5($row['password']);
            }
            //$link="<a href='localhost:8080/phpmailer/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
            require_once('../PHPMailer/class.phpmailer.php');
            require_once('../PHPMailer/class.smtp.php');
            $mail = new PHPMailer();

            $body      = "Klik link berikut untuk reset Password, <a href='http://localhost/nodemcu_rfid_iot_projects/admin/reset_pass.php?reset=$pass&key=$email'>$pass<a>"; //isi dari email

            // $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            // enable SMTP authentication
            $mail->SMTPDebug  = 1;
            $mail->SMTPAuth = true;
            // GMAIL username
            $mail->Username = "xxx";
            // GMAIL password
            $mail->Password = "xxx";
            $mail->SMTPSecure = "ssl";
            // sets GMAIL as the SMTP server
            $mail->Host = "smtp.gmail.com";
            // set the SMTP port for the GMAIL server
            $mail->Port = "465";
            $mail->From = 'xxx';
            $mail->FromName = 'Admin Aplikasi Monitoring Detak Jantung';

            $email = $_POST['email'];

            $mail->AddAddress($email, 'User Sistem');
            $mail->Subject  =  'Reset Password';
            $mail->IsHTML(true);
            $mail->MsgHTML($body);
            if ($mail->Send()) {
                echo "<script> alert('Link reset password telah dikirim ke email anda, Cek email untuk melakukan reset'); window.location = 'mail.html'; </script>";
            } else {
                echo "Mail Error - >" . $mail->ErrorInfo;
            }
        } else {
            echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "Email Tidak Ditemukan",
                                text: "Email yang anda gunakan tidak terdaftar pada sistem!",
                                icon: "error"
                                });
                            }, 500);
                    </script>'; //jika pesan terkirim

        }
    }

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
            text: "Username, Email, atau Password Anda Salah. Mohon periksa kembali form anda!",
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
    <div id="app">
        <section class="login-content">
            <div class="login-container">
                <div class="login-style">
                    <div class="login-coloum pdn-btm">
                        <div class="login-brand">
                            <h1 class="clr-h1">Forgot your password? </h1>
                        </div>
                        <p class="text-center p-style">
                            <span>Please enter the e-mail address you use</span>
                        </p>
                        <p class="text-center p-style">
                            <span>when creating your account, we’ll send you</span>
                        </p>
                        <p class="text-center p-style mrg-btm">
                            <span>instruction to reset your password</span>
                        </p>
                        <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
                            <div class="form-group form-flex mrg-tp-2">
                                <label for="email" class="form-hidden">Email</label>
                                <i class="far fa-envelope fa-lg form-icon"></i>
                                <div class="form-edit">
                                    <input id="email" type="text" placeholder="Confirmation Your Email" class="form-control form-bord " minlength="2" name="email" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Mohon isi Email anda dengan benar!
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-flexs">
                                <button type=" submit" name="submit_email" class="btn black btn-primary btn-lg btn-block btn-width" tabindex="4">
                                    Send
                                </button>
                            </div>
                        </form>
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
<?php } ?>

</html>
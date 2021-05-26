<?php
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

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
  <link href="../css/custom.css" rel="stylesheet">
  <script src="../js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Website Rekam Medis</title>
  <script type="text/javascript">
    var auto_refresh = setInterval(
      function() {
        $('.table-responsive').load('show.php').fadeIn("slow");
      }, 10000); // refresh setiap 10000 milliseconds
  </script>
</head>

<body>
  <div class="homepages">
    <div class="homepages__title_antrian">
      <h1>Selamat Datang</h1>
      <p>Sistem Informasi Pelayanan Kesehatan</p>
    </div>
    <div class="ant_videos">
      <iframe width="500" height="170" src="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1&mute=1">
      </iframe>
    </div>
    <div class="table-responsive"></div>




  </div>

</body>

</html>
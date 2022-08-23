<?php
session_start();
require_once('koneksi.php');

$gejala = $_SESSION['jawaban_all'];
$id_penyakit = $_SESSION['hasil'];

$nama_penyakit = 'Penyakit tidak diketahui';
$pengobatan = '';
$aturan = 'Tidak ada rule yang sesuai';

if (!empty($id_penyakit)) {
    $penyakit = mysqli_fetch_array(mysqli_query($con, "select * from penyakit where id_penyakit='$id_penyakit'"));
    $nama_penyakit = $penyakit['nama_penyakit'];
    $pengobatan = $penyakit['pengobatan'];

    $rule = array();
    $result = mysqli_query($con, "select * from aturan left join gejala on gejala.id_gejala=aturan.id_gejala left join penyakit on penyakit.id_penyakit=aturan.id_penyakit where aturan.id_penyakit='$id_penyakit'");
    while ($row = mysqli_fetch_array($result))
        $rule[] = $row;

    $aturan = 'IF ' . implode(' AND ', array_column($rule, 'kode_gejala')) . '<br>THEN ' . $penyakit['kode_penyakit'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.6.5, mobirise.com">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image:src" content="">
    <meta property="og:image" content="">
    <meta name="twitter:title" content="Diagnosa">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/user/images/pakar-murai-1-96x96.png" type="image/x-icon">
    <meta name="description" content="">


    <title>Diagnosa</title>
    <link rel="stylesheet" href="assets/user/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/user/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/user/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/user/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/user/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/user/theme/css/style.css">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/user/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/user/mobirise/css/mbr-additional.css" type="text/css">

</head>

<body>

    <section data-bs-version="5.1" class="menu menu1 cid-t17OLS2bkT" once="menu" id="menu1-6">


        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="index.php">
                            <img src="assets/user/images/pakar-murai-1-96x96.png" alt="Mobirise Website Builder" style="height: 3rem;">
                        </a>
                    </span>
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-7" href="index.php">Sistem Pakar</a></span>
                </div>


            </div>
        </nav>
    </section>

    <section data-bs-version="5.1" class="features15 cid-t2ePHhxBsm" id="features16-9">

        <div class="container">
            <div class="content-wrapper">
                <div class="row align-items-center">
                    <div class="col-12 col-lg">

                        <h2 class="mb-4">Hasil Diagnosa</h2>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="200">Gejala yang dipilih</td>
                                    <td>
                                        <ul>
                                            <?php foreach ($gejala as $row) : ?>
                                                <li><?php echo $row; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="200">Aturan (rule) yang sesuai</td>
                                    <td><?php echo $aturan; ?></td>
                                </tr>
                                <tr>
                                    <td width="200">Hasil Diagnosa </td>
                                    <td><?php echo $nama_penyakit; ?></td>
                                </tr>
                                <tr>
                                    <td width="200">Pengobatan </td>
                                    <td style="white-space: pre-wrap; word-wrap: break-word;"><?php echo $pengobatan; ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="diagnosa_user.php" class="btn btn-primary">Ulangi Diagnosa</a>
                                        <a href="cetak.php" target="_self" class="btn btn-primary">Print</a>
                                    </td>

                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="footer7 cid-t17ORfPUdM" once="footers" id="footer7-7">





        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">
                        © Copyright 2022 Sistem Pakar - <a href="index1.php">Login Admin</a>
                    </p>
                </div>
            </div>
        </div>  
    </section>
    <section class="" style=""><a href="https://mobiri.se/2014960" style=""></a>
        <a style="" href="https://mobirise.com"></a>
    </section>
    <script src="assets/user/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/user/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/user/ytplayer/index.js"></script>
    <script src="assets/user/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/user/theme/js/script.js"></script>


</body>

</html>
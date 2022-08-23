<?php
session_start();
require_once('koneksi.php');

// -------- metode Forward Chaining --------- START
// jika ditekan tombol ya atau tidak
if (isset($_POST['btn_ya']) || isset($_POST['btn_tidak'])) {
    $jawaban_ya = isset($_SESSION['jawaban_ya']) ? $_SESSION['jawaban_ya'] : null;
    $bukan_penyakit = isset($_SESSION['bukan_penyakit']) ? $_SESSION['bukan_penyakit'] : null;
    $jawaban_all = isset($_SESSION['jawaban_all']) ? $_SESSION['jawaban_all'] : null;

    $id_gejala = $_POST['id_gejala'];
    $id_penyakit = $_POST['id_penyakit'];

    // jawaban ya
    if (isset($_POST['btn_ya'])) {
        $jawaban_ya[] = $id_gejala;
        $_SESSION['jawaban_ya'] = $jawaban_ya;

        $gjl = mysqli_fetch_array(mysqli_query($con, "select * from gejala where id_gejala='$id_gejala'"));
        $jawaban_all[] = $gjl['kode_gejala'] . ' - ' . $gjl['nama_gejala'] . ' (Ya)';
        $_SESSION['jawaban_all'] = $jawaban_all;

        $gejala = array();
        $result = mysqli_query($con, "select * from aturan where id_penyakit='$id_penyakit'");
        while ($row = mysqli_fetch_array($result))
            $gejala[] = $row;

        if (arrays_are_equal($jawaban_ya, array_column($gejala, 'id_gejala'))) {
            $_SESSION['hasil'] = $id_penyakit;
            exit("<script>location.href='diagnosa_hasil_user.php';</script>");
        }
    }

    // jawaban tidak
    if (isset($_POST['btn_tidak'])) {
        $sql = mysqli_query($con, "select * from aturan where id_gejala='$id_gejala'");
        while ($res = mysqli_fetch_array($sql)) {
            $bukan_penyakit[] = $res['id_penyakit'];
        }
        $_SESSION['bukan_penyakit'] = $bukan_penyakit;

        $gjl = mysqli_fetch_array(mysqli_query($con, "select * from gejala where id_gejala='$id_gejala'"));
        $jawaban_all[] = $gjl['kode_gejala'] . ' - ' . $gjl['nama_gejala'] . ' (Tidak)';
        $_SESSION['jawaban_all'] = $jawaban_all;
    }

    $diagnosa = get_pertanyaan();
    if (empty($diagnosa['nama_gejala'])) {
        $_SESSION['hasil'] = '';
        exit("<script>location.href='diagnosa_hasil_user.php';</script>");
    }
} else {

    unset($_SESSION['jawaban_ya']);
    unset($_SESSION['bukan_penyakit']);
    unset($_SESSION['jawaban_all']);
    unset($_SESSION['hasil']);

    // ambil pertanyaan
    $diagnosa = get_pertanyaan();
}

// fungsi untuk mengambil pertanyaan dari rule yang ada
function get_pertanyaan()
{
    global $con;

    $jawaban_ya = isset($_SESSION['jawaban_ya']) ? $_SESSION['jawaban_ya'] : null;
    $bukan_penyakit = isset($_SESSION['bukan_penyakit']) ? $_SESSION['bukan_penyakit'] : null;

    $where = array();
    if (!is_null($bukan_penyakit)) {
        $where[] = "aturan.id_penyakit not in (" . implode(',', $bukan_penyakit) . ")";
    }
    if (!is_null($jawaban_ya)) {
        $where[] = "aturan.id_gejala in (" . implode(',', $jawaban_ya) . ")";
    }

    $sql = "select * ";
    $sql .= "from aturan ";
    if (!empty($where)) {
        $sql .= "where " . implode(' and ', $where);
    }
    $sql .= " group by aturan.id_penyakit";
    if (!is_null($jawaban_ya)) {
        $sql .= " having (count(*) = " . count($jawaban_ya) . ")";
    }
    $penyakit = mysqli_fetch_array(mysqli_query($con, $sql));
    $id_penyakit = empty($penyakit) ? '' :  $penyakit['id_penyakit'];

    if (!empty($id_penyakit)) {
        $sql = "select * from aturan";
        $sql .= " left join gejala on gejala.id_gejala=aturan.id_gejala";
        $sql .= " where aturan.id_penyakit='" . $id_penyakit . "'";
        if (!is_null($jawaban_ya)) {
            $sql .= " and aturan.id_gejala not in (" . implode(',', $jawaban_ya) . ")";
        }
        $sql .= " order by aturan.id_gejala asc";
        $gejala = mysqli_fetch_array(mysqli_query($con, $sql));
    }

    $result['id_gejala'] = empty($penyakit) ? '' : $gejala['id_gejala'];
    $result['nama_gejala'] = empty($penyakit) ? '' : $gejala['nama_gejala'];
    $result['id_penyakit'] = $id_penyakit;

    return $result;
}

// fungsi untuk cek 2 array apakah identik
function arrays_are_equal($array1, $array2)
{
    array_multisort($array1);
    array_multisort($array2);
    return (serialize($array1) === serialize($array2));
}
// -------- metode Forward Chaining --------- END
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

                        <form class="mb-4" action="diagnosa_user.php" method="post">
                            <input type="hidden" name="id_gejala" value="<?php echo $diagnosa['id_gejala']; ?>">
                            <input type="hidden" name="id_penyakit" value="<?php echo $diagnosa['id_penyakit']; ?>">
                            <div class="row">
                                <div class="col-md-12 text-center mb-4">
                                    <h3>Apakah <?php echo strtolower($diagnosa['nama_gejala']); ?> ?</h3>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-3">
                                    <button type="submit" name="btn_ya" class="btn w-100 display-4 btn-success">Ya</button> &nbsp; &nbsp;
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="btn_tidak" class="btn w-100 display-4 btn-danger">Tidak</button>
                                </div>
                            </div>
                        </form>

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
                        © Copyright 2022 Sistem Pakar
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
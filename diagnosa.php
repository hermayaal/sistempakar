<?php
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
            exit("<script>location.href='index.php?page=hasil_diagnosa';</script>");
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
        exit("<script>location.href='index.php?page=hasil_diagnosa';</script>");
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
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Diagnosa</h3>
    </div>
    <div class="box-body">
        <form action="?page=diagnosa" method="post">
            <input type="hidden" name="id_gejala" value="<?php echo $diagnosa['id_gejala']; ?>">
            <input type="hidden" name="id_penyakit" value="<?php echo $diagnosa['id_penyakit']; ?>">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Apakah <?php echo strtolower($diagnosa['nama_gejala']); ?> ?</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="text-center">
                    <button type="submit" name="btn_ya" class="btn btn-lg btn-diagnosa btn-success">Ya</button> &nbsp; &nbsp;
                    <button type="submit" name="btn_tidak" class="btn btn-lg btn-diagnosa btn-danger">Tidak</button>
                </div>
            </div>
            <br>
            <br>
        </form>
    </div>
</div>
<?php
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
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Hasil Diagnosa</h3>
    </div>
    <div class="box-body">
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
                        <a href="?page=diagnosa" class="btn btn-primary"><i class="fa fa-refresh"></i> Ulangi Diagnosa</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php
$link_gejala = '?page=gejala';
$link_penyakit = '?page=penyakit';
$link_aturan = '?page=aturan';
$link_admin = '?page=admin';
$list_data='';
$gejala = "select count(*) from gejala ";
$penyakit = "select count(*) from penyakit ";
$aturan = "select count(*) from aturan ";
$admin = "select count(*) from admin ";

$q_gejala = mysqli_query($con, $gejala);
$q_penyakit = mysqli_query($con, $penyakit);
$q_aturan = mysqli_query($con, $aturan);
$q_admin = mysqli_query($con, $admin);

$c_gejala = mysqli_fetch_assoc($q_gejala);
$c_penyakit = mysqli_fetch_assoc($q_penyakit);
$c_aturan = mysqli_fetch_assoc($q_aturan);
$c_admin = mysqli_fetch_assoc($q_admin);



$list_data .= '
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-info">
<div class="inner">
<h3>

' . implode($c_gejala) . ' 
</h3>

<p>Data Gejala</p>
</div>
<div class="icon">

</div>
<a href="' . $link_gejala . '" class="small-box-footer">Selengkapnya</a>
</div>
</div>

<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-success">
<div class="inner">
<h3>' . implode($c_penyakit) . '</h3>

<p>Data Penyakit</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="' . $link_penyakit . '" class="small-box-footer">Selengkapnya</a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-warning">
<div class="inner">
<h3>' . implode($c_aturan) . '</h3>

<p>Data Aturan</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="' . $link_aturan . '" class="small-box-footer">Selengkapnya</a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
<div class="small-box bg-danger">
<div class="inner">
<h3>' . implode($c_admin) . '</h3>

<p>Data Admin</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="' . $link_admin . '" class="small-box-footer">Selengkapnya</a>
</div>
</div>

'
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Home</h3>
    </div>
    <div class="box-body text-center">
        <img src="assets/images/logo_pakar.png" alt="Logo" width="100">
        <p class="h3">Selamat Datang di Aplikasi Sistem Pakar Metode Forward Chaining</p>
        <!-- <br>
        <p>
            <img src="assets/images/logo_pakar.png" alt="Logo" width="100">
        </p>
        <br> -->
        <br>
        <?php echo $list_data ?>
        <!-- ./col -->
        <!-- ./col -->
    </div>
    <!-- /.row -->
</div>
</div>
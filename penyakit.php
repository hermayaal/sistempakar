<?php
$link_data = '?page=penyakit';
$link_update = '?page=update_penyakit';

$list_data = '';
$q = "select * from penyakit order by id_penyakit asc";
$q = mysqli_query($con, $q);
if (mysqli_num_rows($q) > 0) {
    $no = 1;
    while ($r = mysqli_fetch_array($q)) {
        $id = $r['id_penyakit'];
        $list_data .= '
		<tr>
		<td>' . $no++ . '</td>
		<td>' . $r['kode_penyakit'] . '</td>
		<td>' . $r['nama_penyakit'] . '</td>
        <td>' . $r['pengobatan'] . '</td>
		<td>
		<a href="' . $link_update . '&id=' . $id . '&action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
		<a href="#" data-href="' . $link_update . '&id=' . $id . '&action=delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a></td>
		</tr>';
    }
}
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Data Penyakit</h3>
        <div class="box-tools">
            <a href="<?php echo $link_update; ?>" class="btn btn-primary btn-sm">Tambah Penyakit</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Penyakit</th>
                        <th>Nama Penyakit</th>
                        <th>Pengobatan</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $list_data; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
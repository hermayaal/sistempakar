<?php
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<li <?php if ($page == "home") echo 'class="active"'; ?>><a href="?page=home"><i class="fa fa-home"></i> <span>Home</span></a></li>
<li <?php if ($page == "gejala" || $page == "update_gejala") echo 'class="active"'; ?>><a href="?page=gejala"><i class="fa fa-tags"></i> <span>Data Gejala</span></a></li>
<li <?php if ($page == "penyakit" || $page == "update_penyakit") echo 'class="active"'; ?>><a href="?page=penyakit"><i class="fa fa-folder-open"></i> <span>Data Penyakit</span></a></li>
<li <?php if ($page == "aturan" || $page == "update_aturan") echo 'class="active"'; ?>><a href="?page=aturan"><i class="fa fa-book"></i> <span>Data Aturan</span></a></li>
<!-- <li <?php if ($page == "artikel" || $page == "update_artikel") echo 'class="active"'; ?>><a href="?page=artikel"><i class="fa fa-newspaper-o "></i> <span>Data Artikel</span></a></li> -->
<li <?php if ($page == "admin" || $page == "update_admin") echo 'class="active"'; ?>><a href="?page=admin"><i class="fa fa-user"></i> <span>Data Admin</span></a></li>
<li <?php if ($page == "password") echo 'class="active"'; ?>><a href="?page=password"><i class="fa fa-unlock-alt"></i> <span>Ubah Password</span></a></li>
<li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
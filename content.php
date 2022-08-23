<?php
switch ($page) {
    case 'hasil_diagnosa':
        include "diagnosa_hasil.php";
        break;
    case 'mulai_diagnosa':
        include "diagnosa_mulai.php";
        break;
    case 'mulai_diagnosa_user':
        include "diagnosa_mulai_user.php";
        break;
    case 'diagnosa':
        include "diagnosa.php";
        break;
    case 'diagnosa_user':
        include "diagnosa_user.php";
        break;
    case 'gejala':
        include "gejala.php";
        break;
    case 'update_gejala':
        include "gejala_update.php";
        break;
    case 'penyakit':
        include "penyakit.php";
        break;
    case 'update_penyakit':
        include "penyakit_update.php";
        break;
    case 'aturan':
        include "aturan.php";
        break;
    case 'update_aturan':
        include "aturan_update.php";
        break;
    case 'artikel':
        include "artikel.php";
        break;
    case 'update_artikel':
        include "artikel_update.php";
        break;
    case 'admin':
        include "admin.php";
        break;
    case 'update_admin':
        include "admin_update.php";
        break;
    case 'password':
        include "password.php";
        break;
    case 'cetak':
        include "cetak.php";
        break;
    case 'home':
        include "home.php";
        break;

    default:
        include "home.php";
        break;
}

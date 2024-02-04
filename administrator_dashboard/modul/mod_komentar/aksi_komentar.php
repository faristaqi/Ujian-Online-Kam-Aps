<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
  include "../../../config/koneksi.php";

  $module = $_GET['module'];
  $act = $_GET['act'];

  // Hapus komentar
  if ($module == 'komentar' and $act == 'hapus') {
    mysqli_query($mysqli, "DELETE FROM komentar WHERE id_komentar='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
  }

  // Update komentar
  elseif ($module == 'komentar' and $act == 'update') {
    mysqli_query($mysqli, "UPDATE komentar SET nama_komentar = '$_POST[nama_komentar]',
                                   url           = '$_POST[url]', 
                                   isi_komentar  = '$_POST[isi_komentar]', 
                                   aktif         = '$_POST[aktif]'
                             WHERE id_komentar   = '$_POST[id]'");
    header('location:../../media.php?module=' . $module);
  } elseif ($module == 'komentar' and $act == 'nonaktif') {
    $aktif = 'N';
    mysqli_query($mysqli, "UPDATE komentar SET aktif  = '$aktif'  WHERE id_komentar='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
    echo "tes";
  } elseif ($module == 'komentar' and $act == 'aktif') {
    $aktif = 'Y';
    mysqli_query($mysqli, "UPDATE komentar SET aktif  = '$aktif'  WHERE id_komentar='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
    echo "tes";
  }
}

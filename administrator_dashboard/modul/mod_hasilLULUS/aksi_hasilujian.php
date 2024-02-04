<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";
$module = $_GET['module'];

  if($_GET['id']!=""){
    $id = $_GET['id'];
   $del = mysqli_query($mysqli, "DELETE FROM tbl_nilai WHERE id_nilai='$_GET[id]'");
   mysqli_query($mysqli, "UPDATE tbl_user SET telah_ujian  = ''  WHERE id_user='$_GET[iduser]'");
    if($del){
      $_SESSION['info'] = 'Dihapus';
      header('location:../../media.php?module=' . $module);
    }else{
      $_SESSION['info'] = 'Gagal Dihapus';
      header('location:../../media.php?module=' . $module);
    }
  }
?>




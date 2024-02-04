<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module = $_GET['module'];
$act = $_GET['act'];

// Update user
if ($module == 'mod_hasilTDKikutUJIAN' and $act == 'update') {
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  if (!empty($lokasi_file)) {
    UploadBanner($nama_file);
    move_uploaded_file($lokasi_file, "foto/$nama_file");

    mysqli_query($mysqli, "UPDATE user SET statusaktif  = '$_POST[statusaktif]',
                 nama = '$_POST[nama]',
                 pangkat = '$_POST[pangkat]',
                 nrp = '$_POST[nrp]',
                 password = '$_POST[password]',
                 jabatan = '$_POST[jabatan]',
                 gambar = '$nama_file'
                  WHERE  id_user     = '$_POST[id]'");
  } else {
    mysqli_query($mysqli, "UPDATE user SET statusaktif  = '$_POST[statusaktif]',
                 nama = '$_POST[nama]',
                 pangkat = '$_POST[pangkat]',
                 nrp = '$_POST[nrp]',
                 password = '$_POST[password]',
                 jabatan = '$_POST[jabatan]'
                  WHERE  id_user     = '$_POST[id]'");
  }
  header('location:../../media.php?module=' . $module);



} elseif ($module == 'mod_hasilTDKikutUJIAN' and $act == 'hapus') {

  if($_GET['id']!=""){
    $id = $_GET['id'];

    $del = mysqli_query($mysqli, "DELETE FROM tbl_user WHERE id_user='$_GET[id]'");
    mysqli_query($mysqli, "DELETE FROM tbl_nilai WHERE id_user='$_GET[id]'");

    if($del){
      $_SESSION['info'] = 'Dihapus';
       header('location:../../media.php?module=' . $module);
    }else{
      $_SESSION['info'] = 'Gagal Dihapus';
      header('location:../../media.php?module=' . $module);
    }
  }





} elseif ($module == 'mod_hasilTDKikutUJIAN' and $act == 'input') {
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  if (!empty($lokasi_file)) {
    UploadBanner($nama_file);
    move_uploaded_file($lokasi_file, "foto/$nama_file");

    mysqli_query($mysqli, "INSERT INTO user(nama,pangkat,nrp,password,jabatan,gambar,level) 
    VALUES('$_POST[nama]','$_POST[pangkat]','$_POST[nrp]','$_POST[password]',
    '$_POST[jabatan]','$nama_file','user')");
  } else {
    mysqli_query($mysqli, "INSERT INTO user(nama,pangkat,nrp,password,jabatan,level) 
    VALUES('$_POST[nama]','$_POST[pangkat]','$_POST[nrp]','$_POST[password]',
    '$_POST[jabatan]','user')");
  }
  header('location:../../media.php?module=' . $module);
}
//Pengaktifan dan Pengnonaktifan pengalihan halaman web ke modul = mod_hasilTDKikutUJIAN
elseif ($module == 'mod_hasilTDKikutUJIAN' and $act == 'nonaktif') {
  $aktif = 'N';
  mysqli_query($mysqli, "UPDATE tbl_user SET statusaktif  = '$aktif'  WHERE id_user='$_GET[id]'");
  header('location:../../media.php?module=' .  $module);
} elseif ($module == 'mod_hasilTDKikutUJIAN' and $act == 'aktif') {
  $aktif = 'Y';
  mysqli_query($mysqli, "UPDATE tbl_user SET statusaktif  = '$aktif'  WHERE id_user='$_GET[id]'");
  header('location:../../media.php?module=' .  $module);
}

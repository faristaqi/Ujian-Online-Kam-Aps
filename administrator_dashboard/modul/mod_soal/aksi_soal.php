<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
  include "../../../config/koneksi.php";
  include "../../../config/library.php";
  include "../../../config/fungsi_thumb.php";


  $module = $_GET['module'];
  $act = $_GET['act'];

  // Input soal
  if ($module == 'soal' and $act == 'input') {
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
    $tipe_file      = $_FILES['fupload']['type'];
    $nama_file      = $_FILES['fupload']['name'];
    $acak           = rand(1, 99);
    $nama_file_unik = $acak . $nama_file;

    // Apabila ada gambar yang diupload
    if (!empty($lokasi_file)) {
      UploadBanner($nama_file_unik);
      mysqli_query($mysqli, "INSERT INTO tbl_soal(soal,a,b,c,d,e,knc_jawaban,tanggal,gambar) 
  				VALUES('$_POST[soal]',
					   '$_POST[a]',
					   '$_POST[b]',
					   '$_POST[c]',
					   '$_POST[d]',
             '$_POST[e]',
					   '$_POST[knc_jawaban]',
                       '$tgl_sekarang',
                       '$nama_file_unik')");
    } else {
      mysqli_query($mysqli, "INSERT INTO tbl_soal(soal,a,b,c,d,e,knc_jawaban) 
  				VALUES('$_POST[soal]',
					   '$_POST[a]',
					   '$_POST[b]',
					   '$_POST[c]',
					   '$_POST[d]',
             '$_POST[e]',
					   '$_POST[knc_jawaban]')");
    }
    header('location:../../media.php?module=' . $module);
  }




  //Hapus Soal
  elseif ($module == 'soal' and $act == 'hapus') {

 if($_GET['id']!=""){
$del =  mysqli_query($mysqli, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
    if($del){
      $_SESSION['info'] = 'Dihapus';
       header('location:../../media.php?module=' . $module);
    }else{
      $_SESSION['info'] = 'Gagal Dihapus';
      header('location:../../media.php?module=' . $module);
    }}
  }

  // Update soal
  elseif ($module == 'soal' and $act == 'update') {
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
    $tipe_file      = $_FILES['fupload']['type'];
    $nama_file      = $_FILES['fupload']['name'];
    $acak           = rand(1, 99);
    $nama_file_unik = $acak . $nama_file;

    // Apabila gambar tidak diganti
    if (empty($lokasi_file)) {
      mysqli_query($mysqli, "UPDATE tbl_soal SET soal       = '$_POST[soal]',
                                   			 a  = '$_POST[a]' ,
								             b  = '$_POST[b]',
											 c  = '$_POST[c]',
											 d  = '$_POST[d]',
                       e  = '$_POST[e]',
											knc_jawaban= '$_POST[knc_jawaban]'
                             WHERE id_soal   = '$_POST[id]'");
    } else {
      UploadBanner($nama_file_unik);
      mysqli_query($mysqli, "UPDATE tbl_soal SET soal       = '$_POST[soal]',
                                   			 a  = '$_POST[a]' ,
								             b  = '$_POST[b]',
											 c  = '$_POST[c]',
											 d  = '$_POST[d]',
                       e  = '$_POST[e]',
											knc_jawaban= '$_POST[knc_jawaban]',
                                   gambar      = '$nama_file_unik' 
                             WHERE id_soal   = '$_POST[id]'");
    }
    header('location:../../media.php?module=' . $module);
  }
  //Pengaktifan dan Pengnonaktifan
  elseif ($module == 'soal' and $act == 'nonaktif') {
    $aktif = 'N';
    mysqli_query($mysqli, "UPDATE tbl_soal SET aktif  = '$aktif'  WHERE id_soal='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
    echo "tes";
  } elseif ($module == 'soal' and $act == 'aktif') {
    $aktif = 'Y';
    mysqli_query($mysqli, "UPDATE tbl_soal SET aktif  = '$aktif'  WHERE id_soal='$_GET[id]'");
    header('location:../../media.php?module=' . $module);
    echo "tes";
  }
}
?> 
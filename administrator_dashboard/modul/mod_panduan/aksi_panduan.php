<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <script src="../../../js/sweetalert.min.js"></script>
</head>
<body>


<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module = $_GET['module'];
$act = $_GET['act'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Update profil
if ($module == 'panduan' and $act == 'update') {
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1, 99);
  $nama_file_unik = $acak . $nama_file;


  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)) {


  // Validasi tipe file yang diunggah
    $allowed_types = array('image/jpeg', 'image/png');
    if (!in_array($tipe_file, $allowed_types)) {
        // Tipe file tidak diizinkan, tampilkan pesan kesalahan
        echo '<script>swal("File yang diunggah harus berupa gambar dengan format .jpg atau .png", {
            icon: "error",
        });
        setTimeout(function() {                        
            window.location="../../media.php?module=panduan";
        }, 4000);</script>';
        exit; // Hentikan eksekusi skrip
    }



    UploadBanner($nama_file);
    mysqli_query($mysqli, "UPDATE modul SET isi_modul = '$_POST[isi]',
                                  gambar  = '$nama_file'    
                            WHERE id_modul      = '$_POST[id]'");

    mysqli_query($mysqli, "UPDATE nama_profile SET profile = '$_POST[profile]', 
                                  profile =   '$_POST[profile]'
                            WHERE id_profile      = '$_POST[idprf]'");

    mysqli_query($mysqli, "UPDATE tbl_admin SET username = '$_POST[usernameAdmin]' WHERE id_admin      = '1'");
     mysqli_query($mysqli, "UPDATE tbl_admin SET password = '$_POST[password]' WHERE id_admin      = '1'");
mysqli_query($mysqli, "UPDATE nama_profile SET pakai_sidebar = '$_POST[sidebar]' WHERE id_profile      = '1'");



  } else {
    mysqli_query($mysqli, "UPDATE modul SET 
									   isi_modul = '$_POST[isi]'
                            WHERE id_modul       = '$_POST[id]'");

   mysqli_query($mysqli, "UPDATE nama_profile SET 
                     profile = '$_POST[profile]'
                            WHERE id_profile       = '$_POST[idprf]'");



    mysqli_query($mysqli, "UPDATE tbl_admin SET username = '$_POST[usernameAdmin]' WHERE id_admin      = '1'");
     mysqli_query($mysqli, "UPDATE tbl_admin SET password = '$password' WHERE id_admin      = '1'");

    mysqli_query($mysqli, "UPDATE nama_profile SET pakai_sidebar = '$_POST[sidebar]' WHERE id_profile      = '1'");
  
  }


  }
  
 ?>

 <script >
                      swal('Data berhasil di update..', {
                      icon: 'success',
                                                       });
                      setTimeout(function() {                        
window.location="../../media.php?module=panduan";
                                              }, 1500); 
</script>



</body>
</html>

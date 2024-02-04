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

// Update pengaturanujian
if ($module == 'pengaturanujian' and $act == 'update') {
  mysqli_query($mysqli, "UPDATE tbl_pengaturan_ujian SET nama_ujian = '$_POST[nama_ujian]',		
								waktu = '$_POST[waktu]',
								nilai_min = '$_POST[nilai_min]',
								peraturan = '$_POST[peraturan]'
                            WHERE id      = '$_POST[id]'");

}
 ?>
 <script >
                      swal('Data berhasil di update..', {
                      icon: 'success',
                                                       });
                      setTimeout(function() {                        
window.location="../../media.php?module=pengaturanujian";
                                              }, 1500); 
</script>

</body>
</html>

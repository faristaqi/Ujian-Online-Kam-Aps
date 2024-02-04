<?php
session_start();
include "config/koneksi.php";
// buat login online untuk membuat offline dulu jika data terlanjur tersimpan
  mysqli_query($mysqli,"UPDATE tbl_user set online ='0' where id_user='" . $_SESSION['id_user'] . "'");
?>



<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>side bar</title>

  <script src="js/sweetalert.min.js"></script>
  </head>
 <body>
<?php

session_destroy();
?>


 <script type="text/javascript">

                      swal('Logout Berhasil..', {
                      icon: 'success',
                                                       });
                      setTimeout(function() {     
                       window.location="index.php";
                                              }, 1500); 

</script>



  </body>
  </html>

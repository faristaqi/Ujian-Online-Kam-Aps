<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>side bar</title>

  <script src="../js/sweetalert.min.js"></script>
  </head>
 <body>
<?php
session_start();
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

<?php
ob_start(); 
include "../config/koneksi.php"; 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
 <script src="../js/sweetalert.min.js"></script>
</head>
<body>
<?php
$username = $_POST['username'];
$user_input_password = $_POST['password'];


$qry = mysqli_query($mysqli, "SELECT * FROM tbl_admin WHERE username='$username' ");

$r = mysqli_fetch_array($qry);
// Mendapatkan hashed password dari hasil query
    $hashed_password_from_db = $r['password'];

    // Verifikasi password menggunakan password_verify
    if (password_verify($user_input_password, $hashed_password_from_db)) {
	session_start();
	$_SESSION['username'] = $r['username'];
	$_SESSION['id_admin'] = $r['id_admin'];
	
header('location:media.php?module=home ');


} else {

  echo " <script>

         swal({

  title: 'Gagal Login !',
  text: 'Akun atau Pasword Admin Salah !',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((akhiri) => {
  if (akhiri) {

    swal('Jika ada kendala hubungi DEVELOPER APLIKASI..', {
      icon: 'warning',
    });

 setTimeout(function() {     
 window.location='index.php';
                        }, 10000);  
  } 
            
 else {
    window.location='index.php';
  }
            });           
                         
                       
  </script>";




	exit();
}
?>


</body>

</html>
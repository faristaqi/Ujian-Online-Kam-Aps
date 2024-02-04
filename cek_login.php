<?php
ob_start(); 
include "config/koneksi.php"; 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<script src="js/sweetalert.min.js"></script>
</head>
<body>
<?php
$username = $_POST['username'];
$user_input_password = $_POST['password'];

$query = "SELECT * FROM tbl_user WHERE username = '$username' AND statusaktif='Y'";
$result = mysqli_query($mysqli, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Mendapatkan hashed password dari hasil query
    $hashed_password_from_db = $row['password'];

    // Verifikasi password menggunakan password_verify
    if (password_verify($user_input_password, $hashed_password_from_db)) {
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['id_user'] = $row['id_user'];
        header('location:media.php?hal=home');
    } else {
        echo '<script>
            swal({
                title: "Gagal Login!",
                text: "Password Salah / akun belum (DIVERIFIKASI / AKTIF)",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((akhiri) => {
                if (akhiri) {
                    swal("Untuk verifikasi / mengaktifkan akun hubungi ADMIN", {
                        icon: "warning",
                    });
                    setTimeout(function() {     
                        window.location = "index.php";
                    }, 3000);
                } else {
                    window.location = "index.php";
                }
            });
        </script>';
        exit();
    }
}
?>


</body>

</html>
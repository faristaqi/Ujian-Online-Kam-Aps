<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TAMBAH USER</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <script src="../../../js/sweetalert.min.js"></script>

</head>

<body>

    <?php
   include "../../../config/koneksi.php";

    if (isset($_POST['submit'])) {

$cek = $_POST["username"];
$hasil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE username = '$cek'");
               /// cek adanya ada ndak kalau ada nilai 1 kalau tdk ada nilai 0
if (mysqli_num_rows($hasil) > 0) {

          echo "
            <script>
   swal('Username sudah terdaftar, ganti dengan username yang lain', {
      icon: 'warning',
    });
                </script>";  
            }
 else { 
          

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars(md5($_POST['password']));
$nama = htmlspecialchars($_POST['nama']);
$tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
$jk = htmlspecialchars($_POST['jk']);
$agama = htmlspecialchars($_POST['agama']);
$kwgn = htmlspecialchars($_POST['kwgn']);
$nama_ayah = htmlspecialchars($_POST['nama_ayah']);
$nama_ibu = htmlspecialchars($_POST['nama_ibu']);
$pekerjaan_ayah = htmlspecialchars($_POST['pekerjaan_ayah']);
$pekerjaan_ibu = htmlspecialchars($_POST['pekerjaan_ibu']);
$sekolah_asal = htmlspecialchars($_POST['sekolah_asal']);
$telp = htmlspecialchars($_POST['telp']);
$alamat = htmlspecialchars($_POST['alamat']);


           $simpan = "INSERT INTO tbl_user VALUES

           ('', '$username', '$password', '$nama', '$tgl_lahir', '$jk', '$agama', '$kwgn', '$nama_ayah', '$nama_ibu', '$pekerjaan_ayah', '$pekerjaan_ibu', '$sekolah_asal', '$telp', '$alamat', 'Y', '','','')";

        mysqli_query($mysqli, $simpan);

    echo " <script>

         swal({

  title: 'Selamat akun berhasil dibuat',
  text: 'Akun sudah AKIF & bisa digunakan.',
  icon: 'success',

});
                                           
    </script>";

        
}            
}   
    ?>

    <div style='width=max-width: 100%'>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
 <?php  
        // Tombol kembali ke  jumlah Peserta
         echo "<div style='text-align:left;padding-left:30px;'>
          <input class='btn btn-primary' type=button value='Kembali ke  Peserta' 
          onclick=\"window.location.href='../../media.php?module=users';\">";
?>

 <h6 style="margin-left: 50%; padding: 10px; background-color: greenyellow ; background-size: 10px; text font-size: 6;" > * &nbsp &nbsp&nbsp Wajib di isi  </h6>


                <div style="margin-top: -10px;" class="login-panel panel panel-default">
                    <center>

                    </center>
                    <div class="panel-heading">
                        <h1 class="panel-title" >Pendaftaran Ujian Online</h1>
                    </div>
                    <div class="panel-body">
                        <div id="loading" style="text-align: center"></div>
                        <form name="form" action="" id="loginF" method="post">

                            <fieldset>
                                <div class="form-group">
                                    <label>Username   &nbsp *</label>
                                    <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password   &nbsp *</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>



<!-- membuat password tidak di hide -->
<script>

  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  </script>                </div>

                                <div class="form-group">
                                    <label>Nama Lengkap   &nbsp *</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"required>
                                </div>

                                <div class="form-group">  <div style="width: 200px;">
                                    <label>Tgl Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="YYYY-MM-DD">
                                </div></div>

                                <div class="form-group"> <div style="width: 200px;">
                                    <label>Jenis Kelamin</label>
                                    <select  name="jk" id="jk" class="form-control">
                                        <option selected>Laki-Laki</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div></div>


                                <div class="form-group"> <div style="width: 200px;">
                                    <label>Agama</label>
                                    <select name="agama" id="agama" class="form-control">
                                        <option selected>Islam</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Khatolik">Khatolik</option>
                                    </select>
                                </div></div>


                                <div class="form-group"> <div style="width: 200px;">
                                    <label>Kewarganegaraan</label>
                                    <select name="kwgn" id="kwgn" class="form-control">
                                        <option selected>Indonesia</option>
                                        <option value="Indoensia">Indonesia</option>
                                        <option value="Asing">Asing</option>
                                    </select>
                                </div></div>

                                <div class="form-group">
                                    <label>Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah">
                                </div>

                                <div class="form-group">
                                    <label>Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
                                </div>


                                <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                                </div>


                                <div class="form-group">
                                    <label>Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
                                </div>

                                <div class="form-group">
                                    <label>Sekolah Asal</label>
                                    <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" placeholder="Sekolah asal">
                                </div>

                                <div class="form-group"><div style="width: 200px;">
                                    <label>Telp</label>
                                    <input type="number" class="form-control" id="telp" name="telp" placeholder="Telpon">
                                </div></div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" cols="30" rows="4" id="alamat"></textarea>
                                </div>


                                <div class="checkbox">
                                    <label>
                                        jika ingin keluar dari form ini klik &nbsp; &nbsp;[Kembali ke Peserta]</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->


                                <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="Kirim">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>



</body>

</html>
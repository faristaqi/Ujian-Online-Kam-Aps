<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Ujian Online</title>
    <link rel="shortcut icon" href="images/favicon.gif" type="image/gif" >
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <script src="js/sweetalert.min.js"></script>

</head>

<body>

    <?php
    include "config/koneksi.php";
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
     setTimeout(function() { history.back();}, 3000); 
                </script>";  
// untuk menghentikan program agar tidak berjalan di script dibawahnya               
return false;             
            }



// Validasi kekuatan password
$password = $_POST["password"];

$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
 
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
              echo "
            <script>
   swal('Password minimal delapan karakter yang terdiri dari kombinasi angka, karakter khusus, huruf kapital, dan huruf kecil ', {
      icon: 'warning',
    });
    setTimeout(function() { history.back();}, 3000); 
                </script>"; 
 // untuk menghentikan program agar tidak berjalan di script dibawahnya               
return false;                
}




 else {         

$username = htmlspecialchars($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    
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


//menyiman data gambar

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $error          = $_FILES['fupload']['error']; 
  $ukuranFile     = $_FILES['fupload']['size']; 
  $acak           = rand(1, 99);
  $nama_file_unik = $acak . $nama_file;


  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)) {


// untuk cek gambar dah di upload belum
// cek apakah tidak ada gambar yang diupload => gambar harus diupload jika tdk maka data tdk bisa masuk 
        if( $error === 4 ) { 

              echo "
            <script>
   swal('Gambar belum di upload !!! ', {
      icon: 'warning',
    });
     setTimeout(function() { history.back();}, 3000); 
            </script>"; 
 // untuk menghentikan program agar tidak berjalan di script dibawahnya               
return false;             
}

// cek apakah yang diupload adalah gambar (gambar jenisnya jpg karena script kompress suport di jpg, jpeg)
    $ekstensiGambarValid = ['jpg','jpeg', 'png']; 
    $ekstensiGambar = explode('.', $nama_file); 
    $ekstensiGambar = strtolower(end($ekstensiGambar)); 
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) { 

              echo "
            <script>
   swal('Format gambar yang diizinkan hanya .jpg, .jpeg, dan .png ', {
      icon: 'warning',
    });
     setTimeout(function() { history.back();}, 3000); 
            </script>"; 
 // untuk menghentikan program agar tidak berjalan di script dibawahnya               
return false;            
}

// cek ukuran gambar maksimal 1 mega = kurang lebih 1000.000 kb
if( $ukuranFile > 20000000) {

              echo "
            <script>
   swal('Ukuran gambar terlalu besar! ', {
      icon: 'warning',
    });
     setTimeout(function() { history.back();}, 3000); 
            </script>";
 // untuk menghentikan program agar tidak berjalan di script dibawahnya               
return false;             
}

// jika lolos 3 pengecekan diatan dengan IF maka gambar akan di ipload dengan script dibawah
// mengganti nama file yg di upload dengan nama baru ini untuk antipasi ada yang mengupload file dengan nama yang sama maka gambar akan di timpa => dengan me rename file dengan nama acak (generate)
// tambahan untuk kompres gambar otomatis biar tidak terlalu besar di hosting


// tentukan folder tempat image di upload di hosting################################
$folder = "img/";
$upload_image = $_FILES['fupload']['name'];
// tentukan ukuran width yang diharapkan
$width_size = 200;

// tentukan di mana image akan ditempatkan setelah diupload
$filesave = $folder . $upload_image;
move_uploaded_file($_FILES['fupload']['tmp_name'], $filesave);

// menentukan nama image setelah dibuat
$resize_image = $folder . "resize_" . uniqid(rand()) . ".jpg";

// mendapatkan ukuran width dan height dari image
list( $width, $height ) = getimagesize($filesave);

// mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
$k = $width / $width_size;

// menentukan width yang baru
$newwidth = $width / $k;

// menentukan height yang baru
$newheight = $height / $k;

// fungsi untuk membuat image yang baru
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filesave);

// men-resize image yang baru
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// menyimpan image yang baru
imagejpeg($thumb, $resize_image);

imagedestroy($thumb);
imagedestroy($source);
// menghapus file gambar yg diupload yang blm di resize
unlink("img/".$upload_image); 

// membuat data nama gambar di tabel dikurangi 4 huruf
$nama_gambar_baru = substr($resize_image,4);



$simpan = "INSERT INTO tbl_user VALUES

           ('', '$username', '$password', '$nama', '$tgl_lahir', '$jk', '$agama', '$kwgn', '$nama_ayah', '$nama_ibu', '$pekerjaan_ayah', '$pekerjaan_ibu', '$sekolah_asal', '$telp', '$alamat', 'N', '','','','$nama_gambar_baru ' )";

mysqli_query($mysqli, $simpan);

    echo " <script>

         swal({

  title: 'Selamat akun berhasil dibuat',
  text: 'Akun akan di VERIFIKASI ADMIN agar bisa digunakan',
  icon: 'success',
  buttons: true,
  dangerMode: true,
})
.then((akhiri) => {
  if (akhiri) {

    swal('Untuk verifikasi / mengaktifkan akun hubungin ADMIN', {
      icon: 'warning',
    });

 setTimeout(function() {     
 window.location='index.php';
                        }, 3000);  
  } 
            
 else {
    window.location='index.php';
  }
            });           
                                             
    </script>";

  } else {
              echo "
            <script>
   swal('Foto belum di upload !!', {
      icon: 'warning',
    });
     setTimeout(function() { history.back();}, 3000); 
            </script>";  

  }}} 



    ?>

    <div style='width=max-width: 100%'>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">


 <h6 style="margin-left: 50%; padding: 10px; background-color: greenyellow ; background-size: 10px; text font-size: 6;" > &nbsp * &nbsp &nbsp Wajib diisi! </h6>


                <div style="margin-top: -10px;" class="login-panel panel panel-default">
                    <center>

                    </center>
                    <div class="panel-heading">
                        <h1 class="panel-title" >Pendaftaran Ujian Online</h1>
                    </div>
                    <div class="panel-body">
                        <div id="loading" style="text-align: center"></div>
                        <form name="form" action="" id="loginF" method="post" enctype='multipart/form-data'> <!-- menambakan script enctype='multipart/form-data' dalam tag form untuk mengirimkan file/gambar jk tdk menggunkan data hanya text -->

                            <fieldset>
                                <div class="form-group">
                                    <label>Username   &nbsp *</label>
                                    <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password   &nbsp *</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password (8 - 100) karakter, huruf (besar & kecil),tanpa spasi  dan special karakter  " required>



<!-- membuat show dan hide passwod -->
&nbsp  <input type="checkbox" onclick="myFunction()">&nbsp  Tampilkan Password 
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}  </script>                                     
                                </div>

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
          <div class='form-group'>
            <label >Masukkan pas foto anda &nbsp *</label>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'></label>
            <div class='col-sm-10'>
              <img src='images/icon_photo.jpg' width='136' height='160'>
              <br><br>
            </div>
          </div>

          <div class='form-group'>
           
            <div class='col-sm-5'>
             <input type=file size=30 name=fupload>
             <br><br><br><br><br>
            </div>
          </div>
                                <!-- Change this to a button or input when using this as a form -->


                                <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="Kirim">
                            </fieldset>
                        </form>
                                <div class="checkbox">
                                    <br><br>
                                    <label>
                                        Sudah punya akun ? masuk <a href="login.php">disini</a>
                                    </label>
                                </div>
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
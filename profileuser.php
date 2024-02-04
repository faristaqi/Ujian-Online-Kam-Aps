<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="shortcut icon" href="images/favicon.gif" type="image/gif" >
    <script src="js/sweetalert.min.js"></script>
  </head>
  <body>
  
 
  <div id="page-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <!--   <h3 class="page-header"> Peraturan </h3> -->

              </div>

          </div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-primary">
                      <div class="panel-heading">
                          Profile
                      </div>
                      <div class="panel-body">

                          <?php
                            include "config/koneksi.php";

                            $qry = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]'");
                            $t = mysqli_fetch_array($qry);










//menyimpan atau update data gambar BARU

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $error          = $_FILES['fupload']['error']; 
  $ukuranFile     = $_FILES['fupload']['size']; 
  $acak           = rand(1, 99);
  $nama_file_unik = $acak . $nama_file;




if (isset($_POST['submit'])) {
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
    $ekstensiGambarValid = ['jpg','jpeg']; 
    $ekstensiGambar = explode('.', $nama_file); 
    $ekstensiGambar = strtolower(end($ekstensiGambar)); 
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) { 

              echo "
            <script>
   swal('Yang anda upload bukan gambar atau format gambar tidak sesuai. Format yang diijin ( jpg dan jpeg )... !!! ', {
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
   swal('Ukuran gambar terlalu besar !!! ', {
      icon: 'warning',
    });
     setTimeout(function() { history.back();}, 3000); 
            </script>";
 // untuk menghentikan program agar tidak berjalan di script dibawahnya               
return false;             
}

// jika lolos 3 pengecekan diatan dengan IF maka gambar akan di ipload dengan script dibawah
//#############  script menghapus gambar lama agar tidak berat di hosting
//  (menghindari Error jika gambar kosong dan ada perintah hapus gambar) jadi pesan error akan diabaikan
               ini_set('display_errors',0);
// menghapus gambar yg ada di folder img berdasarkan nama $hapus_gambar
 $hapus_gambar = $t['gambar'] ;             
 unlink('img/'. $hapus_gambar);

//#################################
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




















                            
                                $update = "UPDATE tbl_user set username='" . $_POST['username'] . "',password='" . md5($_POST['password']) . "',nama='" . $_POST['nama'] . "',tgl_lahir='" . $_POST['tgl_lahir'] . "',jk='" . $_POST['jk'] . "',agama='" . $_POST['agama'] . "',kwgn='" . $_POST['kwgn'] . "',nama_ayah='" . $_POST['nama_ayah'] . "',pekerjaan_ayah='" . $_POST['pekerjaan_ayah'] . "',nama_ibu='" . $_POST['nama_ibu'] . "',pekerjaan_ibu='" . $_POST['pekerjaan_ibu'] . "',sekolah_asal='" . $_POST['sekolah_asal'] . "',telp='" . $_POST['telp'] . "',alamat='" . $_POST['alamat'] . "' ,gambar='$nama_gambar_baru' 
                                where id_user='" . $_SESSION['id_user'] . "' ";
mysqli_query($mysqli, $update);         
                         
echo " 

                            <script>
                            swal('Selamat profile anda berhasil di ubah', {
                            icon: 'success', });
    
setTimeout(function() {     
 window.location='media.php?hal=profiluser';
                        }, 3000);                           
                            </script>";   





 } else {


                                $update = "UPDATE tbl_user set username='" . $_POST['username'] . "',password='" . md5($_POST['password']) . "',nama='" . $_POST['nama'] . "',tgl_lahir='" . $_POST['tgl_lahir'] . "',jk='" . $_POST['jk'] . "',agama='" . $_POST['agama'] . "',kwgn='" . $_POST['kwgn'] . "',nama_ayah='" . $_POST['nama_ayah'] . "',pekerjaan_ayah='" . $_POST['pekerjaan_ayah'] . "',nama_ibu='" . $_POST['nama_ibu'] . "',pekerjaan_ibu='" . $_POST['pekerjaan_ibu'] . "',sekolah_asal='" . $_POST['sekolah_asal'] . "',telp='" . $_POST['telp'] . "',alamat='" . $_POST['alamat'] . "' 
                                where id_user='" . $_SESSION['id_user'] . "' ";
mysqli_query($mysqli, $update);









echo "
            <script>
   swal(' Data berhasil di ubah tetapi Photo profile tidak diganti... OK !!', {
      icon: 'warning',
    });
setTimeout(function() {     
 window.location='media.php?hal=profiluser';
                        }, 3000);                           
                            </script>";  

  }}










                              
                            
                            ?>

                          <form name="form1" method="post" action=""enctype='multipart/form-data'> <!-- menambakan script enctype='multipart/form-data' dalam tag form untuk mengirimkan file/gambar jk tdk menggunkan data hanya text -->
                             
                              <div class="form-group" align="center">
                                   <img src='img/<?php echo $t['gambar'] ?>' width='136' height='160'>
                                    <br><br>
                                                 <input type=file size=30 name=fupload>
                                    <br>

                              </div>


                              <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control" id="username" name="username" readonly  value="<?php echo $t['username'] ?>">

                              </div>
                              <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" id="password" name="password" class="form-control" readonly placeholder="tidak boleh diganti">
                              </div>

                              <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" class="form-control" id="nama" name="nama"  value="<?php echo $t['nama'] ?>">
                              </div>

                              
                             <div class="form-group">
                                <div style="width: 200px;">
                                  <label>Tgl Lahir</label>
                                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"  value="<?php echo $t['tgl_lahir'] ?>">
                              </div></div>

                              <div class="form-group"> <div style="width: 200px;">
                                  <label>Jenis Kelamin </label>
                                  <select name="jk" id="jk" class="form-control" >
                                      <option selected>Laki-Laki</option>
                                      <option value="Laki-Laki">Laki-Laki</option>
                                      <option value="Perempuan">Perempuan</option>
                                  </select>
                              </div> </div>


                              <div class="form-group">  <div style="width: 200px;">
                                  <label>Agama</label>
                                  <select name="agama" id="agama" class="form-control">
                                      <option selected>Islam</option>
                                      <option value="Islam">Islam</option>
                                      <option value="Budha">Budha</option>
                                      <option value="Hindu">Hindu</option>
                                      <option value="Kristen">Kristen</option>
                                      <option value="Khatolik">Khatolik</option>
                                  </select>
                              </div> </div>


                              <div class="form-group"> <div style="width: 200px;">
                                  <label>Kewarganegaraan</label>
                                  <select name="kwgn" id="kwgn" class="form-control">
                                      <option selected>Indonesia</option>
                                      <option value="Indoensia">Indonesia</option>
                                      <option value="Asing">Asing</option>
                                  </select>
                              </div> </div>

                              <div class="form-group">
                                  <label>Nama Ayah</label>
                                  <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"  value="<?php echo $t['nama_ayah'] ?>">
                              </div>

                              <div class="form-group">
                                  <label>Pekerjaan Ayah</label>
                                  <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?php echo $t['pekerjaan_ayah'] ?>">
                              </div>


                              <div class="form-group">
                                  <label>Nama Ibu</label>
                                  <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"  value="<?php echo $t['nama_ibu'] ?>">
                              </div>


                              <div class="form-group">
                                  <label>Pekerjaan Ibu</label>
                                  <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu"  value="<?php echo $t['pekerjaan_ibu'] ?>">
                              </div>

                              <div class="form-group">
                                  <label>Sekolah Asal</label>
                                  <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal"  value="<?php echo $t['sekolah_asal'] ?>">
                              </div>

                              <div class="form-group"><div style="width: 200px;">
                                  <label>Telp</label>
                                  <input type="number" class="form-control" id="telp" name="telp"  value="<?php echo $t['telp'] ?>">
                              </div> </div>

                              <div class="form-group">
                                  <label>Alamat</label>
                                  <textarea name="alamat" class="form-control" cols="30" rows="4" id="alamat"><?php echo $t['alamat'] ?></textarea>
                              </div>

                              <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="Kirim">

                          </form>
                      </div>
                      <div class="panel-footer">

                      </div>
                  </div>
              </div>
          </div>
          <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </div>

  <script type="text/javascript">
      var $ = jQuery;
      $('#jk').val('<?php echo $t['jk']; ?>');
      $('#agama').val('<?php echo $t['agama']; ?>');
      $('#kwgn').val('<?php echo $t['kwgn']; ?>');
  </script>


   </body>
  </html>
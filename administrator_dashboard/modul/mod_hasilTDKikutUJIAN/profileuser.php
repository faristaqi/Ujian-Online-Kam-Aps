<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PROFILE USER</title>

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
                             include "../../../config/koneksi.php";


                            $qry = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]'");
                            $t = mysqli_fetch_array($qry);

                            if (isset($_POST['submit'])) {




$cek = $_POST["username"];
$hasil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE username = '$cek'");

// jika username tidak di ubah maka boleh simpan data

if ($cek ==$t['username'])  {


                                $update = "UPDATE tbl_user set username='" . $_POST['username'] . "',password='" . md5($_POST['password']) . "',nama='" . $_POST['nama'] . "',tgl_lahir='" . $_POST['tgl_lahir'] . "',jk='" . $_POST['jk'] . "',agama='" . $_POST['agama'] . "',kwgn='" . $_POST['kwgn'] . "',nama_ayah='" . $_POST['nama_ayah'] . "',pekerjaan_ayah='" . $_POST['pekerjaan_ayah'] . "',nama_ibu='" . $_POST['nama_ibu'] . "',pekerjaan_ibu='" . $_POST['pekerjaan_ibu'] . "',sekolah_asal='" . $_POST['sekolah_asal'] . "',telp='" . $_POST['telp'] . "',alamat='" . $_POST['alamat'] . "' where id_user='" . $_GET['id'] . "' ";
                                mysqli_query($mysqli, $update);         
                         
                            echo " 

                            <script>
                            swal('Selamat profile anda berhasil di ubah', {
                            icon: 'success', });
    
setTimeout(function() {     
 window.location.href='../../media.php?module=mod_hasilTDKikutUJIAN';
                        }, 2000);                           
                            </script>";   
                              
                            }


else { 


// cek jika username di ubah dan username ada di dalam data maka tidak boleh menyimpan data
if (mysqli_num_rows($hasil) > 0)  {

echo "
<script>
   swal('Username sudah terdaftar, ganti dengan username yang lain', {
      icon: 'warning',
    });
</script>";  
            }
 else { 

                                $update = "UPDATE tbl_user set username='" . $_POST['username'] . "',password='" . md5($_POST['password']) . "',nama='" . $_POST['nama'] . "',tgl_lahir='" . $_POST['tgl_lahir'] . "',jk='" . $_POST['jk'] . "',agama='" . $_POST['agama'] . "',kwgn='" . $_POST['kwgn'] . "',nama_ayah='" . $_POST['nama_ayah'] . "',pekerjaan_ayah='" . $_POST['pekerjaan_ayah'] . "',nama_ibu='" . $_POST['nama_ibu'] . "',pekerjaan_ibu='" . $_POST['pekerjaan_ibu'] . "',sekolah_asal='" . $_POST['sekolah_asal'] . "',telp='" . $_POST['telp'] . "',alamat='" . $_POST['alamat'] . "' where id_user='" . $_GET['id'] . "' ";
                                mysqli_query($mysqli, $update);         
                         
                            echo " 

                            <script>
                            swal('Selamat profile anda berhasil di ubah', {
                            icon: 'success', });
    
setTimeout(function() {     
 window.location.href='../../media.php?module=mod_hasilTDKikutUJIAN';
                        }, 2000);                           
                            </script>";   
                              
                              }}}
                            ?>

                          <form name="form1" method="post" action="">
                              <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control" id="username" name="username" placeholder="Username"  value="<?php echo $t['username'] ?>">

                              </div>
                              <div class="form-group">
                                  <label>Password Encryption</label>
                                  <input type="password" id="password" name="password" class="form-control"  placeholder="Password" value="<?php echo $t['password'] ?>">
                              </div>
<!-- membuat password tidak di hide -->
<script>

  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  </script>



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
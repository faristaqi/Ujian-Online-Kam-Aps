<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="10"/>
    <title>online</title>
<script src="../js/sweetalert.min.js"></script>
  </head>
 <body> 
<!-- buat sweet alert di taruh data info SWAL  untuk membuat session di halaman ini hasil dari aksi_hasilujian.php untuk menjalankan sweetalert. krn kalau waktu dibuka pertama kali sesion kosong sweetalert tidak bekerja-->
        <div id="page-wrapper" class="rukiyanto" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>">
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
                    Daftar Peserta Yang Sedang Online
                  </div>
                  <div class="panel-body">
                    <h5> Data akan dikosongkan otomatis setelah 1 hari berlalu </h5>
<?php
                  
// script buat mengosongkan yang telah online selama x hari krn peserta tidak logout jadi masih tampil di daftar online
$lama = 0.1 ; // lama data adalah 0.1 hari/ 6 jam
mysqli_query($mysqli, "UPDATE tbl_user SET online = '0' WHERE DATEDIFF(CURDATE(), waktu_online) > $lama");

                   $aksi = "modul/mod_users/aksi_users.php";
                    switch ($_GET['act']) {
                        // Tampil User
                      default:
                        $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE online = '1' ORDER BY waktu_online DESC");         




                          // Tombol Tambah Peserta
                          echo "<div style='text-align:left;padding-left:2px;'>
          <input class='btn btn-success' type=button value='Kosongkan Data' 
          onclick=\"window.location.href='modul/mod_pesertaLogin/aksi_users.php';\">";


?> 



<div style='overflow-x:auto;'>


                        
    <table class='table table-striped table-bordered table-hover'>
          <tr ><th style="text-align: center">No</th><th style="text-align: center">User name</th><th style="text-align: center">Nama</th><th style="text-align: center">Terakhir Login</th><th style="text-align: center">Lihat</th></tr>
<?php
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
 ?>  


            <tr><td><?php echo $no ; ?></td>
             <td><?php echo  $r['username'] ; ?></td>
            <td><?php echo  $r['nama'] ; ?></td>
            <td><?php echo  $r['waktu_online'] ; ?></td>
<?php 
echo " 
         
        <td align=center ><a class='fa fa-eye' style='font-size:20px;' href='?module=users&act=lihat&id=$r[id_user]'></a></td>
";        
 ?>  

<?php
           
                          echo "</tr>";
                          $no++;
                        }
                        echo "</table><br></br><br></br><br></br><br></br><br></br>";
                        break;

                      case "lihat":
                        $tampil1 = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]'");
                        $t = mysqli_fetch_array($tampil1);


                        echo "
   <div style='overflow-x:auto;'>                     
  <table width=400px>
    <tr><th colspan=2 align='center'>DETAIL PESERTA</th></tr>
    <tr><td>User name</td><td> &nbsp;: $t[username]</td></tr>
    <tr><td valign='top'>Password</td><td> &nbsp;: $t[password]</td></tr>
    <tr><td>Nama</td><td> &nbsp;: $t[nama]</td></tr>
    <tr><td>Tgl Lahir </td><td> &nbsp;: $t[tgl_lahir]</td></tr>
    <tr><td>Jenis Kelamin </td><td> &nbsp;: $t[jk]</td> </tr>
    <tr><td>Agama</td><td> &nbsp;: $t[agama]</td></tr>
    <tr><td>Kewarganegaraan </td><td> &nbsp;: $t[kwgn]</td></tr>
    <tr><td>Nama Ayah </td><td> &nbsp;: $t[nama_ayah]</td></tr>
    <tr><td>Nama Ibu </td><td> &nbsp;: $t[nama_ibu]</td></tr>
    <tr><td>Pekerjaan Ayah</td><td> &nbsp;: $t[pekerjaan_ayah]</td></tr>
    <tr><td>Pekerjaan Ibu </td><td> &nbsp;: $t[pekerjaan_ibu]</td></tr>
    <tr><td>Sekolah Asal </td><td> &nbsp;: $t[sekolah_asal]</td></tr>
    <tr> <td>Telp</td><td> &nbsp;: $t[telp]</td></tr>
    <tr><td>Alamat</td><td> &nbsp;: $t[alamat]</td></tr>
    <tr><td>&nbsp;</td><td> &nbsp;</td></tr>
  </table>";
                        break;

//halaman menampilkan pencarian....

                        case "cariuser22":
 ?>  


<div style='overflow-x:auto;'>
                        
    <table class='table table-striped table-bordered table-hover'>
          <tr ><th style="text-align: center">No</th><th style="text-align: center">User name</th><th style="text-align: center">Nama</th><th style="text-align: center">Lihat</th></tr>
<?php
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
 ?>  


            <tr><td><?php echo $no ; ?></td>
             <td><?php echo  $r['username'] ; ?></td>
            <td><?php echo  $r['nama'] ; ?></td>
<?php 
echo " 
         
        <td align=center ><a class='fa fa-eye' style='font-size:20px;' href='?module=users&act=lihat&id=$r[id_user]'></a></td>
";        
 ?>  

<?php

                          echo "</tr>";
                          $no++;
                        }
                        echo "</table><br></br><br></br><br></br><br></br><br></br>";
                        break;

                      case "lihat":
                        $tampil1 = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]'");
                        $t = mysqli_fetch_array($tampil1);


                        echo "
   <div style='overflow-x:auto;'>                     
  <table width=400px>
    <tr><th colspan=2 align='center'>DETAIL PESERTA</th></tr>
    <tr><td>User name</td><td> &nbsp;: $t[username]</td></tr>
    <tr><td valign='top'>Password</td><td> &nbsp;: $t[password]</td></tr>
    <tr><td>Nama</td><td> &nbsp;: $t[nama]</td></tr>
    <tr><td>Tgl Lahir </td><td> &nbsp;: $t[tgl_lahir]</td></tr>
    <tr><td>Jenis Kelamin </td><td> &nbsp;: $t[jk]</td> </tr>
    <tr><td>Agama</td><td> &nbsp;: $t[agama]</td></tr>
    <tr><td>Kewarganegaraan </td><td> &nbsp;: $t[kwgn]</td></tr>
    <tr><td>Nama Ayah </td><td> &nbsp;: $t[nama_ayah]</td></tr>
    <tr><td>Nama Ibu </td><td> &nbsp;: $t[nama_ibu]</td></tr>
    <tr><td>Pekerjaan Ayah</td><td> &nbsp;: $t[pekerjaan_ayah]</td></tr>
    <tr><td>Pekerjaan Ibu </td><td> &nbsp;: $t[pekerjaan_ibu]</td></tr>
    <tr><td>Sekolah Asal </td><td> &nbsp;: $t[sekolah_asal]</td></tr>
    <tr> <td>Telp</td><td> &nbsp;: $t[telp]</td></tr>
    <tr><td>Alamat</td><td> &nbsp;: $t[alamat]</td></tr>
    <tr><td>&nbsp;</td><td> &nbsp;</td></tr>
  </table>";

         }
                    ?>

                  </div></div>
                  <div class="panel-footer">

                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->




 <script>
/* bila ada session yg di simpan di <div> maka scrip dibawah jalan */
const notifikasi = $('.rukiyanto').data('infodata');
if(notifikasi == "Disimpan" || notifikasi=="Dihapus"){

                      swal('Data berhasil dihapus', {
                      icon: 'success',
                                                       });
                      setTimeout(function() {     
                      window.location='../../ujianonline/admin/media.php?module=users';
                                              }, 1500); 

}else if(notifikasi == "Gagal Disimpan" || notifikasi=="Gagal Dihapus"){
  Swal({
    icon: 'error',
    title: 'GAGAL',
    text: 'Data '+notifikasi,
  })
}else if(notifikasi == "Kosong"){
 
}
/*ketika klik hapus(href) maka.... guna function(e){
  e.preventDefault() untuk mematikan fungsi difault biar tidak menjalankan href kalau tidak di kasih href tetap dijalankan */

$('.delete-data').on('click', function(e){
  e.preventDefault();
  var getLink = $(this).attr('href');

swal({

  title: 'Yakin untuk menghapus data ini ?',
  text: 'Data yang dihapus tidak bisa dikembalikan',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
  }).then((result) => {
    if (result) {


      window.location.href = getLink;
    }
  })
});


  </script>



  </body>
  </html>
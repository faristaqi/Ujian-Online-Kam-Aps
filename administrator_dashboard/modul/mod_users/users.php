<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hasil ujian</title>
<script src="../js/sweetalert.min.js"></script>
  <link href="css/bootstrap.css" rel="stylesheet">
  <script src="css/jquery.min.js"></script>
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
                    Daftar Peserta
                  </div>
                  <div class="panel-body">
<?php
                   $aksi = "modul/mod_users/aksi_users.php";
                    switch ($_GET['act']) {
                        // Tampil User
                      default:
                        $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user ORDER BY nama ASC");
                     
 

  // Tombol cetak data
                          echo "<div class='panel-body' style='text-align:left;padding-left:0px;'>
          <input class='btn btn-secondary' type=button value='Cetak Data' 
          onclick=\"window.location.href='modul/mod_users/cetak.php';\">";
 echo "<br></br>" ;

                          // Tombol Tambah Peserta
                          echo "<div class='panel-body'  style='text-align:left;padding-left:30px; margin-left: -30px;'>
          <input class='btn btn-primary' type=button value='Tambah Peserta' 
          onclick=\"window.location.href='modul/mod_users/tambah_user.php';\">";



                          //Form Pencarian Data
                          echo "<div style='text-align:left;padding-right:40px;max-width:360px;'>
         <form method='POST' action=?module=users&act=cariuser>
     <input type=text name='cari'  placeholder='Masukkan nama peserta' list='auto' size=26 required/> <input type=submit class='btn btn-info' value='Cari'>";
                          echo "<datalist id='auto'>";
                          $qry = mysqli_query($mysqli, "SELECT * FROM tbl_user");
                          while ($t = mysqli_fetch_array($qry)) {
                            echo "<option value='$t[nama]'>";
                          }
                          echo "</datalist></form>
      </div>";

?> 
  <!-- form untuk mengirim data delete yang terseleksi -->
<form  method="POST" name="form1" action="modul/mod_users/delete_all.php" >

<div style='overflow-x:auto;'>
                        
    <table class='table table-striped table-bordered table-hover'>
          <tr ><th style="text-align: center">No</th><th style="text-align: center">User name</th><th style="text-align: center">Password</th><th style="text-align: center">Nama</th><th style="text-align: center">Jenis Kelamin</th><th width="100" style="text-align: center" >Edit</th><th width="100" style="text-align: center">Lihat</th><th width="100" style="text-align: center">Status</th><th width="10"><input type="checkbox" id="check-all"></th><th width="100" style="text-align: center"> <button id="btn-delete" class="btn btn-danger mb-4 mt-4 hapus_all" >Delete Selected</button></th></tr>
<?php
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
 ?>  


            <tr><td><?php echo $no ; ?></td>
            <td><?php echo  $r['username'] ; ?></td>
            <td><?php echo  $r['password'] ; ?></td>
            <td><?php echo  $r['nama'] ; ?></td>      
            <td><?php echo  $r['jk'] ; ?></td>
<?php 
echo "                                
        <td align=center ><a class='fa fa-pencil-square-o' style='font-size:20px;' onclick=\"window.location.href='modul/mod_users/profileuser.php?module=user&id=$r[id_user]';\"></a></td>
         
        <td align=center ><a class='fa fa-eye' style='font-size:20px;' href='?module=users&act=lihat&id=$r[id_user]'></a></td>
";        
 


                         if ($r['statusaktif'] == "Y") { 
                            echo "<td align=center ><input type=button class='btn btn-success btn-xs'  value='Aktif' onclick=\"window.location.href='$aksi?module=users&act=nonaktif&id=$r[id_user]';\"></td>";
                          } else {
                            echo "<td  align=center ><input class='btn btn-default btn-xs' type=button value='Non Aktif' onclick=\"window.location.href='$aksi?module=users&act=aktif&id=$r[id_user]';\"></td>";
                          }
 ?>  

  <td>  <input type="checkbox" name='id[]' class='check-item'  value="<?php echo $r["id_user"]; ?>" /></td>


<!--  class : delete data untuk mengkoneksikan dengan sweet alert href mengirimkan link dan data id (PENTING !!! BIAR KONEK DENGAN SWEET ALERT HARUS <TD> </TD> DALAM BENTUK HTML MAKA PENULISANNYA JUGA BEDA DENGAN YG DI PHP perhatikan petik nya dll ) ) -->

    <td  align=center ><a class="btn btn-danger btn-xs delete-data" href="modul/mod_users/aksi_users.php?module=users&act=hapus&id=<?=$r['id_user']?>">Hapus</a></td>  
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

                        case "cariuser":
 ?>  


<div style='overflow-x:auto;'>
                         <h4 style="color: #9400D3; "> <strong>Hasil Pencarian Yang ditemukan </strong></h4>
<!-- form untuk mengirim data delete yang terseleksi -->
<form  method="POST" name="form1" action="modul/mod_users/delete_all.php" >
                        
    <table class='table table-striped table-bordered table-hover'>
          <tr ><th style="text-align: center">No</th><th style="text-align: center">User name</th><th style="text-align: center">Nama</th><th style="text-align: center">Password</th><th style="text-align: center">Jenis Kelamin</th><th width="100" style="text-align: center" >Edit</th><th width="100" style="text-align: center">Lihat</th><th width="100" style="text-align: center">Status</th><th width="10"><input type="checkbox" id="check-all"></th><th width="100" style="text-align: center"> <button id="btn-delete" class="btn btn-danger mb-4 mt-4 hapus_all" >Delete Selected</button></th></tr>
<?php

                          $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE nama LIKE '%$_POST[cari]%'");
                          $no = 1;
                          while ($r = mysqli_fetch_array($tampil)) {
 ?>  

  


            <tr><td><?php echo $no ; ?></td>
             <td><?php echo  $r['username'] ; ?></td>
            <td><?php echo  $r['nama'] ; ?></td>
            <td><?php echo  $r['password'] ; ?></td>
        <td><?php echo  $r['jk'] ; ?></td>
         
<?php 
echo "                                
        <td align=center ><a class='fa fa-pencil-square-o' style='font-size:20px;' onclick=\"window.location.href='modul/mod_users/profileuser.php?module=user&id=$r[id_user]';\"></a></td>
         
        <td align=center ><a class='fa fa-eye' style='font-size:20px;' href='?module=users&act=lihat&id=$r[id_user]'></a></td>
";        



                         if ($r['statusaktif'] == "Y") { 
                            echo "<td align=center ><input type=button class='btn btn-success btn-xs'  value='Aktif' onclick=\"window.location.href='$aksi?module=users&act=nonaktif&id=$r[id_user]';\"></td>";
                          } else {
                            echo "<td  align=center ><input class='btn btn-default btn-xs' type=button value='Non Aktif' onclick=\"window.location.href='$aksi?module=users&act=aktif&id=$r[id_user]';\"></td>";
                          }
 ?> 

  <td>  <input type="checkbox" name='id[]' class='check-item'  value="<?php echo $r["id_user"]; ?>" /></td>

<!--  class : delete data untuk mengkoneksikan dengan sweet alert href mengirimkan link dan data id (PENTING !!! BIAR KONEK DENGAN SWEET ALERT HARUS <TD> </TD> DALAM BENTUK HTML MAKA PENULISANNYA JUGA BEDA DENGAN YG DI PHP perhatikan petik nya dll ) ) -->

             <td  align=center ><a class="btn btn-danger btn-xs delete-data" href="modul/mod_users/aksi_users.php?module=users&act=hapus&id=<?=$r['id_user']?>">Hapus</a></td>


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
<!--  LETAKNYA HARUS DIATAS </form/> kl ndak bakalan error!!!  input display : none tdk akan ditampilkan fungsinya untuk menjalankan submit(isset) otomatis atau jika tombol <button> dijalankan swal sweet alert -->
<input type="submit"  name="submit"  style="display: none;">
</form>
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



<script>
//  scrip ini buat aktifkan fungsi cek box........
// Ketika halaman sudah siap (sudah selesai di load) .... https://www.mynotescode.com/multiple-delete-php-mysql/
 $(document).ready(function(){ 
// Ketika user men-cek checkbox all      
 $("#check-all").click(function(){ 
// Jika checkbox all diceklis
 if($(this).is(":checked"))
// ceklis semua checkbox masing-masing siswa dengan class "check-item"
 $(".check-item").prop("checked", true);
 else // Jika checkbox all tidak diceklis
 $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"  
   });

 $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete yang ber id="btn-delete"
      });  });  
//  akhir fungsi aktifkan fungsi cekbox ......



$('.hapus_all').on('click', function(e){
  e.preventDefault();
 
swal({

  title: 'Yakin hapus data yg diseleksi ?',
  text: 'Data yang dihapus tidak bisa dikembalikan',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
  }).then((result) => {
    if (result) {

/* script untuk menjalankan submit otomatis */
document.form1.submit.click();

    }
  })
});

  </script>

  </body>
  </html>
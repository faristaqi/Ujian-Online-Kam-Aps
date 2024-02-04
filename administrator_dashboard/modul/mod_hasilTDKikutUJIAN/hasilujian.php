<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hasil ujian</title>
    <script src="../js/sweetalert.min.js"></script>
  </head>
 <body> 
<!-- buat sweet alert di taruh data info SWAL  untuk membuat session di halaman ini hasil dari aksi_hasilujian.php untuk menjalankan sweetalert. krn kalau waktu dibuka pertama kali sesion kosong sweetalert tidak bekerja-->
        <div id="page-wrapper" class="ruki1" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>">
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
                    $aksi = "modul/mod_hasilTDKikutUJIAN/aksi_hasilujian.php";
                    switch ($_GET['act']) {
                        // Tampil User
                      default:
                        $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE telah_ujian='' ORDER BY nama ASC");

 // Tombol cetak data
                          echo "<div style='text-align:left;padding-left:2px;'>
          <input class='btn btn-secondary' type=button value='Cetak Data' 
          onclick=\"window.location.href='modul/mod_hasilTDKikutUJIAN/cetak.php';\">";
 //Form Pencarian Data
                          echo "<div style='text-align:left;padding-right:40px;max-width:360px;'>
         <form method='POST' action=?module=mod_hasilTDKikutUJIAN&act=cariuser>
     <input type=text name='cari'  placeholder='Masukkan nama peserta' list='auto' size=26 required/> <input type=submit class='btn btn-info' value='Cari'>";
                          echo "<datalist id='auto'>";
                          $qry = mysqli_query($mysqli, "SELECT * FROM tbl_user");
                          while ($t = mysqli_fetch_array($qry)) {
                            echo "<option value='$t[nama]'>";
                          }
                          echo "</datalist></form>
      </div>";



                        
 ?>  
          <h4> Daftar Peserta Tidak Ikut Ujian</h4>
<div style='overflow-x:auto;'>


  <!-- form untuk mengirim data delete yang terseleksi -->
<form  method="POST" name="form1" action="modul/mod_hasilTDKikutUJIAN/delete_all.php" >

                        
    <table class='table table-striped table-bordered table-hover'>
          <tr><th style='text-align: center'>No</th><th style='text-align: center'>User name</th><th style='text-align: center'>Nama</th><th style='text-align: center'>Password</th><th style='text-align: center'>Jenis Kelamin</th><th style='text-align: center'>Edit</th><th style='text-align: center'>Lihat</th><th style='text-align: center'>Status</th><th width="10"><input type="checkbox" id="check-all"></th><th width="100" style="text-align: center"> <button id="btn-delete" class="btn btn-danger mb-4 mt-4 hapus_all" >Delete Selected</button></th></tr>
<?php          
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
 ?>                           
            <tr><td><?php echo $no ; ?></td>
            <td><?php echo $r['username'] ; ?></td>
            <td><?php echo $r['nama'] ; ?></td>
            <td><?php echo $r['password'] ; ?></td>
            <td><?php echo $r['jk'] ; ?></td>

<?php 
echo " 

  <td align=center ><a class='fa fa-pencil-square-o' style='font-size:20px;' onclick=\"window.location.href='modul/mod_hasilTDKikutUJIAN/profileuser.php?module=mod_hasilTDKikutUJIAN&id=$r[id_user]';\"></a></td>
  
  <td align=center><a class='fa fa-eye' style='font-size:20px;'  href='?module=users&act=lihat&id=$r[id_user]'></a></td>
";        


                           if ($r['statusaktif'] == "Y") { 
                            echo "<td align=center><input type=button class='btn btn-success btn-xs'  value='Aktif' onclick=\"window.location.href='$aksi?module=mod_hasilTDKikutUJIAN&act=nonaktif&id=$r[id_user]';\"></td>";
                          } else {
                            echo "<td align='center'><input class='btn btn-default btn-xs' type=button value='Non Aktif' onclick=\"window.location.href='$aksi?module=mod_hasilTDKikutUJIAN&act=aktif&id=$r[id_user]';\"></td>";
                          }

 ?> 

 <td>  <input type="checkbox" name='id[]' class='check-item'  value="<?php echo $r["id_user"]; ?>" /></td>
 <!--  class : delete data untuk mengkoneksikan dengan sweet alert href mengirimkan link dan data id (PENTING !!! BIAR KONEK DENGAN SWEET ALERT HARUS <TD> </TD> DALAM BENTUK HTML MAKA PENULISANNYA JUGA BEDA DENGAN YG DI PHP perhatikan petik nya dll ) ) -->        
             <td align=center><a class='btn btn-danger btn-xs delete-data' href="modul/mod_hasilTDKikutUJIAN/aksi_hasilujian.php?module=mod_hasilTDKikutUJIAN&act=hapus&id=<?=$r['id_user']?>">Hapus</a></td>

 <?php   

                          echo "</tr>";
                          $no++;
                        }
                        echo "</table><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                        break;

                      case "lihat":
                        $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]'");
                        $t = mysqli_fetch_array($tampil);
                        echo "
  <table width='60%'>
    <tr><th colspan=2 align='center'>DETAIL PESERTA</th></tr>
    <tr><td>User name</td><td>$t[username]</td></tr>
    <tr><td>Password Enkripsi</td><td>$t[password]</td></tr>
    <tr><td>Nama</td><td>$t[nama]</td></tr>
    <tr><td>Tgl Lahir </td><td>$t[tgl_lahir]</td></tr>
    <tr><td>Jenis Kelamin </td><td>$t[jk]</td> </tr>
    <tr><td>Agama</td><td>$t[agama]</td></tr>
    <tr><td>Kewarganegaraan</td><td>$t[kwgn]</td></tr>
    <tr><td>Nama Ayah </td><td>$t[nama_ayah]</td></tr>
    <tr><td>Nama Ibu </td><td>$t[nama_ibu]</td></tr>
    <tr><td>Pekerjaan Ayah</td><td>$t[pekerjaan_ayah]</td></tr>
    <tr><td>Pekerjaan Ibu </td><td>$t[pekerjaan_ibu]</td></tr>
    <tr><td>Sekolah Asal </td><td>$t[sekolah_asal]</td></tr>
    <tr> <td>Telp</td><td>$t[telp]</td></tr>
    <tr><td>Alamat</td><td>$t[alamat]</td></tr>
  </table>";
                        break;





//halaman menampilkan pencarian....


                        case "cariuser":
 ?>  


<div style='overflow-x:auto;'>
 <h4 style="color: #9400D3; "> <strong>Hasil Pencarian Yang ditemukan </strong></h4>
 

   <!-- form untuk mengirim data delete yang terseleksi -->
<form  method="POST" name="form1" action="modul/mod_hasilTDKikutUJIAN/delete_all.php" >
  
    <table class='table table-striped table-bordered table-hover'>
          <tr><th style='text-align: center'>No</th><th style='text-align: center'>User name</th><th style='text-align: center'>Nama</th><th style='text-align: center'>Password</th><th style='text-align: center'>Jenis Kelamin</th><th style='text-align: center'>Edit</th><th style='text-align: center'>Lihat</th><th style='text-align: center'>Status</th><th width="10"><input type="checkbox" id="check-all"></th><th width="100" style="text-align: center"> <button id="btn-delete" class="btn btn-danger mb-4 mt-4 hapus_all" >Delete Selected</button></th></tr>
<?php
                          $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE  nama LIKE '%$_POST[cari]%' and  telah_ujian='' ORDER BY nama ASC");
                       $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
 ?>                           
            <tr><td><?php echo $no ; ?></td>
            <td><?php echo $r['username'] ; ?></td>
            <td><?php echo $r['nama'] ; ?></td>
            <td><?php echo $r['password'] ; ?></td>
              <td><?php echo $r['jk'] ; ?></td>

<?php 
echo " 

  <td align=center ><a class='fa fa-pencil-square-o' style='font-size:20px;' onclick=\"window.location.href='modul/mod_hasilTDKikutUJIAN/profileuser.php?module=mod_hasilTDKikutUJIAN&id=$r[id_user]';\"></a></td>
  
  <td align=center><a class='fa fa-eye' style='font-size:20px;'  href='?module=users&act=lihat&id=$r[id_user]'></a></td>
";        


                           if ($r['statusaktif'] == "Y") { 
                            echo "<td align=center><input type=button class='btn btn-success btn-xs'  value='Aktif' onclick=\"window.location.href='$aksi?module=mod_hasilTDKikutUJIAN&act=nonaktif&id=$r[id_user]';\"></td>";
                          } else {
                            echo "<td align='center'><input class='btn btn-default btn-xs' type=button value='Non Aktif' onclick=\"window.location.href='$aksi?module=mod_hasilTDKikutUJIAN&act=aktif&id=$r[id_user]';\"></td>";
                          }

 ?> 

 <td>  <input type="checkbox" name='id[]' class='check-item'  value="<?php echo $r["id_user"]; ?>" /></td>
 <!--  class : delete data untuk mengkoneksikan dengan sweet alert href mengirimkan link dan data id (PENTING !!! BIAR KONEK DENGAN SWEET ALERT HARUS <TD> </TD> DALAM BENTUK HTML MAKA PENULISANNYA JUGA BEDA DENGAN YG DI PHP perhatikan petik nya dll ) ) -->        
             <td align=center><a class='btn btn-danger btn-xs delete-data' href="modul/mod_hasilTDKikutUJIAN/aksi_hasilujian.php?module=mod_hasilTDKikutUJIAN&act=hapus&id=<?=$r['id_user']?>">Hapus</a></td>

 <?php   

                          echo "</tr>";
                          $no++;
                        }
                        echo "</table><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                        break;

                      case "lihat":
                        $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]'");
                        $t = mysqli_fetch_array($tampil);
                        echo "
  <table width='60%'>
    <tr><th colspan=2 align='center'>DETAIL PESERTA</th></tr>
    <tr><td>User name</td><td>$t[username]</td></tr>
    <tr><td>Password Enkripsi</td><td>$t[password]</td></tr>
    <tr><td>Nama</td><td>$t[nama]</td></tr>
    <tr><td>Tgl Lahir </td><td>$t[tgl_lahir]</td></tr>
    <tr><td>Jenis Kelamin </td><td>$t[jk]</td> </tr>
    <tr><td>Agama</td><td>$t[agama]</td></tr>
    <tr><td>Kewarganegaraan</td><td>$t[kwgn]</td></tr>
    <tr><td>Nama Ayah </td><td>$t[nama_ayah]</td></tr>
    <tr><td>Nama Ibu </td><td>$t[nama_ibu]</td></tr>
    <tr><td>Pekerjaan Ayah</td><td>$t[pekerjaan_ayah]</td></tr>
    <tr><td>Pekerjaan Ibu </td><td>$t[pekerjaan_ibu]</td></tr>
    <tr><td>Sekolah Asal </td><td>$t[sekolah_asal]</td></tr>
    <tr> <td>Telp</td><td>$t[telp]</td></tr>
    <tr><td>Alamat</td><td>$t[alamat]</td></tr>
  </table>";
                        break;


         }
                    ?>

<!--  LETAKNYA HARUS DIATAS </form/> kl ndak bakalan error!!!  input display : none tdk akan ditampilkan fungsinya untuk menjalankan submit(isset) otomatis atau jika tombol <button> dijalankan swal sweet alert -->
<input type="submit"  name="submit"  style="display: none;">
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
        <!-- /#page-wrapper -->

 <script>
/* bila ada session yg di simpan di <div> maka scrip dibawah jalan */
const notifikasi = $('.ruki1').data('infodata');
if(notifikasi == "Disimpan" || notifikasi=="Dihapus"){

                      swal('Data berhasil dihapus', {
                      icon: 'success',
                                                       });
                      setTimeout(function() {     
                      window.location='../../ujianonline/admin/media.php?module=mod_hasilTDKikutUJIAN';
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

  title: 'Yakin hapus data ini ?',
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
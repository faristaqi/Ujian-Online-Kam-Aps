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
        <div id="page-wrapper" class="ruki" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>">
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
                    Hasil Ujian
                  </div>
                  <div class="panel-body">
<?php
                    $aksi = "modul/mod_hasilujian/aksi_hasilujian.php";
                    switch ($_GET['act']) {
                        // Tampil Hasil Ujian Users
                      default:
// selesksi seluruh data dan gabungkan dari tabel tbl_nilai dgn tbl_user (yang gabungan tsb tampilkan berdasar id_user yang ada di tabel tbl_user) {dan dgn syarat tbl_nilai = keterangan[lulus]} kemudian tampilkan berdasar nilai tertinggi (ASC)

                        $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_nilai,tbl_user WHERE tbl_nilai.id_user=tbl_user.id_user and tbl_nilai.keterangan='Lulus' ORDER BY tbl_nilai.benar DESC");


// Tombol cetak data
                          echo "<div style='text-align:left;padding-left:2px;'>
          <input class='btn btn-secondary' type=button value='Cetak Data' 
          onclick=\"window.location.href='modul/mod_hasilLULUS/cetak.php';\">";

 //Form Pencarian Data
                          echo "<div style='text-align:left;padding-right:40px;max-width:360px;'>
         <form method='POST' action=?module=mod_hasilLULUS&act=cariuser>
     <input type=text name='cari'  placeholder='Masukkan nama peserta' list='auto' size=26 required/> <input type=submit class='btn btn-info' value='Cari'>";
                          echo "<datalist id='auto'>";
                          $qry = mysqli_query($mysqli, "SELECT * FROM tbl_user");
                          while ($t = mysqli_fetch_array($qry)) {
                            echo "<option value='$t[nama]'>";
                          }
                          echo "</datalist></form>
      </div>";


 

?>

                      <h4>Peserta Yang Lulus Berdasarkan Peringkat Score</h4>
<div style='overflow-x:auto;'>
                        
        <table class='table table-striped table-bordered table-hover'>
          <tr><th style="text-align: center">No</th><th style="text-align: center">User name</th><th style="text-align: center">Nama</th><th style="text-align: center">Benar</th><th style="text-align: center">Salah</th><th style="text-align: center">Kosong</th><th style="text-align: center">Nilai</th><th style="text-align: center">Tanggal Lahir</th><th style="text-align: center">Keterangan</th><th style="text-align: center">Aksi</th></tr>
<?php                       
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
                          $tgl = tgl_indo($r['tanggal']);

?>                          

    <tr><td><?php echo $no ; ?></td>
        <td><?php echo $r['username']; ?></td>
        <td><?php echo $r['nama']; ?></td>
        <td><?php echo $r['benar']; ?></td>
        <td><?php echo $r['salah']; ?></td>
        <td><?php echo $r['kosong']; ?></td>
        <td><?php echo $r['score']; ?></td>
        <td><?php echo $tgl; ?></td>
        <td><?php echo $r['keterangan']; ?></td>

 

   <td align ='center'><a href="modul/mod_hasilLULUS/aksi_hasilujian.php?module=mod_hasilLULUS&id=<?=$r['id_nilai']?>&iduser=<?=$r['id_user']?>" class="btn btn-danger btn-xs delete-data">Hapus</a></td>
   </tr>
<?php   
                          $no++;
                        }
                        echo "</table><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                        break;
                    





//halaman menampilkan pencarian....


                        case "cariuser":
 ?>  


<div style='overflow-x:auto;'>
  <h4 style="color: #9400D3; "> <strong>Hasil Pencarian Yang ditemukan </strong></h4>
  
   <table class='table table-striped table-bordered table-hover'>
          <tr ><th style="text-align: center">No</th><th style="text-align: center">User name</th><th style="text-align: center">Nama</th><th style="text-align: center">Benar</th><th style="text-align: center">Salah</th><th  style="text-align: center" >Kosong</th><th style="text-align: center">Nilai</th><th style="text-align: center">Tanggal Lahir</th><th style="text-align: center">Keterangan</th><th style="text-align: center">Aksi</th></tr>
<?php

                          $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_nilai,tbl_user WHERE  nama LIKE '%$_POST[cari]%' and tbl_nilai.id_user=tbl_user.id_user and tbl_nilai.keterangan='Lulus' ORDER BY tbl_nilai.benar DESC");
                          $no = 1;
                          while ($r = mysqli_fetch_array($tampil)) {
                          $tgl = tgl_indo($r['tanggal']); 
 ?>  

  <tr><td><?php echo $no ; ?></td>
        <td><?php echo $r['username']; ?></td>
        <td><?php echo $r['nama']; ?></td>
        <td><?php echo $r['benar']; ?></td>
        <td><?php echo $r['salah']; ?></td>
        <td><?php echo $r['kosong']; ?></td>
        <td><?php echo $r['score']; ?></td>
        <td><?php echo $tgl; ?></td>
        <td><?php echo $r['keterangan']; ?></td>

 

   <td align ='center'><a href="modul/mod_hasilLULUS/aksi_hasilujian.php?module=mod_hasilLULUS&id=<?=$r['id_nilai']?>&iduser=<?=$r['id_user']?>" class="btn btn-danger btn-xs delete-data">Hapus</a></td>
   </tr>
<?php   
                          $no++;
                        }
                        echo "</table><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                        break;                  

         }
                    ?>




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
const notifikasi = $('.ruki').data('infodata');
if(notifikasi == "Disimpan" || notifikasi=="Dihapus"){

                      swal('Data berhasil dipindahkan', {
                      icon: 'success',
                                                       });
                      setTimeout(function() {     
                      window.location='../../ujianonline/admin/media.php?module=mod_hasilLULUS';
                                              }, 1000); 

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
  text: 'Data akan masuk PESERTA TDK IKUT UJIAN',
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
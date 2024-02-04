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
                    Kelola Soal
                  </div>
                  <div style="position:first;
    margin-left: -30px;" class="panel-body">



                    <script language="JavaScript">
                      function bukajendela(url) {
                        window.open(url, "window_baru", "width=800,height=500,left=120,top=10,resizable=1,scrollbars=1");
                      }
                    </script>

<?php
                    session_start();
                    if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
                      echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
                      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
                    } else {
                      $aksi = "modul/mod_soal/aksi_soal.php";
                      switch ($_GET['act']) {
                          // Tampil Soal
                        default:
                          echo "<h3>&nbsp;&nbsp;&nbsp;&nbsp; Soal Ujian</h3>";


// Tombol cetak data 
                          echo "<div class='panel-body' style='text-align:left;padding-left 2px; margin-left:10px;'>
          <input class='btn btn-secondary' type=button value='Cetak Data 1' 
          onclick=\"window.location.href='modul/mod_soal/cetak_soal.php';\">
           
                     <input class='btn btn-secondary' type=button value='Cetak Data 2' 
          onclick=\"window.location.href='modul/mod_soal/cetak_soal_2.php';\">



          ";


                          // Tombol Tambah Soal
                           echo "<div class='panel-body'  style='text-align:left;padding-left:30px; margin-left: -30px;'>
          <input class='btn btn-primary' type=button value='Tambah Soal' 
          onclick=\"window.location.href='?module=soal&act=tambahsoal';\">";
                          //Form Pencarian Data
                          echo "<div style='text-align:left;padding-right:40px;max-width:360px;'>
         <form method='POST' action=?module=soal&act=carisoal>
     <input type=text name='cari'  placeholder='Masukkan Pertanyaan' list='auto' size=26 required/> <input type=submit class='btn btn-info' value='Cari'>";
                          echo "<datalist id='auto'>";
                          $qry = mysqli_query($mysqli, "SELECT * FROM tbl_soal");
                          while ($t = mysqli_fetch_array($qry)) {
                            echo "<option value='$t[soal]'>";
                          }
                          echo "</datalist></form>
      </div>";
 ?>  
  <!-- form untuk mengirim data delete yang terseleksi -->
<form  method="POST" name="form1" action="modul/mod_soal/delete_all.php" >

<?php

                          //Tampil Data Soal    
                          echo "<div style='overflow-x:auto;margin-top:10px;'> <table class='table table-striped table-bordered table-hover'>
          <tr><th style='text-align: center'>No</th><th style='text-align: center'>Pertanyaan</th><th width='100' style='text-align: center'>Edit</th><th  width='100' style='text-align: center'>Lihat</th><th width='100'  style='text-align: center'>status</th><th width='10'><input type='checkbox' id='check-all'></th><th width='100' style='text-align: center'> <button id='btn-delete' class='btn btn-danger mb-4 mt-4 hapus_all' >Delete Selected</button></th></tr>";
                          $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
                          $no = 1;
                          while ($r = mysqli_fetch_array($tampil)) {
                            $soal = substr($r['soal'], 0, 78);

 ?>  

 


        <tr><td><?php echo $no ; ?></td>
       <td><?php echo $soal; ?></td>
       <td align="center"> <a href="?module=soal&act=editsoal&id=<?=$r['id_soal']?>"><i class='fa fa-pencil-square-o'></i></a></td>
<?php

echo "
        <td align=center> <a href='#' onclick=\"bukajendela('zoom.php?id=$r[id_soal]')\"><i class='fa fa-eye'></i></a></td>";


                            if ($r['aktif'] == "Y") {
                              echo "<td align=center><input type=button class='btn btn-success' value='Aktif' onclick=\"window.location.href='$aksi?module=soal&act=nonaktif&id=$r[id_soal]';\"></td>";
                            } else {
                              echo "<td align=center><input class='btn btn-default' type=button value='Non Aktif' onclick=\"window.location.href='$aksi?module=soal&act=aktif&id=$r[id_soal]';\"></td>";
                            }

   ?>  
                         
        <td>  <input type="checkbox" name='id[]' class='check-item'  value="<?php echo $r["id_soal"]; ?>" /></td>
        <td align=center> <a><i class='fa fa-trash delete-data' href="modul/mod_soal/aksi_soal.php?module=soal&act=hapus&id=<?=$r['id_soal']?>"></i></a></td>
    </tr>

  <?php
                            $no++;
                          }
                          echo "</table></div>";
                          break;

                          // Form Tambah Soal
                        case "tambahsoal":
                          echo "<h3> &nbsp Tambah Soal</h3>
          <form method=POST class='form-horizontal'style='margin-left:20px;' action='$aksi?module=soal&act=input' enctype='multipart/form-data'>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Pertanyaan</label>
                          <div class='col-sm-10'>
                            <textarea name='soal' style='width: 290px; height: 100px;'></textarea>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Gambar</label>
                          <div class='col-sm-10'>
                            <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px
                          </div>
                        </div>


                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban A</label>
                          <div class='col-sm-4'>
                            <input type=text name='a' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban B</label>
                          <div class='col-sm-4'>
                            <input type=text name='b' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban C</label>
                          <div class='col-sm-4'>
                            <input type=text name='c' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban D</label>
                          <div class='col-sm-4'>
                            <input type=text name='d' class='form-control' size=80 required/>
                          </div>
                        </div>


                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban E</label>
                          <div class='col-sm-4'>
                            <input type=text name='e' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Kunci Jawaban</label>
                          <div class='col-sm-4'>
                            <select name='knc_jawaban' class='form-control'>
                            <option value='a'>A</option>
                            <option value='b'>B</option>
                            <option value='c'>C</option>
                            <option value='d'>D</option>
                            <option value='e'>E</option>
                            </select>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'></label>
                          <div class='col-sm-4'>
                        <input type=submit name=submit value=Simpan class='btn btn-primary'>
                        <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                        </div>
                        </div>
                  </form>";
                          break;

                          // Form Edit Soal 
                          
                        case "editsoal":
                          $edit = mysqli_query($mysqli, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
                          $r = mysqli_fetch_array($edit);

                          echo "<h3> &nbsp; &nbsp; Edit Soal</h3>
          <form method=POST action=$aksi?module=soal&act=update class='form-horizontal'style='margin-left:20px;'  enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id_soal]'>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Pertanyaan</label>
                          <div class='col-sm-10'>
                            <textarea name='soal' style='width: 290px; height: 100px;'>$r[soal]</textarea>
                          </div>
                        </div>";
                          if ($r['gambar'] != '') {

                            echo "
                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'></label>
                          <div class='col-sm-10'>
                            <img src='../foto/$r[gambar]'>
                          </div>
                        </div>

                        ";
                          }

                          echo "
                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Gambar</label>
                          <div class='col-sm-10'>
                            <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px
                          </div>
                        </div>


                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban A</label>
                          <div class='col-sm-4'>
                            <input type=text name='a' class='form-control' value='$r[a]' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban B</label>
                          <div class='col-sm-4'>
                            <input type=text name='b' value='$r[b]' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban C</label>
                          <div class='col-sm-4'>
                            <input type=text name='c' value='$r[c]' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban D</label>
                          <div class='col-sm-4'>
                            <input type=text name='d' value='$r[d]' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Jawaban E</label>
                          <div class='col-sm-4'>
                            <input type=text name='e' value='$r[e]' class='form-control' size=80 required/>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'>Kunci Jawaban</label>
                          <div class='col-sm-4'>
                            <select name='knc_jawaban' id='knc_jawaban' class='form-control'>
                            <option value='a'>A</option>
                            <option value='b'>B</option>
                            <option value='c'>C</option>
                            <option value='d'>D</option>
                            <option value='e'>E</option>
                            </select>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label for='inputEmail3' class='col-sm-2 control-label'></label>
                          <div class='col-sm-4'>
                        <input type=submit name=submit value=Simpan class='btn btn-primary'>
                        <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                        </div>
                        </div>

        </form>";
                          break;

                        case "viewsoal":
                          $view = mysqli_query($mysqli, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
                          $t = mysqli_fetch_array($view);
                          echo "<h2>Soal :</h2>
    $t[soal]</br>";
                          if ($t['gambar'] != '') {
                            echo "<img src='../foto/$t[gambar]'>";
                          }
                          echo "<h2>Jawaban :</h2>
    a. $t[a] </br>
    b. $t[b] </br>
    c. $t[c] </br>
    d. $t[d] </br>";
                          break;

    




                        case "carisoal":
 ?>  
<div class='panel-body'>

  <h4 style="color: #9400D3; "> <strong>Hasil Pencarian Yang ditemukan </strong></h4>
<div style='overflow-x:auto;margin-top:10px;'> 


  <!-- form untuk mengirim data delete yang terseleksi -->
<form  method="POST" name="form1" action="modul/mod_soal/delete_all.php" >

<?php

echo "

          <table class='table table-striped table-bordered table-hover'>
          <tr><th style='text-align: center'>No</th><th style='text-align: center'>Pertanyaan</th><th width='100' style='text-align: center'>Edit</th><th  width='100' style='text-align: center'>Lihat</th><th width='100'  style='text-align: center'>status</th><th width='10'><input type='checkbox' id='check-all'></th><th width='100' style='text-align: center'> <button id='btn-delete' class='btn btn-danger mb-4 mt-4 hapus_all' >Delete Selected</button></th></tr>";
                          $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_soal WHERE soal LIKE '%$_POST[cari]%'");
                          $no = 1;
                          while ($r = mysqli_fetch_array($tampil)) {

 ?>  

        <tr><td><?php echo $no ; ?></td>
       <td><?php echo $r['soal']; ?></td>
       <td align=center><a href="?module=soal&act=editsoal&id=<?=$r['id_soal']?>"><i class='fa fa-pencil-square-o'></i></a></td>
<?php
echo "
        <td align=center> <a href='#' onclick=\"bukajendela('zoom.php?id=$r[id_soal]')\"><i class='fa fa-eye'></i></a></td>";

                            if ($r['aktif'] == "Y") {
                              echo "<td  align=center><input class='btn btn-success' type=button value='Aktif' onclick=\"window.location.href='$aksi?module=soal&act=nonaktif&id=$r[id_soal]';\"></td>";
                            } else {
                              echo "<td align='center'><input class='btn btn-default' type=button value='Non Aktif' onclick=\"window.location.href='$aksi?module=soal&act=aktif&id=$r[id_soal]';\"></td>";                                                             
                            }
 ?>  

        <td>  <input type="checkbox" name='id[]' class='check-item'  value="<?php echo $r["id_soal"]; ?>" /></td>
        <td align=center><a><i class='fa fa-trash delete-data' href="modul/mod_soal/aksi_soal.php?module=soal&act=hapus&id=<?=$r['id_soal']?>"></i></a></td>

<?php


                 $no++;
                          }
                          echo "</table>";
                          break;
                      }
                    }
                    ?>
  <!--  LETAKNYA HARUS DIATAS </form/> kl ndak bakalan error!!!  input display : none tdk akan ditampilkan fungsinya untuk menjalankan submit(isset) otomatis atau jika tombol <button> dijalankan swal sweet alert -->
<input type="submit"  name="submit"  style="display: none;">
</form>                  

                  </div></div></div>
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


        <script type="text/javascript">
          var $ = jQuery;
          $('#knc_jawaban').val('<?php echo $r['knc_jawaban']; ?>');
        </script>



 <script>
/* bila ada session yg di simpan di <div> maka scrip dibawah jalan */
const notifikasi = $('.rukiyanto').data('infodata');
if(notifikasi == "Disimpan" || notifikasi=="Dihapus"){

                      swal('Data berhasil dihapus', {
                      icon: 'success',
                                                       });
                      setTimeout(function() {     
                      window.location='../../ujianonline/admin/media.php?module=soal';
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
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hasil ujian</title>
    <script src="../js/sweetalert.min.js"></script>
  </head>
 <body> 

<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";


// selesksi seluruh data dan gabungkan dari tabel tbl_nilai dgn tbl_user (yang gabungan tsb tampilkan berdasar id_user yang ada di tabel tbl_user) {dan dgn syarat tbl_nilai = keterangan[lulus]} kemudian tampilkan berdasar nilai tertinggi (ASC)

                        $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE telah_ujian=''  ORDER BY nama ASC");





?>

                      <h4>Daftar Peserta Tidak Ikut Ujian</h4>

                        
         <table border="1" cellpadding="10">
          <tr><th style="text-align: center">No</th><th style="text-align: center">User name / No Pendaftaran</th><th style="text-align: center">Nama</th><th style="text-align: center">Keterangan</th></tr>
<?php                       
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
                          

?>                          

    <tr><td><?php echo $no ; ?></td>
        <td><?php echo $r['username']; ?></td>
        <td><?php echo $r['nama']; ?></td>  
        <td><?php echo 'Tidak Ikut Ujian'; ?></td>

 

<?php   
                          $no++;
                        }
                 
?>

</table >
                  

        
  </body>
  </html>
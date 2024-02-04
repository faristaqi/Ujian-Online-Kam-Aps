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

                       $tampil = mysqli_query($mysqli, "SELECT * FROM tbl_nilai,tbl_user WHERE tbl_nilai.id_user=tbl_user.id_user ORDER BY tbl_nilai.benar DESC");





?>

                      <h4>Hasil Tes Ujian Peserta Berdasar score tertinggi</h4>

                        
         <table border="1" cellpadding="10">
          <tr><th style="text-align: center">No</th><th style="text-align: center">User name / No Pendaftaran</th><th style="text-align: center">Nama</th><th style="text-align: center">Benar</th><th style="text-align: center">Salah</th><th style="text-align: center">Kosong</th><th style="text-align: center">Nilai</th><th style="text-align: center">Keterangan</th></tr>
<?php                       
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
                          

?>                          

    <tr><td><?php echo $no ; ?></td>
        <td><?php echo $r['username']; ?></td>
        <td><?php echo $r['nama']; ?></td>
        <td><?php echo $r['benar']; ?></td>
        <td><?php echo $r['salah']; ?></td>
        <td><?php echo $r['kosong']; ?></td>
        <td><?php echo $r['score']; ?></td>
       
        <td><?php echo $r['keterangan']; ?></td>

 

<?php   
                          $no++;
                        }
                 
?>

</table >
                  

        
  </body>
  </html>
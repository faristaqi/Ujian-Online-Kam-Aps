<?php
ob_start(); 
 include "../../../config/koneksi.php";
?>
<!DOCTYPE HTML>
<html>
  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>soal</title>
  </head>
 <body >
  
  
  				

  <?php
                                        
                        $sql2  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
                        $r2    = mysqli_fetch_array($sql2);
						$profile2 = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
						$rowprofile = mysqli_fetch_array($profile2);                 
                      
                        $result = mysqli_query($mysqli, "select * from tbl_soal WHERE aktif='Y'");
                        $hitung = mysqli_num_rows($result);
                        $qry = mysqli_query($mysqli, "SELECT * FROM tbl_pengaturan_ujian");
                        $r = mysqli_fetch_array($qry);

?>


<center>
<?php

			
//--> atur  panjang dan lebar buat kotak box float/scrol untuk tabel soal
		 
			echo "<table width='1200 px' border='0'>

  <tr>

   <td colspan='4' > 


          <h3 align='center'> <img src='../../../foto/$r2[gambar]' width='80' height='90'>   </h3>
         <h3 align='center'>$rowprofile[profile]</h3>


		<br ><strong>$r[nama_ujian]</strong></br>
		Waktu Pengerjaan &nbsp;  : $r[waktu] menit</br>
		Jumlah Soal &nbsp; &nbsp; &nbsp;<span style='color: white;'>.</span> &nbsp; &nbsp; : $hitung<br>
		<br> <br>

</td></tr>

			";

									
									$hasil = mysqli_query($mysqli, "select * from tbl_soal WHERE aktif='Y' ");
									$jumlah = mysqli_num_rows($hasil);
									$urut = 0;
									while ($row = mysqli_fetch_array($hasil)) {
										$id = $row["id_soal"];
										$pertanyaan = $row["soal"];
										$pilihan_a = $row["a"];
										$pilihan_b = $row["b"];
										$pilihan_c = $row["c"];
										$pilihan_d = $row["d"];
										$pilihan_e = $row["e"];

							?>			
  										<tr>
  											<td width="10" valign="top" >
  												<font color="#000000"><?php echo  $urut = $urut + 1 ;  echo "&nbsp;";?></font>
  											</td>
  											<td width="430">
  												<font color="#000000"><?php echo "$pertanyaan"; ?></font>
  											</td>
  										</tr>
  										<?php
											if (!empty($row["gambar"])) {
												echo "<tr><td></td><td><img src='../../../foto/$row[gambar]' width='200' hight='200'></td></tr>";
											}
											?>
  										<tr>
  											<td height="21">
  												<font color="#000000">&nbsp;</font>
  											</td>
  											<td>
  												<font color="#000000">
  													A. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="A">
  													<?php echo "$pilihan_a"; ?></font>
  											</td>
  										</tr>
  										<tr>
  											<td>
  												<font color="#000000">&nbsp;</font>
  											</td>
  											<td>
  												<font color="#000000">
  													B. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="B">
  													<?php echo "$pilihan_b"; ?></font>
  											</td>
  										</tr>
  										<tr>
  											<td>
  												<font color="#000000">&nbsp;</font>
  											</td>
  											<td>
  												<font color="#000000">
  													C. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="C">
  													<?php echo "$pilihan_c"; ?></font>
  											</td>
  										</tr>
  										<tr>
  											<td>
  												<font color="#000000">&nbsp;</font>
  											</td>
  											<td>
  												<font color="#000000">
  													D. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="D">
  													<?php echo "$pilihan_d"; ?></font>
  											</td>
  										</tr>
  										<tr>
  											<td>
  												<font color="#000000">&nbsp;</font>
  											</td>
  											<td>
  												<font color="#000000">
  													E. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="E">
  													<?php echo "$pilihan_e"; ?></font>
  											</td>
  										</tr>

  									<?php
									}
										?>
  									<tr>
  										<td>&nbsp;</td>
  									</tr>
  									</table> </center>
  									
 									</p>

	<!--  ubah ukuran bundaran radio button untuk beberapa Browser-->
  			<style >
  				input[type="radio"] {
    -ms-transform: scale(0.6); /* Untu IE  */
    -webkit-transform: scale(0.6); /* untuk Chrome, Mozilla,Safari, Opera */
    transform: scale(0.6);
}

  			</style >		

  </body>
  </html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>soal2</title>
<meta name="generator" content="WYSIWYG Web Builder 18 - https://www.wysiwygwebbuilder.com">
<link href="Untitled1.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">
</head>
<body>

	<?php
ob_start(); 
 include "../../../config/koneksi.php";

                         $sql2  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
                        $r2    = mysqli_fetch_array($sql2);
						$profile = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
						$rowprofile = mysqli_fetch_array($profile); 

   echo "    
         <center> <table>
           <tr><td width='900'  align='center'>&nbsp;</td></tr>    
          <tr><td width='900'  align='center'><img src='../../../foto/$r2[gambar]' width='80' height='90'><br>
          <h4>$rowprofile[profile]</h4>
          </td></tr>     
 
         </table> </center>";


                      
                        $result = mysqli_query($mysqli, "select * from tbl_soal WHERE aktif='Y'");
                        $hitung = mysqli_num_rows($result);
                        $qry = mysqli_query($mysqli, "SELECT * FROM tbl_pengaturan_ujian");
                        $r = mysqli_fetch_array($qry);


  echo "
   <br><br><br>
 <center> 
 	<form  name='form1' method='post' action='?hal=jawaban'>
<table style='left:2px;top:354px;width:927px;height:277px;z-index:0;' id='Table2'> 

  <tr>

   <td colspan='4' > 

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
										$urut = $urut + 1;

echo "
   
<tr>
<td class='cell0'>$urut</td>
<td colspan='6' class='cell1'>$pertanyaan</td>
</tr>";
						



											if (!empty($row["gambar"])) {
												echo "
												<td colspan='6' class='cell1'>&nbsp;</td></tr>
												<tr><td ><td ><td ><td colspan='2' > <div id='wb_Image1' style='display:inline-block;width:80%;height:auto;z-index:0;'>
												<img src='../../../foto/$row[gambar]' align='left'  id='Image1' alt='' width='100' height='100'>

                                                    </div>

											</td></td></td></td></tr>";
											}

echo "

<tr>
<td class='cell7'><br></td>
<td colspan='6' class='cell8'><p>&nbsp;</p></td>
</tr>

<tr>
<td class='cell9'><br></td>
<td class='cell10'><p> A.&nbsp; &nbsp; </p></td>
<td class='cell11'><input name='pilihan[<?php echo $id; ?>]' type='radio' value='A'</td>
<td colspan='4' class='cell12'>$pilihan_a</td>
</tr>

<tr>
<td class='cell9'><br></td>
<td class='cell10'><p> B.&nbsp; &nbsp; </p></td>
<td class='cell11'><input name='pilihan[<?php echo $id; ?>]' type='radio' value='B'</td>
<td colspan='4' class='cell12'>$pilihan_b</td>
</tr>

<tr>
<td class='cell9'><br></td>
<td class='cell10'><p> C.&nbsp; &nbsp; </p></td>
<td class='cell11'><input name='pilihan[<?php echo $id; ?>]' type='radio' value='C'</td>
<td colspan='4' class='cell12'>$pilihan_c</td>
</tr>

<tr>
<td class='cell9'><br></td>
<td class='cell10'><p> D.&nbsp; &nbsp; </p></td>
<td class='cell11'><input name='pilihan[<?php echo $id; ?>]' type='radio' value='D'</td>
<td colspan='4' class='cell12'>$pilihan_d</td>
</tr>

<tr>
<td class='cell9'><br></td>
<td class='cell10'><p> E. &nbsp; &nbsp;</p></td>
<td class='cell11'><input name='pilihan[<?php echo $id; ?>]' type='radio' value='E'</td>
<td colspan='4' class='cell12'>$pilihan_e</td>";

}
 echo "
</tr>
</table> </from>
</center>";


?>

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
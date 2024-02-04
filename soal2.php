<?php
ob_start();
session_start();
include "config/koneksi.php"; 
?>
<!DOCTYPE HTML>
<html>
  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>soal</title>
<link rel="shortcut icon" href="images/favicon.gif" type="image/gif" >
  <script src="js/sweetalert.min.js"></script>
  </head>
 <body  id="class_online">
  
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-lg-12">
  				<!--   <h3 class="page-header"> Peraturan </h3> -->

  			</div>

  		</div>

  		<div class="row">
  			<div class="col-lg-12">
  				<div class="panel panel-primary">

             <ul class="nav navbar-top-links navbar-right" style="position: fixed; right: 1%;">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" onclick="ruki3()">
                      <h6> Koneksi :&nbsp; <i class="fa fa-rss"> <span></span> </i> </h6>     
                        <i class="fa fa-meh-o">&nbsp;<?php echo $_SESSION['username'] ?>  &nbsp;&nbsp;</i> 

                        <i class="fa fa-external-link"></i> Logout</a>
<?php 

			echo ' <div style="background-color: #F0FFF0;margin-top: -15px; margin-left:1%;margin-right:1%; ">
			<center>  <h6  > Waktu Ujian Online</h6>
			<h6 ><span style="align:center;color: red;font-size:18px"><span id="menit"></span>:<span id="detik"></span></span> </h6> </center>	
             </div>';
			
 ?>



                        
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links --> 					

  <?php
  	
                                        
                        $sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
                        $r    = mysqli_fetch_array($sql);
						$profile = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
						$rowprofile = mysqli_fetch_array($profile);                 


   echo " 
         <center> <table>
           <tr><td width='900'  align='center'>&nbsp;</td></tr>    
          <tr><td width='900'  align='center'><img src='foto/$r[gambar]' width='80' height='90'></td></tr>     
         <tr><td width='900'  align='center'><h4>$rowprofile[profile]</h4></td></tr>
         </table> </center>";

?>

  					<div class="panel-heading"  style="margin-top: -1px;margin-top: -4px;">
  						<table>
  						 <tr><td valign='top'><button style="background: transparent; height: 4;width: 100; border: 1px;" onclick="openFullscreen()" style="color: white;"  >Full Screen</button> </td><td>&nbsp;</td>
  						 	<td valign='top'> <button style="background: transparent; height: 4;width: 150;border: 1px;" onclick="closeFullscreen()" style="color: white;"  > Normal</button> </td></tr>	


  						</table>

  					</div>
  					<div class="panel-body" id="idhide">

  						<?php
							if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
								echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
								echo "<a href=index.php><b>LOGIN</b></a></center>";
							} else {
								//Lakukan Pengecekan Apakah Sudah Pernah Mengerjakan Soal atau belum
								$cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT id_user FROM tbl_nilai WHERE id_user='$_SESSION[id_user]'"));
								if ($cek > 0) {
									$tampil = mysqli_query($mysqli, "SELECT * FROM tbl_nilai WHERE id_user='$_SESSION[id_user]'");
									$t = mysqli_fetch_array($tampil);
									$username =  ucwords($_SESSION['username']);;

									echo "<h4 style='border:0';>user name <u>$username</u>, Anda Telah Mengerjakan Ujian Online</h4>";
									echo "<br><div align='center'>
		 <table><tr><th colspan=3><h2><u>Hasil Tes Anda</u></h2></th></tr>
		 <tr><td valign='top'><h4>Jawaban Benar &nbsp;&nbsp;&nbsp;</h4></td><td valign='top'><h4> : $t[benar]</h4></td>";
									$qry = mysqli_query($mysqli, "SELECT nilai_min FROM tbl_pengaturan_ujian");
									$hasil = mysqli_fetch_array($qry);
									$cek = $hasil['nilai_min'];
									if ($t['score'] >= $cek) {
										echo "<td rowspan='4'><h1 style='color: green;'>&nbsp;&nbsp;&nbsp;&nbsp;<u>Lulus</u></h1></td></tr>";
									} else {
										echo "<td rowspan='4'><h1 style='color: red;'>&nbsp;&nbsp;&nbsp;&nbsp;<u>Gagal</u></h1></td></tr>";
									}
									echo"
		 <tr><td valign='top'><h4>Jawaban Salah</h4></td><td valign='top'><h4> : $t[salah]</h4></td></tr>
		 <tr><td valign='top'><h4>Jawaban Kosong&nbsp;</h4></td><td valign='top'><h4>: $t[kosong]</h4></td></tr>
		 <tr><td valign='top'><h4>Nilai anda   </h4>         </td><td valign='top'><h2 style='color: blue;'> $t[score]</h2></td></tr></table></div>";
								} else {



	
			echo '<table width="100%" border="0">';

									
									$hasil = mysqli_query($mysqli, "select * from tbl_soal WHERE aktif='Y' ORDER BY RAND ()");
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
						
					<form  name="form1" method="post" action="?hal=jawaban">
  										<input type="hidden" name="id[]" value=<?php echo $id; ?>>          <!-- mengirim tampa kelihatan ke script jawaban.php-->
  										<input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>     <!-- mengirim tanpa kelihatan ke script jawaban.php-->
  										<tr>
  											<td width="10" valign="top">
  												<font color="#000000"><?php echo  $urut = $urut + 1 ;  echo "&nbsp;";?></font>
  											</td>
  											<td width="430">
  												<font color="#000000"><?php echo "$pertanyaan"; ?></font>
  											</td>
  										</tr>
  										<?php
											if (!empty($row["gambar"])) {
												echo "<tr><td></td><td><img src='foto/$row[gambar]' width='200' hight='200'></td></tr>";
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
  									</table>
  									<!--  input display : none tdk akan ditampilkan fungsinya untuk menjalankan submit(isset) otomatis atau jika tombol <button> dijalankan swal sweet alert -->
  									<input type="submit"  name="submit"  style="display: none;">
  									</form>
  									</p>
  			
<!--  untuk memunculkan popup sweet alert krn di framework codeeiniter maka harus baris bawah sendiri agar tidak kena class dari framework supaya popup jalan 
  <script src="js/sweetalert.min.js"></script>  tak taruh diatas sebagai library-->
<center>
<button style="background-color: #FFA500; margin-top: 5%; padding: 20px;" onclick="ruki()">&nbsp; Jawab | Selesai &nbsp;</button>
</center>
 <script type="text/javascript">

        function ruki(){ swal({

  title: 'Yakin untuk mengakhiri ujian ini ?',
  text: 'Perhatikan score anda setelah mengakhiri ujian ini',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((akhiri) => {
  if (akhiri) {
/* script untuk menjalankan submit otomatis */
document.form1.submit.click();

    swal('Selamat anda telah mengakhiri ujian online', {
      icon: 'success',
    });
  } else {
    swal('Silahkan kerjakan kembali ujian online anda');
  }
            });
        }
</script>

  					<?php
									$qrywaktu = mysqli_query($mysqli, "SELECT * FROM tbl_pengaturan_ujian");
									$wkt = mysqli_fetch_array($qrywaktu);
	  						    	$rwaktu= $wkt["waktu"]; 			

		             ?>
  					<script>

  						// mengnampilkan waktu mundur
  						var detik = 5;
  						var menit = <?php echo $rwaktu ?>;
  						//document.counter.d2.value='30' 

  						function display() {
  							if (menit == 0 && detik == 0) {

         swal({

  title: 'Waktu ujian online Anda telah berakhir !',
  text: 'Akhiri ujian ini, dan perhatikan nilai Anda',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((akhiri) => {
  if (akhiri) {
/* script untuk menjalankan submit otomatis */
document.form1.submit.click();

    swal('Selamat anda telah mengakhiri ujian online', {
      icon: 'success',
    });
  } else {
    swal('Maaf tidak bisa di cancel');
  }
            });
        

/* script  jika mau hide css di clasnya menggunakan id ( kalau di style="display:none;")*/
 var x = document.getElementById("idhide");
   x.style.display = "none";


} 		
  							if (detik <= 0) {
  								detik = 60;
  								menit -= 1;
  							}
  							if (menit <= -1) {
  								detik = 0;
  								menit += 1;
  							} else
  								detik -= 1

  							detik = "" + detik
  							menit = "" + menit
  							var pad = "00"
  							document.getElementById("menit").innerHTML = pad.substring(0, pad.length - menit.length) + menit;
  							document.getElementById("detik").innerHTML = pad.substring(0, pad.length - detik.length) + detik;
  							//document.counter.d2.value=menit;
  							//document.counter.d3.value=detik;
  							setTimeout("display()", 1000)
  						}
  						display()
  						-->
  					</script><?php }
							} ?>
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
  <!-- halaman popup di aktifkan saat waktu habis karena menggunakan display .../ hidden
<style>
.hide{display:none;visibility:hidden;}
.popbox{position:fixed;top:0;left:0;bottom:0;width:100%;z-index:1000000;}
.pop-content{width:850px;height:450px;display:block;position:absolute;top:50%;left:50%;margin:-225px 0 0 -425px;z-index:2;box-shadow:0 3px 20px 0 rgba(0,0,0,.5);}
.popcontent{width:100%;height:100%;display:block;background:#fff;border-radius:5px;overflow:hidden}
.pop-overlay{position:absolute;top:0;left:0;bottom:0;width:100%;z-index:1;background:rgba(0,0,0,.7)}
.popbox-close-button{position:absolute;width:28px;height:28px;line-height:28px;text-align:center;top:-14px;right:-14px;background-color:#fff;box-shadow:0 -1px 1px 0 rgba(0,0,0,.2);border:none;border-radius:50%;cursor:pointer;font-size:34px;font-weight:lighter;padding:0}
.popcontent img{width:100%;height:100%;display:block}
.flowbox{position:relative;overflow:hidden}
@media screen and (max-width:840px){.pop-content{width:90%;height:auto;top:20%;margin:0 0 0 -45%}
.popcontent img{height:auto}
}
</style> -->


   <!-- halaman popup  yang tampil

<div class="popbox hide" id="popbox">
<div aria-label='Close' class="pop-overlay" onclick='document.form1.submit.click();' role="button" tabindex="0"/>
<div class="pop-content">
<a href="#" target="_blank" rel="noopener noreferrer" title="box">
<div class="popcontent">

<button  style="background-color: #FFA500;margin-left: 40%; margin-top: 15%; padding: 20px;" type="submit" name="submit"   onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"> &nbsp; Jawab | Selesai &nbsp</button>

</div>
</a>
<button aria-label='Close' class='popbox-close-button' onclick='document.getElementById("popbox").style.display="none";removeClassonBody();'>&times;</button>
</div>
</div> -->

<script>
/* Get the documentElement (<html>) to display the page in fullscreen */
var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}
</script>

	<!--  ubah ukuran bundaran radio button untuk beberapa Browser-->
  			<style >
  				input[type="radio"] {
    -ms-transform: scale(0.8); /* Untu IE  */
    -webkit-transform: scale(0.8); /* untuk Chrome, Mozilla,Safari, Opera */
    transform: scale(0.8);
}

  			</style >	










  			<script type="text/javascript">

        function ruki3(){ swal({
  

  title: 'Yakin untuk LOGOUT ?',
  text: '',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((akhiri) => {
  if (akhiri) {
window.location.href = "logout.php" ;

  }
            });
        }
</script>


<!-- script membuat class online kl konek internet warna hijau/offline warna merah -->

<script> 
const status = window.navigator.onLine;
if(status) online(

    )
else offline()
window.addEventListener('online', online);
window.addEventListener('offline', offline);
function online(){

<?php

//  setiap klik menu di dasboard atau klik jawab /ok/canscel mengisi data  tanggal hari ini buat (online)

  date_default_timezone_set('Asia/Jakarta');
$tanggalHariIni = date("Y-m-d H:i:s");
  mysqli_query($mysqli,"UPDATE tbl_user set waktu_online ='$tanggalHariIni' where id_user='" . $_SESSION['id_user'] . "'");
  mysqli_query($mysqli,"UPDATE tbl_user set online ='1' where id_user='" . $_SESSION['id_user'] . "'");


?>



    document.getElementById('class_online').style.backgroundColor = '#F8F8F8';
    document.querySelector('span').textContent = 'on';
}
function offline(){


    document.getElementById('class_online').style.backgroundColor = '#FFC0CB';
    document.querySelector('span').textContent = 'Off';
}


</script>
<script src="anti-copas.js"></script>


  </body>
  </html>
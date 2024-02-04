        <div id="page-wrapper">
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
        						Hasil Ujian Online
        					</div>
        					<div class="panel-body">
  <?php
                         include "config/koneksi.php";
 session_start();                       
include "config/library.php"; 
// buat login online untuk membuat offline dulu jika data terlanjur tersimpan
 mysqli_query($mysqli,"UPDATE tbl_user set online ='0' where id_user='" . $_SESSION['id_user'] . "'");
 						                                           
            $sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
            $r    = mysqli_fetch_array($sql);
						$profile = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
						$rowprofile = mysqli_fetch_array($profile);                 


   echo "    
         <center> <table style='background-color: #DCDCDC;'>
           <tr><td width='900'  align='center'>&nbsp;</td></tr>    
          <tr><td width='900'  align='center'><img src='foto/$r[gambar]' width='80' height='90'></td></tr>     
         <tr><td width='900'  align='center'><h4>$rowprofile[profile]</h4></td></tr>
         </table> </center>";

								if (isset($_POST['submit'])) {
									$pilihan = $_POST["pilihan"];
									$id_soal = $_POST["id"];
									$jumlah = $_POST['jumlah'];

									$score = 0;
									$benar = 0;
									$salah = 0;
									$kosong = 0;

									for ($i = 0; $i < $jumlah; $i++) {
										//id nomor soal
										$nomor = $id_soal[$i];

										//jika user tidak memilih jawaban
										if (empty($pilihan[$nomor])) {
											$kosong++;
										} else {
											//jawaban dari user
											$jawaban = $pilihan[$nomor];

											//cocokan jawaban user dengan jawaban di database
											$query = mysqli_query($mysqli, "select * from tbl_soal where id_soal='$nomor' and knc_jawaban='$jawaban'");

											$cek = mysqli_num_rows($query);

											if ($cek) {
												//jika jawaban cocok (benar)
												$benar++;
											} else {
												//jika salah
												$salah++;
											}
										}
										/*RUMUS
				Jika anda ingin mendapatkan Nilai 100, berapapun jumlah soal yang ditampilkan 
				hasil= 100 / jumlah soal * jawaban yang benar
				*/

										$result = mysqli_query($mysqli, "select * from tbl_soal WHERE aktif='Y'");
										$jumlah_soal = mysqli_num_rows($result);
										$score = 100 / $jumlah_soal * $benar;
										$hasil = number_format($score, 1);
									}
								}
								//Lakukan Pengecekan  Data  dalam Database
								$cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT id_user FROM tbl_nilai WHERE id_user='$_SESSION[id_user]'"));
								if ($cek < 1) {
									//Pemberian kondisi lulus/ tidak lulus
									$qry2 = mysqli_query($mysqli, "SELECT nilai_min FROM tbl_pengaturan_ujian");
									$q2 = mysqli_fetch_array($qry2);
									$ceknilai = $q2['nilai_min'];

// untuk cek yangtidak ikut ujian
mysqli_query($mysqli, "UPDATE tbl_user SET telah_ujian  = '1'  WHERE id_user='$_SESSION[id_user]'");

									if ($hasil >= $ceknilai) {
										//Lakukan Penyimpanan Kedalam Database
										$iduser = ucwords($_SESSION['id_user']);
										mysqli_query($mysqli, "INSERT INTO tbl_nilai (id_user,benar,salah,kosong,score,tanggal,keterangan) Values ('$iduser','$benar','$salah','$kosong','$hasil','$tgl_sekarang','Lulus')");
									} else {
										//Lakukan Penyimpanan Kedalam Database
										$iduser = ucwords($_SESSION['id_user']);
										mysqli_query($mysqli, "INSERT INTO tbl_nilai (id_user,benar,salah,kosong,score,tanggal,keterangan) Values ('$iduser','$benar','$salah','$kosong','$hasil','$tgl_sekarang','Tidak Lulus')");
									}
								}

								//Menampilkan Hasil Ujian Kompetensi
								$username =  ucwords($_SESSION['username']);
								echo "<h4 style='border:0;background-color: #F5F5F5;';>user name  <u>$username</u> anda sudah mengerjakan ujian online</h4>";
								echo "<br><div align='center'>
		 <table><tr><th colspan=3><h2><u>Hasil Tes Anda</u></h2></th></tr>
		  <tr><td valign='top'><b><h4>Nilai anda   </h4>         </td><td valign='top'><h2 style='color: blue;'>$hasil</h2></b></td>";
								$qry = mysqli_query($mysqli, "SELECT nilai_min FROM tbl_pengaturan_ujian");
								$q = mysqli_fetch_array($qry);
								$cek = $q['nilai_min'];
								if ($hasil >= $cek) {
									echo "<td rowspan='4'><h1 style='color: green;'>&nbsp;&nbsp;&nbsp;&nbsp;<u>Lulus</u></h1></td></tr>";
								} else {
									echo "<td rowspan='4'><h1 style='color: red;' >&nbsp;&nbsp;&nbsp;&nbsp;<u>Gagal</u></h1></td></tr>";
								}
								echo "
		 <tr><td valign='top'><h4>Jawaban Benar</h4></td><td valign='top'><h4> : $benar</h4> </td></tr>
		 <tr><td valign='top'><h4>Jawaban Salah</h4></td><td valign='top'><h4> : $salah</h4></td></tr>
		 <tr><td valign='top'><h4>Jawaban Kosong&nbsp;</h4></td><td valign='top'><h4>: $kosong</h4></td></tr>
		</table></div>";
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
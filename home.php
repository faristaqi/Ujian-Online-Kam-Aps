<?php
session_start();
include "config/koneksi.php";
// buat login online untuk membuat offline dulu jika data terlanjur tersimpan
 mysqli_query($mysqli,"UPDATE tbl_user set online ='0' where id_user='" . $_SESSION['id_user'] . "'");

                        $sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
                        $r    = mysqli_fetch_array($sql);
                        $profile = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
                        $rowprofile = mysqli_fetch_array($profile);  
 $cek_pakaiSidebar= $rowprofile["pakai_sidebar"] ; 

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
 <body>
<!-- Page Content -->
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
                        Peraturan
                    </div>
                    <div class="panel-body">

                        <?php
                        $result = mysqli_query($mysqli, "select * from tbl_soal WHERE aktif='Y'");
                        $hitung = mysqli_num_rows($result);
                        $qry = mysqli_query($mysqli, "SELECT * FROM tbl_pengaturan_ujian");
                        $r = mysqli_fetch_array($qry);

                        echo "
		<h3 align='center'>$r[nama_ujian]</h3><br/>
		Waktu Pengerjaan &nbsp;  : $r[waktu] menit<br/>
		Jumlah Soal &nbsp; &nbsp; &nbsp;<span style='color: white;'>.</span> &nbsp; &nbsp; : $hitung<br/>
		<p/>
		<h2>PERATURAN</h2><br/>
		$r[peraturan]<br/>
		";
                        ?>
                        <script>
                            var cek = <?php echo $cek_pakaiSidebar ?>;
                            function cekForm() {
                                if (!document.fValidate.agree.checked) {



                    swal('Silahan klik chek box untuk menyetujui peraturan ini', {
                                            icon: 'warning',
                                            });
                                    return false;

                                 } else {
                                            if (cek == 3) {
                                    location.href = "?hal=soal4";}
                                     else {
                                        if (cek == 2) {
                                    location.href = "?hal=soal3";}
                                     else {

                                    if (cek == 0) {
                                    location.href = "?hal=soal2";}

                                    else {
                                        location.href = "?hal=soal";}
                                }}}
                            }
                        </script>
                        <form name="fValidate">
                            <input type="checkbox" name="agree" id="agree" value="1"> &nbsp; Saya Mengerti dan Siap Untuk Mengikuti Tes<br /><br />
                            <div style='text-align:center;'><input type="button" name="button-ok" class="btn btn-primary" value="MULAI TES" onclick="cekForm()"></div>
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
  </body>
  </html>
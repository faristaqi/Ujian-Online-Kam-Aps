<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

// script buat mengosongkan yang telah online selama x hari krn peserta tidak logout jadi masih tampil di daftar online
$lama = 0.1 ; // lama data adalah 0.1 hari / 6 jam
mysqli_query($mysqli, "UPDATE tbl_user SET online = '0' WHERE DATEDIFF(CURDATE(), waktu_online) > $lama");


$module = $_GET['module'];
$act = $_GET['act'];


$sql_nilai_l  = mysqli_query($mysqli, "SELECT count(*) as jum FROM tbl_nilai WHERE keterangan='Lulus'");
$r_nilai_l    = mysqli_fetch_array($sql_nilai_l);
$lulus = $r_nilai_l['jum'];

$sql_nilai_tl  = mysqli_query($mysqli, "SELECT count(*) as jum FROM tbl_nilai WHERE keterangan='Tidak Lulus'");
$r_nilai_tl    = mysqli_fetch_array($sql_nilai_tl);
$tidak_lulus = $r_nilai_tl['jum'];

$sql_user         = mysqli_query($mysqli, "SELECT count(*) as jum FROM tbl_user WHERE statusaktif='N'");
$r_user           = mysqli_fetch_array($sql_user);
$total_usernonAktif  = $r_user['jum'];

$peserta  = mysqli_query($mysqli, "SELECT count(*) as jum FROM tbl_user WHERE telah_ujian=''");
$r_tdkikut    = mysqli_fetch_array($peserta);
$tidakikut = $r_tdkikut['jum'];

$sql_user         = mysqli_query($mysqli, "SELECT count(*) as jum FROM tbl_user");
$r_user           = mysqli_fetch_array($sql_user);
$total_user       = $r_user['jum'];

$sql_online        = mysqli_query($mysqli, "SELECT count(*) as jum FROM tbl_user WHERE online='1'");
$r_online           = mysqli_fetch_array($sql_online);
$total_online       = $r_online['jum'];


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="10"/>
    <title>home</title>
</head>
<body>
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
                        Dashboard
                    </div>
                    <div class="panel-body">
                        <h3>SELAMAT DATANG ADMIN</h3>

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div style="background-color:#3CB371">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $lulus ?></div>
                                                <div>Peserta Lulus</div>
                                            </div>
                                        </div>
                                    </div>

  <a href="?module=mod_hasilLULUS">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $tidak_lulus ?></div>
                                                <div>Peserta Tidak Lulus</div>
                                            </div>
                                        </div>
                                    </div>
 <a href="?module=mod_hasilTDKlulus">




                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div style="background-color:#549CD0;">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $tidakikut ?></div>
                                                <div>Peserta Tidak Ikut Ujian</div>
                                            </div>
                                        </div>
                                    </div>
 <a href="?module=mod_hasilTDKikutUJIAN">

                                   
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $total_usernonAktif ?></div>
                                                <div>Total Peserta Yang di Non Aktifkan</div>
                                            </div>
                                        </div>
                                    </div>
<a href="?module=mod_dinonAktifkan">





                                     <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                 <div style="background-color:#3CB371">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $total_online  ?></div>
                                                <div>Peserta Sedang Online</div>
                                            </div>
                                        </div>
                                    </div>
 <a href="?module=mod_pesertaLogin">



                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $total_user ?></div>
                                                <div>Total Peserta Ujian Online</div>
                                            </div>
                                        </div>
                                    </div>
<a href="?module=users">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

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
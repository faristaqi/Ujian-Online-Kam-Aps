<?php
session_start();
include "config/koneksi.php";

?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>side bar</title>

  <script src="js/sweetalert.min.js"></script>
  </head>
 <body>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header" id="class_online">  <font style="color: green;"> Koneksi :</font> <i class="fa fa-rss"></i> 
                <span style="text-align: center; color: green;"> </span>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?hal=home" >UjianOnline</a>


            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" onclick="ruki3()" href="#">
                          
                        <i class="fa fa-meh-o"></i> <?php echo $_SESSION['username'] ?>  &nbsp;&nbsp;

                        <i class="fa fa-external-link"></i> Logout</a>
                        
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">



                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="?hal=home"><i class="fa fa-dashboard fa-fw  keluar"></i> Dashboard</a>
                        </li>


                        <li>
                            <a href="?hal=profiluser"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>

                        <li>
                            <a style="display: none;" ><i class="fa fa-user fa-fw"></i> </i>   </a>
                        </li>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

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




  </body>
  </html>

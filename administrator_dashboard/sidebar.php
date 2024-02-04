<?php
include "../../../config/koneksi.php";
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>side bar</title>
    <link rel="shortcut icon" href="../images/favicon.gif" type="image/gif" >
  <script src="../js/sweetalert.min.js"></script>
  </head>
 <body>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"  href="?module=home">UjianOnline</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" onclick="ruki35()" href="#">
                          
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
                            <a href="?module=home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>


                        <li>
                            <a href="?module=soal"><i class="fa fa-file fa-fw"></i>Kelola Soal</a>
                        </li>

                        <li>
                            <a href="?module=hasilujian"><i class="fa fa-file fa-fw"></i>Hasil Ujian</a>
                        </li>

                        <li>
                            <a href="?module=pengaturanujian"><i class="fa fa-gear fa-fw"></i>Pengaturan Ujian</a>
                        </li>

                        <li>
                            <a href="?module=panduan"><i class="fa fa-book fa-fw"></i>Panduan</a>
                        </li>

                        <li>
                            <a href="?module=users"><i class="fa fa-user fa-fw"></i> Daftar Peserta</a>
                        </li>




<!-- /.TAMBHAN DEMO WEBSITE RUKIYANTO :-)  -->


                          

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
         <script type="text/javascript">

        function ruki35(){ swal({
  

  title: 'Yakin untuk LOGOUT ?',
  text: '',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((akhiri) => {
  if (akhiri) {
window.location.href = "logout.php" ;

  } else {

  swal('Logout dibatalkan..');
                      setTimeout(function() {     
                        window.location =' media.php?module=home ';
                                              }, 900); 



  
  }
            });
        }
</script>



  </body>
  </html>
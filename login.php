<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Ujian Online</title>
    <link rel="shortcut icon" href="images/favicon.gif" type="image/gif" >

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="background:#F5F5F5">
                   
                  <?php
                        ob_start(); 
                        include "config/koneksi.php";                
                        $sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
                        $r    = mysqli_fetch_array($sql);
                        $profile = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
                        $rowprofile = mysqli_fetch_array($profile);                 


   echo "    
         <center> <table style='margin-top: 10px;'>
            
          <tr><td width='900'  align='center'><img src='foto/$r[gambar]' width='45' height='50'></td></tr>     
         <tr><td width='900'  align='center'><h6 style='color:#008D8D'>$rowprofile[profile]</h6></td></tr>
         </table> </center>";

               ?>
                    <div class="panel-heading"align="center" style="background: #008D8D">
                        <h3 class="panel-title" style="color: white;">Selamat Datang di Aplikasi Ujian Online</h3> 
                         <span class="panel-title" style="color: white;">Silahkan Login</span>                       
                    </div>

                    <div class="panel-body">
                        <div id="loading" style="text-align: center"></div>
                        <form name="form" action="cek_login.php" id="loginF" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">


<!-- membuat show dan hide passwod -->
&nbsp  <input type="checkbox" onclick="myFunction()">&nbsp  Tampilkan Password 
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}  </script>  <br>
<h5> &nbsp  &nbsp Username antar siswa harus berbeda</h5>
<br><br>


                                </div>
                                <div class="checkbox">
                                    <label>
                                        Belum punya akun ? daftar <a href="register.php" style="color: green;">disini</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->

                                <button type="submit" class="btn btn-lg btn-success btn-block">Sign in</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>



</body>

</html>
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
                    Panduan
                  </div>
                  <div class="panel-body">



                    <?php
                    $aksi = "modul/mod_panduan/aksi_panduan.php";
                    switch ($_GET['act']) {
                      default:
                        $sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
                        $r    = mysqli_fetch_array($sql);

$profile = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
$rowprofile = mysqli_fetch_array($profile);
$profile2 = mysqli_query($mysqli, "SELECT * FROM tbl_admin WHERE id_admin='1'");
$rowprofile2 = mysqli_fetch_array($profile2);
$radio = $rowprofile['pakai_sidebar'];


                        echo "<h3>Edit Profile & Panduan Pengoperasian aplikasi</h3>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=panduan&act=update class='form-horizontal'>
          <input type=hidden name=id value=$r[id_modul]>
          <input type=hidden name=idprf value=$rowprofile[id_profile]>
          <input type=hidden name=idadmin value=$rowprofile2[username]>
          <input type=hidden name=idpassword value=$rowprofile2[password]>



          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'></label>
            <div class='col-sm-10'>
              <img src='../foto/$r[gambar]' width='160' height='160'>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>logo size :160px dan .jpg</label>
            <div class='col-sm-5'>
             <input type=file size=30 name=fupload>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Nama </label>
            <div class='col-sm-10'>
             
             <input size='30' type='text' id='id_profile' name='profile'  value='$rowprofile[profile]'>
            </div>
          </div>


          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Username Admin </label>
            <div class='col-sm-10'>
             
             <input size='30' type='text' id='idadmin' name='usernameAdmin'  value='$rowprofile2[username]'>
            </div>
          </div>
  

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Password Admin </label>
            <div class='col-sm-10'>
             
             <input size='30' type='text' id='idpassword' name='password'  value='$rowprofile2[password]'>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>&nbsp;</label>
            <div class='col-sm-10'>
             
                        <div class='col-sm-10'>
              <img src='../images/sidebar.jpg' width='110' height='120'> &nbsp;  <img src='../images/no_sidebar.jpg' width='110' height='120'>
            </div>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'style='margin-top: -8px;'>Tampilan soal  </label>
            <div class='col-sm-10'>
   
";
  // radiobutton tampilan soal

   if ($radio =='1')
   { 
       $option1 = "<input type='radio' name='sidebar' value='1' <?php if($radio =='1') {echo ' checked ';} ?>";
       $option2 = "<input type='radio' name='sidebar' value='0' <?php if($radio =='0') ?>";
       $option3 = "<input type='radio' name='sidebar' value='2' <?php if($radio =='2') ?>";
       $option4 = "<input type='radio' name='sidebar' value='3' <?php if($radio =='3')?>";
   }
 
   // dicek
     if ($radio =='0')
        {
         $option1 = "<input type='radio' name='sidebar' value='1' <?php if($radio =='1') ?>";
           $option2 = " <input type='radio' name='sidebar' value='0' <?php if($radio =='0') {echo ' checked ';} ?>";
           $option3 = "<input type='radio' name='sidebar' value='2' <?php if($radio =='2') ?>";
           $option4 = "<input type='radio' name='sidebar' value='3' <?php if($radio =='3')?>";          
        }


     if ($radio =='2')
        {
         $option1 = "<input type='radio' name='sidebar' value='1' <?php if($radio =='1') ?>";
           $option2 = " <input type='radio' name='sidebar' value='0' <?php if($radio =='0')?>";
           $option3 = "<input type='radio' name='sidebar' value='2' <?php if($radio =='2') {echo ' checked ';}  ?>";
           $option4 = "<input type='radio' name='sidebar' value='3' <?php if($radio =='3')?>";
         }

     if ($radio =='3')
        {
         $option1 = "<input type='radio' name='sidebar' value='1' <?php if($radio =='1') ?>";
           $option2 = " <input type='radio' name='sidebar' value='0' <?php if($radio =='0')?>";
           $option3 = "<input type='radio' name='sidebar' value='2' <?php if($radio =='2')?>";
           $option4 = "<input type='radio' name='sidebar' value='3' <?php if($radio =='3') {echo ' checked ';}  ?>";



        }

 echo "".$option1.' Pakai sidebar &nbsp;&nbsp;&nbsp;&nbsp; '.$option2.' Tidak pakai sidebar'."";

  
echo "
           </div>
          </div>



          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>&nbsp;</label>
            <div class='col-sm-10'>
             
                        <div class='col-sm-10'>
              <img src='../images/tdk_acak.jpg' width='110' height='120'>  <img src='../images/tdk_acak.jpg' width='110' height='120'> 
            </div>
            </div>
          </div>


          <div class='form-group' >
            <label for='inputEmail3' class='col-sm-2 control-label'style='margin-top: -8px;'>Tampilan soal  </label>
            <div class='col-sm-10'>
   
";
  // radiobutton tampilan soal


 echo "".$option3.'  View lebar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$option4.' Soal tidak diacak'."";
  
echo "
           </div>
          </div>

<br>



          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>&nbsp;</label>
            <div class='col-sm-10'>
             <input type=submit value=Update class='btn btn-primary'>
            </div>
          </div>


          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Petunjuk Pemakaian Aplikasi</label>
            <div class='col-sm-10'>
             <textarea name='isi' style='width: 270px; height: 300px;'>$r[isi_modul]</textarea>
            </div>
          </div>




         </form>";
                        break;
                    }
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
        <!-- /#page-wrapper -->


     
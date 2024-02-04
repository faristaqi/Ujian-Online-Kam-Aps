<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="../js/sweetalert.min.js"></script>
</head>
<body>




<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

                        $sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
                        $r    = mysqli_fetch_array($sql);
                        $profile = mysqli_query($mysqli, "SELECT * FROM nama_profile WHERE id_profile='1'");
                        $rowprofile = mysqli_fetch_array($profile); 
					   echo "    
					      <div style='display: flex; justify-content: center; margin-top:250px;'>
					         <center> <table >
					            
					          <tr><td width='900'  align='center'><img src='../../../foto/$r[gambar]' width='90' height='100'></td></tr>     
					         <tr><td width='900'  align='center'><h6 style='color:#008D8D'>$rowprofile[profile]</h6></td></tr>
					         </table> </center>
					         </div>";
    

    if (empty($_POST["id"])){
 ?>

                        <script>
            		  alert('Oops! Silahkan pilih data check list dulu...');                 
                      window.location='../../media.php?module=users';                  
                        </script>

 <?php
    }       
    else{
	
	if(isset($_POST["id"])){
		foreach($_POST["id"] as $id){
			$query = "DELETE FROM tbl_user WHERE id_user=?";
			$dewan1 = $mysqli->prepare($query);
			$dewan1->bind_param("i", $id);
			$dewan1->execute();

			$query2 = "DELETE FROM tbl_nilai WHERE id_user=?";
			$dewan2 = $mysqli->prepare($query2);
			$dewan2->bind_param("i", $id);
			$dewan2->execute();

		}
	}



        }
        ?>
        <script language="JavaScript">
            alert('Good! Hapus data yg ceklist sekaligus SUCCESS...');
        window.location='../../media.php?module=users';
        </script>



  </body>
  </html>
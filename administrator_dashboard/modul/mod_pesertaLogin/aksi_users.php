<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

 mysqli_query($mysqli,"UPDATE tbl_user set online ='0'");

	header('location:../../media.php?module=mod_pesertaLogin');

?>
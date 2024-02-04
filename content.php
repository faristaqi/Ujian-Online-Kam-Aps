<?php
// jika ada script yang mengakses media.php maka akan mengirimkan data lewat $_GET['hal'] misal data $hal='register' di masukin menu side bar (sidebar.php)
include "config/koneksi.php";

if ($_GET['hal'] == "soal") {
	include "sidebar.php";
	include "soal.php";
} elseif ($_GET['hal'] == "home") {
	include "sidebar.php";
	include "home.php";
} elseif ($_GET['hal'] == "register") {
	include "sidebar.php";
	include "register.php";
} elseif ($_GET['hal'] == "formlogin") {
	include "sidebar.php";
	include "formlogin.php";
} elseif ($_GET['hal'] == "jawaban") {
	include "sidebar.php";
	include "jawaban.php";
} elseif ($_GET['hal'] == "profiluser") {
	include "sidebar.php";
	include "profileuser.php";
} elseif ($_GET['hal'] == "profil") {
	include "sidebar.php";
	$sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='2'");
	$r    = mysqli_fetch_array($sql);

	echo "<div style='text-align:center'><img src='foto/$r[gambar]' width='260' height='260' align='center'></div>";
	echo "$r[isi_modul]";
} elseif ($_GET['hal'] == "panduan") {
	include "sidebar.php";
	$sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='3'");
	$r    = mysqli_fetch_array($sql);

	echo "<div align='center'><img src='foto/$r[gambar]' width='500' height='160'></div>";
	echo "$r[isi_modul]";


} elseif ($_GET['hal'] == "soal2") {
    include "soal2.php";

} elseif ($_GET['hal'] == "soal3") {
    include "soal3.php";


} elseif ($_GET['hal'] == "soal4") {
    include "soal4.php";
}


//Home
else {
	include "sidebar.php";
	$sql  = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='1'");
	$r    = mysqli_fetch_array($sql);

	echo "

<br><br><br><br><br><br><br><br><br><br><br><br>
	<img src='foto/$r[gambar]' width='160' height='160' align='center'>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HALAMAN BELUM ADA DI FILE content.php";
}

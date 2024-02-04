<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";

// Bagian User
if ($_GET['module'] == 'home') {
  include "sidebar.php";
  include "modul/mod_home/home.php";
} elseif ($_GET['module'] == 'soal') {
  include "sidebar.php";
  include "modul/mod_soal/soal.php";
} elseif ($_GET['module'] == 'profil') {
  include "sidebar.php";
  include "modul/mod_profil/profil.php";
} elseif ($_GET['module'] == 'komentar') {
  include "sidebar.php";
  include "modul/mod_komentar/komentar.php";
} elseif ($_GET['module'] == 'hasilujian') {
  include "sidebar.php";
  include "modul/mod_hasilujian/hasilujian.php";
} elseif ($_GET['module'] == 'pengaturanujian') {
  include "sidebar.php";
  include "modul/mod_pengaturanujian/pengaturanujian.php";
} elseif ($_GET['module'] == 'panduan') {
  include "sidebar.php";
  include "modul/mod_panduan/panduan.php";
} elseif ($_GET['module'] == 'users') {
  include "sidebar.php";
  include "modul/mod_users/users.php";


// TAMBAHAN RUKI UNTUK MODUL JUMLAH YG LULUS DAN TDK LULUS

 } elseif ($_GET['module'] == 'mod_hasilLULUS') {
  include "sidebar.php";
  include "modul/mod_hasilLULUS/hasilujian.php";
            } elseif ($_GET['module'] == 'aksiLULUS') {
            include "sidebar.php";
            include "modul/mod_hasilLULUS/aksi_hasilujian.php";
 

} elseif ($_GET['module'] == 'mod_hasilTDKlulus') {
  include "sidebar.php";
  include "modul/mod_hasilTDKlulus/hasilujian.php";


} elseif ($_GET['module'] == 'mod_hasilTDKikutUJIAN') {
  include "sidebar.php";
  include "modul/mod_hasilTDKikutUJIAN/hasilujian.php";

          } elseif ($_GET['module'] == 'aksi_hasilTDKikutUJIAN') {
          include "sidebar.php";
          include "modul/mod_hasilTDKikutUJIAN/aksi_hasilujian.php";




  } elseif ($_GET['module'] == 'mod_dinonAktifkan') {
  include "sidebar.php";
  include "modul/mod_dinonAktifkan/hasilujian.php";



 } elseif ($_GET['module'] == 'mod_pesertaLogin') {
  include "sidebar.php";
  include "modul/mod_pesertaLogin/user.php";
}  





// ------------------------------------
// Apabila modul tidak ditemukan karena link nya belum di buat di halaman ini
else {
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP TAMBAHKAN MODUL DI admin/content.php</b></p>";
}

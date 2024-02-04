<?php
$server = "localhost";
$username = "ujianon7_faris";
$password = "Vjn&^@t_eBgj";
$database = "ujianon7_db_ujianonline";

// Koneksi dan memilih database di server
$mysqli = mysqli_connect($server, $username, $password, $database) or die("Koneksi gagal");
// mysqli_select_db($database) or die("Database tidak bisa dibuka");

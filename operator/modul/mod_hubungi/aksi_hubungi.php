<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 
  echo "
  <link href='../../css/stylesheet.css' rel='stylesheet' type='text/css'>
  <link rel='shortcut icon' href='../favicon.png' />";

  echo "
  <body class='special-page'>
  <div id='container'>
  
  <section id='error-number'>
  <center><div class='gembok'><img src='../../img/lock.png'></div></center>
  <h1>AKSES ILEGAL</h1>
  <p class='maaf'>Untuk mengakses modul, Anda harus login dahulu!</p><br/>
  </section>
  
  <section id='error-text'>
  <p><a class='tombol' href=../../index.php><b>LOGIN DISINI</b></a></p>
  </section>
  </div>";}




else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus hubungi
if ($module=='hubungi' AND $act=='hapus'){
  mysql_query("DELETE FROM hubungi WHERE id_hubungi='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}

elseif($module=='hubungi' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysql_query("DELETE FROM hubungi WHERE id_hubungi=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
}}
?>

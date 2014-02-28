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
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kategoriartikel
if ($module=='kategoriartikel' AND $act=='hapus'){
  mysql_query("DELETE FROM kategoriartikel WHERE id_kategoriartikel='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}


// Hapus Terseleksi
elseif($module=='kategoriartikel' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysql_query("DELETE FROM kategoriartikel WHERE id_kategoriartikel=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
}





// Input kategoriartikel
elseif ($module=='kategoriartikel' AND $act=='input'){
  $kategoriartikel_seo = seo_title($_POST['nama_kategoriartikel']);
  
  mysql_query("INSERT INTO kategoriartikel
  (nama_kategoriartikel,
  username,
  kategoriartikel_seo) 
  
  VALUES(
  '$_POST[nama_kategoriartikel]',
  '$_SESSION[namauser]',
  '$kategoriartikel_seo')");
   
  header('location:../../media.php?module='.$module.'&msg=insert');
}

// Update kategoriartikel
elseif ($module=='kategoriartikel' AND $act=='update'){
  $kategoriartikel_seo = seo_title($_POST['nama_kategoriartikel']);
  mysql_query("UPDATE kategoriartikel SET nama_kategoriartikel='$_POST[nama_kategoriartikel]', aktif='$_POST[aktif]', kategoriartikel_seo='$kategoriartikel_seo' 
               WHERE id_kategoriartikel = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

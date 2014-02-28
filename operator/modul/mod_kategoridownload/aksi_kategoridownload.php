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

// Hapus kategoridownload
if ($module=='kategoridownload' AND $act=='hapus'){
  mysql_query("DELETE FROM kategoridownload WHERE id_kategoridownload='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}


// Hapus Terseleksi
elseif($module=='kategoridownload' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysql_query("DELETE FROM kategoridownload WHERE id_kategoridownload=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
}





// Input kategoridownload
elseif ($module=='kategoridownload' AND $act=='input'){
  $kategoridownload_seo = seo_title($_POST['nama_kategoridownload']);
  
  mysql_query("INSERT INTO kategoridownload
  (nama_kategoridownload,
  username,
  kategoridownload_seo) 
  
  VALUES(
  '$_POST[nama_kategoridownload]',
  '$_SESSION[namauser]',
  '$kategoridownload_seo')");
   
  header('location:../../media.php?module='.$module.'&msg=insert');
}

// Update kategoridownload
elseif ($module=='kategoridownload' AND $act=='update'){
  $kategoridownload_seo = seo_title($_POST['nama_kategoridownload']);
  mysql_query("UPDATE kategoridownload SET nama_kategoridownload='$_POST[nama_kategoridownload]', kategoridownload_seo='$kategoridownload_seo' 
               WHERE id_kategoridownload = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

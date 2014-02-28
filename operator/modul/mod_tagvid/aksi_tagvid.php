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

// Hapus tagvid
if ($module=='tagvid' AND $act=='hapus'){
  mysql_query("DELETE FROM tagvid WHERE id_tag='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}




// Hapus Terseleksi
elseif($module=='tagvid' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysql_query("DELETE FROM tagvid WHERE id_tag=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
}




// Input tagvid
elseif ($module=='tagvid' AND $act=='input'){
  $tag_seo = seo_title($_POST['nama_tag']);
  mysql_query("INSERT INTO tagvid(nama_tag,username,tag_seo) VALUES('$_POST[nama_tag]','$_SESSION[namauser]',
'$tag_seo')");
  header('location:../../media.php?module='.$module.'&msg=insert');
}

// Update tagvid
elseif ($module=='tagvid' AND $act=='update'){
  $tag_seo = seo_title($_POST['nama_tag']);
  mysql_query("UPDATE tagvid SET nama_tag = '$_POST[nama_tag]', tag_seo='$tag_seo' WHERE id_tag = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

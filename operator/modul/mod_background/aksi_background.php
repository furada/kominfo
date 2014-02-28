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
$dir="img_background/";
$upload="../../../".$dir.$_FILES['gambar']['name'];
$gambar=$dir.$_FILES['gambar']['name'];


//pengecekan apakah tabel masih kosong atau tidak

$cek = mysql_num_rows(mysql_query("SELECT * FROM background"));
if($cek<=0){
mysql_query("INSERT INTO background SET gambar='$gambar' ")or die(mysql_error());
} 

else {
$b=mysql_fetch_array(mysql_query("SELECT * FROM background"));
unlink("../../../$b[gambar]");
mysql_query("UPDATE background SET gambar='$gambar' ")or die(mysql_error());
}
//upload gambar
move_uploaded_file($_FILES['gambar']['tmp_name'],$upload);
header('location:../../media.php?module=background');
}
?>












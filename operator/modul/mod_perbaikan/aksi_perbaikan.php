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
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Update perbaikan
if ($module=='perbaikan' AND $act=='update'){



 mysql_query("UPDATE perbaikan SET  tanggal = '$_POST[tanggal]',									   
								      judul_perbaikan  = '$_POST[judul_perbaikan]',  
                                      warna = '$_POST[warna]',
                                      kuota   = '$_POST[kuota]'
                                WHERE id_perbaikan   = '$_POST[id]'");


  }
 
   header('location:../../media.php?module='.$module.'&msg=update');
}

?>

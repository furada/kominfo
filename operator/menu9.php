<?php
include "../config/koneksi.php";
  $baru=mysql_query("SELECT * FROM orders WHERE status_order='Baru'");
  $hit=mysql_num_rows($baru);
$isi_komentar=mysql_num_rows(mysql_query("SELECT * FROM komentar WHERE dibaca='N'"));

$cek=umenu_akses("?module=resume",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=resume'><span class='text'>Resume</span></a></li>";}


$cek=umenu_akses("?module=kategoriresume",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=kategoriresume'><span class='text'>Kategori Resume</span></a></li>";}






?>

<?php
include "../config/koneksi.php";
  $baru=mysql_query("SELECT * FROM orders WHERE status_order='Baru'");
  $hit=mysql_num_rows($baru);
$isi_komentar=mysql_num_rows(mysql_query("SELECT * FROM komentar WHERE dibaca='N'"));

$cek=umenu_akses("?module=artikel",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=artikel'><span class='text'>Artikel</span></a></li>";}

$cek=umenu_akses("?module=kategoriartikel",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=kategoriartikel'><span class='text'>Kategori Artikel</span></a></li>";}

$cek=umenu_akses("?module=tag",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=tag'><span class='text'>Tag Artikel</span></a></li>";}

$cek=umenu_akses("?module=katajelek",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=katajelek'><span class='text'>Sensor Kata Komentar</span></a></li>";}

$cek=umenu_akses("?module=komentar",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=komentar'><span class='text'>Komentar Artikel</span>
<a href='?module=komentar' class='caption yellow link_navPopMessages'>$isi_komentar</a></a></li>";}



?>

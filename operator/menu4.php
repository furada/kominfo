<?php
include "../config/koneksi.php";
 $jumHub=mysql_num_rows(mysql_query("SELECT * FROM hubungi WHERE dibaca='N'"));
$pesan=mysql_num_rows(mysql_query("SELECT * FROM testimoni WHERE dibaca='N'"));

$cek=umenu_akses("?module=newsletter",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=newsletter'><span class='text'>Newsletter</a></li>";}

$cek=umenu_akses("?module=agenda",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=agenda'><span class='text'>Agenda</a></li>";}

$cek=umenu_akses("?module=poling",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=poling'><span class='text'>Polling</span></li>";}

$cek=umenu_akses("?module=logo",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=logo'><span class='text'>Logo Website</a></li>";}

$cek=umenu_akses("?module=templates",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=templates'><span class='text'>Template Website</a></li>";}

$cek=umenu_akses("?module=background",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=background'><span class='text'>Background Website</span></a></li>";}

$cek=umenu_akses("?module=perbaikan",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=perbaikan'><span class='text'>Maintenance Website</span></a></li>";}

$cek=umenu_akses("?module=hubungi",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=hubungi'><span class='text'>Pesan Masuk</span>
<a href='?module=hubungi' class='caption yellow link_navPopMessages'>$jumHub</a></a></li>";}

$cek=umenu_akses("?module=peta",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=peta'><span class='text'>Peta Lokasi</span></a></li>";}

$cek=umenu_akses("?module=ym",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=ym'><span class='text'>Yahoo Messenger</span></a></li>";}

$cek=umenu_akses("?module=kategoridownload",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=kategoridownload'><span class='text'>Kategori Download</span></a></li>";}

$cek=umenu_akses("?module=download",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=download'><span class='text'>Download</span></a></li>";}

$cek=umenu_akses("?module=sekilasinfo",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=sekilasinfo'><span class='text'>Sekilas Info</a></li>";}

?>

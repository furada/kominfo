<?php
include "../config/koneksi.php";
$isi_komentar=mysql_num_rows(mysql_query("SELECT * FROM komentarvid WHERE dibaca='N'"));

$cek=umenu_akses("?module=album",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=album'><span class='text'>Album Foto</span></a></li>";}

$cek=umenu_akses("?module=galerifoto",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=galerifoto'><span class='text'>Galeri Foto</span></a></li>";}

$cek=umenu_akses("?module=galerifoto2",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=galerifoto2'><span class='text'>Foto Kolase</span></a></li>";}


$cek=umenu_akses("?module=video",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=video'><span class='text'>Video</span></a></li>";}

$cek=umenu_akses("?module=playlist",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=playlist'><span class='text'>Playlist Video</span></a></li>";}

$cek=umenu_akses("?module=tagvid",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=tagvid'><span class='text'>Tag Video</span></a></li>";}

$cek=umenu_akses("?module=komentarvid",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=komentarvid'><span class='text'>Komentar Video</span>
<a href='?module=komentarvid' class='caption yellow link_navPopMessages'>$isi_komentar</a></a></li>";}

?>

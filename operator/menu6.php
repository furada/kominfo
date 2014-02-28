<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=iklanheader",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=iklanheader'><span class='text'>Banner Header</span></a></li>";}

$cek=umenu_akses("?module=iklantengah_home",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=iklantengah_home'><span class='text'>Banner Tengah (home)</span></a></li>";}

$cek=umenu_akses("?module=iklantengah_dalam",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=iklantengah_dalam'><span class='text'>Banner Tengah (dalam)</span></a></li>";}

$cek=umenu_akses("?module=iklansidebar_home",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=iklansidebar_home'><span class='text'>Banner Sidebar (home)</span></a></li>";}

$cek=umenu_akses("?module=iklansidebar_dalam",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=iklansidebar_dalam'><span class='text'>Banner Sidebar (dalam)</span></a></li>";}


$cek=umenu_akses("?module=iklan_popup",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=iklan_popup'><span class='text'>Banner PopUp</span></a></li>";}
?>

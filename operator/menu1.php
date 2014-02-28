<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=profil",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=profil'><span class='text'>Profil</span></a></li>";}




$cek=umenu_akses("?module=identitas",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=identitas'><span class='text'>Identitas Website</span></a></li>"; }



$cek=umenu_akses("?module=menu",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=menu'><span class='text'>Menu Website (Atas)</span></a></li>";}

$cek=umenu_akses("?module=menu2",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=menu2'><span class='text'>Menu Website (Utama)</span></a></li>";}


$cek=umenu_akses("?module=menuutama",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=menuutama'><span class='text'>Menu Website (Bawah)</span></a></li>";}


$cek=umenu_akses("?module=halamanstatis",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=halamanstatis'><span class='text'>Halaman Baru</span></a></li>";}

?>

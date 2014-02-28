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

$module=$_GET[module];
$act=$_GET[act];

// Hapus poling
if ($module=='poling' AND $act=='hapus'){
  mysql_query("DELETE FROM poling WHERE id_poling='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}

// Input poling
elseif ($module=='poling' AND $act=='input'){
  mysql_query("INSERT INTO poling(pilihan,
                                  status, 
							       username,
                                  aktif) 
	                       VALUES('$_POST[pilihan]',
	                              '$_POST[status]',
							 '$_SESSION[namauser]',
                                '$_POST[aktif]')");
  header('location:../../media.php?module='.$module.'&msg=insert');
}


// Hapus Terseleksi
elseif($module=='poling' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysql_query("DELETE FROM poling WHERE id_poling=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
}




// Update poling
elseif ($module=='poling' AND $act=='update'){
  mysql_query("UPDATE poling SET pilihan = '$_POST[pilihan]',
                                 status  = '$_POST[status]',
                                 aktif   = '$_POST[aktif]'  
                          WHERE id_poling = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

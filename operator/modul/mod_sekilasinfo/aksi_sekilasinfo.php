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
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];


// Hapus sekilas info
if ($module=='sekilasinfo' AND $act=='hapus'){
  mysql_query("DELETE FROM sekilasinfo WHERE id_sekilas='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}


// Hapus terpilih

elseif($module=='sekilasinfo' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysql_query("DELETE FROM sekilasinfo WHERE id_sekilas=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	}



// Input SEKILAS INFO
elseif ($module=='sekilasinfo' AND $act=='input'){
 
									
									
    mysql_query("INSERT INTO sekilasinfo(info,
	                                     username,
										 aktif,
                                    tgl_posting) 
									
									
                            VALUES('$_POST[info]',
							'$_SESSION[namauser]',
							 '$_POST[aktif]',
                                   '$tgl_sekarang')");
									
									
  header('location:../../media.php?module='.$module.'&msg=insert');
}




// Update sekilas info
elseif ($module=='sekilasinfo' AND $act=='update'){

   mysql_query("UPDATE sekilasinfo SET info = '$_POST[info]',
	                                   aktif   = '$_POST[aktif]'
                             WHERE id_sekilas = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
}
}

?>





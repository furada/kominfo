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
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus iklansidebar_dalam
if ($module=='iklansidebar_dalam' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM iklansidebar_dalam WHERE id_iklansidebar_dalam='$_GET[id]'"));
  if ($data['gambar']!=''){
  mysql_query("DELETE FROM iklansidebar_dalam WHERE id_iklansidebar_dalam='$_GET[id]'");
     unlink("../../../iklansidebar_dalam/$_GET[namafile]");   
  }
  else{
  mysql_query("DELETE FROM iklansidebar_dalam WHERE id_iklansidebar_dalam='$_GET[id]'");  
  }
  header('location:../../media.php?module='.$module);
}



// Input iklansidebar_dalam
elseif ($module=='iklansidebar_dalam' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    Uploadiklansidebar_dalam ($nama_file);
    mysql_query("INSERT INTO iklansidebar_dalam(judul,
	                               username,
                                    url,
										aktif,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[judul]',
							  '$_SESSION[namauser]',
                                   '$_POST[url]',
								   '$_POST[aktif]', 
                                   '$tgl_sekarang',
                                   '$nama_file')");
  }
  else{
    mysql_query("INSERT INTO iklansidebar_dalam(judul,
	                                   username,
                                    tgl_posting,
									aktif,
                                    url) 
                            VALUES('$_POST[judul]',
							  '$_SESSION[namauser]',
                                   '$tgl_sekarang',
								    '$_POST[aktif]',
                                   '$_POST[url]')");
  }
  header('location:../../media.php?module='.$module);
}

// Update iklansidebar_dalam
elseif ($module=='iklansidebar_dalam' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE iklansidebar_dalam SET judul     = '$_POST[judul]',
	                                   aktif     = '$_POST[aktif]',
                                   url       = '$_POST[url]'
                             WHERE id_iklansidebar_dalam = '$_POST[id]'");
  }
  else{
    
	$data_gambar = mysql_query("SELECT gambar FROM iklansidebar_dalam WHERE id_iklansidebar_dalam='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../iklansidebar_dalam/'.$r['gambar']);
	@unlink('../../../iklansidebar_dalam/'.'small_'.$r['gambar']);
	Uploadiklansidebar_dalam ($nama_file);
	
    mysql_query("UPDATE iklansidebar_dalam SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
								      aktif       = '$_POST[aktif]',
                                   gambar    = '$nama_file'   
                             WHERE id_iklansidebar_dalam = '$_POST[id]'");
  }
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

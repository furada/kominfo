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

// Hapus download
if ($module=='resume' AND $act=='hapus'){
  mysql_query("DELETE FROM resume WHERE id_download='$_GET[id]'");
   unlink("../../../files_resume/$_GET[namafile]");   
  header('location:../../media.php?module='.$module.'&msg=delete');
}


// Hapus Yang Terseleksi/////////////////////////////////////////////////////////////////////////
elseif($module=='resume' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysql_query("DELETE FROM resume WHERE id_download=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
}
}


// Input download
elseif ($module=='resume' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadResume($nama_file);
    mysql_query("INSERT INTO resume( id_kategoridownload,
	                                     judul,
	                                 username,
                                    nama_file,
								
                                    tgl_posting) 
                            VALUES(	 '$_POST[kategoridownload]',
							'$_POST[judul]',
						
							  '$_SESSION[namauser]',
                                   '$nama_file',
                                   '$tgl_sekarang')");
  }
  else{
    mysql_query("INSERT INTO resume( id_kategoridownload,
	                                     judul,
	                                 username,
                                    nama_file,
								
                                    tgl_posting) 
                            VALUES(	 '$_POST[kategoridownload]',
							'$_POST[judul]',
						
							  '$_SESSION[namauser]',
                                   '$nama_file',
                                   '$tgl_sekarang')");

  }
  header('location:../../media.php?module='.$module.'&msg=insert');
}

// Update donwload
elseif ($module=='resume' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE resume SET judul     = '$_POST[judul]',
                                   id_kategoridownload = '$_POST[kategoridownload]'
                             WHERE id_download = '$_POST[id]'");
  }
  else{
  
    $data= mysql_query("SELECT nama_file FROM resume WHERE id_download='$_POST[id]'");
	$r    	= mysql_fetch_array($data);
	@unlink('../../../files_resume/'.$r['nama_file']);
    UploadResume($nama_file);	
    mysql_query("UPDATE resume SET judul     = '$_POST[judul]',
                                   id_kategoridownload = '$_POST[kategoridownload]',
                                   nama_file    = '$nama_file'   
                             WHERE id_download = '$_POST[id]'");
  }
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

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
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus album
if ($module=='album' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gbr_album FROM album WHERE id_album='$_GET[id]'"));
  if ($data['gbr_album']!=''){
     mysql_query("DELETE FROM album WHERE id_album='$_GET[id]'");
     unlink("../../../img_album/$_GET[namafile]");   
     unlink("../../../img_album/kecil_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM album WHERE id_album='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module.'&msg=delete');
}



// Hapus terpilih
elseif($module=='album' AND $act=='hapussemua'){
if(isset($_POST['cek'])){
foreach($_POST['cek'] as $cek => $num){
$data=mysql_fetch_array(mysql_query("SELECT gbr_album FROM album WHERE id_album=$num"));
  if ($data['gbr_album']!=''){
     unlink("../../../img_album/$data[gbr_album]");   
     unlink("../../../img_album/kecil_$data[gbr_album]");  
} 
mysql_query("DELETE FROM album WHERE id_album=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
}
} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
}
}



// Input album
elseif ($module=='album' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

 $album_seo = seo_title($_POST['jdl_album']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
   // UploadAlbum($nama_file_unik);
	UploadAlbum($nama_file_unik,'../../../img_album/',300,120);

   mysql_query("INSERT INTO album(jdl_album,
                                    album_seo,
									    keterangan,
										 username,
										tgl_posting,
										 jam,
										hari,
                                    gbr_album) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo',
								      '$_POST[keterangan]',
									      '$_SESSION[namauser]',
										     '$tgl_sekarang',
											  '$jam_sekarang',
											    '$hari_ini',
                                   '$nama_file_unik')");
								   
								   
  header('location:../../media.php?module='.$module.'&msg=insert');
  }
  else{
     mysql_query("INSERT INTO album(jdl_album,
                                    album_seo,
									     username,
										    tgl_posting,
											  jam,
											  hari,
									   keterangan) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo',
								     '$_SESSION[namauser]',
									   '$tgl_sekarang',
									    '$jam_sekarang',
										  '$hari_ini',
								      '$_POST[keterangan]')");
								   
  header('location:../../media.php?module='.$module.'&msg=insert');
  }
}

// Update album
elseif ($module=='album' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $album_seo = seo_title($_POST['jdl_album']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE album SET jdl_album     = '$_POST[jdl_album]',
                                  album_seo     = '$album_seo', 
								     keterangan  = '$_POST[keterangan]',
                                  aktif='$_POST[aktif]' 
                             WHERE id_album = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
  }
  else{    
    //UploadAlbum($nama_file_unik);
	// Penambahan fitur unlink utk menghapus file yg lama biar gak ngebek-ngebeki server ^_^
	$data_gbr_album= mysql_query("SELECT gbr_album FROM album WHERE id_album='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gbr_album);
	@unlink('../../../img_album/'.$r['gbr_album']);
	@unlink('../../../img_album/'.'kecil_'.$r['gbr_album']);
    UploadAlbum($nama_file_unik,'../../../img_album/',300,120);
	
	 mysql_query("UPDATE album SET jdl_album  = '$_POST[jdl_album]',
                                   album_seo = '$album_seo',
								      keterangan  = '$_POST[keterangan]',  
                                   gbr_album    = '$nama_file_unik', 
                                   aktif='$_POST[aktif]'    
                             WHERE id_album = '$_POST[id]'");
							 
							 
   header('location:../../media.php?module='.$module.'&msg=update');
	}
    
  }

}
?>

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
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus playlist
if ($module=='playlist' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gbr_playlist FROM playlist WHERE id_playlist='$_GET[id]'"));
  if ($data['gbr_playlist']!=''){
     mysql_query("DELETE FROM playlist WHERE id_playlist='$_GET[id]'");
     unlink("../../../img_playlist/$_GET[namafile]");   
     unlink("../../../img_playlist/kecil_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM playlist WHERE id_playlist='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module.'&msg=delete');
}




// Hapus terpilih
elseif($module=='playlist' AND $act=='hapussemua'){
if(isset($_POST['cek'])){
foreach($_POST['cek'] as $cek => $num){
$data=mysql_fetch_array(mysql_query("SELECT gbr_playlist FROM playlist WHERE id_playlist =$num"));
  if ($data['gbr_playlist']!=''){
     unlink("../../../img_playlist/$data[gbr_playlist]");   
     unlink("../../../img_playlist/kecil_$data[gbr_playlist]");  
} 
mysql_query("DELETE FROM playlist WHERE id_playlist=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
}
} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
}
}




// Input playlist
if ($module=='playlist' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $playlist_seo = seo_title($_POST['jdl_playlist']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadPlaylist($nama_file_unik);
    mysql_query("INSERT INTO playlist(jdl_playlist,
	                                    username,
                                    playlist_seo,
                                    gbr_playlist) 
                            VALUES('$_POST[jdl_playlist]',
							       '$_SESSION[namauser]',
                                   '$playlist_seo',
                                   '$nama_file_unik')");
  }
  else{
    mysql_query("INSERT INTO playlist(jdl_playlist,
	                                        username,
                                    playlist_seo) 
                            VALUES('$_POST[jdl_playlist]',
							    '$_SESSION[namauser]',
                                   '$playlist_seo')");
  }
  header('location:../../media.php?module='.$module.'&msg=insert');
}

// Update playlist
elseif ($module=='playlist' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $playlist_seo = seo_title($_POST['jdl_playlist']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE playlist SET jdl_playlist     = '$_POST[jdl_playlist]',
                                  playlist_seo     = '$playlist_seo', 
                                  aktif='$_POST[aktif]' 
                             WHERE id_playlist = '$_POST[id]'");
  }
  else{
    UploadPlaylist($nama_file_unik);
	
	
    $data_gambar = mysql_query("SELECT gbr_playlist FROM playlist WHERE id_playlist='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);	
	@unlink('../../../img_playlist/'.'kecil_'.$r['gbr_playlist']);
	@unlink('../../../img_playlist/'.$r['gbr_playlist']);
	
    mysql_query("UPDATE playlist SET jdl_playlist  = '$_POST[jdl_playlist]',
                                   playlist_seo = '$playlist_seo',
                                   gbr_playlist    = '$nama_file_unik', 
                                   aktif='$_POST[aktif]'    
                             WHERE id_playlist = '$_POST[id]'");
  }
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

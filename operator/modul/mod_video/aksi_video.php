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

 // Hapus video
if ($module=='video' AND $act=='hapus'){
  mysql_query("DELETE FROM video WHERE id_video='$_GET[id]'");
  unlink("../../../img_video/$_GET[namafile]");
  unlink("../../../img_video/kecil_$_GET[namafile]");   
  header('location:../../media.php?module='.$module.'&msg=delete');
}


// Hapus terpilih
elseif($module=='video' AND $act=='hapussemua'){
if(isset($_POST['cek'])){
foreach($_POST['cek'] as $cek => $num){
$data=mysql_fetch_array(mysql_query("SELECT gbr_video FROM video WHERE id_video=$num"));
  if ($data['gbr_video']!=''){
     unlink("../../../img_video/$data[gbr_video]");   
     unlink("../../../img_video/kecil_$data[gbr_video]");  
} 
mysql_query("DELETE FROM video WHERE id_video=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
}
} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
}
}



// Input video
elseif ($module=='video' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $lokasi_file2    = $_FILES['fupload2']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $nama_file2     = $_FILES['fupload2']['name'];
  $acak           = rand(000000,999999);
  
  $nama_file_unik 	= $acak.$nama_file; 
  $nama_file_unik2	= $acak.$nama_file2;
  
  if (!empty($_POST[tag_seo])){
    $tag_seo = $_POST[tag_seo];
    $tagvid=implode(',',$tag_seo);
  }
  $video_seo      = seo_title($_POST['jdl_video']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadVideo($nama_file_unik);
	if(!empty($lokasi_file2)){
			UploadVideo2($nama_file_unik2);
    mysql_query("INSERT INTO video(jdl_video,
                                    video_seo,
                                    id_playlist,
									username,
									jam,
                                    tanggal,
                                    hari,
									tagvid,
                                    keterangan,
									youtube,
                                    gbr_video,
									video) 
                            VALUES('$_POST[jdl_video]',
                                   '$video_seo',
                                   '$_POST[playlist]',
								   '$_SESSION[namauser]',
								   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$hari_ini',
								   '$tagvid',
                                   '$_POST[keterangan]',
								   '$_POST[youtube]',
                                   '$nama_file_unik',
								   '$nama_file_unik2')");
	}
	elseif(empty($lokasi_file2)){
		mysql_query("INSERT INTO video(jdl_video,
                                    video_seo,
                                    id_playlist,
									username,
									jam,
                                    tanggal,
                                    hari,
									tagvid,
                                    keterangan,
									youtube,
                                    gbr_video) 
                            VALUES('$_POST[jdl_video]',
                                   '$video_seo',
                                   '$_POST[playlist]',
								   '$_SESSION[namauser]',
								   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$hari_ini',
								   '$tagvid',
                                   '$_POST[keterangan]',
								   '$_POST[youtube]',
                                   '$nama_file_unik')");
	}
		
	}
  else{
	  if(!empty($lokasi_file2)){
			UploadVideo2($nama_file_unik2);
    mysql_query("INSERT INTO video(jdl_video,
                                    video_seo,
                                    id_playlist,
									username,
									jam,
                                    tanggal,
                                    hari,
									tagvid,
                                    keterangan,
									youtube,
									video) 
                            VALUES('$_POST[jdl_video]',
                                   '$video_seo',
                                   '$_POST[playlist]',
								   '$_SESSION[namauser]',
								   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$hari_ini',
								   '$tagvid',
                                   '$_POST[keterangan]',
								   '$_POST[youtube]',
								   '$nama_file_unik2')");
	}
	elseif(empty($lokasi_file2)){
    mysql_query("INSERT INTO video(jdl_video,
                                    video_seo,
                                    id_playlist,
									username,
									jam,
                                    tanggal,
                                    hari,
									tagvid,
									youtube,
                                    keterangan) 
                            VALUES('$_POST[jdl_video]',
                                   '$video_seo',
                                   '$_POST[playlist]',
								   '$_SESSION[namauser]',
								   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$hari_ini',
								   '$tagvid',
								   '$_POST[youtube]',
                                   '$_POST[keterangan]')");
	}
  }
  $jml=count($tag_seo);
  for($i=0;$i<$jml;$i++){
    mysql_query("UPDATE tagvid SET count=count+1 WHERE tag_seo='$tag_seo[$i]'");
  }
  header('location:../../media.php?module='.$module.'&msg=insert');
}

// Update video
elseif ($module=='video' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $lokasi_file2    = $_FILES['fupload2']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $nama_file2     = $_FILES['fupload2']['name'];
  $acak           = rand(000000,999999);
 
  $nama_file_unik 	= $acak.$nama_file; 
  $nama_file_unik2	= $acak.$nama_file2;
  if (!empty($_POST[tag_seo])){
    $tag_seo = $_POST[tag_seo];
    $tagvid=implode(',',$tag_seo);
  }
  
  $video_seo      = seo_title($_POST['jdl_video']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
  if(!empty($lokasi_file2)){
  UploadVideo2($nama_file_unik2);
			

    $data_video = mysql_query("SELECT video FROM video WHERE id_video='$_POST[id]'");
	$d   	= mysql_fetch_array($data_video);	
	@unlink('../../../img_video/'.$d['video']);

			
    mysql_query("UPDATE video SET jdl_video  = '$_POST[jdl_video]',
                                   video_seo   = '$video_seo', 
                                   id_playlist = '$_POST[playlist]',
                                   keterangan  = '$_POST[keterangan]',
								   youtube		= '$_POST[youtube]',
								   tagvid         = '$tagvid',
								   video		= '$nama_file_unik2'
                             WHERE id_video   = '$_POST[id]'");
	  }
	  elseif(empty($lokasi_file2)){
		  mysql_query("UPDATE video SET jdl_video  = '$_POST[jdl_video]',

                                  video_seo   = '$video_seo', 
                                   id_playlist = '$_POST[playlist]',
								   tagvid         = '$tagvid',
								   youtube		= '$_POST[youtube]',
                                   keterangan  = '$_POST[keterangan]'
                             WHERE id_video   = '$_POST[id]'");
	  }
  }
  
  else{
	 
    UploadVideo($nama_file_unik);
	if(!empty($lokasi_file2)){
	UploadVideo2($nama_file_unik2);

			
    mysql_query("UPDATE video SET jdl_video  = '$_POST[jdl_video]',
                                   video_seo   = '$video_seo', 
                                   id_playlist = '$_POST[playlist]',
                                   keterangan  = '$_POST[keterangan]',
								   tagvid         = '$tagvid',
								   youtube		= '$_POST[youtube]',  
                                   gbr_video      = '$nama_file_unik',
								   video		= '$nama_file_unik2'   
                             WHERE id_video   = '$_POST[id]'");
	}
	elseif(empty($lokasi_file2)){
	
	
    $data_gambar = mysql_query("SELECT gbr_video FROM video WHERE id_video='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);	
	@unlink('../../../img_video/'.'kecil_'.$r['gbr_video']);
	@unlink('../../../img_video/'.$r['gbr_video']);

	
	
		mysql_query("UPDATE video SET jdl_video  = '$_POST[jdl_video]',
                                   video_seo   = '$video_seo', 
                                   id_playlist = '$_POST[playlist]',
								   tagvid         = '$tagvid',
								   youtube		= '$_POST[youtube]',
                                   keterangan  = '$_POST[keterangan]',  
                                   gbr_video      = '$nama_file_unik'
                             WHERE id_video   = '$_POST[id]'");
	}
  }
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>
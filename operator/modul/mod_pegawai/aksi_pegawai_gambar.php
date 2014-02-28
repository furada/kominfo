<?php
include "../../../config/koneksi.php";
$b=mysql_fetch_array(mysql_query("SELECT * FROM logo"));
session_start();
$image_path = "../../../img_logo/$b[gambar]";

function watermark_image($oldimage_name){
    global $image_path;
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = $owidth;
	$height = $oheight;    
    $im = imagecreatetruecolor($width, $height);
    $img_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $watermark = imagecreatefrompng($image_path);
    list($w_width, $w_height) = getimagesize($image_path);        
    $pos_x = $width - $w_width -5; 
    $pos_y = $height - $w_height - 5;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $oldimage_name, 100);
    imagedestroy($im);
	return true;
}


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
include "../../../config/fungsi_newsletter.php";




$module=$_GET['module'];
$act=$_GET['act'];

// Hapus artikel
if ($module=='artikel' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM pegawai WHERE id_pegawai='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM pegawai WHERE id_pegawai='$_GET[id]'");
     unlink("../../../img_pegawai/$_GET[namafile]");   
     unlink("../../../img_pegawai/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM pegawai WHERE id_artikel='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module.'&msg=delete');
}




// Hapus terpilih
elseif($module=='pegawai' AND $act=='hapussemua'){
if(isset($_POST['cek'])){
foreach($_POST['cek'] as $cek => $num){
$data=mysql_fetch_array(mysql_query("SELECT gambar FROM pegawai WHERE id_pegawai=$num"));
  if ($data['gambar']!=''){
     unlink("../../../img_pegawai/$data[gambar]");   
     unlink("../../../img_pegawai/small_$data[gambar]");  
} 
mysql_query("DELETE FROM pegawai WHERE id_pegawai=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
}
} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
}
}





// Input artikel
elseif ($module=='pegawai' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  if (!empty($_POST['tag_seo'])){
    $tag_seo = $_POST['tag_seo'];
    $tag=implode(',',$tag_seo);
  }
  $judul_seo      = seo_title($_POST['judul']);



  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
  
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=pegawai)</script>";
    }
    else{
    Uploadartikel($nama_file_unik);
    watermark_image('../../../img_artikel/'.$nama_file_unik);

   mysql_query("INSERT INTO pegawai(   username,
                                      nama,
									    jabatan,
                                    urutan,
                                    gambar,
                                    keterangan,
									    dibaca,
                                    aktif) 
                            VALUES('$_POST[username]',
							  '$_POST[nama]',
							  '$_POST[jabatan]',
                                   '$_POST[urutan]',
								   '$nama_file_unik'
								   '$_POST[keterangan]', 
                                   '$_SESSION[dibaca]',
                                   '$_POST[aktif]'
								   )");
  header('location:../../media.php?module='.$module.'&msg=insert');
 }
  }
  else{
    mysql_query("INSERT INTO pegawai(  judul,
                                      sub_judul,
									      youtube,
                                    judul_seo,
                                    id_kategoriartikel,
                                    headline,
									    dibaca,
                                    username,
                                    isi_artikel,
                                    jam,
                                    tanggal,
                                    tag, 
                                    hari) 
                            VALUES('$_POST[judul]',
								  '$_POST[sub_judul]',
								  '$_POST[youtube]',
                                   '$judul_seo',
                                   '$_POST[kategoriartikel]',
                                   '$_POST[headline]', 

								   '$_POST[dibaca]', 
                                   '$_SESSION[namauser]',
                                   '$_POST[isi_artikel]',
                                   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$tag',
                                   '$hari_ini')");
  header('location:../../media.php?module='.$module.'&msg=insert');
  }
  $jml=count($tag_seo);
  for($i=0;$i<$jml;$i++){
    mysql_query("UPDATE tag SET count=count+1 WHERE tag_seo='$tag_seo[$i]'");
  }
}

// Update artikel
elseif ($module=='pegawai' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  if (!empty($_POST['tag_seo'])){
    $tag_seo = $_POST['tag_seo'];
    $tag=implode(',',$tag_seo);
  }

  $judul_seo = seo_title($_POST['judul']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE pegawai SET judul       = '$_POST[judul]',
	                          sub_judul       = '$_POST[sub_judul]',
							   youtube      = '$_POST[youtube]',
                                   judul_seo   = '$judul_seo', 
                                   id_kategoriartikel= '$_POST[kategoriartikel]',
                                   headline    = '$_POST[headline]',
								     aktif       = '$_POST[aktif]',
								     utama     = '$_POST[utama]',
                                   tag         = '$tag',
                                   isi_artikel  = '$_POST[isi_artikel]',
						 keterangan_gambar  = '$_POST[keterangan_gambar]'  
                             WHERE id_artikel   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&msg=update');
    }
    else{
	
	
    $data_gambar = mysql_query("SELECT gambar FROM pegawai WHERE id_pegawai='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../img_pegawai/'.$r['gambar']);
	@unlink('../../../img_pegawai/'.'small_'.$r['gambar']);
    Uploadartikel($nama_file_unik,'../../../pegawai/',300,120);
	watermark_image('../../../img_pegawai/'.$nama_file_unik);

	
    mysql_query("UPDATE pegawai SET judul       = '$_POST[judul]',
	                        sub_judul       = '$_POST[sub_judul]',
							  youtube      = '$_POST[youtube]',
                                   judul_seo   = '$judul_seo', 
                                   id_kategoriartikel = '$_POST[kategoriartikel]',
                               headline    = '$_POST[headline]',
								   	 aktif       = '$_POST[aktif]',
								   utama      = '$_POST[utama]',
                                   tag         = '$tag',
                                   isi_artikel  = '$_POST[isi_artikel]',
										  keterangan_gambar  = '$_POST[keterangan_gambar]',   
                                   gambar      = '$nama_file_unik'     
                             WHERE id_artikel   = '$_POST[id]'");
if(isset($_POST['kirimnewsletter']) && $_POST['kirimnewsletter']=='ya'){
		$id=mysql_insert_id();
		echo getNewsletter($id);
		}
   header('location:../../media.php?module='.$module.'&msg=update');
   }
  }
}
?>

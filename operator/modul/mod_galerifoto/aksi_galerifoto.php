<?php
session_start();

$image_path = "../../../img_logo/zal_marking.png";
$font_path = "RIZAL.TTF";
$font_size = 14;       // in pixcels
//$water_mark_text_1 = "9";
$water_mark_text_2 = "TerasKreasi";

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
    $pos_x = $width - $w_width -10; 
    $pos_y = $height - $w_height - 10;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $oldimage_name, 100);
    imagedestroy($im);
	return true;
}

//fungsi thumb logo
function thumb_logo($nama_file){
//identitas file asli  
  $im_src = imagecreatefrompng($nama_file);
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);
  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 150;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagepng($im,"logo.png");
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
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

$module=$_GET[module];
$act=$_GET[act];

// Hapus gallery
if ($module=='galerifoto' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gbr_gallery FROM gallery WHERE id_gallery='$_GET[id]'"));
  if ($data['gbr_gallery']!=''){
     mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
     unlink("../../../img_galeri/$_GET[namafile]");   
     unlink("../../../img_galeri/kecil_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module.'&msg=delete');


  mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}



// Hapus terpilih
elseif($module=='galerifoto' AND $act=='hapussemua'){
if(isset($_POST['cek'])){
foreach($_POST['cek'] as $cek => $num){
$data=mysql_fetch_array(mysql_query("SELECT gbr_gallery FROM gallery WHERE id_gallery=$num"));
  if ($data['gbr_gallery']!=''){
     unlink("../../../img_galeri/$data[gbr_gallery]");   
     unlink("../../../img_galeri/kecil_$data[gbr_gallery]");  
} 
mysql_query("DELETE FROM gallery WHERE id_gallery=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
}
} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
}
}


// Input gallery
elseif ($module=='galerifoto' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

 $gallery_seo = seo_title($_POST['jdl_gallery']);
 if($_POST['slide']=='1'){
	$sqlUp="update gallery set slide='0' where id_album='$_POST[album]'";
	 mysql_query($sqlUp);
 }

  // Apabila ada gbr_gallery yang diupload
  if (!empty($lokasi_file)){
   // UploadGaleri($nama_file_unik);
	UploadGaleri($nama_file_unik,'../../../img_galeri/',300,120);
	watermark_image('../../../img_galeri/'.$nama_file_unik);
	watermark_image('../../../img_galeri/kecil_'.$nama_file_unik);

   mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    id_album,
									username,
                                    keterangan,
                                    gbr_gallery, slide) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[album]',
								   '$_SESSION[namauser]',
                                   '$_POST[keterangan]',
                                   '$nama_file_unik', '$_POST[slide]')");
								   
								   
  header('location:../../media.php?module='.$module.'&msg=insert');
  }
  else{
     mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    id_album,
									username,
                                    keterangan, slide) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[album]', 
								   '$_SESSION[namauser]',
                                   '$_POST[keterangan]', '$_POST[slide]')");
								   
								   
								   
  header('location:../../media.php?module='.$module.'&msg=insert');
  }
}

// Update gallery
elseif ($module=='galerifoto' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $gallery_seo = seo_title($_POST['jdl_gallery']);
  
  
  if($_POST['slide']=='1'){
	$sqlUp="update gallery set slide='0' where id_album='$_POST[album]'";
	 mysql_query($sqlUp);
 }

  // Apabila gbr_gallery tidak diganti
  if (empty($lokasi_file)){
     mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]',
                                   keterangan  = '$_POST[keterangan]', 
								   slide='$_POST[slide]' 
                             WHERE id_gallery   = '$_POST[id]'");
							 
   header('location:../../media.php?module='.$module.'&msg=update');
  }
  else{    
    //UploadGaleri($nama_file_unik);
	// Penambahan fitur unlink utk menghapus file yg lama biar gak ngebek-ngebeki server ^_^
	$data_gbr_gallery= mysql_query("SELECT gbr_gallery FROM gallery WHERE id_gallery='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gbr_gallery);
	@unlink('../../../img_galeri/'.$r['gbr_gallery']);
	@unlink('../../../img_galeri/'.'kecil_'.$r['gbr_gallery']);
    UploadGaleri($nama_file_unik,'../../../img_galeri/',300,120);
	watermark_image('../../../img_galeri/'.$nama_file_unik);
	watermark_image('../../../img_galeri/kecil_'.$nama_file_unik);
	
	 mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]',
                                   keterangan  = '$_POST[keterangan]',  
                                   gbr_gallery      = '$nama_file_unik',  
								   slide='$_POST[slide]' 
                             WHERE id_gallery   = '$_POST[id]'");
							 
							 
							 
   header('location:../../media.php?module='.$module.'&msg=update');
	}
    
  }

}
?>

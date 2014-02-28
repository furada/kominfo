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
    $pos_x = $width - $w_width -15; 
    $pos_y = $height - $w_height -15;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $oldimage_name, 100);
    imagedestroy($im);
	return true;
}




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
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";

$module=$_GET['module'];
$act=$_GET['act'];



// Hapus pegawai
if ($module=='pegawai' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM pegawai WHERE id_pegawai='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM pegawai WHERE id_pegawai='$_GET[id]'");
     unlink("../../../img_pegawai/$_GET[namafile]");   
     unlink("../../../img_pegawai/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM pegawai WHERE id_pegawai='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module.'&msg=delete');
}


// Input pegawai

if ($module=='pegawai' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
 
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
  
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=pegawai)</script>";
    }
    else{
    Uploadpegawai($nama_file_unik);
    watermark_image('../../../img_pegawai/'.$nama_file_unik);

   mysql_query("INSERT INTO pegawai(username, nama, nip, tlahir, tgllahir, gol, tmtgol, jabatan, tmtjabatan, pendidikan, universitas, thnlulus, ijazah, urutan, gambar,keterangan,aktif) 
                            VALUES( '$_SESSION[namauser]','$_POST[nama]', '$_POST[nip]', '$_POST[tlahir]', '$_POST[tgllahir]', '$_POST[gol]', '$_POST[tmtgol]', '$_POST[jabatan]', '$_POST[tmtjabatan]', '$_POST[pendidikan]', '$_POST[universitas]', '$_POST[thnlulus]', '$_POST[ijazah]',
                                   '$_POST[urutan]','$nama_file_unik',
                                   '$_POST[keterangan]', '$_POST[aktif]')");
  header('location:../../media.php?module='.$module.'&msg=insert');
 }
  }
  else{
    mysql_query("INSERT INTO pegawai(username, nama, nip, tlahir, tgllahir, gol, tmtgol, jabatan, tmtjabatan, pendidikan, universitas, thnlulus, ijazah, jabatan,urutan, keterangan,aktif) 
                            VALUES('$_SESSION[namauser]','$_POST[nama]', '$_POST[nip]', '$_POST[tlahir]', '$_POST[tgllahir]', '$_POST[gol]', '$_POST[tmtgol]', '$_POST[jabatan]', '$_POST[tmtjabatan]', '$_POST[pendidikan]', '$_POST[universitas]', '$_POST[thnlulus]', '$_POST[ijazah]',
                                   '$_POST[urutan]',
                                   '$_POST[keterangan]', 
								   '$_POST[aktif]')");

  header('location:../../media.php?module='.$module.'&msg=insert');
  }
 
}


// Update pegawai
elseif ($module=='pegawai' AND $act=='update'){
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
     // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE pegawai SET nama       = '$_POST[nama]',
	                          jabatan       = '$_POST[jabatan]',
							   urutan      = '$_POST[urutan]',
								 aktif       = '$_POST[aktif]',
						 	keterangan = '$_POST[keterangan]'  
                             WHERE id_pegawai   = '$_POST[id]'");

  header('location:../../media.php?module='.$module.'&msg=update');
    }
    else{
	
	
    $data_gambar = mysql_query("SELECT gambar FROM pegawai WHERE id_pegawai='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../img_pegawai/'.$r['gambar']);
	@unlink('../../../img_pegawai/'.'small_'.$r['gambar']);
    Uploadpegawai($nama_file_unik,'../../../img_pegawai/',300,120);
	watermark_image('../../../img_pegawai/'.$nama_file_unik);

	
    mysql_query("UPDATE pegawai SET nama       = '$_POST[nama]',
	                          jabatan       = '$_POST[jabatan]',
							   urutan      = '$_POST[urutan]',
								 aktif       = '$_POST[aktif]',
						 	keterangan = '$_POST[keterangan]',  
                                   gambar      = '$nama_file_unik'     
                             WHERE id_pegawai   = '$_POST[id]'");

   header('location:../../media.php?module='.$module.'&msg=update');
   }
}

// Update id order posup
elseif ($module=='pegawai' AND $act=='posup'){
	$id=abs((int)$_GET['id']);
	$urutan=abs((int)$_GET['urutan']);
	$edit_order=$urutan-1;
	mysql_query("UPDATE pegawai SET urutan='$edit_order' WHERE id_pegawai=$id")or die(mysql_error());
	mysql_query("UPDATE pegawai SET urutan='$urutan' WHERE id_pegawai!=$id AND urutan=$edit_order")or die(mysql_error());
   header('location:../../media.php?module='.$module.'&msg=update');
}

// Update id order posup
elseif ($module=='pegawai' AND $act=='posdo'){
	$id=abs((int)$_GET['id']);
	$urutan=abs((int)$_GET['urutan']);
	$edit_order=$urutan+1;
	mysql_query("UPDATE pegawai SET urutan='$edit_order' WHERE id_pegawai=$id")or die(mysql_error());
	mysql_query("UPDATE pegawai SET urutan='$urutan' WHERE id_pegawai!=$id AND urutan=$edit_order")or die(mysql_error());
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>

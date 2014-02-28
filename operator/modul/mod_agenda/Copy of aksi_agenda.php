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
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus agenda
if ($module=='agenda' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM agenda WHERE id_agenda='$_GET[id]'"));
  if ($data['gambar']!=''){
  mysql_query("DELETE FROM agenda WHERE id_agenda='$_GET[id]'");
     unlink("../../../img_agenda/$_GET[namafile]");   
     unlink("../../../img_agenda/small_$_GET[namafile]");   
  }
  else{
  mysql_query("DELETE FROM agenda WHERE id_agenda='$_GET[id]'");  
  }
  header('location:../../media.php?module='.$module.'&msg=delete');
}




// Hapus terpilih
elseif($module=='agenda' AND $act=='hapussemua'){
if(isset($_POST['cek'])){
foreach($_POST['cek'] as $cek => $num){
$data=mysql_fetch_array(mysql_query("SELECT gambar FROM agenda WHERE id_agenda=$num"));
  if ($data['gambar']!=''){
     unlink("../../../img_agenda/$data[gambar]");   
     unlink("../../../img_agenda/small_$data[gambar]");  
} 
mysql_query("DELETE FROM agenda WHERE id_agenda=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
}
} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
}
}





// Input agenda
elseif ($module=='agenda' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file   = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
  $selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];
  
  $tema_seo = seo_title($_POST['tema']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=agenda')</script>";
    }
    else{
    UploadAgenda($nama_file_unik);
    mysql_query("INSERT INTO agenda(tema,
                                  tema_seo, 
                                  isi_agenda,
                                  tempat,
                                  jam,
                                  tanggal_agenda,
                                  tgl_posting,
                                  pengirim,
                                  gambar, 
                                  username) 
					                VALUES('$_POST[tema]',
					                       '$tema_seo', 
                                 '$_POST[isi_agenda]',
                                 '$_POST[tempat]',
                                 '$_POST[jam]',
                                 '$_POST[tanggal_agenda]',
                                 '$tgl_sekarang',
                                 '$_POST[pengirim]',
                                 '$nama_file_unik',
                                 '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module.'&msg=insert');
  }
  }
  else{
    mysql_query("INSERT INTO agenda(tema,
                                  tema_seo, 
                                  isi_agenda,
                                  tempat,
                                  jam,
                                  tanggal_agenda,
                                  tgl_posting,
                                  pengirim,
                                  username) 
					                VALUES('$_POST[tema]',
					                       '$tema_seo', 
                                 '$_POST[isi_agenda]',
                                 '$_POST[tempat]',
                                 '$_POST[jam]',
                                 '$_POST[tanggal_agenda]',
                                 '$tgl_sekarang',
                                 '$_POST[pengirim]',
                                 '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module.'&msg=insert');
  }
}

// Update agenda
elseif ($module=='agenda' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
  $selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];

  $tema_seo = seo_title($_POST['tema']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
  mysql_query("UPDATE agenda SET tema        = '$_POST[tema]',
                                 tema_seo    = '$tema_seo',
                                 isi_agenda  = '$_POST[isi_agenda]',
                                 tempat      = '$_POST[tempat]',  
                                 jam         = '$_POST[jam]',
                            tanggal_agenda   = '$_POST[tanggal_agenda]',
                                 pengirim    = '$_POST[pengirim]'  
                           WHERE id_agenda   = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=album')</script>";
    }
    else{
	
	$data_gambar = mysql_query("SELECT gambar FROM agenda WHERE id_agenda='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../img_agenda/'.$r['gambar']);
	@unlink('../../../img_agenda/'.'small_'.$r['gambar']);
    UploadAgenda($nama_file_unik,'../../../img_agenda/',300,120);
	
  
    mysql_query("UPDATE agenda SET tema      = '$_POST[tema]',
                                 tema_seo    = '$tema_seo',
                                 isi_agenda  = '$_POST[isi_agenda]',
                                 tempat      = '$_POST[tempat]',  
                                 jam         = '$_POST[jam]',  
                            tanggal_agenda   = '$_POST[tanggal_agenda]',
                                 gambar      = '$nama_file_unik', 
                                 pengirim    = '$_POST[pengirim]'  
                           WHERE id_agenda   = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
  }
  }
}
}
?>

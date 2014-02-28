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
  //cek hak akses user
  $cek=user_akses($_GET[module],$_SESSION[sessid]);
  if($cek==1 OR $_SESSION[leveluser]=='admin'){


  $aksi="modul/mod_galerifoto2/aksi_galerifoto.php";
  switch($_GET[act]){

  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Galeri Foto Kolase.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Galeri Foto Kolase.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Galeri Foto Kolase.
  </div>";}
  
   
  echo "
  <div class='workplace'>
  <form action='$aksi?module=galerifoto2&act=hapussemua' method='post'>
  
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>GALERI FOTO KOLASE</h1>   
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=galerifoto2&act=tambahgalerifoto'><span class='isw-plus'></span> Tambahkan Foto</a></li>
  <li><input type='submit' value='Hapus yang terseleksi' class='btn btn-warning' style='width: 150px; height: 30px;'></li>
  </ul>
  </li>
  </ul>     
                              
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid table-sorting'>
  <table cellpadding='0' cellspacing='0' width='100%' class='table' id='tSortable'>
	  
 
  <thead>
  <tr>
  <th><center><input type='checkbox' name='checkall' class='checkall' /></center></th>
  <th><center>Foto</center></th>
  <th>Judul Foto Kolase</th>
  <th>Album</th>
  <th>Oleh</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
  
	
  if ($_SESSION['leveluser']=='admin'){
  $tampil = mysql_query("SELECT * FROM gallery2  ORDER BY id_gallery DESC");}
	
  else{
    
  echo "<span class style=\"color:#FAFAFA;margin-top:-40px;\">$_SESSION[namauser]</span>";
  $tampil = mysql_query("SELECT * FROM gallery2  
  gallery.username='$_SESSION[namauser]' ORDER BY id_gallery DESC");}
   
   
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
 
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_gallery]'></center></td>
  
  <td width=50><center>
  <a class='fancybox' rel='group' href='../img_galeri2/$r[gbr_gallery]'>
  <img src='../img_galeri2/$r[gbr_gallery]' width=50 class='ttLT'' title='Perbesar Gambar'></a>
  </center></td>
  
  <td>$r[jdl_gallery]</td>
  <td></td>
   <td>$r[username]</td>
  <td width='8%'>
  <a href=?module=galerifoto2&act=editgalerifoto&id=$r[id_gallery]>
  <center><img src='img/edit.png' class='ttLT'' title='Edit Foto'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=galerifoto2&act=hapus&id=$r[id_gallery]&namafile=$r[gbr_gallery]') >
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Foto'></center></a> 
  </td>
	  
  </tr>";
   
  $no++;}
  
  echo "</table></form>
  <div class='clear'></div>
  </div>
  </div>                                
  </div>            
  <div class='dr'><span></span></div>";
 
 
  break;    
  //TAMBAH FOTO//////////////////////////////////////////////////////////////////////////////////////////
  case "tambahgalerifoto":
 
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Foto Kolase</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=galerifoto2&act=input' enctype='multipart/form-data' >


  <div class='row-form'>
  <div class='span3'>Judul Foto</div>
  <div class='span9'><input type=text name='jdl_gallery'></div>
  <div class='clear'></div>
  </div>    


  <div class='row-form'>
  <div class='span3'>Album</div>
  <div class='span9'>
  <select name='album'>
  <option value=0 selected>Pilih Album</option>";
 
 
  echo "</select></div> <div class='clear'></div>
  </div>    

   
  <div class='row-form'>
  <div class='span3'>Keterangan</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan' style='height: 200px;'></textarea></div>
  <div class='clear'></div>
  </div>    
	
	
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>    
	
	
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=galerifoto2'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
	
	
   
  break;
  // EDIT FOTO //////////////////////////////////////////////////////////////////////////
  case "editgalerifoto":
  
   if ($_SESSION['leveluser']=='admin'){
  $edit = mysql_query("SELECT * FROM gallery2 WHERE id_gallery='$_GET[id]'");}
  
  else{
	  $edit = mysql_query("SELECT * FROM gallery2 WHERE id_gallery='$_GET[id]' AND username='$_SESSION[namauser]'");}
  $r    = mysql_fetch_array($edit);

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Foto</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
	
  <form method=POST enctype='multipart/form-data' action=$aksi?module=galerifoto2&act=update class='editprofileform'>
  <input type=hidden name=id value=$r[id_gallery]>
	
	
  <div class='row-form'>
  <div class='span3'>Judul Foto Kolase</div>
  <div class='span9'><input type=text name='jdl_gallery' value='$r[jdl_gallery]'></div>
  <div class='clear'></div>
  </div>    
	
	
	   
  <div class='row-form'>
  <div class='span3'>Album</div>
  <div class='span9'>
  <select name='album'>";
    
  echo "</select></div> <div class='clear'></div>
  </div>    
	
	
  <div class='row-form'>
  <div class='span3'>Keterangan</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan' style='height: 200px;'>$r[keterangan]</textarea></div>
  <div class='clear'></div>
  </div>    
	
		  
  <div class='row-form'>
  <div class='span3'>Foto</div>";
  if ($r[gbr_gallery]!=''){
  echo "<div class='span9'>
  <a class='fancybox' rel='group' href='../img_galeri2/$r[gbr_gallery]'>
  <img src='../img_galeri2/$r[gbr_gallery]' width=200 class='ttLT'' title='Perbesar Gambar'></a></div>
  <div class='clear'></div>
  </div>";}
  
  
		  
  echo "
  <div class='row-form'>
  <div class='span3'>Ganti Foto</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>
  
	
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=galerifoto2'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
	
	  
    break;  
   }
   //kurawal akhir hak akses module
   } else {
	echo akses_salah();
   }
   }
   ?>

  <script>
  function confirmdelete(delUrl) {
  if (confirm("Anda yakin ingin menghapus?")) {
  document.location = delUrl;}}
  </script>

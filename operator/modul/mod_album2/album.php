  <script>
  function confirmdelete(delUrl) {
  if (confirm("Anda yakin ingin menghapus?")) {
  document.location = delUrl;}}
  </script>


<?php    
session_start();
  //Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
  if(count(get_included_files())==1)
  {
  echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
  exit("Direct access not permitted.");}
  
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  /////////////////////////////////////////////////////////////////////////////////////
   
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


  $aksi="modul/mod_album/aksi_album.php";
  switch($_GET[act]){


  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Album Foto.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Album Foto.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Album Foto.
  </div>";}
  


  echo "
  <div class='workplace'>
  <form action='$aksi?module=album&act=hapussemua' method='post'>
   
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>ALBUM FOTO</h1>   
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=album&act=tambahalbum'><span class='isw-plus'></span> Tambahkan Album</a></li>
  <li><input type='submit' value='Hapus yang terseleksi' class='btn btn-warning' style='width: 150px; height: 30px;'></li>
  </ul>
  </li>
  </ul>     
                              
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid table-sorting'>
  <table cellpadding='0' cellspacing='0' width='100%' class='table' id='tSortable'>";

  if (empty($_GET['kata'])){

  echo "
  <thead>
  <tr>
  <th><center><input type='checkbox' name='checkall' class='checkall' /></center></th>
  <th><center>Foto</center></th>
  <th>Judul Album</th>
  <th>Link</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
  

  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM album ORDER BY id_album DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM album 
  WHERE username='$_SESSION[namauser]'       
  ORDER BY id_album DESC");}
  
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
  
	
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_album]'></center></td>
  
  <td width=50><center>
  <a class='fancybox' rel='group' href='../img_album/$r[gbr_album]'>
  <img src='../img_album/kecil_$r[gbr_album]' width=50 class='ttLT'' title='Perbesar Gambar'></a>
  </center></td>
  
  <td>$r[jdl_album]</td>
  <td>album-$r[id_album]-$r[album_seo].html</td>
			 
  <td width='8%'>
  <a href=?module=album&act=editalbum&id=$r[id_album]>
  <center><img src='img/edit.png' class='ttLT' title='Edit Album'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=album&act=hapus&id=$r[id_album]&namafile=$r[gbr_album]')  >
  <center><img src='img/hapus.png' class='ttLT'  title='Hapus Album'></center></a> 
  </td>
	  
  </tr>";
   
  $no++;}
  
  echo "</table></form>
  <div class='clear'></div>
  </div>
  </div>                                
  </div>            
  <div class='dr'><span></span></div>";

  if ($_SESSION[leveluser]=='admin'){
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM album"));}
  
  else{
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM album WHERE username='$_SESSION[namauser]'"));}  
  
  break; }
  
  else{
	  
  echo "
  <thead>
  <tr>
  <th><center><input type='checkbox' name='checkall' class='checkall' /></center></th>
  <th><center>Foto</center></th>
  <th>Judul Album</th>
  <th>Link</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";

  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM album WHERE judul LIKE '%$_GET[kata]%' ORDER BY id_album DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM album 
  WHERE username='$_SESSION[namauser]'
  AND judul LIKE '%$_GET[kata]%'       
  ORDER BY id_album DESC");}
  
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
  
	  
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_album]'></center></td>
  
  <td width=50><center>
  <a class='fancybox' rel='group' href='../img_album/$r[gbr_album]'>
  <img src='../img_album/kecil_$r[gbr_album]' width=50 class='ttLT'' title='Perbesar Gambar'></a>
  </center></td>
  
  <td>$r[jdl_album]</td>
  <td>album-$r[id_album]-$r[album_seo].html</td>
			 
  <td width='8%'>
  <a href=?module=album&act=editalbum&id=$r[id_album]>
  <center><img src='img/edit.png' class='ttLT'' title='Edit Album'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=album&act=hapus&id=$r[id_album]&namafile=$r[gbr_album]')  >
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Album'></center></a> 
  </td>
	  
  </tr>";
   
  $no++;}
  echo "</table></form>
  <div class='clear'></div>
  </div>
  </div>                                
  </div>            
  <div class='dr'><span></span></div>";

  if ($_SESSION[leveluser]=='admin'){
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM album WHERE jdl_album LIKE '%$_GET[kata]%'"));}
  
  else{
  
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM album WHERE username='$_SESSION[namauser]' 
  AND jdl_album LIKE '%$_GET[kata]%'"));}  
  
  
  break;}
  // TAMBAH ALBUM////////////////////////////////////////////////////////////////////////////
  case "tambahalbum":

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Album Foto</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=album&act=input' enctype='multipart/form-data'>
	
   
  <div class='row-form'>
  <div class='span3'>Judul Album</div>
  <div class='span9'><input type=text name='jdl_album'></div>
  <div class='clear'></div>
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
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=album'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
  
	
		  
  break;
  //EDIT ALBUM///////////////////////////////////////////////////////////////////////////////////////
  case "editalbum":
  $edit = mysql_query("SELECT * FROM album WHERE id_album='$_GET[id]' AND username='$_SESSION[namauser]'");
  $r    = mysql_fetch_array($edit);

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Album Foto</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             

  <form method=POST enctype='multipart/form-data' action=$aksi?module=album&act=update>
  <input type=hidden name=id value='$r[id_album]'>
		
  
  <div class='row-form'>
  <div class='span3'>Judul Album</div>
  <div class='span9'><input type=text name='jdl_album' value='$r[jdl_album]'></div>
  <div class='clear'></div>
  </div>    
  
	
  <div class='row-form'>
  <div class='span3'>Keterangan</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan' style='height: 200px;'>$r[keterangan]</textarea></div>
  <div class='clear'></div>
  </div>    
	
	
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><a class='fancybox' rel='group' href='../img_album/$r[gbr_album]'>
  <img src='../img_album/kecil_$r[gbr_album]' width=200 class='ttLT'' title='Perbesar Gambar'></a></div>
  <div class='clear'></div>
  </div>    
	
  <div class='row-form'>
  <div class='span3'>Ganti Gambar</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>";  
	
   
   if ($r[aktif]=='Y'){
   echo "
   <div class='row-form'>
   <div class='span3'>Aktifkan</div>
   <div class='span9'>
   <input type=radio name='aktif' value='Y' checked>Ya
   <input type=radio name='aktif' value='N'>Tidak
   </div>
   <div class='clear'></div>
   </div>";}
									  
   else{
   echo "
   <div class='row-form'>
   <div class='span3'>Aktifkan</div>
   <div class='span9'>
   <input type=radio name='aktif' value='Y'>Ya
   <input type=radio name='aktif' value='N' checked>Tidak
   </div>
   <div class='clear'></div>
   </div>";}
									  
   
  echo "
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=album'>Batal</a>
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

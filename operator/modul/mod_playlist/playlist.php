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


  $aksi="modul/mod_playlist/aksi_playlist.php";
  switch($_GET[act]){

  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Playlist Video.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Playlist Video.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Playlist Video.
  </div>";}

  
   
  echo "
  <div class='workplace'>
  <form action='$aksi?module=playlist&act=hapussemua' method='post'>

  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>PLAYLIST VIDEO</h1> 
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=playlist&act=tambahplaylist'><span class='isw-plus'></span> Tambahkan Playlist</a></li>
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
  <th><center>Gambar</center></th>
  <th>Judul Playlist</th>
  <th>Link</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
  
	
  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM playlist ORDER BY id_playlist DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM playlist 
  WHERE username='$_SESSION[namauser]'       
  ORDER BY id_playlist  DESC");}
	
	
  $no=1;
  while ($r=mysql_fetch_array($tampil)){
	
	

  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_playlist]'></center></td>
  
  <td><center>
  <a class='fancybox' rel='group' href='../img_playlist/$r[gbr_playlist]'>
  <img width=50 src='../img_playlist/kecil_$r[gbr_playlist]'class='ttLT'' title='Perbesar Gambar'></a>
  </center></td>
  
  <td>$r[jdl_playlist]</td>
  <td>playlist-$r[id_playlist]-$r[playlist_seo].html</td>
   
  <td width='8%'>
  <a href=?module=playlist&act=editplaylist&id=$r[id_playlist] >
  <center><img src='img/edit.png' class='ttLT'' title='Edit Playlist'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=playlist&act=hapus&id=$r[id_playlist]&namafile=$r[gbr_playlist]')>
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Playlist'></center></a> 
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
  //TAMBAH PLAYLIST/////////////////////////////////////////////////////////////////////////////////////
  case "tambahplaylist":
  
  
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Playlist</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=playlist&act=input' enctype='multipart/form-data'>
		  

  <div class='row-form'>
  <div class='span3'>Judul Playlist</div>
  <div class='span9'><input type=text name='jdl_playlist'></div>
  <div class='clear'></div>
  </div>    
   
  
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>    


  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=playlist'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
  


  break;
  //EDIT PLAYLIST//////////////////////////////////////////////////////////////////////////////////////////////
  case "editplaylist":
  $edit=mysql_query("SELECT * FROM playlist WHERE id_playlist='$_GET[id]'");
  $r=mysql_fetch_array($edit);
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Playlist</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
   
  <form method=POST enctype='multipart/form-data' action=$aksi?module=playlist&act=update>
  <input type=hidden name=id value='$r[id_playlist]'>
		  

  <div class='row-form'>
  <div class='span3'>Judul Playlist</div>
  <div class='span9'><input type=text name='jdl_playlist' value='$r[jdl_playlist]'></div>
  <div class='clear'></div>
  </div>    
	
		
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><a class='fancybox' rel='group' href='../img_playlist/$r[gbr_playlist]'>
  <img src='../img_playlist/kecil_$r[gbr_playlist]' width=200 class='ttLT'' title='Perbesar Gambar'></a></div>
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
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=playlist'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
  
  
	
  break;  }} 
  else {
  echo akses_salah();}}
  ?>
  
  <script>
  function confirmdelete(delUrl) {
  if (confirm("Anda yakin ingin menghapus?")) {
  document.location = delUrl;}}
  </script>


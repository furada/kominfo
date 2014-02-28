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

  $aksi="modul/mod_menuutama/aksi_menuutama.php";
  switch($_GET[act]){
  
  default:
  
  
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Menu.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Menu.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Menu.
  </div>";}
  
	
  echo "
  <div class='workplace'>
  <form action='$aksi?module=menuutama&act=hapussemua' method='post'>
   
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>MENU WEBSITE (ATAS)</h1>  
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=menuutama&act=tambahmenuutama'><span class='isw-plus'></span> Tambahkan Menu</a></li>
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
  <th>Menu Atas</th>
  <th>Link</th>
  <th>Urutan</th>
  <th>Aktif</th>
  <th>Aksi</th>
  </tr>
  </thead>";
   
  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM mainmenu ORDER BY urutan DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM mainmenu WHERE username='$_SESSION[namauser]' ORDER BY urutan DESC");}
	
	
  $no=1;
  while ($r=mysql_fetch_array($tampil)){
  $id=$r['id_main'];
				
   //menu pengaturan posisi
	$desc=mysql_fetch_array(mysql_query("SELECT * FROM mainmenu ORDER BY urutan DESC LIMIT 1"));
	$urutan_desc = $desc['urutan'];
	if($r['urutan']<=1){
	$menu_posisi="<lable><img src='img/blank.png'>
	<a href='$aksi?module=menuutama&act=posdo&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/down.png'></a></lable>";}
	
	elseif($r['urutan']<$urutan_desc) {
	$menu_posisi="<a href='$aksi?module=menuutama&act=posup&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/up.png'></a><a href='$aksi?module=menuutama&act=posdo&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/down.png'></a>";}
	
	elseif($r['urutan']>=$urutan_desc){
	$menu_posisi="<a href='$aksi?module=menuutama&act=posup&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/up.png'></a>
	<img src='img/blank.png'>";}
	
	
	
  echo "<tr class=gradeX> 
  <td>$r[nama_menu]</td>
  <td>$r[link]</td>
  <td><center><input id='25' type=text value='$r[urutan]' disabled></div>&nbsp;$menu_posisi</center></td>
  <td><center>$r[aktif]</center></td>
   
  <td>
  <a href=?module=menuutama&act=editmenuutama&id=$r[id_main]>
  <center><img src='img/edit.png' class='ttLC' title='Edit Menu'></center></a>
  </td>
   
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
  ///TAMBAH MENU ////////////////////////////////////////////////////////////////////////////////////////
 case "tambahmenuutama":
 
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Menu (Atas)</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=menuutama&act=input'>
		  
  <div class='row-form'>
  <div class='span3'>Nama Menu</div>
  <div class='span9'><input type=text name='nama_menu'></div>
  <div class='clear'></div>
  </div>    
   
  <div class='row-form'>
  <div class='span3'>Link Menu</div>
  <div class='span9'>  <input type=text name='link'></div>
  <div class='clear'></div>
  </div>    
   		
		
  <div class='row-form'>
  <div class='span3'>Urutan</div>
  <div class='span9'>  <input type=text name='urutan' value='$r[urutan]'></div>
  <div class='clear'></div>
  </div>    
		
	 
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=menuutama'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
	 
	 
	 
  break;
  ///EDIT MENU ////////////////////////////////////////////////////////////////////////////////////////
  case "editmenuutama":
  $edit=mysql_query("SELECT * FROM mainmenu WHERE id_main='$_GET[id]'");
  $r=mysql_fetch_array($edit);

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Menu</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action=$aksi?module=menuutama&act=update>
  <input type=hidden name=id value='$r[id_main]'>	  

   
  <div class='row-form'>
  <div class='span3'>Nama Menu</div>
  <div class='span9'>  <input type=text name='nama_menu' value='$r[nama_menu]'></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <div class='span3'>Link Menu</div>
  <div class='span9'><input type=text name='link' value='$r[link]'></div>
  <div class='clear'></div>
  </div>    
   
  <div class='row-form'>
  <div class='span3'>Urutan</div>
  <div class='span9'>  <input type=text name='urutan' value='$r[urutan]'></div>
  <div class='clear'></div>
  </div>";
   
  if ($r[aktif]=='Ya'){
  echo "
  <div class='row-form'>
  <div class='span3'>Aktifkan</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Ya' checked>Ya
  <input type=radio name='aktif' value='Tidak'>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
									  
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Aktifkan</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Ya'>Ya
  <input type=radio name='aktif' value='Tidak' checked>Tidak
  </div>
  <div class='clear'></div>
  </div>";}


	  
  echo "
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=menuutama'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";  
  
  break;}} 
	
  else {
  echo akses_salah();
  }
  }
  ?>


  <script>
  function confirmdelete(delUrl) {
  if (confirm("Anda yakin ingin menghapus?")) {
  document.location = delUrl;}}
  </script>

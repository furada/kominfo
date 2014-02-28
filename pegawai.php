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

  $aksi="modul/mod_pegawai/aksi_pegawai.php";
  switch($_GET[act]){
  
  default:
  
  
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Pegawai.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Pegawai.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Pegawai.
  </div>";}
  
	
  echo "
  <div class='workplace'>
  <form action='$aksi?module=mod_pegawai&act=hapussemua' method='post'>
   
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>MENU PEGAWAI</h1>  
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=pegawai&act=tambahpegawai'><span class='isw-plus'></span> Tambahkan Pegawai</a></li>
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
  <th>Nama Pegawai</th>
  <th>jabatan</th>
  <th>Urutan</th>
  <th>Aktif</th>
  <th>Edit</th>
    <th>Hapus</th>
  </tr>
  </thead>";
   
  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM pegawai ORDER BY urutan DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM pegawai WHERE username='$_SESSION[namauser]' ORDER BY urutan DESC");}
	
	
  $no=1;
  while ($r=mysql_fetch_array($tampil)){
  $id=$r['id_pegawai'];
				
   //menu pengaturan posisi
	$desc=mysql_fetch_array(mysql_query("SELECT * FROM pegawai ORDER BY urutan DESC LIMIT 1"));
	$urutan_desc = $desc['urutan'];
	if($r['urutan']<=1){
	$menu_posisi="<lable><img src='img/blank.png'>
	<a href='$aksi?module=pegawai&act=posdo&id=$r[id_pegawai]&urutan=$r[urutan]'>
	<img src='img/down.png'></a></lable>";}
	
	elseif($r['urutan']<$urutan_desc) {
	$menu_posisi="<a href='$aksi?module=pegawai&act=posup&id=$r[id_pegawai]&urutan=$r[urutan]'>
	<img src='img/up.png'></a><a href='$aksi?module=pegawai&act=posdo&id=$r[id_pegawai]&urutan=$r[urutan]'>
	<img src='img/down.png'></a>";}
	
	elseif($r['urutan']>=$urutan_desc){
	$menu_posisi="<a href='$aksi?module=pegawai&act=posup&id=$r[id_pegawai]&urutan=$r[urutan]'>
	<img src='img/up.png'></a>
	<img src='img/blank.png'>";}
	
	
	
  echo "<tr class=gradeX> 
  <td>$r[nama]</td>
  <td>$r[jabatan]</td>
  <td><center><input id='25' type=text value='$r[urutan]' disabled></div>&nbsp;$menu_posisi</center></td>
  <td><center>$r[aktif]</center></td>
   
  <td>
  <a href=?module=pegawai&act=editpegawai&id=$r[id_pegawai]>
  <center><img src='img/edit.png' class='ttLC' title='Edit Menu'></center></a>
  </td>
   
    <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=pegawai&act=hapus&id=$r[id_pegawai]&namafile=$r[gambar]')>
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Pegawai'></center></a> 

   
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
  ///TAMBAH PEGAWAI ////////////////////////////////////////////////////////////////////////////////////////
 case "tambahpegawai":
 
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Pegawai</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=pegawai&act=input' enctype='multipart/form-data'>
		  
  <div class='row-form'>
  <div class='span3'>Nama Pegawai</div>
  <div class='span9'><input type=text name='nama'></div>
  <div class='clear'></div>
  </div>  
  
  <div class='row-form'>
  <div class='span3'>NIP</div>
  <div class='span9'><input type=text name='nip'></div>
  <div class='clear'></div>
  </div>    
   
  <div class='row-form'>
  <div class='span3'>Tempat Lahir</div>
  <div class='span9'><input type=text name='tlahir'></div>
  <div class='clear'></div>
  </div>
   
  <div class='row-form'>
  <div class='span3'>Tgl Lahir</div>
  <div class='span9'><input type=text name='tgllahir'></div>
  <div class='clear'></div>
  </div>

  <div class='row-form'>
  <div class='span3'>Golongan</div>
  <div class='span9'><input type=text name='gol'></div>
  <div class='clear'></div>
  </div>

  <div class='row-form'>
  <div class='span3'>T.M.T Golongan</div>
  <div class='span9'><input type=text name='tmtgol'></div>
  <div class='clear'></div>
  </div>
   
  <div class='row-form'>
  <div class='span3'>Jabatan</div>
  <div class='span9'>  <input type=text name='jabatan'></div>
  <div class='clear'></div>
  </div>    
   		
  <div class='row-form'>
  <div class='span3'>T.M.T Jabatan</div>
  <div class='span9'><input type=text name='tmtjabatan'></div>
  <div class='clear'></div>
  </div>
  
  <div class='row-form'>
  <div class='span3'>Pendidikan</div>
  <div class='span9'><input type=text name='pendidikan'></div>
  <div class='clear'></div>
  </div>
  
  <div class='row-form'>
  <div class='span3'>Universitas</div>
  <div class='span9'><input type=text name='universitas'></div>
  <div class='clear'></div>
  </div>
  
  <div class='row-form'>
  <div class='span3'>Thn Lulus</div>
  <div class='span9'><input type=text name='thnlulus'></div>
  <div class='clear'></div>
  </div>
  
  <div class='row-form'>
  <div class='span3'>Tingkat Ijazah</div>
  <div class='span9'><input type=text name='ijazah'></div>
  <div class='clear'></div>
  </div>
		
  <div class='row-form'>
  <div class='span3'>Urutan</div>
  <div class='span9'>  <input type=text name='urutan' value='$r[urutan]'></div>
  <div class='clear'></div>
  </div>    

<div class='row-form'>
  <div class='span3'>Keterangan</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan'  style='height: 350px;'>
  </textarea></div>
  <div class='clear'></div>
  </div>    
	
	<div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><input type=file name='fupload'>
  </div>
  <div class='clear'></div>
  </div>  
  

 
  <div class='row-form'>
  <div class='span3'>Aktif</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Ya' checked>Ya 
  <input type=radio name='aktif' value='Tidak'>Tidak
  </div>
  <div class='clear'></div>
  </div>";
  //////////////////////////////////////////////////////////////////////
										 
echo "
	 
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=pegawai'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
	 
	 
	 
  break;
  ///EDIT PEGAWAI ////////////////////////////////////////////////////////////////////////////////////////
  case "editpegawai":
  $edit=mysql_query("SELECT * FROM pegawai WHERE id_pegawai='$_GET[id]'");
  $r=mysql_fetch_array($edit);

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Pegawai</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action=$aksi?module=pegawai&act=update enctype='multipart/form-data' >
  <input type=hidden name=id value='$r[id_pegawai]'>	  

   
  <div class='row-form'>
  <div class='span3'>Nama Pegawai</div>
  <div class='span9'>  <input type=text name='nama' value='$r[nama]'></div>
  <div class='clear'></div>
  </div>    
   
   <div class='row-form'>
  <div class='span3'>NIP</div>
  <div class='span9'>  <input type=text name='nip' value='$r[nip]'></div>
  <div class='clear'></div>
  </div>
   
  <div class='row-form'>
  <div class='span3'>Jabatan</div>
  <div class='span9'><input type=text name='jabatan' value='$r[jabatan]'></div>
  <div class='clear'></div>
  </div>    

  <div class='row-form'>
  <div class='span3'>Urutan</div>
  <div class='span9'>  <input type=text name='urutan' value='$r[urutan]'></div>
  <div class='clear'></div>
  </div>
  
  <div class='row-form'>
  <div class='span3'>Keterangan</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan'  style='height: 350px;'>
  </textarea></div>
  <div class='clear'></div>
  </div>    
  
  
    
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><a class='fancybox' rel='group' href='../img_pegawai/$r[gambar]'>
  <img src='../img_pegawai/small_$r[gambar]' width=200 class='ttLT'' title='Perbesar Gambar'></a></div>
  <div class='clear'></div>
  </div>    
	  
	  
  <div class='row-form'>
  <div class='span3'>Ganti Gambar</div>
  <div class='span9'><input type=file name='fupload'>
  </div>
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

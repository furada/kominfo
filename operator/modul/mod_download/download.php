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

  $aksi="modul/mod_download/aksi_download.php";
  switch($_GET[act]){
  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Download.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Download.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Download.
  </div>";}  


   echo "
  <div class='workplace'>
  <form action='$aksi?module=download&act=hapussemua' method='post'>
   
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>DOWNLOAD</h1>       
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=download&act=tambahdownload'><span class='isw-plus'></span> Tambahkan File</a></li>
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
  <th>Judul</th>
  <th>Nama File</th>
  <th>Tgl. Posting</th>
    <th>Oleh</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
	 	 

  $p      = new Paging;
  $batas  = 15;
  $posisi = $p->cariPosisi($batas);


  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM download ORDER BY id_download DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM download 
  WHERE username='$_SESSION[namauser]'       
  ORDER BY id_download DESC");}

  $no = $posisi+1;
  while ($r=mysql_fetch_array($tampil)){
  $tgl=tgl_indo($r[tgl_posting]);
	  
				
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_download]'></center></td>
  <td>$r[judul]</td>
  <td>$r[nama_file]</td>
  <td>$tgl</td>
    <td>$r[username]</td> 
  <td width='8%'>
  <a href=?module=download&act=editdownload&id=$r[id_download]>
  <center><img src='img/edit.png' class='ttLT'' title='Edit File'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=download&act=hapus&id=$r[id_download]&namafile=$r[nama_file]')>
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus File'></center></a> 
  </td>
  
  </tr>";
				
				
  $no++;}
	
  echo "</table></form>
  <div class='clear'></div>
  </div>
  </div>                                
  </div>            
  <div class='dr'><span></span></div>";

  $jmldata=mysql_num_rows(mysql_query("SELECT * FROM download"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);




  break;
  //TAMBAH DOWNLOAD/////////////////////////////////////////////////////////////////////////////////////////
  case "tambahdownload":
  
  
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan File Download</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=download&act=input' enctype='multipart/form-data'>
		 
   
  <div class='row-form'>
  <div class='span3'>Nama File</div>
  <div class='span9'><input type=text name='judul'></div>
  <div class='clear'></div>
  </div>    
   
	
  <div class='row-form'>
  <div class='span3'>Kategori</div>
  <div class='span9'>        
  <select name='kategoridownload' id='s2_2'>   
  <option value=0 selected>Pilih Kategori</option>";
  $tampil=mysql_query("SELECT * FROM kategoridownload ORDER BY nama_kategoridownload");
  while($r=mysql_fetch_array($tampil)){
  echo "<option value=$r[id_kategoridownload]>$r[nama_kategoridownload]</option>"; }
  echo "</select>  </div><div class='clear'></div>
  </div>
   
   
  <div class='row-form'>
  <div class='span3'>File</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>
   

  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=download'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>


  </form>
  </div></div></div>";   
   


  break;
  //EDIT DOWNLOAD//////////////////////////////////////////////////////////////////////////////////////////////////  
  case "editdownload":
   if ($_SESSION['leveluser']=='admin'){
  $edit = mysql_query("SELECT * FROM download WHERE id_download='$_GET[id]'");}
    else{
		$edit = mysql_query("SELECT * FROM download WHERE id_download='$_GET[id]' AND username='$_SESSION[namauser]'");}
  $r    = mysql_fetch_array($edit);



  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit File Download</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST enctype='multipart/form-data' action=$aksi?module=download&act=update>
  <input type=hidden name=id value=$r[id_download]>

   
  <div class='row-form'>
  <div class='span3'>Nama File</div>
  <div class='span9'><input type=text name='judul' value='$r[judul]'></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <div class='span3'>Kategori</div>
  <div class='span9'>        
  <select name='kategoridownload' id='s2_2'> ";
  $tampil=mysql_query("SELECT * FROM kategoridownload ORDER BY nama_kategoridownload");
  if ($r[id_kategoridownload]==0){
  echo "<option value=0 selected>Pilih Kategori</option>"; }   
  while($w=mysql_fetch_array($tampil)){
  if ($r[id_kategoridownload]==$w[id_kategoridownload]){
  echo "<option value=$w[id_kategoridownload] selected>$w[nama_kategoridownload]</option>";}
  else{
  echo "<option value=$w[id_kategoridownload]>$w[nama_kategoridownload]</option>";}}
  echo "</select> </div><div class='clear'></div>
  </div>
   
   
   
  <div class='row-form'>
  <div class='span3'>File</div>
  <div class='span9'><h5>$r[nama_file]</h5></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <div class='span3'>Ganti File</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>
   
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=download'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>


  </form>
  </div></div></div>";   
   	  
     
   break; }
   
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

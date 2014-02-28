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


  $aksi="modul/mod_poling/aksi_poling.php";
  switch($_GET[act]){

  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Polling.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Polling.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Polling.
  </div>";}
  
  if (empty($_GET['kata'])){
  
  echo "
  <div class='workplace'>
  <form action='$aksi?module=poling&act=hapussemua' method='post'>

  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>POLLING</h1>            
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=poling&act=tambahpoling'><span class='isw-plus'></span> Tambahkan Polling</a></li>
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
  <th>Pilihan</th>
  <th>Status</th>
  <th>Rating</th>
  <th>Aktif</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";

  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM poling ORDER BY id_poling DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM poling 
  WHERE username='$_SESSION[namauser]'       
  ORDER BY id_poling DESC");}
  
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
	
	
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_poling]'></center></td>
  <td>$r[pilihan]</td>
  <td>$r[status]</td>
  <td><center>$r[rating]</center></td>
  <td><center>$r[aktif]</center></td>
   
   
  <td>
  <a href=?module=poling&act=editpoling&id=$r[id_poling] >
  <center><img src='img/edit.png' class='ttLT'' title='Edit Polling'></center></a>
  </td>
   
  <td>
  <a href=javascript:confirmdelete('$aksi?module=poling&act=hapus&id=$r[id_poling]') >
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Polling'></center></a> 
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
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM poling"));}
  
  else{
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM poling WHERE username='$_SESSION[namauser]'"));}  
  
  break;}
  
  else{
  
  
  echo "
  <thead>
  <tr>
  <th><center><input type='checkbox' name='checkall' class='checkall' /></center></th>
  <th>Pilihan</th>
  <th>Status</th>
  <th>Rating</th>
  <th>Aktif</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
  

  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM poling WHERE pilihan LIKE '%$_GET[kata]%' ORDER BY id_poling DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM poling 
  WHERE username='$_SESSION[namauser]'
  AND pilihan LIKE '%$_GET[kata]%'       
  ORDER BY id_poling DESC");}
  
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
	  
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_poling]'></center></td>
  <td>$r[pilihan]</td>
  <td>$r[status]</td>
  <td><center>$r[rating]</center></td>
  <td><center>$r[aktif]</center></td>
   
   
  <td>
  <a href=?module=poling&act=editpoling&id=$r[id_poling] >
  <center><img src='img/edit.png' class='ttLT'' title='Edit Polling'></center></a>
  </td>
   
  <td>
  <a href=javascript:confirmdelete('$aksi?module=poling&act=hapus&id=$r[id_poling]') >
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Polling'></center></a> 
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
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM poling WHERE pilihan LIKE '%$_GET[kata]%'"));}
  
  else{
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM poling WHERE username='$_SESSION[namauser]' 
  AND pilihan LIKE '%$_GET[kata]%'"));} 
   
   
   
   
  break;}
  //TAMBAH POLLING////////////////////////////////////////////////////////////////////////////////////
  case "tambahpoling":
  
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Polling</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  
  <form method=POST action='$aksi?module=poling&act=input' class='editprofileform' >
		  
   
  <div class='row-form'>
  <div class='span3'>Pilihan</div>
  <div class='span9'><input type=text name='pilihan'></div>
  <div class='clear'></div>
  </div>    
	
	
  
  <div class='row-form'>
  <div class='span3'>Status</div>
  <div class='span9'>
  <input type=radio name='status' value='Jawaban' checked>Jawaban 
  <input type=radio name='status' value='Pertanyaan'>Pertanyaan
  </div>
  <div class='clear'></div>
  </div>    
	
  
  <div class='row-form'>
  <div class='span3'>Aktifkan</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Ya' checked>Ya 
  <input type=radio name='aktif' value='Tidak'>Tidak
  </div>
  <div class='clear'></div>
  </div>    
  
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=poling'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
  
  
  
		  
  break;
  case "editpoling":
  //EDIT POLLING////////////////////////////////////////////////////////////////////////////////////////////////
  
  $edit = mysql_query("SELECT * FROM poling WHERE id_poling='$_GET[id]' AND username='$_SESSION[namauser]'");
  $r    = mysql_fetch_array($edit);


  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Polling</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
	
  <form method=POST action=$aksi?module=poling&act=update>
  <input type=hidden name=id value='$r[id_poling]'>
  
  <div class='row-form'>
  <div class='span3'>Pilihan</div>
  <div class='span9'><input type=text name='pilihan' value='$r[pilihan]'></div>
  <div class='clear'></div>
  </div> ";   
  

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
  &nbsp;&nbsp;&nbsp;&nbsp;<span class style=\"color:#245689;font-size:12px;\">Pilih <b>'Ya'</b> 
  jika ingin diaktifkan di halaman homepage.</span>
  </div>
  <div class='clear'></div>
  </div>";}
	
	
  if ($r[status]=='Jawaban'){
  echo "
  <div class='row-form'>
  <div class='span3'>Status</div>
  <div class='span9'>
  <input type=radio name='status' value='Jawaban' checked>Jawaban 
  <input type=radio name='status' value='Pertanyaan'>Pertanyaan
  </div>
  <div class='clear'></div>
  </div>";}
									  
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Status</div>
  <div class='span9'>
  <input type=radio name='status' value='Jawaban'>Jawaban 
  <input type=radio name='status' value='Pertanyaan' checked>Pertanyaan
  </div>
  <div class='clear'></div>
  </div>";}
	
	
  echo "
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=poling'>Batal</a>
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

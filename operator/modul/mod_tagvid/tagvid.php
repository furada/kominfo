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

  $aksi="modul/mod_tagvid/aksi_tagvid.php";
  switch($_GET[act]){

  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Tag Video.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Tag Video.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Tag Video.
  </div>";}


  echo "
  <div class='workplace'>
  <form action='$aksi?module=tagvid&act=hapussemua'  method='post'>

  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>TAG VIDEO</h1>    
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=tagvid&act=tambahtag'><span class='isw-plus'></span> Tambahkan Tag Video</a></li>
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
  <th><center>No</center></th>
  <th>Nama Tag</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";

  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM tagvid  ORDER BY id_tag DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM tagvid 
  WHERE username='$_SESSION[namauser]'       
  ORDER BY id_tag DESC");}
	
  $no=1;
  while ($r=mysql_fetch_array($tampil)){
	   
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_tag]'></center></td>
  <td width='8%'><center>$no</center></td>
  <td>$r[nama_tag]</td>
  
  
  <td width='8%'>
  <a href=?module=tagvid&act=edittag&id=$r[id_tag]><center><img src='img/edit.png' class='ttLT' title='Edit Tag Video'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=tagvid&act=hapus&id=$r[id_tag]') >
  <center><img src='img/hapus.png' class='ttLT' title='Hapus Tag Video'></center></a> 
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
  //TAMBAH TAG VIDEO///////////////////////////////////////////////////////////////////////
  case "tambahtag":
  
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Tag Video</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=tagvid&act=input'>
	
		
  <div class='row-form'>
  <div class='span3'>Nama Tag</div>
  <div class='span9'><input type=text name='nama_tag'></div>
  <div class='clear'></div>
  </div>    
	

  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=tagvid'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";


	    
  break;
  //EDIT VIDEO/////////////////////////////////////////////////////////////////////////////////////
  case "edittag":
  $edit=mysql_query("SELECT * FROM tagvid WHERE id_tag='$_GET[id]'");
  $r=mysql_fetch_array($edit);

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Tag Video</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  
  <form method=POST action=$aksi?module=tagvid&act=update>
  <input type=hidden name=id value='$r[id_tag]'>
   
		
  <div class='row-form'>
  <div class='span3'>Nama Tag</div>
  <div class='span9'> <input type=text name='nama_tag' value='$r[nama_tag]'></div>
  <div class='clear'></div>
  </div>    
		
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=tagvid'>Batal</a>
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

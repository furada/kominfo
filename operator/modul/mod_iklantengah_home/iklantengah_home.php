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

  $aksi="modul/mod_iklantengah_home/aksi_iklantengah_home.php";
  switch($_GET[act]){
  
  default:
  
  // PESAN UPDATE
  if(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Iklan Tengah (home).
  </div>";}
  
  
  echo "
  <div class='workplace'>
  
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>IKLAN TENGAH (home) ~ Ukuran 620 x 120</h1>                               
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid table-sorting'>
  <table cellpadding='0' cellspacing='0' width='100%' class='table' id='tSortable'>
	         
  
  <thead>
  <tr>
  <th>Gambar</th>
  <th>URL</th>
  <th><center>Aktif</center></th>
  <th><center>Edit</center></th>
  </tr>
  </thead>";
  
		  
  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM iklantengah_home ORDER BY id_iklantengah_home DESC");}
	  
  else{ $tampil=mysql_query("SELECT * FROM iklantengah_home WHERE username='$_SESSION[namauser]' ORDER BY id_iklantengah_home DESC");}
	
  $no=1;
  while ($r=mysql_fetch_array($tampil)){
  $tgl=tgl_indo($r[tgl_posting]);
	  
	  
	  
  echo "
  <tr>
  
  <td> 
  <a class='fancybox' rel='group' href='../img_iklantengah_home/$r[gambar]'>
  <embed src='../img_iklantengah_home/$r[gambar]' height=60 class='ttLT'' title='Perbesar Gambar'></embed></a>
  </td>
  
  <td><a href=$r[url] target=_blank>$r[url]</a></td>
  <td><center>$r[aktif]</center></td>
				
  <td width='8%'>
  <a href=?module=iklantengah_home&act=editiklantengah_home&id=$r[id_iklantengah_home] >
  <center><img src='img/edit.png' class='ttLT'' title='Edit Iklan'></center></a>
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
  //EDIT IKLAN///////////////////////////////////////////////////////////////////////////////////
  case "editiklantengah_home":
  $edit = mysql_query("SELECT * FROM iklantengah_home WHERE id_iklantengah_home='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Iklan</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST enctype='multipart/form-data' action=$aksi?module=iklantengah_home&act=update>
  <input type=hidden name=id value=$r[id_iklantengah_home]>
		  
   
  <div class='row-form'>
  <div class='span3'>Judul Iklan</div>
  <div class='span9'><input type=text name='judul' value='$r[judul]'></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <div class='span3'>URL</div>
  <div class='span9'><input type=text name='url' value='$r[url]'></div>
  <div class='clear'></div>
  </div>    
   
   
   
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'>
  <a class='fancybox' rel='group' href='../img_iklantengah_home/$r[gambar]'>
  <embed src='../img_iklantengah_home/$r[gambar]' height=60 class='ttLT'' title='Perbesar Gambar'></embed></a>
  </div>
  <div class='clear'></div>
  </div>   
   
  <div class='row-form'>
  <div class='span3'>Ganti Gambar</div>
  <div class='span9'><input type=file name='fupload'>
  <p>Ukuran: 620 x 120</p></div>
  <div class='clear'></div>
  </div>";
    									 
  if ($r[aktif]=='Ya'){
  echo "
  <div class='row-form'>
  <div class='span3'>Aktifkan</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Ya' checked>Ya
  <input type=radio name='aktif' value='Tidak'>Tidak
  &nbsp;&nbsp;&nbsp;&nbsp;<span class style=\"color:#245689;font-size:12px;\">Pilih <b>'Ya'</b> 
  jika ingin diaktifkan di halaman web.</span></div>
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
  jika ingin diaktifkan di halaman web.</span>
  </div>
  <div class='clear'></div>
  </div>";}
		
   
  echo "
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=iklantengah_home'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";


  break;}} 
  else {
  echo akses_salah();}}
  ?>

  <script>
  function confirmdelete(delUrl) {
  if (confirm("Anda yakin ingin menghapus?")) {
  document.location = delUrl;}}
  </script>

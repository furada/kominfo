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


  $base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

  $aksi="modul/mod_komentarvid/aksi_komentarvid.php";
  switch($_GET[act]){
  
  
  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Komentar Video.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Komentar Video.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Komentar Video.
  </div>";}
   
   
  echo "
  <div class='workplace'>
  <form action='$aksi?module=komentarvid&act=hapussemua'method='post'>

  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>KOMENTAR VIDEO</h1>    
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
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
  <th>Nama</th>
  <th>Komentar</th>
  <th>Tgl. Masuk</th>
  <th><center>Baca</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
   
  $p      = new Paging;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);

  $tampil=mysql_query("SELECT * FROM komentarvid ORDER BY id_komentar DESC");

  $no = $posisi+1;
  while ($r=mysql_fetch_array($tampil)){
	
  $tgl = tgl_indo($r[tgl]);
  if($r[dibaca]=='N'){
	
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_komentar]'></center></td>
  
  <td><b><blink>$r[nama_komentar]</blink></b></td>
  <td><a href='../play-$r[id_video]-$r[video_seo].html#$r[id_komentar]'target='blank'>
  <b><blink>$r[isi_komentar]</blink></b></a></td>
  <td><b><blink>$tgl</blink></b></td>
	
  <td width='8%'>
  <a href=?module=komentarvid&act=editkomentar&id=$r[id_komentar]>
  <center><img src='img/edit.png' class='ttLT'' title='Baca Komentar'></center></a>
  </td>
   
  <td width='8%'>
  <a  href=javascript:confirmdelete('$aksi?module=komentarvid&act=hapus&id=$r[id_komentar]') >
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Komentar'></center></a> 
  </td>
  
  
  </tr>";} 
  
  else {
  
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_komentar]'></center></td>
  <td>$r[nama_komentar]</td>
  <td><a href='../play-$r[id_video]-$r[video_seo].html#$r[id_komentar]'target='blank'>$r[isi_komentar]</a></td>
  <td>$tgl</td>
  
  <td width='8%'>
  <a href=?module=komentarvid&act=editkomentar&id=$r[id_komentar]>
  <center><img src='img/edit.png' class='ttLT'' title='Baca Komentar'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=komentarvid&act=hapus&id=$r[id_komentar]') >
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Komentar'></center></a> 
  </td>
  
  </tr>";} 

  $no++;}
  
  echo "</table></form>
  <div class='clear'></div>
  </div>
  </div>                                
  </div>            
  <div class='dr'><span></span></div>";
	
	
  $jmldata=mysql_num_rows(mysql_query("SELECT * FROM komentarvid"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  break;
  
  
  //EDIT KOMENTAR/////////////////////////////////////////////////////////////////////////////////////////////////
  case "editkomentar":
  $edit = mysql_query("SELECT * FROM komentarvid WHERE id_komentar='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
  mysql_query("UPDATE komentarvid SET dibaca='Y' WHERE id_komentar='$_GET[id]'");


  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Komentar Video</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  
  <form method=POST action=$aksi?module=komentarvid&act=update>
  <input type=hidden name=id value=$r[id_komentar]>
		  
		
  <div class='row-form'>
  <div class='span3'>Nama</div>
  <div class='span9'><input type=text name='nama_komentar' value='$r[nama_komentar]'></div>
  <div class='clear'></div>
  </div>    
	
		 
  <div class='row-form'>
  <div class='span3'>Email</div>
  <div class='span9'><input type=text name='url' value='$r[url]'></div>
  <div class='clear'></div>
  </div>    
		 
   
  <div class='row-form'>
  <div class='span3'>Komentar</div>
  <div class='span9'><textarea id='teraskreasi' name=isi_komentar style='height: 200px;'>$r[isi_komentar]</textarea></div>
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
  &nbsp;&nbsp;&nbsp;&nbsp;<span class style=\"color:#245689;font-size:12px;\">Pilih <b>'Ya'</b> 
  jika ingin diaktifkan di halaman homepage.</span>
  </div>
  <div class='clear'></div>
  </div>";}


  echo  "
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=komentarvid'>Batal</a>
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


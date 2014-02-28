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


  $aksi="modul/mod_agenda/aksi_agenda.php";
  switch($_GET[act]){

  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Agenda.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Agenda.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Agenda.
  </div>";}
  
  
  echo "
  <div class='workplace'>
  <form action='$aksi?module=agenda&act=hapussemua' method='post'>
   
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>Agenda</h1>       
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=agenda&act=tambahagenda'><span class='isw-plus'></span> Tambahkan Agenda</a></li>
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
  <th>Tema</th>
  <th>Tgl. Agenda</th>
  <th>Oleh</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
  
  $p      = new Paging;
  $batas  = 15;
  $posisi = $p->cariPosisi($batas);

  if ($_SESSION[leveluser]=='admin'){
  $tampil=mysql_query("SELECT * FROM agenda ORDER BY id_agenda DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM agenda 
  WHERE username='$_SESSION[namauser]'       
  ORDER BY id_agenda DESC");}
  

  $no = $posisi+1;
  while ($r=mysql_fetch_array($tampil)){
  $tgl_mulai   = tgl_indo($r[tgl_mulai]);
  $tgl_selesai = tgl_indo($r[tgl_selesai]);
    
	

  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_agenda]'></center></td>
  <td>$r[tema]</td>
  <td>$tgl_mulai</td>
 <td>$r[username]</td>
  <td width='8%'>
  <a href=?module=agenda&act=editagenda&id=$r[id_agenda]>
  <center><img src='img/edit.png' class='ttLT'' title='Edit Agenda'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=agenda&act=hapus&id=$r[id_agenda]&namafile=$r[gambar]') >
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Agenda'></center></a> 
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
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM agenda"));}
  
  else{
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM agenda WHERE username='$_SESSION[namauser]'"));} 
   
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);




  break;
  //TAMBAH AGENDA/////////////////////////////////////////////////////////////////////////////////////////
  case "tambahagenda":
  
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Agenda</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=agenda&act=input' enctype='multipart/form-data'>
    
   
  <div class='row-form'>
  <div class='span3'>Tema</div>
  <div class='span9'><input type=text name='tema'></div>
  <div class='clear'></div>
  </div>    
   
  <div class='row-form'>
  <div class='span3'>Isi Agenda</div>
  <div class='span9'><textarea id='teraskreasi' name='isi_agenda' style='height: 200px;'></textarea></div>
  <div class='clear'></div>
  </div>    
   
   
		  
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>    
	
		
  <div class='row-form'>
  <div class='span3'>Tempat</div>
  <div class='span9'><input type=text name='tempat'></div>
  <div class='clear'></div>
  </div>    
		
  <div class='row-form'>
  <div class='span3'>Jam</div>
  <div class='span9'><input type=text name='jam'></div>
  <div class='clear'></div>
  </div>";   
  
  
  echo "
  <div class='row-form'>
  <div class='span3'>Tanggal</div>
  <div class='span7'>  <table><td width='200px'>";  
  combotgl(1,31,'tgl_mulai',$tgl_skrg);
  echo "</td><td width='200px'>";    
  combonamabln(1,12,'bln_mulai',$bln_sekarang);
  echo "</td><td width='200px'>";    
  combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang);
  echo "<td></table>
  </div>
  <div class='clear'></div>
  </div>    
   
  <div class='row-form'>
  <div class='span3'>Sampai Tanggal</div>
  <div class='span9'><input type=text name='selesai'></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=agenda'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
   
   
  break;
  case "editagenda":
  //EDIT AGENDA////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  if ($_SESSION['leveluser']=='admin'){
  $edit = mysql_query("SELECT * FROM agenda WHERE id_agenda='$_GET[id]'");}
  
  else{
	  $edit = mysql_query("SELECT * FROM agenda WHERE id_agenda='$_GET[id]' AND username='$_SESSION[namauser]'");}
  $r    = mysql_fetch_array($edit);
  
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Agenda</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=agenda&act=update' enctype='multipart/form-data'>
  <input type=hidden name=id value=$r[id_agenda]>
	
   
  <div class='row-form'>
  <div class='span3'>Tema</div>
  <div class='span9'><input type=text name='tema' value='$r[tema]'></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <div class='span3'>Isi Agenda</div>
  <div class='span9'><textarea id='teraskreasi' name='isi_agenda' style='height: 300px;'>$r[isi_agenda]</textarea></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'>
  <a class='fancybox' rel='group' href='../img_agenda/$r[gambar]'>
  <img src='../img_agenda/small_$r[gambar]' width=300 class='ttLT'' title='Perbesar Gambar'></a>
  </div>
  <div class='clear'></div>
  </div>    
   
		  
  <div class='row-form'>
  <div class='span3'>Ganti Gambar</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>    
		
 		
  <div class='row-form'>
  <div class='span3'>Tempat</div>
  <div class='span9'><input type=text name='tempat' value='$r[tempat]'></div>
  <div class='clear'></div>
  </div>    
   
	
  <div class='row-form'>
  <div class='span3'>Jam</div>
  <div class='span9'><input type=text name='jam' value='$r[jam]'></div>
  <div class='clear'></div>
  </div>"; 
  
  echo "
  <div class='row-form'>
  <div class='span3'>Tanggal</div>
  <div class='span7'>
  <table><td width='200px'>";    
  $get_tgl=substr("$r[tgl_mulai]",8,2);
  combotgl(1,31,'tgl_mulai',$get_tgl);
  echo "</td><td width='200px'>";    
  $get_bln=substr("$r[tgl_mulai]",5,2);
  combonamabln(1,12,'bln_mulai',$get_bln);
  echo "</td><td width='200px'>";    
  $get_thn=substr("$r[tgl_mulai]",0,4);
  $thn_skrg=date("Y");
  combothn($thn_sekarang-2,$thn_sekarang+2,'thn_mulai',$get_thn);
  echo "</td></table>
  </div>
  <div class='clear'></div>
  </div>    
   
  <div class='row-form'>
  <div class='span3'>Sampai Tanggal</div>
  <div class='span9'><input type=text name='selesai' value='$r[selesai]'></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=agenda'>Batal</a>
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

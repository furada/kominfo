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
  function GetCheckboxes($table, $key, $Label, $Nilai='') {
  $s = "select * from $table order by nama_tag";
  $r = mysql_query($s);
  $_arrNilai = explode(',', $Nilai);
  $str = '';
  
  while ($w = mysql_fetch_array($r)) {
  $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
  $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] ";}
  return $str;}
  
	
  //cek hak akses user
  $cek=user_akses($_GET[module],$_SESSION[sessid]);
  if($cek==1 OR $_SESSION[leveluser]=='admin'){

  $aksi="modul/mod_video/aksi_video.php";
  switch($_GET[act]){


  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Video.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Video.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Video.
  </div>";}
	   
   
  echo "
  <div class='workplace'>
  <form action='$aksi?module=video&act=hapussemua' method='post'>

  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>Video</h1>    
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=video&act=tambahvideo'><span class='isw-plus'></span> Tambahkan Video</a></li>
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
  <th>Judul Video</th>
  <th>Tgl. Posting</th>
  <th>Playlist</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
  
  	
  $p      = new Paging;
  $batas  = 15;
  $posisi = $p->cariPosisi($batas);
  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM video,playlist WHERE video.id_playlist=playlist.id_playlist ORDER BY id_video DESC");}
	
  else{
  $tampil = mysql_query("SELECT * FROM video,playlist WHERE (video.id_playlist=playlist.id_playlist) 
  AND (username='$_SESSION[namauser]')  ORDER BY id_video DESC");}
  
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
  $tgl_posting=tgl_indo($r[tanggal]);
		
		
	
  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_video]'></center></td>
  <td>$r[jdl_video]</td>
  <td>$tgl_posting</td>
  <td>$r[jdl_playlist]</td>

  <td width='8%'>
  <a href=?module=video&act=editvideo&id=$r[id_video] >
  <center><img src='img/edit.png' class='tt' title='Edit Video'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=video&act=hapus&id=$r[id_video]&namafile=$r[gbr_video]') >
  <center><img src='img/hapus.png' class='tt' title='Hapus Video'></center></a> 
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
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM video"));}

  else{
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM video WHERE username='$_SESSION[namauser]'"));}  
    
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
 
  break;
  //TAMBAH VIDEO///////////////////////////////////////////////////////////////////////////////////////////
  case "tambahvideo":
   
	
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Video</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=video&act=input' enctype='multipart/form-data'>
      
  <div class='row-form'>
  <div class='span3'>Judul Video</div>
  <div class='span9'><input type=text name='jdl_video'></div>
  <div class='clear'></div>
  </div>    
	 
	      
  <div class='row-form'>
  <div class='span3'>Playlist</div>
  <div class='span9'>        
  <select name='playlist'>
  <option value=0 selected>Pilih Playlist</option>";
  $tampil=mysql_query("SELECT * FROM playlist ORDER BY jdl_playlist");
  while($r=mysql_fetch_array($tampil)){
  echo "<option value=$r[id_playlist]>$r[jdl_playlist]</option>";}
			
  echo "</select> </div><div class='clear'></div>
  </div>
	
  <div class='row-form'>
  <div class='span3'>Keterangan</div>
  <div class='span9'> <textarea id='teraskreasi' name='keterangan' style='height: 200px;'></textarea></div>
  <div class='clear'></div>
  </div>    
	
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>    
   
  <div class='row-form'>
  <div class='span3'>Link Youtube</div>
  <div class='span9'>
  <input type=text name='youtube'>
  <p class style=\"color:#245689;font-size:12px;margin-bottom:-5px;\">
  contoh: http://www.youtube.com/embed/xbuEmoRWQHU</span></p></div>
  <div class='clear'></div>
  </div>    
						  			
  <div class='row-form'>
  <div class='span3'>Video File</div>
  <div class='span9'><input type=file name='fupload2'>
  <p class style=\"color:#245689;font-size:12px;margin-bottom:-5px;\">Tipe video harus MP4/FLV
  </p></div>
  <div class='clear'></div>
  </div>";
	
  $tagvid = mysql_query("SELECT * FROM tagvid ORDER BY tag_seo");
  echo " <div class='row-form'>
  <div class='span3'>Tag Video</div> <div class='span9'>";
  while ($t=mysql_fetch_array($tagvid)){
  echo "<input type=checkbox value='$t[tag_seo]' name=tag_seo[]>$t[nama_tag] ";}
		  
	
  echo "
  </div>
  <div class='clear'></div>
  </div> 
  
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=video'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>


  </form>
  </div></div></div>";
	
		  
  break;
  //EDIT VIDEO///////////////////////////////////////////////////////////////////////////////////////////
  case "editvideo":
  $edit = mysql_query("SELECT * FROM video WHERE id_video='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
	
  
  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Video</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  
  <form method=POST enctype='multipart/form-data' action=$aksi?module=video&act=update>
  <input type=hidden name=id value=$r[id_video]>
	
  <div class='row-form'>
  <div class='span3'>Judul Video</div>
  <div class='span9'><input type=text name='jdl_video' value='$r[jdl_video]'></div>
  <div class='clear'></div>
  </div>    
	 
	 
	 
  <div class='row-form'>
  <div class='span3'>Playlist</div>
  <div class='span9'>        
  <select name='playlist'>";
  $tampil=mysql_query("SELECT * FROM playlist ORDER BY jdl_playlist");
  if ($r[id_playlist]==0){
  echo "<option value=0 selected>- Pilih Playlist -</option>"; }   
  while($w=mysql_fetch_array($tampil)){
   
  if ($r[id_playlist]==$w[id_playlist]){
  echo "<option value=$w[id_playlist] selected>$w[jdl_playlist]</option>";}
  else{
  echo "<option value=$w[id_playlist]>$w[jdl_playlist]</option>";} }
   		  
  echo "</select></div><div class='clear'></div>
  </div>
     
  <div class='row-form'>
  <div class='span3'>Keterangan</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan' style='height: 350px;'>$r[keterangan]</textarea></div>
  <div class='clear'></div>
  </div>    
	 
	 
  <div class='row-form'>
  <div class='span3'>Gambar</div>";
  if ($r[gbr_video]!=''){
  echo "<div class='span9'>
  
  <a class='fancybox' rel='group' href='../img_video/$r[gbr_video]'>
  <img src='../img_video/kecil_$r[gbr_video]' width=200 class='tt' title='Perbesar Gambar'></a>
  
  
  </div>
  <div class='clear'></div>
  </div>";}
  	 
	 
  echo "
   		  
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><input type=file name='fupload'></div>
  <div class='clear'></div>
  </div>    
		
  <div class='row-form'>
  <div class='span3'>Link Youtube</div>
  <div class='span9'>
  <input type=text name='youtube' value='$r[youtube]'>
  <p class style=\"color:#245689;font-size:12px;margin-bottom:-5px;\">
  contoh: http://www.youtube.com/embed/xbuEmoRWQHU</span></p></div>
  <div class='clear'></div>
  </div>    
		
		
  <div class='row-form'>
  <div class='span3'>Video Terpasang</div>";
  echo "<div class='span9'>
  
  <div style='background-image:url(../img_video/kecil_$r[gbr_video]); 
  width: 250px; height: 140px; no-repeat; margin-bottom:100px;'>
   
  <iframe width='250' height='170' src='$r[youtube]?modestbranding=1;autohide=1&amp;showinfo=0&amp;controls=0;' 
  frameborder='0' allowfullscreen></iframe>   
   
  <a href='../play-$r[id_video]-$r[jdl_video].html' target='blank' class='btn btn-info btn-rounded'> 
  Test Play on website </a></div>
  
  </div>
  <div class='clear'></div>
  </div>    
		 
		 
  <div class='row-form'>
  <div class='span3'>Ganti Video</div>
  <div class='span9'><input type=file name='fupload2'>
  <p class style=\"color:#245689;font-size:12px;margin-bottom:-5px;\">Tipe video harus MP4/FLV
  </p></div>
  <div class='clear'></div>
  </div>";
		  
  $d = GetCheckboxes('tagvid', 'tag_seo', 'nama_tag', $r[tagvid]);
  echo "  <div class='row-form'>
  <div class='span3'>Tag Video</div><div class='span9'>
  $d";
  
  echo "
  </div>
  <div class='clear'></div>
  </div>
  
  
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=video'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>
   
  </form>
  </div></div></div>";
		 
  break;}} 
  else {
  echo akses_salah();}}
  ?>
  
  

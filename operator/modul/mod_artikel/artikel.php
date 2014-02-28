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

  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
  
  
  function GetCheckboxes($table, $key, $Label, $Nilai='') {
  $s = "select * from $table order by nama_tag";
  $r = mysql_query($s);
  $_arrNilai = explode(',', $Nilai);
  $str = '';
  
  while ($w = mysql_fetch_array($r)) {
  $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
  $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] ";}
  return $str;}



  $aksi="modul/mod_artikel/aksi_artikel.php";
  switch($_GET[act]){
  
  default:
  
  // PESAN INPUT
  if(isset($_GET['msg']) && $_GET['msg']=='insert'){
  echo "<div class='alert alert-success'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menambahkan Artikel.
  </div>";}
	
	
  // PESAN UPDATE
  elseif(isset($_GET['msg']) && $_GET['msg']=='update'){
  echo " <div class='alert alert-info'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> meng-update Artikel.
  </div>";}
  
  // PESAN HAPUS
  elseif(isset($_GET['msg']) && $_GET['msg']=='delete'){
  echo "
  <div class='alert alert-error'>
  <button data-dismiss='alert' class='close' type='button'>x</button>
  <strong>Anda berhasil</strong> menghapus Artikel.
  </div>";}

  
  echo "
  <div class='workplace'>
  <form action='$aksi?module=artikel&act=hapussemua' method='post'>
   
  <div class='row-fluid'>
  <div class='span12'>                    
  <div class='head'>
  <div class='isw-grid'></div>
  <h1>Artikel</h1>   
  
  <ul class='buttons'>
  <li class='ttLC' title='Control Panel'>
  <a href='#' class='isw-settings'></a>
  <ul class='dd-list'>
  <li><a href='?module=artikel&act=tambahartikel'><span class='isw-plus'></span> Tambahkan Artikel</a></li>
  <li><input type='submit' value='Hapus yang terseleksi' class='btn btn-warning' style='width: 150px; height: 30px;'></li>
  </ul>
  </li>
  </ul>     
                              
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid table-sorting'>
  <table cellpadding='0' cellspacing='0' width='100%' class='table' id='tSortable'>";
 
  
  if (empty($_GET['kata'])){
	
	
  echo " 
  <thead>
  <tr>
  <th><center><input type='checkbox' name='checkall' class='checkall' /></center></th>
  <th>Judul</th>
   <th>Kategori</th>
  <th>Tgl. Posting</th>
  <th>Oleh</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";
    
  $p      = new Paging;
  $batas  =40;
  $posisi = $p->cariPosisi($batas);

  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM artikel ORDER BY id_artikel DESC");}
  
  else{
  $tampil=mysql_query("SELECT * FROM artikel 
  WHERE username='$_SESSION[namauser]'       
  ORDER BY id_artikel DESC");}
  
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
  $tgl_posting=tgl_indo($r[tanggal]);

$kat= $r['id_kategoriartikel'];
$sql="select * from kategoriartikel where id_kategoriartikel='$kat'";
$query=mysql_query($sql);
$row=mysql_fetch_assoc($query);

  echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_artikel]'></center></td>
  <td>$r[judul]</td>
  <td>$row[nama_kategoriartikel]</td>
  <td>$tgl_posting</td>
  <td>$r[username]</td>
  <td width='8%'>
  <a href=?module=artikel&act=editartikel&id=$r[id_artikel]>
  <center><img src='img/edit.png' class='ttLT'' title='Edit Artikel'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=artikel&act=hapus&id=$r[id_artikel]&namafile=$r[gambar]')>
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Artikel'></center></a> 
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
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM artikel"));}
  
  else{
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM artikel WHERE username='$_SESSION[namauser]'"));}  
  
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  break;}
  else{
  
  
   echo " 
  <thead>
  <tr>
  <th><center><input type='checkbox' name='checkall' class='checkall' /></center></th>
  <th>Judul</th>
  <th>Tgl. Posting</th>
  <th><center>Edit</center></th>
  <th><center>Hapus</center></th>
  </tr>
  </thead>";


  $p      = new Paging9;
  $batas  = 15;
  $posisi = $p->cariPosisi($batas);

  if ($_SESSION[leveluser]=='admin'){
  $tampil = mysql_query("SELECT * FROM artikel WHERE judul LIKE '%$_GET[kata]%' ORDER BY id_artikel DESC LIMIT $posisi,$batas");}
  
  else{
  $tampil=mysql_query("SELECT * FROM artikel 
  WHERE username='$_SESSION[namauser]'
  AND judul LIKE '%$_GET[kata]%'       
  ORDER BY id_artikel DESC LIMIT $posisi,$batas");}
  
  $no = $posisi+1;
  while($r=mysql_fetch_array($tampil)){
  $tgl_posting=tgl_indo($r[tanggal]);
	
	  
   echo "
  <tr> 
  <td width='5%'><center><input type='checkbox' name='cek[]' value='$r[id_artikel]'></center></td>
  <td>$r[judul]</td>
  <td>$tgl_posting</td>
  
  <td width='8%'>
  <a href=?module=artikel&act=editartikel&id=$r[id_artikel]>
  <center><img src='img/edit.png' class='ttLT'' title='Edit Artikel'></center></a>
  </td>
   
  <td width='8%'>
  <a href=javascript:confirmdelete('$aksi?module=artikel&act=hapus&id=$r[id_artikel]&namafile=$r[gambar]')>
  <center><img src='img/hapus.png' class='ttLT'' title='Hapus Artikel'></center></a> 
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
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM artikel WHERE judul LIKE '%$_GET[kata]%'"));}
  
  else{
  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM artikel WHERE username='$_SESSION[namauser]' 
  AND judul LIKE '%$_GET[kata]%'"));}  
  
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);


  break;}
  // TAMBAH ARTIKEL////////////////////////////////////////////////////////////////////////////
  case "tambahartikel":
   

  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Tambahkan Artikel</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST action='$aksi?module=artikel&act=input' enctype='multipart/form-data'>
   
   
  <div class='row-form'>
  <div class='span3'>Judul Artikel</div>
  <div class='span9'><input type=text name='judul'></div>
  <div class='clear'></div>
  </div>    
   
   
  <div class='row-form'>
  <div class='span3'>Sub Judul Artikel</div>
  <div class='span9'><input type=text name='sub_judul'></div>
  <div class='clear'></div>
  </div>    
   
	
  <div class='row-form'>
  <div class='span3'>Kategori</div>
  <div class='span9'>        
  <select name='kategoriartikel' id='s2_2'>   
  <option value=0 selected>Pilih Kategori</option>";
  $tampil=mysql_query("SELECT * FROM kategoriartikel ORDER BY nama_kategoriartikel");
  while($r=mysql_fetch_array($tampil)){
  echo "<option value=$r[id_kategoriartikel]>$r[nama_kategoriartikel]</option>"; }
  echo "</select>  </div><div class='clear'></div>
  </div>";
  
  
  if ($r[headline]=='Y'){
  echo "
  <div class='row-form'>
  <div class='span3'>Headline</div>
  <div class='span9'>
  <input type=radio name='headline' value='Y' checked>Ya  
  <input type=radio name='headline' value='N'>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
   
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Headline</div>
  <div class='span9'>
  <input type=radio name='headline' value='Y'>Ya  
  <input type=radio name='headline' value='N' checked>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
   
   
  ///////////////////////////////////////////////////////////////////////
  if ($r[aktif]=='Y'){
  echo "
  <div class='row-form'>
  <div class='span3'>Aktif</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Y' checked>Ya 
  <input type=radio name='aktif' value='N'>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
									  
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Aktif</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Y'>Ya 
  <input type=radio name='aktif' value='N' checked>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
  //////////////////////////////////////////////////////////////////////
										 

   if ($r[utama]=='Y'){
   echo "
  <div class='row-form'>
  <div class='span3'>Berita Utama</div>
  <div class='span9'>
  <input type=radio name='utama' value='Y' checked>Ya 
  <input type=radio name='utama' value='N'>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
						
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Berita Utama</div>
  <div class='span9'>
  <input type=radio name='utama' value='Y'>Ya 
  <input type=radio name='utama' value='N' checked>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
									  
  //////////////////////////////////////////////////////////						 
   
   
  echo "	
  <div class='row-form'>
  <div class='span3'><b>NEWSLETTER</b></div>
  <div class='span9'><input type='checkbox' name='kirimnewsletter' value='ya'>Kirimkan Newsletter</div>
  <div class='clear'></div>
  </div>    

  
  <div class='row-form'>
  <div class='span3'>Isi Artikel</div>
  <div class='span9'><textarea id='teraskreasi' name='isi_artikel'  style='height: 350px;'>
  <b>$iden[nama_website],</b> mulai isi artikel disini..</textarea></div>
  <div class='clear'></div>
  </div>    
	
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><input type=file name='fupload'>
  </div>
  <div class='clear'></div>
  </div>  
  
  <div class='row-form'>
  <div class='span3'>Keterangan Gambar</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan_gambar'></textarea></div>
  <div class='clear'></div>
  </div>";
  
  $tag = mysql_query("SELECT * FROM tag ORDER BY tag_seo");
  echo " <div class='row-form'>
  <div class='span3'>Tag Arikel</div> <div class='span9'>";
  while ($t=mysql_fetch_array($tag)){
  echo "<input type=checkbox value='$t[tag_seo]' name=tag_seo[]>$t[nama_tag] ";}
		  
  echo "</div>
  <div class='clear'></div>
  </div>
  
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=artikel'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";

		  
  break;
  // EDIT ARTIKEL////////////////////////////////////////////////////////////////////////////
  case "editartikel":
  
   if ($_SESSION[leveluser]=='admin'){
  $edit = mysql_query("SELECT * FROM artikel WHERE id_artikel='$_GET[id]'");}
  
  else{
	   $edit = mysql_query("SELECT * FROM artikel WHERE id_artikel='$_GET[id]' AND username='$_SESSION[namauser]'");}
  
	  
  $r    = mysql_fetch_array($edit);



  echo "
  <div class='workplace'>
  <div class='row-fluid'>
  
  <div class='span12'>
  <div class='head'>
  <div class='isw-documents'></div>
  <h1>Edit Artikel</h1>
  <div class='clear'></div>
  </div>
					
  <div class='block-fluid'>             
  <form method=POST enctype='multipart/form-data' action=$aksi?module=artikel&act=update>
  <input type=hidden name=id value=$r[id_artikel]>
		 

  <div class='row-form'>
  <div class='span3'>Judul Artikel</div>
  <div class='span9'><input type=text name='judul' value='$r[judul]'></div>
  <div class='clear'></div>
  </div>    

   
  <div class='row-form'>
  <div class='span3'>Sub Judul Artikel</div>
  <div class='span9'><input type=text name='sub_judul' value='$r[sub_judul]'></div>
  <div class='clear'></div>
  </div>    
   

  <div class='row-form'>
  <div class='span3'>Kategori</div>
  <div class='span9'>        
  <select name='kategoriartikel' id='s2_2'> ";
  $tampil=mysql_query("SELECT * FROM kategoriartikel ORDER BY nama_kategoriartikel");
  if ($r[id_kategoriartikel]==0){
  echo "<option value=0 selected>Pilih Kategori</option>"; }   
  while($w=mysql_fetch_array($tampil)){
  if ($r[id_kategoriartikel]==$w[id_kategoriartikel]){
  echo "<option value=$w[id_kategoriartikel] selected>$w[nama_kategoriartikel]</option>";}
  else{
  echo "<option value=$w[id_kategoriartikel]>$w[nama_kategoriartikel]</option>";}}
  echo "</select> </div><div class='clear'></div>
  </div>";


  if ($r[headline]=='Y'){
  echo "
  <div class='row-form'>
  <div class='span3'>Headline</div>
  <div class='span9'>
  <input type=radio name='headline' value='Y' checked>Ya  
  <input type=radio name='headline' value='N'>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
   
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Headline</div>
  <div class='span9'>
  <input type=radio name='headline' value='Y'>Ya  
  <input type=radio name='headline' value='N' checked>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
   

  ///////////////////////////////////////////////////////////////////////
  if ($r[aktif]=='Y'){
  echo "
  <div class='row-form'>
  <div class='span3'>Aktif</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Y' checked>Ya 
  <input type=radio name='aktif' value='N'>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
									  
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Aktif</div>
  <div class='span9'>
  <input type=radio name='aktif' value='Y'>Ya 
  <input type=radio name='aktif' value='N' checked>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
  //////////////////////////////////////////////////////////////////////
										 

  if ($r[utama]=='Y'){
  echo "
  <div class='row-form'>
  <div class='span3'>Berita Utama</div>
  <div class='span9'>
  <input type=radio name='utama' value='Y' checked>Ya  
  <input type=radio name='utama' value='N'>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
						
  else{
  echo "
  <div class='row-form'>
  <div class='span3'>Berita Utama</div>
  <div class='span9'>
  <input type=radio name='utama' value='Y'>Ya  
  <input type=radio name='utama' value='N' checked>Tidak
  </div>
  <div class='clear'></div>
  </div>";}
									  
  //////////////////////////////////////////////////////////						 
   


  echo "
  <div class='row-form'>
  <div class='span3'><b>NEWSLETTER</b></div>
  <div class='span9'><input type='checkbox' name='kirimnewsletter' value='ya'>Kirimkan Newsletter </div>
  <div class='clear'></div>
  </div>    
  
  <div class='row-form'>
  <div class='span3'>Isi Artikel</div>
  <div class='span9'><textarea id='teraskreasi' name='isi_artikel' style='height: 350px;'>$r[isi_artikel]</textarea></div>
  <div class='clear'></div>
  </div>    
	  
	  
  <div class='row-form'>
  <div class='span3'>Gambar</div>
  <div class='span9'><a class='fancybox' rel='group' href='../img_artikel/$r[gambar]'>
  <img src='../img_artikel/small_$r[gambar]' width=200 class='ttLT'' title='Perbesar Gambar'></a></div>
  <div class='clear'></div>
  </div>    
	  
	  
  <div class='row-form'>
  <div class='span3'>Ganti Gambar</div>
  <div class='span9'><input type=file name='fupload'>
  </div>
  <div class='clear'></div>
  </div>


  <div class='row-form'>
  <div class='span3'>Keterangan Gambar</div>
  <div class='span9'><textarea id='teraskreasi' name='keterangan_gambar' style='height: 150px;'>
  $r[keterangan_gambar]</textarea></div>
  <div class='clear'></div>
  </div>";


  $d = GetCheckboxes('tag', 'tag_seo', 'nama_tag', $r[tag]);
  echo "  <div class='row-form'>
  <div class='span3'>Tag Arikel</div><div class='span9'>
  $d";


  echo "</div>
  <div class='clear'></div>
  </div>
  
  <div class='row-form'>
  <a class='btn btn-danger btn-rounded' id=reset-validate-form href='?module=artikel'>Batal</a>
  <input type='submit' name=TerasKreasi'  class='btn' value='Simpan' style='height:30px;'>
  </div>

  </form>
  </div></div></div>";
  
		 
  break; }
	
  } else {
  echo akses_salah();
  }
  }
  ?>

  <script>
  function confirmdelete(delUrl) {
  if (confirm("Anda yakin ingin menghapus ini?")) {
  document.location = delUrl;}}
  </script>

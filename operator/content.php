   
   <?php
   include "../config/koneksi.php";
   include "../config/library.php";
   include "../config/fungsi_indotgl.php";
   include "../config/fungsi_combobox.php";
   include "../config/class_paging.php";


  $isi_komentar=mysql_num_rows(mysql_query("SELECT * FROM komentar WHERE dibaca='N'"));
  $jumHub=mysql_num_rows(mysql_query("SELECT * FROM hubungi WHERE dibaca='N'"));
  $hit=mysql_num_rows($baru);

   // Bagian Home
   if ($_GET['module']=='home'){
   if ($_SESSION['leveluser']=='admin'){
   echo "
  
   <div class='workplace'>
   <div class='row-fluid'>
   <div class='span12'>
   <div class='contentinner content-dashboard'>
  
   <div class='alert alert-success'>
   <strong>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda atau pilih ikon-ikon pada  
   Control Panel di bawah ini:
   </div>
                
   <div class='widgetButtons'>   					
					
   <div class='bb'>
   <a href=media.php?module=identitas>
   <img src='img/www.png'/></a>
   <div class='caption'>Identitas Website</div>   
   </div>
   
   <div class='bb'>
   <a href=media.php?module=menu><img src='img/modul.png'/></a>
   <div class='caption'>Menu Website</div>
   </div>

   <div class='bb'>
   <a href=media.php?module=halamanstatis><img src='img/add_page.png'/></a>
   <div class='caption'>Halaman Baru</div>
   </div>
   


   <div class='bb'>
   <a href=media.php?module=artikel>
   <img src='img/berita.png'/></a>
   <div class='caption'>Artikel</div>
   </div>
   
   
   <div class='bb'>
   <a href=media.php?module=kategoriartikel>
   <img src='img/kategoriblog.png'/></a>
   <div class='caption'>Kategori Artikel</div>
   </div>
   
   <div class='bb'>
   <a href=media.php?module=katajelek><img src='img/sensor.png'/></a>
   <div class='caption'>Sensor Kata</div>
   </div>
   
   <div class='bb'>
   <a href=media.php?module=komentar><img src='img/komentar.png'/></a>
   <div class='caption'>Komentar Artikel</div>
   </div>

   
   <div class='bb'>
   <a href=media.php?module=album><img src='img/album.png'/></a>
   <div class='caption'>Album Foto</div>
   </div>
   
   
   <div class='bb'>
   <a href=media.php?module=galerifoto><img src='img/foto.png'/></a>
   <div class='caption'>Galeri Foto</div>
   </div>


   <div class='bb'>
   <a href=media.php?module=video>
   <img src='img/video.png'/></a>
   <div class='caption'>Video</div>
   </div>
   
   
   <div class='bb'>
   <a href=media.php?module=playlist>
   <img src='img/playlist.png'/></a>
   <div class='caption'>Playlist Video</div>
   </div>


   <div class='bb'>
   <a href=media.php?module=agenda><img src='img/agenda.png'/></a>
   <div class='caption'>Agenda</div>
   </div>
   
   
   
   <div class='bb'>
   <a href=media.php?module=hubungi><img src='img/hubungi.png'/></a>
   <div class='caption'>Pesan Masuk</div>
   </div>
   
   
   <div class='bb'>
   <a href=media.php?module=logo><img src='img/gantilogo.png'/></a>
   <div class='caption'>Logo Website</div>
   </div>
   
   
   <div class='bb'>
   <a href=media.php?module=templates><img src='img/template.png'/></a>
   <div class='caption'>Template</div>
   </div>


   
   <div class='bb'>
   <a href=media.php?module=peta><img src='img/peta.png'/></a>
   <div class='caption'>Peta Lokasi</div>
   </div>
  
   
   <div class='bb'>
   <a href=media.php?module=ym><img src='img/ym.png'/></a>
   <div class='caption'>Modul YM</div>
   </div>
  
   <div class='bb'>
   <a href=media.php?module=download><img src='img/link.png'/></a>
   <div class='caption'>Download</div>
   </div>
   
   
   <div class='bb'>
   <a href=media.php?module=perbaikan><img src='img/perbaikan.png'/></a>
   <div class='caption'>Maintenance Web</div>
   </div>

   
   <div class='bb'>
   <a href=media.php?module=user><img src='img/user.png'/></a>
   <div class='caption'>User Admin</div>
   </div>


  <br/><br/>
  <div class='block-fluid2'>
  <table cellpadding='0' cellspacing='0' width='55%' class='table'>  
  <tr>
  <td width='150px'>Waktu Login</td>
  <td>$hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " - "; 
  echo date("H:i:s");
  echo " WIB</td></tr> ";
  
  
  
  
  
  // STATISTIK //////////////////////////////////////////////////////////////
  
  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
  
  if(mysql_num_rows($s) == 0){
  mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");} 
  
  else{
  mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");}

  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik 
  WHERE tanggal='$tanggal' GROUP BY  tanggal")); 
  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $bataswaktu       = time() - 300;
  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

  $path = "counter/";
  $ext = ".png";

  $tothitsgbr = sprintf("%06d", $tothitsgbr);
  for ( $i = 0; $i <= 9; $i++ ){
  $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);}

  echo "
  <tr>
  <td class='width30'>Pengunjung Website</td><td class='width70'>$pengunjungonline</td>
  </tr>
  <tr>
  <td class='width30'>Hits Hari Ini</td><td class='width70'>$hits[hitstoday]</td>
  </tr>";
 
  echo " 
  </table>
  </div>
  </div></div>
  </div></div>";} 
   
   
   else {
   echo "    <div class='workplace'>
   <div class='row-fluid'>
   <div class='span12'>
   <div class='contentinner content-dashboard'>
  
   <div class='alert alert-info'>
   <strong>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda.
   </div>


  <div class='block-fluid2'>
  <table cellpadding='0' cellspacing='0' width='55%' class='table'>  
  <tr>
  <td width='150px'>Waktu Login</td>
  <td>$hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " - "; 
  echo date("H:i:s");
  echo " WIB</td></tr> ";
  
  
  
  // STATISTIK //////////////////////////////////////////////////////////////
  
  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
  
  if(mysql_num_rows($s) == 0){
  mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");} 
  
  else{
  mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");}

  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik 
  WHERE tanggal='$tanggal' GROUP BY  tanggal")); 
  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $bataswaktu       = time() - 300;
  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

  $path = "counter/";
  $ext = ".png";

  $tothitsgbr = sprintf("%06d", $tothitsgbr);
  for ( $i = 0; $i <= 9; $i++ ){
  $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);}

  echo "
  <tr>
  <td class='width30'>Pengunjung Website</td><td class='width70'>$pengunjungonline</td>
  </tr>
  <tr>
  <td class='width30'>Hits Hari Ini</td><td class='width70'>$hits[hitstoday]</td>
  </tr>";
 
  echo " 
  </table>
  </div>
  </div></div>
  </div></div>";}} 
   


  //============= 01. MENU UTAMA ==================================================->
  
  // Bagian Pofil
  elseif ($_GET['module']=='profil'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_profil/profil.php";}}
  
  // Bagian Simulasi IMB
  elseif ($_GET['module']=='imb'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_imb/imb.php";}}
  
  
  // Bagian Identitas 
  elseif ($_GET['module']=='identitas'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_identitas/identitas.php";}}

  // Bagian Menu Utama
  elseif ($_GET['module']=='menu'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_menu/menu.php";}}
  
  // Bagian Menu Utama2
  elseif ($_GET['module']=='menu2'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_menu2/menu.php";}}

  // Bagian Menu (Atas)
  elseif ($_GET['module']=='menuutama'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_menuutama/menuutama.php";}}

  // Bagian Halaman Statis
  elseif ($_GET['module']=='halamanstatis'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_halamanstatis/halamanstatis.php";}}
  
  //====================================================================->

  
  
  //======================== 02. MODUL ARTIKEL =============================->

  // Bagian Artikel
  elseif ($_GET['module']=='artikel'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_artikel/artikel.php";}}

  // Bagian Kategori Artikel
  elseif ($_GET[module]=='kategoriartikel'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_kategoriartikel/kategoriartikel.php";}}
  
  // Bagian Tag
  elseif ($_GET['module']=='tag'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_tag/tag.php"; }}

  // Bagian Komentar Artikel
  elseif ($_GET['module']=='komentar'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_komentar/komentar.php";}}
  
  // Bagian Kata Jelek
  elseif ($_GET['module']=='katajelek'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_katajelek/katajelek.php";}}

  //====================================================================->






  
  //======================== 07. MODUL PERUNDANGAN =============================->

  // Bagian Perundangan
  elseif ($_GET['module']=='perundangan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_perundangan/artikel.php";}}

  // Bagian Kategori Artikel
  elseif ($_GET[module]=='kategoriperundangan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_kategoriperundangan/kategoriartikel.php";}}
  
  
  //====================================================================->



  //============= 03. MODUL GALERI  ==================================================->
  // Bagian Album
  elseif ($_GET['module']=='album'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_album/album.php";}}

  // Bagian Galeri Foto
  elseif ($_GET['module']=='galerifoto'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_galerifoto/galerifoto.php";}}
  
  // Bagian Galeri Foto Kolase
  elseif ($_GET['module']=='galerifoto2'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_galerifoto2/galerifoto.php";}}
  
  // Bagian Playlist
  elseif ($_GET['module']=='playlist'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_playlist/playlist.php";}}

  // Bagian Video
  elseif ($_GET['module']=='video'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_video/video.php";}}

  // Bagian KomentarVideo 
  elseif ($_GET['module']=='komentarvid'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_komentarvid/komentarvid.php";}}

  // Bagian Tag Video
  elseif ($_GET['module']=='tagvid'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_tagvid/tagvid.php";}}
  
  //=====================================================================->


  //======================== 04. MODUL IKLAN =============================->
  
 // Bagian Iklan PopUp
  elseif ($_GET['module']=='iklanheader'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_iklanheader/iklanheader.php";}}

  // Bagian Iklan Tengah Home
  elseif ($_GET['module']=='iklantengah_home'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_iklantengah_home/iklantengah_home.php";}}
  
  // Bagian Iklan Tengah Dalam
  elseif ($_GET['module']=='iklantengah_dalam'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_iklantengah_dalam/iklantengah_dalam.php";}}

  // Bagian Iklan Sidebar Dalam
  elseif ($_GET['module']=='iklansidebar_dalam'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_iklansidebar_dalam/iklansidebar_dalam.php";}}
  
  
  // Bagian Iklan Sidebar Home
  elseif ($_GET['module']=='iklansidebar_home'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_iklansidebar_home/iklansidebar_home.php";}}
  
  // Bagian Iklan PopUp
  elseif ($_GET['module']=='iklan_popup'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_iklan_popup/iklan_popup.php";}}
  //=====================================================================->




  //======================== 05. MODUL WEB ===============================->
  
  // Bagian Logo
  elseif ($_GET[module]=='logo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_logo/logo.php";}}

  // Bagian Templates
  elseif ($_GET['module']=='templates'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_templates/templates.php";}}


  //  Bagian Header
  elseif ($_GET[module]=='header'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_header/header.php";}}


  // Bagian Perbaikan Website
  elseif ($_GET['module']=='perbaikan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_perbaikan/perbaikan.php";}}


  // Bagian Background
  elseif ($_GET[module]=='background'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
  include "modul/mod_background/background.php";}}   
  

  // Bagian Hubungi Kami
  elseif ($_GET['module']=='hubungi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_hubungi/hubungi.php";}}


  // Bagian Testimoni
  elseif ($_GET[module]=='testimoni'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
  include "modul/mod_testimoni/testimoni.php";}}


   // Bagian Peta
  elseif ($_GET['module']=='peta'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
  include "modul/mod_peta/peta.php";}}


  // Bagian YM
  elseif ($_GET[module]=='ym'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_ym/ym.php";}}


  // Bagian Poling
  elseif ($_GET['module']=='poling'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_poling/poling.php";}}

  // Bagian Newsletter
  elseif ($_GET['module']=='newsletter'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_newsletter/newsletter.php";}}

  // Bagian Agenda
  elseif ($_GET['module']=='agenda'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_agenda/agenda.php";}}
  
  // Bagian Sekilas Info
  elseif ($_GET['module']=='sekilasinfo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_sekilasinfo/sekilasinfo.php";}}
  
  // Bagian Download
  elseif ($_GET['module']=='download'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_download/download.php";}}


  // Bagian KategoriDownload
  elseif ($_GET[module]=='kategoridownload'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_kategoridownload/kategoridownload.php";}}
  
  // Bagian Sekilas Info
  elseif ($_GET['module']=='sekilasinfo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_sekilasinfo/sekilasinfo.php";}}
  //=================================================================================->
  


  //======================== 06. MODUL USER =============================->
  
  // Bagian User
  elseif ($_GET['module']=='user'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
  include "modul/mod_users/users.php"; }}

  // Bagian Modul
  elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_modul/modul.php";}}
  
  //=========================================================================->

  
  
  //======================== 08. MODUL PEGAWAI =============================->

  // Bagian Perundangan
  elseif ($_GET['module']=='pegawai'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_pegawai/pegawai.php";}}

  // Bagian Kategori Artikel
  elseif ($_GET[module]=='kategoripegawai'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_kategoripegawai/kategoriartikel.php";}}
  
  
  //====================================================================->

  
  
  

  
  //======================== 09. MODUL RESUME =============================->

  // Bagian Perundangan
  elseif ($_GET['module']=='resume'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_resume/resume.php";}}

  // Bagian Kategori Artikel
  elseif ($_GET[module]=='kategoriresume'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
  include "modul/mod_kategoriresume/kategoriresume.php";}}
  
  
  //====================================================================->
  
  
  // Apabila modul tidak ditemukan
  else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";}


  ?>

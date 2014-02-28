 
  <?php
  
  
  if($_GET['module']=='home'){
  echo "<li><a href='?module=home'>Beranda</a></li>";}
  
  
  
  
  //// MODUL UTAMA ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  elseif($_GET['module']=='profil'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Profil</li>";}
  
  elseif($_GET['module']=='identitas'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Identitas Website</li>";}
  
  elseif($_GET['module']=='menu'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Menu Website (Atas)</li>";}
  
  elseif($_GET['module']=='menu2'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Menu Website (Utama)</li>";}

  elseif($_GET['module']=='menuutama'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Menu Website (Bawah)</li>";}

  elseif($_GET['module']=='halamanstatis'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Halaman Baru</li>";}
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  //// MODUL ARTIKEL  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  elseif($_GET['module']=='artikel'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Artikel</li>";}

  elseif($_GET['module']=='kategoriartikel'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Kategori Artikel</li>";}

  elseif($_GET['module']=='tag'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Tag Artikel</li>";}

  elseif($_GET['module']=='katajelek'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Sensor Komentar Artikel</li>";}

  elseif($_GET['module']=='komentar'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Komentar Artikel</li>";}
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  //// MODUL GALERI////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  elseif($_GET['module']=='album'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Album Foto</li>";}

  elseif($_GET['module']=='galerifoto'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Galeri Foto</li>";}
  
  elseif($_GET['module']=='galerifoto2'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Foto Kolase</li>";}
  
  elseif($_GET['module']=='video'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Video</li>";}
  
  elseif($_GET['module']=='playlist'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Playlist Video</li>";}
  
  elseif($_GET['module']=='komentarvid'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Komentar Video</li>";}
  
  elseif($_GET['module']=='tagvid'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Tag Video</li>";}
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  

  //// MODUL IKLAN////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  elseif($_GET['module']=='iklanheader'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Iklan Header</li>";}

  elseif($_GET['module']=='iklantengah_home'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Iklan Tengah (home)</li>";}
  
  elseif($_GET['module']=='iklantengah_dalam'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Iklan Tengah (dalam)</li>";}
  
  elseif($_GET['module']=='iklansidebar_home'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Iklan Sidebar (home)</li>";}
  
  elseif($_GET['module']=='iklansidebar_dalam'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Iklan Sidebar (dalam)</li>";}
  
  elseif($_GET['module']=='iklan_popup'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Iklan PopUp</li>";}
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  //// MODUL WEB ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  elseif($_GET['module']=='newsletter'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Newsletter</li>";}

  elseif($_GET['module']=='agenda'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Agenda</li>";}
  
  elseif($_GET['module']=='poling'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Polling</li>";}
  
  elseif($_GET['module']=='logo'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Logo Website</li>";}
  
  elseif($_GET['module']=='templates'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Templates Website</li>";}
  
  elseif($_GET['module']=='background'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Background Website</li>";}
  
  elseif($_GET['module']=='perbaikan'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Maintenance Website</li>";}
  
  elseif($_GET['module']=='hubungi'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Pesan Masuk</li>";}
  
  elseif($_GET['module']=='ym'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Yahoo Messenger</li>";}
  
  elseif($_GET['module']=='kategoridownload'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Kategori Download</li>";}
  
  elseif($_GET['module']=='download'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Download</li>";}
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  //// MODUL USER ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  elseif($_GET['module']=='user'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>User Admin</li>";}
  
  elseif($_GET['module']=='modul'){
  echo "<li><a href='?module=home'>Beranda</a></li><span class='divider'>></span> <li class='active'>Manajemen Modul</li>";}
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ?>

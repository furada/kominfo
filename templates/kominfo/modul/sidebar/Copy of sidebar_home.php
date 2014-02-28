
  <aside id="sidebar" class="four column pull-right">
  <ul class="no-bullet">


  <!--================= TAB KONTEN ========================-->  
  <li class="widget tabs-widget clearfix">
  <ul class="tab-links no-bullet clearfix">
  <li class="active"><a href="#popular-tab">Populer</a></li>
  <li><a href="#recent-tab">Terkini</a></li>
  <li><a href="#comments-tab">Komentar</a></li>
  </ul>

  <div id="popular-tab">
  <ul>
  <?php    
  //Terpopuler berdasarkan seminggu 
  /* $hari_ini=date("Ymd");
  $sebelum=mktime(0, 0, 0, date("m"), date("d") - 7, date("Y"));    
  $tgl_sebelumnya=date("Ymd", $sebelum);
  $populer=mysql_query("SELECT * FROM artikel WHERE tanggal BETWEEN '$tgl_sebelumnya' AND '$hari_ini' 
  ORDER BY dibaca DESC LIMIT 5"); */ 
  
   /*  Terpopuler harian
  $hari_ini=date("Ymd");
  $populer=mysql_query("SELECT * FROM artikel WHERE tanggal='$hari_ini' ORDER BY dibaca DESC LIMIT 4");
  */ 
  
  $populer=mysql_query("SELECT * FROM artikel ORDER BY dibaca DESC LIMIT 5");
                 
 
  while($p=mysql_fetch_array($populer)){
  $baca = $p[dibaca]+1;
  
  if ($p['gambar']!=''){
  
  echo "
  <li>
  <a href='artikel-$p[id_artikel]-$p[judul_seo].html'>
  <img alt='$p[judul]' src='img_artikel/small_$p[gambar]' ></a>";}
  
  else{	
  echo "<li>
  <a href='artikel-$p[id_artikel]-$p[judul_seo].html'>
  <img alt='$p[judul]' src='img_artikel/gakadegambarnye.jpg'></a>";}
  
  echo "
  <h3> <a href='artikel-$p[id_artikel]-$p[judul_seo].html'>$p[judul]</a></h3>
  <div class='post-date'>dibaca: $baca pembaca</div>
  </li> ";}
  ?>
  </ul>
  </div>

  <!--=======================================================-->  


  <div id="recent-tab">
  <ul>
  <?php 
  $terkini=mysql_query("SELECT * FROM artikel ORDER BY id_artikel DESC LIMIT 4");
  while($t=mysql_fetch_array($terkini)){
  $tgl = tgl_indo($t['tanggal']);
  
  
  if ($t['gambar']!=''){
  echo "
  <li>
  <a href='artikel-$t[id_artikel]-$t[judul_seo].html'>
  <img alt='$t[judul]' src='img_artikel/small_$t[gambar]' ></a>";}
  
  else{	
  echo "<li>
  <a href='artikel-$t[id_artikel]-$t[judul_seo].html'>
  <img alt='$t[judul]' src='img_artikel/gakadegambarnye.jpg'></a>";}
  
  echo "
  <h3> <a href='artikel-$t[id_artikel]-$t[judul_seo].html'>$t[judul]</a></h3>
  <div class='post-date'>$t[hari], $tgl</div>
  </li> ";}
  ?>
  </ul>
  </div>
  <!--=======================================================-->  

  <div id="comments-tab">
  <ul>
  <?php    
  $komentar=mysql_query("SELECT * FROM artikel,komentar 
  WHERE komentar.id_artikel=artikel.id_artikel  
  ORDER BY id_komentar DESC LIMIT 6");
  while($k=mysql_fetch_array($komentar)){
  $tanggal = tgl_indo($k[tgl]);
  $grav_url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim( $k[url] ) ) ) . '?d=' . urlencode( $default ) . '&s=' .  
  $size;;
  
  if ($k[url]!=''){
  echo "<li><a href='#'><img alt='' src='$grav_url''></a>";}
  
  else{	
  echo " <div class='single-post'>
  <div class='image'>
  <img src='$f[folder]/img/gakadefotonye.jpg' height=40/></div>";}
  
  echo "
  <h3><a href='http://$k[url]' target='_blank'>$k[nama_komentar]</a></h3>
  <div class='author-comment'>pada: <a href='artikel-$k[id_artikel]-$k[judul_seo].html#$k[id_komentar]' title='$k[isi_komentar]'>$k[judul]</a></div>";}
  ?>
  
  </ul>
  </div>
  <!--=======================================================-->  
  </li>
  <!--================= AKHIR TAB KONTEN ========================-->  
					
					
  <!--================= NEWSLETTER ========================-->  
  <li class="widget subscribe-widget clearfix">
  <h3 class="widget-title">Berlangganan Artikel</h3>
  <?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
  $email=htmlspecialchars($_POST['email']);
  $mail=explode("@",$email);
  $akun=$mail[1];
  $cek=mysql_num_rows(mysql_query("SELECT * FROM newsletter WHERE email='$email'"));
  $array = array("yahoo.com","ymail.com","yahoo.co.id","rocketmail.com","gmail.com");

  if($cek>0){
  echo "
  <h5>Maaf email ini sudah terdaftar sebelumnya.</h5>
  <a href='javascript:history.go(-1);'><input type='button' value='ulangi' class='button-yellow'/></a>";}
  
  elseif(!in_array($akun, $array)){
  echo "<h5>Maaf email yang anda inputkan tidak valid.</h5>
  <a href='javascript:history.go(-1);'><input type='button' value='ulangi' class='button-yellow'/></a>";} 
  
  else {
  mysql_query("INSERT INTO newsletter SET email='$email'");
  echo "<p>Terima kasih telah berlangganan artikel kami.</p>";}} 
  
  else {
  echo "
  <form method='post' action='' >
  <input type='text' name='email' placeholder='email anda'/>
  <input type='submit' value='daftar'/>
  </form>";}
  ?>  
  </li>
  <!--================= AKHIR NEWSLETTER ========================-->  
						
  <!--================= IKLAN SIDEBAR HOME 1 ========================-->
  <li class="widget widget_ads_big clearfix">
  <?php
  $iklantengah_home=mysql_query("SELECT * FROM iklansidebar_home WHERE aktif='Ya' AND id_iklansidebar_home='1'
  ORDER BY id_iklansidebar_home DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='clearfix'>
  
  <div style='width:300px;height:350px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='300' height='350'>
  <param name='movie' value='img_iklansidebar_home/$b[gambar]'' />
  <param name='quality' value='high' />
  <param name='wmode' value='transparent'>
  <embed src='img_iklansidebar_home/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='300' height='350' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer2.png' width='300' height='350'/></a>
  </div>
  </div>  
  
  
  </div>";}?>
  </li>
  <!--================= AKHIR IKLAN SIDEBAR HOME 1 ========================-->
						
					
					
					
  <!--================= KURS VALUTA ASING ========================-->  
  <li class="widget widget_facebook_box clearfix">
  <h3 class="widget-title">KURS VALUTA ASING</h3>
  <?php
  include_once("fungsi_kurs_bca.php");
  ?>  </li>
  <!--================= AKHIR VALUTA ASING ========================-->  
					
					
  <!--=================  VIDEO  ========================-->  
  <li class="widget widget_video clearfix">
  <h3 class="widget-title">Video</h3>
  <?php    
  $detailrzl=mysql_query("SELECT * FROM video ORDER BY id_video DESC limit 1");
  $drzl   = mysql_fetch_array($detailrzl);
  if($drzl[video]==''){
  $teraskreasi="1";
  $detail=mysql_query("SELECT * FROM video,users WHERE users.username=video.username ORDER BY id_video DESC limit 1");
  while ($d   = mysql_fetch_array($detail)){ 
  
  echo "  
  <div id='mediaplayer'></div>
  <script src='$f[folder]/js/jwplayer.js' type='text/javascript'></script>
  <script type='text/javascript'>
  jwplayer('mediaplayer').setup({
  flashplayer: '$f[folder]/flash/jwplayer.swf',
  file: '$d[youtube]',
  image: 'img_video/$d[gbr_video]',   
  volume: '70',
  autostart: false,
  width: '100%',
  height: '190',
  stretching: 'exactfit',
  skin: '$f[folder]/flash/minimal/minimal.xml'
  });
  </script>  
  <a href=play-$d[id_video]-$d[video_seo].html><p>$d[jdl_video]</p></a>";}}
  
  else {  
  $teraskreasi="2";		
  $detail=mysql_query("SELECT * FROM  video,users WHERE users.username=video.username ORDER BY id_video DESC limit 1");
  while ($d   = mysql_fetch_array($detail)){ 

  echo "							
  <div id='mediaplayer'></div>
  <script src='$f[folder]/js/jwplayer.js' type='text/javascript'></script>
  <script type='text/javascript'>
  jwplayer('mediaplayer').setup({
  flashplayer: '$f[folder]/flash/jwplayer.swf',
  file: 'img_video/$d[video]',
  image: 'img_video/$d[gbr_video]',   
  volume: '70',
  autostart: false,
  width: '100%',
  height: '190',
  stretching: 'exactfit',
  skin: '$f[folder]/flash/minimal/minimal.xml'
  });
  </script>
  <a href=play-$d[id_video]-$d[video_seo].html><p>$d[jdl_video]</p></a>";}}
  ?>						
  </li>
  <!--================= AKHIR VIDEO  ========================-->  
					
						
  <!--================= IKLAN SIDEBAR HOME 2 ========================-->
  <li class="widget widget_ads_big clearfix">
  <?php
  $iklantengah_home=mysql_query("SELECT * FROM iklansidebar_home WHERE aktif='Ya' AND id_iklansidebar_home='2'
  ORDER BY id_iklansidebar_home DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='clearfix'>
  
  <div style='width:300px;height:350px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='300' height='350'>
  <param name='movie' value='img_iklansidebar_home/$b[gambar]'' />
  <param name='quality' value='high' />
  <param name='wmode' value='transparent'>
  <embed src='img_iklansidebar_home/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='300' height='350' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer2.png' width='300' height='350'/></a>
  </div>
  </div>  
  
  </div>";}?>
  </li>
  <!--================= AKHIR IKLAN SIDEBAR HOME 2 ========================-->
					
	
  <!--================= INDEX & ARSIP ARTIKEL ========================-->
  <div class="widget clearfix">
  <h3 class="widget-title">INDEX & ARSIP ARTIKEL</h3>
  <ul class="bullet-list">
  
  <?php
  $qindeks=mysql_num_rows(mysql_query("select * from modul where nama_modul='Indeks Berita' and publish='Ya'"));
  if ($qindeks > 0){
  echo "
  <form method=POST action='indeks-artikel.html' id='contact'>";    
  combotgl(1,31,'tanggal',$tgl_skrg);
  echo " / ";
  combobln(1,12,'bulan',$bln_sekarang);
  echo " / ";
  combothn(2000,$thn_sekarang,'tahun',$thn_sekarang);
  echo "<input type=submit value='' class='input-submit2'/></form>";}
  ?>
  
  <?php
  $archive = mysql_query("SELECT DISTINCT(MONTH(tanggal)) as bulan, YEAR(tanggal) as tahun FROM artikel ORDER BY tahun DESC,bulan DESC LIMIT 8");
  while($h = mysql_fetch_array($archive)){
  
  $jumlah_berita = mysql_num_rows(mysql_query("SELECT id_artikel FROM artikel WHERE MONTH(tanggal)='$h[bulan]' AND YEAR(tanggal)='$h[tahun]'"));
  echo "<li><a href='arsip-$h[bulan]-$h[tahun].html'>".getBulan($h[bulan])." $h[tahun] 
  <span class style=\"color:#fc7100;float:right;\">($jumlah_berita)</span></a></li>";}
  ?>	
  
  </ul>	
  </div>
  <!--================= AKHIR INDEX & ARSIP ARTIKEL ========================-->  
	
	
  <!--================= TAG ARTIKEL ========================-->
  <li class="widget widget_tag_cloud clearfix">
  <h3 class="widget-title">Tag Artikel</h3>
  <div class="tagcloud">
  <?php
  $tag = mysql_query("SELECT * FROM tag ORDER BY id_tag");
  $ambil = mysql_num_rows(mysql_query("SELECT id_artikel FROM artikel"));
  while ($var=mysql_fetch_array($tag)) {
  $an = mysql_query("SELECT count(id_artikel) as jml, tag FROM artikel WHERE tag LIKE '%$var[tag_seo]%'");
  $kk = mysql_fetch_array($an);
  if ($kk[jml] > 0) {
  $px = (($kk[jml]*100)/$ambil)+100;
	
  echo "<a href='tag-$var[id_tag]-$var[tag_seo].html' style='font-size:".$px."%' class='badge'>
  $var[nama_tag]</a>";
	
  mysql_query("UPDATE rdb_tag SET jumlah =$kk[jml] WHERE id_tag = $var[id_tag]");}
  else {echo " ";}}
  
  ?>
  </div>
  </li>
  <!--================= AKHIR TAG ARTIKEL ========================-->
		
	
	
  <!--================= KALENDER ACARA ========================-->
  <div class="widget clearfix">
  <h3 class="widget-title">Kalender Acara</h3>
  
  <div class="dzscalendar" id="tr1" style="width:100%;">
  <div class="events">
  <?php
  $agenda=mysql_query("SELECT * FROM agenda");
  while($a=mysql_fetch_array($agenda)){
  $pisah = explode("-", $a[tgl_mulai]);
  $tgl = $pisah[2];
  $bln = $pisah[1];
  $thn = $pisah[0];
  $tgl_mulai   = tgl_indo($a[tgl_mulai]);
  $isi_agenda = strip_tags($a['isi_agenda']);
  $isi = substr($isi_agenda,0,200);
  $isi = substr($isi_agenda,0,strrpos($isi," ")); 
  ?>
  <div class="realmarkupindocs" data-day="<?php echo "$tgl";?>" data-month="<?php echo "$bln";?>" data-year="<?php echo "$thn";?>">
  <div style="width:220px;">
  <div class="gbragenda"><?php echo "<a href='agenda-$a[id_agenda]-$a[tema_seo].html'><img src='img_agenda/small_$a[gambar]' width='220' alt='$a[tema]'></a>";?>
  <h5><?php echo "<a href='agenda-$a[id_agenda]-$a[tema_seo].html'>$a[tema]</a>";?></h5>
  <span>Tanggal: </span><?php echo $tgl_mulai;?><br/>
  <span>Lokasi : </span><?php echo $a[tempat];?><br/></div>
  </div>
  </div>
  <?php }	
  ?>
  </div>
  </div>		
		

  </div>
  <!--================= AKHIR KALENDER ACARA ========================-->  
		
		
			
  </ul>
  </aside>

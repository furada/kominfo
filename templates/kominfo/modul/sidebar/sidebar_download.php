
  <aside id="sidebar" class="four column pull-right">
  <ul class="no-bullet">

		
	
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

					

  <!--================= BERITA FOTO  ========================-->  
  <li class="widget widget_ads_small clearfix">
  <h3 class="widget-title">BERITA FOTO</h3>
  <ul class="no-bullet clearfix">
						
  <?php
  $album= mysql_query("SELECT jdl_album, album.id_album, gbr_album, album_seo,  
  COUNT(gallery.id_gallery) as jumlah 
  FROM album LEFT JOIN gallery 
  ON album.id_album=gallery.id_album 
  WHERE album.aktif='Y'  
  GROUP BY id_album
  ORDER BY rand() DESC LIMIT 4");
  
  while($w=mysql_fetch_array($album)){
  $jdl_album=($w[jdl_album]);
						
  echo "   
  <li><a href=album-$w[id_album]-$w[album_seo].html><img src='img_album/kecil_$w[gbr_album]' class='booltip' title='$w[jdl_album]'></a></li>";}
  ?>
  </ul>
  </li>					
  <!--================= AKHIR BERITA FOTO  ========================-->  


						
  <!--================= IKLAN SIDEBAR DALAM 2 ========================-->
  <li class="widget widget_ads_big clearfix">
  <?php
  $iklantengah_home=mysql_query("SELECT * FROM iklansidebar_dalam WHERE aktif='Ya' AND id_iklansidebar_dalam='2'
  ORDER BY id_iklansidebar_dalam DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='clearfix'>
  
  <div style='width:300px;height:160px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='300' height='160'>
  <param name='movie' value='img_iklansidebar_dalam/$b[gambar]'' />
  <param name='quality' value='high'/>
  <param name='wmode' value='transparent'>
  <embed src='img_iklansidebar_dalam/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='300' height='160' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer3.png' width='300' height='160'/></a>
  </div>
  </div>  
  
  </div>";}?>
  </li>
  <!--================= AKHIR IKLAN SIDEBAR DALAM 2 ========================-->
					
	
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

						
  <!--================= IKLAN SIDEBAR DALAM 1 ========================-->
  <li class="widget widget_ads_big clearfix">
  <?php
  $iklantengah_home=mysql_query("SELECT * FROM iklansidebar_dalam WHERE aktif='Ya' AND id_iklansidebar_dalam='1'
  ORDER BY id_iklansidebar_dalam DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='clearfix'>
  
  <div style='width:300px;height:160px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='300' height='160'>
  <param name='movie' value='img_iklansidebar_dalam/$b[gambar]'' />
  <param name='quality' value='high' />
  <param name='wmode' value='transparent'>
  <embed src='img_iklansidebar_dalam/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='300' height='160' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer3.png' width='300' height='160'/></a>
  </div>
  </div>  
  
  </div>";}?>
  </li>
  <!--================= AKHIR IKLAN SIDEBAR DALAM 1 ========================-->
	
	
  </ul>
  </aside>

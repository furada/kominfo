

  <!--================= DETAIL VIDEO ========================-->
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
				
  <?php
  $detail=mysql_query("SELECT * FROM video,users,playlist WHERE users.username=video.username 
  AND   video.id_playlist=playlist.id_playlist AND id_video='".$val->validasi($_GET['id'],'sql')."'");
  $d   = mysql_fetch_array($detail);
  $tgl = tgl_indo($d[tanggal]);
  $lihat = $d[dilihat]+1;
  
  mysql_query("UPDATE video SET dilihat=$d[dilihat]+1 
  WHERE id_video='".$val->validasi($_GET['id'],'sql')."'");       
  
  echo "  						
  <h1 class='post-title4'>$d[jdl_video]</h1>
  
  <div class='post-meta'>
  <span>$d[nama_lengkap]</span> <span class style=\"color:#fc7100;\">|</span>
  <span>$d[hari], $tgl- $d[jam] WIB</span> <span class style=\"color:#fc7100;\">|</span>
  <span>Dilihat: $lihat</span> 
  </div>

	
  <div class='addthis_toolbox addthis_default_style'>
  <a class='addthis_button_preferred_1'></a>
  <a class='addthis_button_preferred_2'></a>
  <a class='addthis_button_preferred_3'></a>
  <a class='addthis_button_preferred_4'></a>
  <a class='addthis_button_compact'></a>
  <a class='addthis_counter addthis_bubble_style'></a>
  </div>
  <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-504c13fd103cdd62'></script>
  
  <div class='clear'></div>
  <div class='line'></div>";
				

  $detailteras=mysql_query("SELECT * FROM video WHERE id_video=$d[id_video]");
  $dteras  = mysql_fetch_array($detailteras);
  if($dteras[video]==''){
  $teraskreasi="1";
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
  height: '360',
  stretching: 'exactfit',
  skin: '$f[folder]/flash/minimal/minimal.xml'
  });
  </script><br/>";}
  
  else {  
  $teraskreasi="2";			  
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
  height: '360',
  stretching: 'exactfit',
  skin: '$f[folder]/flash/minimal/minimal.xml'
  });
  </script><br/>";}
  
  
  echo "
  <div class='clear'></div>
  <div class='line'></div>
  $d[keterangan]
  <div class='clear'></div>
  <div class='line'></div>";
  
  
  //NEXT-PREV VIDEO///////////////////////////////////////////////////////////////////////
  $qp = mysql_query("select id_video, jdl_video, video_seo from
  video where id_video < '".$val->validasi($_GET['id'],'sql')."' order by id_video desc limit 1");
  $jp = mysql_num_rows($qp);
  $tp = mysql_fetch_array($qp);
  
  $qn = mysql_query("select id_video, jdl_video, video_seo from
  video where id_video > '".$val->validasi($_GET['id'],'sql')."' order by id_video asc limit 1");
  $jn = mysql_num_rows($qn);
  $tn = mysql_fetch_array($qn);
  
  echo "<br/><br/><div class='post-navigation'> ";
  
  if($jp <> 0) {
  echo "<div class='post-previous'><a href='play-$tp[id_video]-$tp[video_seo].html' rel='prev'>
  <span>Sebelumnya:</span>$tp[jdl_video]</a></div>";}
 
  if($jn <> 0) {
  echo "<div class='post-next'><a href='play-$tn[id_video]-$tn[video_seo].html' rel='next'>
  <span>Selanjutnya:</span> $tn[jdl_video]</a></div>";}
  
  echo "</div>";  
  // AKHIR NEXT-PREV VIDEO ///////////////////////////////////////////////////////////////////////  
  
  
  echo "	
  <div class='relatednews'>
  <h5 class='lune'><span>Video Terkait</span></h5>
  <ul>";
							   
  $pisah_kata  = explode(",",$d[tagvid]);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1; 
  $ambil_id = substr($_GET[id],0,4);

  $cari = "SELECT * FROM video,users WHERE (users.username=video.username) and (id_video<'$ambil_id') and (id_video!='$ambil_id') and (" ;
  for ($i=0; $i<=$jml_kata; $i++){
  $cari .= "tagvid LIKE '%$pisah_kata[$i]%'";
  if ($i < $jml_kata ){
  $cari .= " OR ";}}
  $cari .= ") ORDER BY id_video DESC LIMIT 4";
  $hasil  = mysql_query($cari);
  while($h=mysql_fetch_array($hasil)){
  
  if ($h['gbr_video']!=''){
  echo "
  <li>
  <a href='play-$h[id_video]-$h[video_seo].html'><img src='img_video/kecil_$h[gbr_video]' alt='$h[jdl_video]'></a>";}
 
  else{	
  echo "
  <li>
  <a href='play-$h[id_video]-$h[video_seo].html'><<img src='img_video/gakadegambarnye.jpg' alt='$h[jdl_video]'></a>";}
  
  echo "
  <p><h3><a href='play-$h[id_video]-$h[video_seo].html'><$h[jdl_video]</a></h3></p>
  </li>";}
								
								
  echo "</ul>
  </div>
  <div class='clear'></div>";	


  // IKLAN TENGAH DALAM//////////////////////////////////////////////////////////////////////////
  $iklantengah_home=mysql_query("SELECT * FROM iklantengah_dalam WHERE aktif='Ya' AND id_iklantengah_dalam='3'
  ORDER BY id_iklantengah_dalam DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='ads-middle mb25'>
  
  
  <div style='width:620px;height:120px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='620' height='120'>
  <param name='movie' value='img_iklantengah_dalam/$b[gambar]'' />
  <param name='quality' value='high' />
  <param name='wmode' value='transparent'>
  <embed src='img_iklantengah_dalam/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='620' height='120' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer.png' width='620' height='120'/></a>
  </div>
  </div>  
  
  </div>";}
  ////////////////////////////////////////////////////////////////////////////////////////////////////
  
  $komentar = mysql_query
  ("select count(komentarvid.id_komentar) as jml from komentarvid WHERE id_video='".$val->validasi($_GET['id'],'sql')."' AND aktif='Y'");
  $k = mysql_fetch_array($komentar); 

  echo "
  <div class='clear'></div>
  <h5 class='post-title2'>$k[jml] Komentar</h5>
  <br>";
  
  $p      = new HalKomentarVideo;
  $batas  = 5;
  $posisi = $p->cariPosisi($batas);

 
  $sql = mysql_query("SELECT * FROM komentarvid WHERE id_video='".$val->validasi($_GET['id'],'sql')."' AND aktif='Y' LIMIT $posisi,$batas");
  $jml = mysql_num_rows($sql);
 
  if ($jml > 0){
  while ($s = mysql_fetch_array($sql)){
  $tanggal = tgl_indo($s[tgl]);
  $grav_url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim( $s[url] ) ) ) . '?d=' . urlencode( $default ) . '&s=' .  
  $size;;
  
  if ($s[url]!=''){
  echo "<ol id='comments'>
  <li class='depth-1'>
  <div class='author-avatar'><img alt='$s[nama_komentar]' src='$grav_url'></div>
  <div class='comment-author'>$s[nama_komentar]</div>";}
  
  else{
  echo "
  <div class='comment-author'>$s[nama_komentar]</div>";}
  
  echo "<div class='comment-date'>$tanggal - $s[jam_komentar] WIB</div> 
  <div class='comment-text'><p>";
  
  $isian=nl2br($s[isi_komentar]); 
  $isikan=sensor($isian); 
  echo autolink($isikan);
  
  echo "</p></div>
  </li></ol><div class='line'></div>";}
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM komentarvid WHERE id_video='".$val->validasi($_GET['id'],'sql')."' AND aktif='Y'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halkomentarvideo'], $jmlhalaman);


  echo "<div class='pagenation clearfix'>
  <ul class='no-bullet'>
  $linkHalaman
  </ul>
  </div>";}
  

  echo "		
  <h5 class='judul'><span>Tulis Komentar</span></h5><br/>

			
  <div class='contact-form comment cleafix'>
  <form id='teraskreasi-form' action=simpankomentarvid.php method=POST onSubmit=\"return validasi(this)\">
 
  <label>Nama</label>
  <input required name='nama_komentar' type='text' id='nama_komentar' size=70><br/>
  
  
  <label>Email</label>
  <input required name='url'  type='text' id='url' size=70><br/>
  
  <label>Komentar</label>
  <textarea required name='isi_komentar' class='twelve column' id='isi_komentar'></textarea>


  <input required name='kode' size=6 maxlength=6  type='text' id='kode'>
  <div class='captcha'>
  <img id='captcha' src='terasconfig/captcha.php' border='0' ><a href='JavaScript: captcha();'>
  <img border='0' alt='' src='terasconfig/refresh.png' align='top'></a>
  </div>
  
  <input type='submit' value='KIRIM KOMENTAR'>
  <input type=hidden name=id value=$_GET[id]>
  <input type=hidden name=judul value=$d[video_seo]>			  
  </form>
  </div><br/><br/><br/>";  
			  
  // IKLAN TENGAH DALAM//////////////////////////////////////////////////////////////////////////
  $iklantengah_home=mysql_query("SELECT * FROM iklantengah_dalam WHERE aktif='Ya' AND id_iklantengah_dalam='1'
  ORDER BY id_iklantengah_dalam DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='ads-middle mb25'>
  <a href='$b[url]'' target='_blank'><embed src='img_iklantengah_dalam/$b[gambar]' border='0'></embed></a>
  </div>";}
  ////////////////////////////////////////////////////////////////////////////////////////////////////
  
  echo "		
  </section>";  
  ?>			
  <!--================= AKHIR DETAIL VIDEO ========================-->


  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  

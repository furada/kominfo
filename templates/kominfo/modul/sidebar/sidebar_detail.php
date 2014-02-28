<div class="main-content-right">
						
						<!-- BEGIN .main-nosplit -->
					  <div class="panel">
					    <h3 style="background:#f07f07;">ppid pembantu</h3>
					    <div><!-- BEGIN .article-side-block --><!-- BEGIN .article-array -->
					      <ul class="article-array content-category">
					        <li> <a href="hal-profil-ppid-pembantu-diskominfo.html">PROFIL PPID PEMBANTU DISKOMINFO</a></li>
					        <li> <a href="hal-peraturan-ppid.html">Peraturan PPID</a></li>
					        <li> <a href="hal-informasi-setiap-saat.html">Informasi Setiap Saat
</a></li>
					        <li> <a href="hal-informasi-serta-merta.html">Informasi Serta Merta</a></li>
					        <li> <a href="hal-informasi-berkala.html">Informasi Berkala</a></li>
					       <li> <a href="hal-informasi-dikecualikan.html">Informasi Dikecualikan</a></li>
					        <li> <a href="hal-tata-cara-permohonan-informasi.html">Tata cara Permohonan Informasi</a></li>
					        <li> <a href="hal-pelaporan.html">Pelaporan</a></li>
                               <li> <a href="download.html">DOWNLOAD</a></li>
					        <!-- END .article-array -->
				          </ul>
				        </div>
					    <!-- END .panel -->
				      </div>
					  <div class="main-nosplit">
					    <!-- BEGIN .banner -->
					    
                          <?php
  $iklantengah_home=mysql_query("SELECT * FROM iklansidebar_home WHERE aktif='Ya' AND id_iklansidebar_home='2'
  ORDER BY id_iklansidebar_home DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='clearfix'>
  
  <div style='width:300px;height:248px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='300' height='248'>
  <param name='movie' value='img_iklansidebar_home/$b[gambar]'' />
  <param name='quality' value='high' />
  <param name='wmode' value='transparent'>
  <embed src='img_iklansidebar_home/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='300' height='248' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer2.png' width='300' height='248'/></a>
  </div>
  </div>  
  
  </div>";}?>
					      <br>
				      <!-- END .main-nosplit --></div>
					  <div class="panel">
					    <h3 style="background:#f07f07;">Berita Terpopular</h3>
                        
                        
                       
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
  
  
  $populer2=mysql_query("SELECT * FROM artikel ORDER BY dibaca DESC LIMIT 1,4");
  $populer=mysql_query("SELECT * FROM artikel ORDER BY dibaca DESC LIMIT 1");               
	
  while($p=mysql_fetch_array($populer)){
  $baca = $p[dibaca]+1;
  
   $isi_artikel =(strip_tags($p['isi_artikel']));
  $isi = substr($isi_artikel,0,90); 
  $isi = substr($isi_artikel,0,strrpos($isi," "));
  
  if ($p['gambar']!=''){
  
  echo "
 
  <div class='article-small-block'>
<div class='article-photo'> <span class='image-hover'> <span class='drop-icons'> <span class='icon-block'>
 
  <a href='artikel-$p[id_artikel]-$p[judul_seo].html' class='icon-link legatus-tooltip'>&nbsp;</a></span> </span>
  <img alt='$p[judul]' src='img_artikel/small_$p[gambar]' class='setborder' ></span> </div>";}
  
  else{	
  echo "
  <a href='artikel-$p[id_artikel]-$p[judul_seo].html'>
  <img alt='$p[judul]' src='img_artikel/gakadegambarnye.jpg'></a>";}
  
  echo "<div class='article-content'>
  <h4> <a href='artikel-$p[id_artikel]-$p[judul_seo].html'>$p[judul]</a></h4>
  <p>$isi ..</p></div>
   <div class='article-links'><a href='post.html' class='article-icon-link'><span class='icon-text'>&#59160;</span>dibaca: $baca</a> <a href='post.html' class='article-icon-link'><span class='icon-text'>&#59212;</span>Read Full Article</a> </div></div>
   ";}
  ?>
 
					    <!-- END .panel -->
                        <?php
while($p2=mysql_fetch_array($populer2)){
  $baca2 = $p2[dibaca]+1;
  
   $isi_artikel2 =(strip_tags($p2['isi_artikel']));
  $isi2 = substr($isi_artikel2,0,80); 
  $isi2 = substr($isi_artikel2,0,strrpos($isi2," "));                        
                        ?>
                        <ul class="article-array content-category">
									    
                                        <li> <a href="post.html"><?php echo $p2[judul]; ?></a><a href="post.html#comments" class="comment-icon"><span class="icon-text">dibaca &#59160;</span><?php echo $baca2 ?></a> </li>
                                        
                                        
                                        <?php } ?>
                        </ul>
                        
                        
                        
				      </div>
                      
                      
					  <div class="main-nosplit">
					    <!-- BEGIN .banner -->
					    
					       
                          
                          <?php
  $iklantengah_home=mysql_query("SELECT * FROM iklansidebar_home WHERE aktif='Ya' 
  ORDER BY id_iklansidebar_home DESC LIMIT 1,2");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='clearfix'>
  
  <div style='width:310px;height:160px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='300' height='100'>
  <param name='movie' value='img_iklansidebar_home/$b[gambar]'' />
  <param name='quality' value='high' />
  <param name='wmode' value='transparent'>
  <embed src='img_iklansidebar_home/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='300' height='100' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer2.png' width='300' height='100'/></a>
  </div>
  </div>  
  
  </div>";}?>
                          
                        
					      <!-- END .banner -->
				        
					    <!-- END .main-nosplit -->
				       
                      </div>
<div class="panel">
					    <h3 style="background:#f07f07;">Indeks Berita</h3>
					    <div class="tagcloud"> 
                        
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
  echo "<input type=submit value='cari' class='submit-button2'/></form>";}
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
					    <!-- END .panel -->
				      </div>
					  <div class="panel">
					    <h3 style="background:#f07f07;">Polling </h3>
					    <div class="tagcloud">
					      <?php
  $tanya=mysql_query("SELECT * FROM poling WHERE aktif='Ya' and status='Pertanyaan'");
  $t=mysql_fetch_array($tanya);
  echo "<div class='poling'>$t[pilihan]</div>";
  echo "<form method=POST action='hasil-poling.html'>";
  $poling=mysql_query("SELECT * FROM poling WHERE aktif='Ya' and status='Jawaban'");
  while ($p=mysql_fetch_array($poling)){
  echo "<div class='marginpoling'><input type=checkbox name=pilihan value='$p[id_poling]'/>
   &nbsp;<b>$p[pilihan]</b></div>";}
  echo "<br/><div><input type=submit value='PILIH' class='button-yellow'/></form>
  <a href=lihat-poling.html><input type=button value='LIHAT HASIL' class='button-gray'></a></div>";
  ?>
				        </div>
					    <!-- END .panel -->
  </div>
  <div class="panel">
    <h3 style="background:#f07f07;">Video</h3>
					    <div class="tagcloud"><span class="widget widget_video clearfix">
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
					    </span></div>
					    <!-- END .panel -->
  </div>
  <div class="panel">
    <h3 style="background:#f07f07;">Tag </h3>
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
    <!-- END .panel -->
  </div>
  <!-- BEGIN .main-content-split -->
					  <!-- BEGIN .main-nosplit -->
<div class="main-nosplit">
							
							<!-- BEGIN .banner -->
<div class="banner">
								<div class="banner-block"></div>
<!-- END .banner -->
    </div>

<!-- BEGIN .panel --><!-- BEGIN .panel -->
							<!-- BEGIN .panel -->
							<!-- BEGIN .panel -->
							<!-- BEGIN .panel -->
						  <!-- END .main-nosplit -->
					  </div>
						
					<!-- END .main-content-right -->
					</div>
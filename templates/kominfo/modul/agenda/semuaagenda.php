  <div class="main-content-left">
<?php

  $p      = new Agenda;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas); 
  
  $sql = mysql_query("SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT $posisi,$batas");		 
  
?>
						<div class="content-article-title">						
  							<h2>Agenda</h2>		
						</div>
						<div class="main-article-content">
							<div class="article-controls">
							  <div class="date">									
									<div class="calendar-time">
										<font><?php echo" $tgl_posting" ?></font>
										<font></font>
									</div>
								</div>
								

							<!-- END .article-controls -->
						  </div>
                          
							<div class="article-photo">
							
							</div>
							
							<!-- BEGIN .article-controls -->
							

							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
							  <?php   
							  while($r=mysql_fetch_array($sql)){
  $tgl_posting = tgl_indo($r[tgl_posting]);
  $tgl_mulai   = tgl_indo($r[tgl_mulai]);
  $tgl_selesai = tgl_indo($r[tgl_selesai]);
  $isi_agenda  = nl2br($r[isi_agenda]);
  $tanggalan=explode(' ', $tgl_posting);
  $baca = $r[dibaca]+1;
  if ($r['gambar']!=''){
  echo "
  				
  <div class='post-image'>
  <a href='agenda-$r[id_agenda]-$r[tema_seo].html'><img src='img_agenda/small_$r[gambar]'alt='$r[tema]'></a>
  </div>";}
  
  else{	
  echo "				
  <div class='post-image'>
  <a href='agenda-$r[id_agenda]-$r[tema_seo].html'><img src='img_artikel/gakadegambarnye.jpg' alt='$$r[tema]'></a>
  </div>";}
            
  echo "<br>
  <a href='agenda-$r[id_agenda]-$r[tema_seo].html'><h2 class='post-title5'>$r[tema]</h2></a><br><br>
 ";} 

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM agenda"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halagenda], $jmlhalaman);
			
  echo " 		
 
  <div class='line'></div>
  <div class='pagenation clearfix'>
  $linkHalaman
  </div>"; 
   
  ?>       
							<!-- END .shortcode-content -->
							</div>
						</div>

						<!-- BEGIN .main-nosplit -->
  <div class="main-nosplit">
    <div class="article-share-bottom">
								
		<b>Share</b>

		<span class="social-icon">
			<a href="#" class="social-button" style="background:#495fbd;"><span class="icon-text">&#62220;</span><font>Share</font></a>
		</span>

		<span class="social-icon">
			<a href="#" class="social-button" style="background:#43bedd;"><span class="icon-text">&#62217;</span><font>Tweet</font></a>
		</span> 

		<span class="social-icon">
			<a href="#" class="social-button" style="background:#df6149;"><span class="icon-text">&#62223;</span><font>+1</font></a>
									
		</span>

		<span class="social-icon">
			<a href="#" class="social-button" style="background:#d23131;"><span class="icon-text">&#62226;</span><font>Share</font></a>
		</span>

		<span class="social-icon">
			<a href="#" class="social-button" style="background:#264c84;"><span class="icon-text">&#62232;</span><font>Share</font></a>
		</span>

	  <div class="clear-float"></div>

	</div>

						<!-- END .main-nosplit -->
  </div>
						<!-- BEGIN .main-nosplit -->

						<div class="content-article-title">
						  <div class="right-title-side">
						  <a href="#top"><span class="icon-text">&#59231;</span>Scroll Back To Top</a></div>
  </div>

					<!-- END .main-content-left -->
</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  
  
  
  
  
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
  <h4 class='cat-title mb25'>AGENDA</h4>

	
  <!--=========  SEMUA AGENDA ========================-->
  <section class="row">
  <?php
  $p      = new Agenda;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas); 
  
  $sql = mysql_query("SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT $posisi,$batas");		 
  while($r=mysql_fetch_array($sql)){
  $tgl_posting = tgl_indo($r[tgl_posting]);
  $tgl_mulai   = tgl_indo($r[tgl_mulai]);
  $tgl_selesai = tgl_indo($r[tgl_selesai]);
  $isi_agenda  = nl2br($r[isi_agenda]);
  $tanggalan=explode(' ', $tgl_posting);
  $baca = $r[dibaca]+1;
		
					
  if ($r['gambar']!=''){
  echo "
  <article class='post six column'>				
  <div class='post-image'>
  <a href='agenda-$r[id_agenda]-$r[tema_seo].html'><img src='img_agenda/small_$r[gambar]'alt='$r[tema]'></a>
  </div>";}
  
  else{	
  echo "<article class='post six column'>				
  <div class='post-image'>
  <a href='agenda-$r[id_agenda]-$r[tema_seo].html'><img src='img_artikel/gakadegambarnye.jpg' alt='$$r[tema]'></a>
  </div>";}
            
  echo "
  <a href='agenda-$r[id_agenda]-$r[tema_seo].html'><h2 class='post-title5'>$r[tema]</h2></a>
  </article>";} 

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM agenda"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halagenda], $jmlhalaman);
			
  echo " 		
  </section>
  <div class='line'></div>
  <div class='pagenation clearfix'>
  <ul class='no-bullet'>$linkHalaman</ul>
  </div>"; 
  
  
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
  
  ?>
  </section>
  <!--========= AKHIR KATEGORI ARTIKEL ========================-->


  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_agenda.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  
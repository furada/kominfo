 
   <div class="main-content-left">

						<div class="content-article-title">						
  							<h2>Video</h2>		
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
							  $p      = new SemuaVideo;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);
  
  $rizalvideo=mysql_query("SELECT * FROM video ORDER BY id_video DESC LIMIT $posisi,$batas");
  while ($d2   = mysql_fetch_array($rizalvideo)){
  $tgl = tgl_indo($d2[tanggal]);
  $lihat = $d2[dilihat]+1;
					
  if ($d2['gbr_video']!=''){
  echo "
  <article class='post six column'>				
  <div class='post-image3'>
  <a href='play-$d2[id_video]-$d2[video_seo].html'><img src='img_video/kecil_$d2[gbr_video]' alt='$d2[jdl_video]'>
  <div class='post-image4'></div></a></div>";}
  
  else{	
  echo "<article class='post six column'>				
  <div class='post-image'>
  <a href='play-$d2[id_video]-$d2[video_seo].html'><img src='img_video/nopic.jpg' alt='$d2[jdl_video]'></a>
  </div>";}
            
  $isi_berita = (strip_tags($d2[keterangan]));
  $isi = substr($isi_berita,0,350);
  $isi = substr($isi_berita,0,strrpos($isi," ")); 
	
  echo "
  <div class='post-container'>
  <a href='play-$d2[id_video]-$d2[video_seo].html'><h2 class='post-title'>$d2[jdl_video]</h2></a>
  <div class='post-content'>
  <p>$isi ...</p>
  </div>
  </div>
  <div class='post-meta'>
  <span><a href='#'>Dilihat: $lihat</a></span> <span class style=\"color:#fc7100;\">|</span>
  <span class='date'><a href='#'>$d2[hari], $tgl</a></span>
  </div>
  
  </article>";}

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM video"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halvideo], $jmlhalaman);
				
  echo " 		
  </section>
  <div class='line'></div>
  <div class='pagenation clearfix'>
  <ul class='no-bullet'>$linkHalaman</ul>
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
  
  
  
  
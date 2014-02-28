  <div class="main-content-left">
<?php
$g2 = mysql_query("SELECT * FROM playlist WHERE id_playlist='".$val->validasi($_GET['id'],'sql')."'");
  $w2 = mysql_fetch_array($g2);
?>
						<div class="content-article-title">						
  							<?php echo "   
  <h2>$w2[jdl_playlist]</h2>"; 
  ?> 	
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
							 $p      = new PlayList;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);

  $col = 4;

  $g = mysql_query("SELECT * FROM video WHERE id_playlist='".$val->validasi($_GET['id'],'sql')."' ORDER BY id_playlist DESC LIMIT $posisi,$batas");
  $ada = mysql_num_rows($g);
  if ($ada > 0) {

  while ($w = mysql_fetch_array($g)) {
  $tgl = tgl_indo($w[tanggal]);
  $lihat = $w[dilihat]+1;			
					
  if ($w['gbr_video']!=''){
  echo "
  <article class='post six column'>				
  <div class='post-image3'>
  <a href='play-$w[id_video]-$w[video_seo].html'><img src='img_video/kecil_$w[gbr_video]' alt='$w[jdl_video]'>
  <div class='post-image4'></div></a></div>";}
  
  else{	
  echo "<article class='post six column'>				
  <div class='post-image'>
  <a href='play-$w[id_video]-$w[video_seo].html'><img src='img_artikel/gakadegambarnye.jpg' alt='$w[jdl_video]'></a>
  </div>";}
            
  $isi_berita = (strip_tags($w[keterangan]));
  $isi = substr($isi_berita,0,350);
  $isi = substr($isi_berita,0,strrpos($isi," ")); 
	
  echo "
  <div class='post-container'>
  <a href='play-$w[id_video]-$w[video_seo].html'><h2 class='post-title'>$w[jdl_video]</h2></a>
  <div class='post-content'>
  <p>$isi ...</p>
  </div>
  </div>
  <div class='post-meta'>
  <span><a href='#'>Dilihat: $lihat</a></span> <span class style=\"color:#fc7100;\">|</span>
  <span class='date'><a href='#'>$w[hari], $tgl</a></span>
  </div>
  
  </article>";}

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM video WHERE id_playlist='".$val->validasi($_GET['id'],'sql')."'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halplaylist], $jmlhalaman);
				
  echo " 		
  </section>
  <div class='line'></div>
  <div class='pagenation clearfix'>
  <ul class='no-bullet'>$linkHalaman</ul>
  </div>";}  
  
  else{
  echo " 
  <article class='column'>
  <h5>Belum ada video pada playlist $w2[jdl_playlist].</h5> 
  </article>
  </section>";}
   
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
  
  
  
  
 

<div class="main-content-left">

						 
                               <?php
  $detail=mysql_query("SELECT * FROM halamanstatis,users WHERE judul_seo='$_GET[judul]'");
  $d   = mysql_fetch_array($detail);
  $tgl_posting   = tgl_indo($d[tgl_posting]);
  $baca = $d[dibaca]+1;
  mysql_query("UPDATE halamanstatis SET dibaca='$baca' WHERE judul_seo='$_GET[judul]'");
  ?>
						
						<div class="content-article-title">
							<?php echo " <p class style=\"color:#fc7100;font-size:14px;margin-bottom:-3px;\">
  <h2>$d[judul]</h2>";?>
							
						</div>
						
						
						<div class="main-article-content">
							
                            
							<div class="article-controls">

								<div class="date">
									
									<div class="calendar-time">
										<font><?php echo" $tgl" ?></font>
										<font><?php echo" $d[jam] WIB" ?></font>
									</div>
								</div>

								<div class="right-side">
									<div class="colored">
										<a href="javascript:printArticle();" class="icon-link"><span class="icon-text">&#59158;</span>Print This Article</a>
										 <div class="addthis_toolbox addthis_default_style">
  <a class="addthis_button_preferred_1"></a>
  <a class="addthis_button_preferred_2"></a>
  <a class="addthis_button_preferred_3"></a>
  <a class='addthis_button_preferred_4'></a>
  <a class='addthis_button_compact'></a>
  <a class='addthis_counter addthis_bubble_style'></a>
  </div>
  <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-504c13fd103cdd62'></script>
  
									</div>

									<div>
										<a href="#" class="icon-link"><span class="icon-text">&#128100;</span>by <?php echo"$d[nama_lengkap]" ?></a>
										<a href="#" class="icon-link"> <span class="icon-text">&#59160;</span>dibaca <?php echo"$baca" ?> kali</a>
									</div>
								</div>

								<div class="clear-float"></div>

							<!-- END .article-controls -->
						  </div>
                          
							<div class="article-photo">
							
							<?php
							  if ($d[gambar]!=''){
  echo "  
  <img src='img_statis/small_$d[gambar]' alt='$d[judul]'  class='setborder' class='gambar'> ";} 
 
							?>
							
							
							</div>
							
							<!-- BEGIN .article-controls -->
							

							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
							  <?php    
 
  echo"
  <div class='clear'></div>
  <div class='line'></div>";
  echo " $d[isi_halaman]
  <div class='clear'></div>
  <div class='line'></div>";
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

  <div class="comment-block">
                        
                        		
                        <?php
  $sql = mysql_query("SELECT * FROM komentar WHERE id_artikel='$d[id_artikel]' AND aktif='Y' LIMIT $posisi,$batas");
  $jml = mysql_num_rows($sql);
 
  if ($jml > 0){
  while ($s = mysql_fetch_array($sql)){
  $tanggal = tgl_indo($s[tgl]);
  $grav_url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim( $s[url] ) ) ) . '?d=' . urlencode( $default ) . '&s=' .  
  $size;;
 
  if ($s[url]!=''){
  echo "<ol class='comments'>
  <li>
  <div class='commment-content'>
  <div class='user-avatar'>
  <img alt='$s[nama_komentar]' src='$grav_url'></div>
  <strong class='user-nick'><a href='#'>$s[nama_komentar]</a></strong>
  <span class='time-stamp'>$tanggal - $s[jam_komentar] WIB</span>";}
  
  else{
  echo "
  <strong class='user-nick'><a href='#'>$s[nama_komentar]</a></strong>
  <span class='time-stamp'>$tanggal - $s[jam_komentar] WIB</span>";}
  
  echo "<span class='time-stamp'>$tanggal - $s[jam_komentar] WIB</span> 
  <div class='comment-text'><p>";
  
  $isian=nl2br($s[isi_komentar]); 
  $isikan=sensor($isian); 
  echo autolink($isikan);
  
  echo "</p></div>
  </li></ol><div class='line'></div>";}
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM komentar 
  WHERE id_artikel='".$val->validasi($_GET['id'],'sql')."' AND aktif='Y'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halkomentar'], $jmlhalaman);

  echo "<div class='pagenation clearfix'>
  <ul class='no-bullet'>
  $linkHalaman
  </ul>
  </div>";}?>
					
								
							</ol>

  </div>
						<div class="comment-form">
						  <div class="split-line"></div>
  </div>
						
					<!-- END .main-content-left -->
</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  
  
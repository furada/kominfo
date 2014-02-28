<div class="main-content-left">
<?php
$detail=mysql_query("SELECT * FROM agenda,users WHERE id_agenda='".$val->validasi($_GET['id'],'sql')."'");
  $d   = mysql_fetch_array($detail);
  $tgl_posting   = tgl_indo($d[tgl_posting]);
  $tgl_mulai     = tgl_indo($d['tgl_mulai']);
  $isi_agenda=nl2br($d[isi_agenda]);
  $baca = $d[dibaca]+1;
  mysql_query("UPDATE agenda  SET dibaca='$baca' WHERE id_agenda='".$val->validasi($_GET['id'],'sql')."'");
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
							
							</div>
							
							<!-- BEGIN .article-controls -->
							

							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
							  <?php    
  echo "  						
  <h1 class='post-title4'>$d[tema]</h1>
  
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
				

  if ($d[gambar]!=''){
  echo "  
  <img src='img_agenda/$d[gambar]' alt='$d[tema]' class='featured-img'><br><br>";} 
  
  echo "$isi_agenda
  <div class='isiagenda'><b>Tanggal</b> : $tgl_mulai $d[selesai]</div>
  <div class='isiagenda'><b>Tempat</b>  : $d[tempat]</div>
  <div class='isiagenda'><b>Pukul&nbsp;&nbsp;&nbsp;</b>   : $d[jam]</div>
  <div class='clear'></div>
  <div class='line'></div>";
  
  //NEXT-PREV ARTIKEL///////////////////////////////////////////////////////////////////////
  $qp = mysql_query("select id_agenda, tema, tema_seo from
  agenda where id_agenda < '".$val->validasi($_GET['id'],'sql')."' order by id_agenda desc limit 1");
  $jp = mysql_num_rows($qp);
  $tp = mysql_fetch_array($qp);
  
  $qn = mysql_query("select id_agenda, tema, tema_seo from
  agenda where id_agenda > '".$val->validasi($_GET['id'],'sql')."' order by id_agenda asc limit 1");
  $jn = mysql_num_rows($qn);
  $tn = mysql_fetch_array($qn);
  
  echo "<br/><br/><div class='post-navigation'> ";
  
  if($jp <> 0) {
  echo "<div class='post-previous'><a href='agenda-$tp[id_agenda]-$tp[tema_seo].html' rel='prev'>
  <span>Sebelumnya:</span>$tp[tema]</a></div>";}
 
  if($jn <> 0) {
  echo "<div class='post-next'><a href='agenda-$tn[id_agenda]-$tn[tema_seo].html' rel='next'>
  <span>Selanjutnya:</span> $tn[tema]</a></div>";}
  
  echo "</div>";  
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
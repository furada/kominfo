<div class="main-content-left">
					
						<div class="content-article-title">
							<?php echo " <p class style=\"color:#fc7100;font-size:14px;margin-bottom:-3px;\">
  <h2>perundangan</h2>";?>
							<div class="right-title-side">
								<a href="index.php"><span class="icon-text">&#8962;</span>Back To Homepage</a>
								<a href="#" class="orange"><span class="icon-text">&#59194;</span>Subscribe To RSS Feed</a>
							</div>
  </div>					
						<div class="main-article-content">
							
							
							<div class="article-photo">
							</div>
							
							<!-- BEGIN .article-controls -->
							

							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
                            
                            <form method="POST" action="hasilcari.html">
 
<table width="350">
<tr>
 <td><input type='text' name='kata' size='60'></td>
 <td> <input type='submit' value='Cari Perundangan'></td>
</tr>
</table>
  </form>
							<?php
  $p      = new Download;
  $batas  = 30;
  $posisi = $p->cariPosisi($batas);
  
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas")); 
  echo "
  <article>		
  <ul class='bullet-daftar'>"; 

  //$sql = mysql_query("SELECT * FROM download  ORDER BY id_download DESC LIMIT $posisi,$batas");		  
 // while($d=mysql_fetch_array($sql)){
  
$sql = mysql_query("SELECT * FROM kategoriperundangan  ORDER BY id_kategoridownload DESC LIMIT $posisi,$batas");		  
  while($d=mysql_fetch_array($sql)){
  
  
  echo "<li><a href='kategoriperundangan-$d[id_kategoridownload]-$d[kategoridownload_seo].html'>$d[nama_kategoridownload]</a>
  <span class style=\"color:#999;font-size:12px;padding-left:0px;\"></span></li>";}
  
  //echo "<li><a href='terasconfig/downlot.php?file=$d[nama_file]'>$d[judul]</a>
  //<span class style=\"color:#999;font-size:12px;padding-left:0px;\">( didownload: $d[hits] x )</span></li>";}


  echo "</ul> 
  </article> <br/><div class='clear'></div>
  <div class='line'></div> ";
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM perundangan"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[haldownload], $jmlhalaman);
  
  echo " 		
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
						<div class="comment-form">
						  <div class="split-line"></div>
  </div>
						
					<!-- END .main-content-left -->
</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_home.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  

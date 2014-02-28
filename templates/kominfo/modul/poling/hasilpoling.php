 <div class="main-content-left">  	
						<div class="content-article-title">
	<?php echo " <h2>HASIL POLLING</h2>";?>
						</div>
						<div class="main-article-content">  
							<div class="article-controls">
								<div class="date">								
								</div>
								<div class="clear-float"></div>
							<!-- END .article-controls -->
						  </div>	
							<!-- BEGIN .article-controls -->
							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
							<?php
  if (isset($_COOKIE["poling"])) {
  
  echo "  				
  <article>	
  <h5>Maaf, anda sudah pernah melakukan pemilihan terhadap jajak pendapat ini</h5></section>";}  
  
  else{
  setcookie("poling", "sudah poling", time() + 3600 * 24);
  
  
  echo "
  <article>	";
  $u=mysql_query("UPDATE poling SET rating=rating+1 WHERE id_poling='$_POST[pilihan]'");
  $tanya=mysql_query("SELECT * FROM poling WHERE aktif='Ya' and status='Pertanyaan'");
  $t=mysql_fetch_array($tanya);

  echo "<h5>Terima kasih atas partisipasi anda mengikuti polling kami.</h5>
  <h4>$t[pilihan]</h4>";
  
  echo " 

  <table style=\"width:100%; padding:15px; border-bottom:#e2e2e2 solid 1px;\"> ";
								
  $jml=mysql_query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Ya'");
  $j=mysql_fetch_array($jml);  
  $jml_vote=$j[jml_vote];  
  $sql=mysql_query("SELECT * FROM poling WHERE aktif='Ya' and status='Jawaban'");  
  while ($s=mysql_fetch_array($sql)){ 	
  $prosentase = sprintf("%2.1f",(($s[rating]/$jml_vote)*100));
  $gbr_vote   = $prosentase * 3;
  
  
  echo "<tr style=\"border-radius:4px; background:#f3f3f3; margin-bottom:5px; width:100%; float:left;\">
	
	
  <td style=\"text-align:left; width:45%; float:left; font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px;
  font-weight: bold; height: 20px; padding-top: 10px; padding-right: 1%; padding-bottom: 1%; padding-left: 15px;\">
	
  $s[pilihan] ($s[rating]) </b></td>
  
  
  <td> 
  <div class='donate_bar'>
  <div class='progress'><img src=$f[folder]/images/balokpoling.png width=$gbr_vote> <span>$prosentase %</span></div>
  </div>  
  </td>
  
  
  </tr>";}
  
  echo "</table><article>
  <div class='teras-box'>Total Jumlah Pemilih: $jml_vote</div></section>"; }  
  ?>		
				<!-- END .shortcode-content -->
							</div>
						</div>
						<!-- BEGIN .main-nosplit -->
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
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	

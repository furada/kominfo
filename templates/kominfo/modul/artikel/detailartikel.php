<div class="main-content-left">

						 
                                <?php
  $detail=mysql_query("SELECT * FROM artikel,users,kategoriartikel WHERE users.username=artikel.username 
  AND kategoriartikel.id_kategoriartikel=artikel.id_kategoriartikel AND id_artikel='".$val->validasi($_GET['id'],'sql')."'");
  $d   = mysql_fetch_array($detail);
  $tgl = tgl_indo($d[tanggal]);
  $tanggalan=explode(' ', $tgl);
  $baca = $d[dibaca]+1;
  
  $komentar = "SELECT * FROM komentar WHERE id_artikel= '".$d['id_artikel']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
  
  mysql_query("UPDATE artikel SET dibaca=$d[dibaca]+1 
  WHERE id_artikel='".$val->validasi($_GET['id'],'sql')."'");   
  
   
  ?>
						
						<div class="content-article-title">
  <?php echo " <p class style=\"color:#fc7100;font-size:14px;margin-bottom:-3px;\">$d[sub_judul]</p>
  <h2>$d[judul]</h2>";?></div>
						
						
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
							<div class="article-photo"><?php
								 if ($d[gambar]!=''){
  echo "  
 <img src='img_artikel/small_$d[gambar]' class='setborder' alt='$d[judul]' class='gambar'>
  <div class='ket_gambar'>$d[keterangan_gambar]</div>  ";}  ?>
							</div>
							
							<!-- BEGIN .article-controls -->
							

							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
							  <?php    
 
  echo"
  <div class='clear'></div>
  <div class='line'></div>";
  echo " $d[isi_artikel]
  <div class='clear'></div>
  <div class='line'></div>";
  ?>
                                
                                
							<!-- END .shortcode-content -->
							</div>
						</div>

						<!-- BEGIN .main-nosplit -->
						<div class="main-nosplit">
						  <div class="article-share-bottom">
								
							  <b>Tags</b>

							  <div class="tag-block">
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

								<div class="clear-float"></div>

						  </div>
							
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
					    <h2>Berita Terkait</h2>
							<div class="right-title-side">
								<a href="#top"><span class="icon-text">&#59231;</span>Scroll ke atas</a>
								<a href="category.html"><span class="icon-text">&#128196;</span>Artikel yang lain</a>
							</div>
						</div>

						<div class="related-block">
							
							<!-- BEGIN .article-array -->
                           <ul class="article-array">
                            <?php
							
  $pisah_kata  = explode(",",$d[tag]);
  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1; 
  $ambil_id = substr($d[id_artikel],0,4);


  $cari = "SELECT * FROM artikel WHERE (id_artikel<'$ambil_id') and (id_artikel!='$ambil_id') and (" ;
  for ($i=0; $i<=$jml_kata; $i++){
  $cari .= "tag LIKE '%$pisah_kata[$i]%'";
  if ($i < $jml_kata ){
  $cari .= " OR ";}}
  $cari .= ") ORDER BY id_artikel DESC LIMIT 4";

  $hasil  = mysql_query($cari);
  while($h=mysql_fetch_array($hasil)){

  
  echo "
  <li><a href=artikel-$h[id_artikel]-$h[judul_seo].html>$h[judul]</a></h3></p>
  </li>";}
						
							?>
							<!-- END .article-array -->
							</ul>
							<div class="split-line"></div>

</div>

						
						<div class="content-article-title">
                        
                        
                        
                        <?php
						$komentar = mysql_query("select count(komentar.id_komentar) as jml from komentar WHERE id_artikel='$d[id_artikel]' AND aktif='Y'");
  $k = mysql_fetch_array($komentar); 
  echo "
  <div class='clear'></div>
  <h2>$k[jml] Komentar</h2>
  <br>";
  
  $p      = new HalKomentarArtikel;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);
?>
							
					  <div class="right-title-side">
								<a href="#top"><span class="icon-text">&#59231;</span>Scroll Keatas</a>
								<a href="#writecomment"><span class="icon-text">&#9998;</span>Tulis Komentar</a>
							</div>
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
						
						<div class="content-article-title">
							<h2>Tulis Komentar</h2>
							<div class="right-title-side">
								<a href="#top"><span class="icon-text">&#59231;</span>Scroll ke Atas</a>
							</div>
						</div>

						<div class="comment-form">
                        
                       
                        <form  action="simpankomentar.php" method="POST" onSubmit="return validasi(this)" id="writecomment">
							
		      <p class="comment-notes">Your email address will not be published.<br/>Required fields are marked <span class="required">*</span></p>
								<p class="comment-form-author">
									<label for="author">Nickname:<span class="required">*</span></label>
									<input type="text" placeholder="My name" name="nama_komentar" id="nama_komentar" />
								</p>
								<p class="comment-form-email">
									<label for="email">E-mail address:<span class="required">*</span></label>
									<input class="error" placeholder="e.g. email@mail.me" type="text" name="url" id="url" />
						  </p>
								<p class="comment-form-text">
							    <label for="comment">Comment:</label>
								  <textarea id="isi_komentar" name="isi_komentar" placeholder="Your comment text.."></textarea></p>
									<!-- <font class="comment-error textarea-error"><span class="icon-text">&#9888;</span>ERROR: Field is Empty</font> -->
     <p class="comment-form-text">                               
  <input required name="kode" size=6 maxlength=6  type="text" id="kode"></p>
  <p class="comment-form-text">
  <img id="captcha" src="terasconfig/captcha.php" border="0" ><a href="JavaScript: captcha();">
  <img border="0" alt="" src="terasconfig/refresh.png" align="top"></a>
  
				    </p>
								<p class="form-submit">
									<input name="submit" type="submit" id="submit" class="submit-button" value="Post a Comment" />
								</p><input type="hidden" name="id" value="<?php echo"$d[id_artikel]" ?>">
							</form>

							<div class="split-line"></div>
						</div>
						
					<!-- END .main-content-left -->
					</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
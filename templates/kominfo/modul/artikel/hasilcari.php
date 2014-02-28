    <div class="main-content-left">

						<div class="content-article-title">
                        
                         <?php
 
 echo " <h2>hasil pencarian</h2>";?>
							<div class="right-title-side">
								<a href="index.php"><span class="icon-text">&#8962;</span>Back To Homepage</a>
								<a href="#" class="orange"><span class="icon-text">&#59194;</span>Subscribe To RSS Feed</a>
							</div>
						</div>
						
						
  <div class="main-article-content">
							
                             <?php
  $kata = trim($_POST['kata']);
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM artikel WHERE " ;
  for ($i=0; $i<=$jml_kata; $i++){
  $cari .= "isi_artikel LIKE '%$pisah_kata[$i]%' or judul LIKE '%$pisah_kata[$i]%'";
  if ($i < $jml_kata ){
  $cari .= " OR "; } }
  
  $cari .= " ORDER BY id_artikel DESC LIMIT 3";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);
  
  if ($ketemu > 0){
  echo "
  <h2>Ditemukan <font style='background-color:#fc7100;color:#fff;'><b>$ketemu</b></font> pencarian 
  dengan kata <font style='background-color:#fc7100;color:#fff;'><b>$kata</b></font></h2><br>"; 
  
  
  while($t=mysql_fetch_array($hasil)){
  $tgl = tgl_indo($t[tanggal]);
  $baca = $t[dibaca]+1;		
  $komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t['id_artikel']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
		?>
                            
                            <div class="article-small-block">
									<div class="article-header"> <h2><?php echo"<a href=artikel-$t[id_artikel]-$t[judul_seo].html><h2 class='post-title'>$t[judul]</h2></a>" ?></h2>
									</div>

									<div class="article-photo">
										<span class="image-hover">
											<span class="drop-icons">
												<span class="icon-block"><a href="<?php echo"artikel-$t[id_artikel]-$t[judul_seo].html"; ?>" title="Read Article" class="icon-link legatus-tooltip">&nbsp;</a></span>
											</span>
                                            
                                            <?php
					
  if ($t['gambar']!=''){
  echo "
  <a href=artikel-$t[id_artikel]-$t[judul_seo].html><img src='img_artikel/small_$t[gambar]' class='setborder'  alt='$t[judul]'></a>
  ";}
  
  else{	
  echo "<a href=artikel-$t[id_artikel]-$t[judul_seo].html></a>";} ?>
											
										</span>
									</div>
									
									<div class="article-content">
                                    
                                    <?php
  $isi_artikel =(strip_tags($t['isi_artikel']));
  $isi = substr($isi_artikel,0,180); 
  $isi = substr($isi_artikel,0,strrpos($isi," "));
	
 ?> 
										<p><?php echo"  <p>$isi ...</p>"; ?></p>
                                        
                                        <div class="article-links">
										
			<a href="<?php echo "artikel-$t[id_artikel]-$t[judul_seo].html"; ?>#comments" class="article-icon-link"><?php echo "$total_komentar"; ?> komentar</a> | 
			<a href="<?php echo "artikel-$t[id_artikel]-$t[judul_seo].html"; ?>" class="article-icon-link"></a><?php echo"$t[hari], $tgl - $t[jam]"; ?> WIB</a>
									</div>
									</div>
									
									
                                    
								<!-- END .article-small-block -->
								</div>
                          
                              <?php 
							  }
  }
  
  else{
  echo " <article class='column'>
  <h5>Tidak ditemukan pencarian dengan kata <font style='background-color:#fc7100;color:#fff;'><b>$kata</b> </h5>   
  </article></section>";}
  ?>
                            
                            
							<div class="article-photo">
							  
							</div>
							
							<!-- BEGIN .article-controls -->
							
							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
	  <section class="row">
      
 
                                
                                
							<!-- END .shortcode-content -->
							</div>
						</div>

						<!-- BEGIN .main-nosplit --><!-- BEGIN .main-nosplit -->

  

  <!-- END .main-content-left -->
					</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  
  
  
  
  
  
  
  
  
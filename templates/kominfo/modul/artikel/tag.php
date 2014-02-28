  <div class="main-content-left">

						<div class="content-article-title">
                        
                         <?php
  $tags	= mysql_query("SELECT * FROM tag WHERE id_tag=".abs((int)$_GET[idtag])."");
  $data   = mysql_fetch_array($tags);
 echo " <h2>$data[nama_tag]</h2>";?>
							<div class="right-title-side">
								<a href="index.php"><span class="icon-text">&#8962;</span>Back To Homepage</a>
								<a href="#" class="orange"><span class="icon-text">&#59194;</span>Subscribe To RSS Feed</a>
							</div>
						</div>
						
						
  <div class="main-article-content">
							
                             <?php
 $p      = new Tag;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);
  
  $sql   = "SELECT * FROM artikel, tag WHERE artikel.tag LIKE '%$data[tag_seo]%' GROUP BY artikel.id_artikel
  DESC LIMIT $posisi,$batas";	
  
  $hasil = mysql_query($sql);
  $jumlah = mysql_num_rows($hasil);
	
  
  if ($jumlah > 0){
  while($t=mysql_fetch_array($hasil)){
  $tgl = tgl_indo($t[tanggal]);

  $baca = $t[dibaca]+1;		
  	
  $komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t['id_artikel']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
		?>
                            
                            <div class="article-small-block">
									<div class="article-header"> <h2><?php echo"<a href='artikel-$t[id_artikel]-$t[judul_seo].html'><h2 class='post-title'>$t[judul]</h2></a>" ?></h2>
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
                          
                              <?php };?>
							
							<div class="article-photo">
							  
							</div>
							
							<!-- BEGIN .article-controls -->
							

							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
	  <section class="row">
      
 <?php

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM artikel WHERE id_kategoriartikel='".$val->validasi($_GET['id'],'sql')."'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategoriartikel], $jmlhalaman);
				
  echo " 		
  </section>
  <div class='line'></div>
 <div class='pagenation clearfix'>
  $linkHalaman  </div>";}  
  
  else{
  echo " 
  <article class='column'>
   <h5>Belum ada artikel pada Tag: $data[nama_tag].</h5> 
 
  </article>
  </section>";}  
  ?>
                                
                                
							<!-- END .shortcode-content -->
							</div>
						</div>

						<!-- BEGIN .main-nosplit --><!-- BEGIN .main-nosplit -->

  

  <!-- END .main-content-left -->
					</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  
    
  
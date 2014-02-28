  <div class="main-content-left">
						<div class="content-article-title"> 
                         <?php
  $format_mysql = $_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tanggal']; 
  $format_indo = tgl_indo($_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tanggal']);

  $cari   = mysql_query("SELECT * FROM artikel WHERE tanggal='$format_mysql'");
  $jumlah = mysql_num_rows($cari);
  
 echo " <h2>$jumlah Hasil Indeks Artikel: $format_indo</h2>";?>
						</div>
			
  <div class="main-article-content">
							
                             <?php
  $qindeks=mysql_num_rows(mysql_query("select * from modul where nama_modul='Indeks Berita' and publish='Ya'"));
  if ($qindeks > 0){
  echo "<br>
  <form method=POST action='indeks-artikel.html' id='contact'>";    
  combotgl(1,31,'tanggal',$tgl_skrg);
  echo " / ";
  combobln(1,12,'bulan',$bln_sekarang);
  echo " / ";
  combothn(2000,$thn_sekarang,'tahun',$thn_sekarang);
  
  echo "<input type=submit value='Cari' class='submit-button2'/></form><br>
  ";}
   
  $format_mysql = $_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tanggal']; 
  $format_indo = tgl_indo($_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tanggal']);

  $cari   = mysql_query("SELECT * FROM artikel WHERE tanggal='$format_mysql'");
  $jumlah = mysql_num_rows($cari);
  
  if ($jumlah > 0){
	
  while($t=mysql_fetch_array($cari)){
  $tgl = tgl_indo($t[tanggal]);
  $baca = $t[dibaca]+1;		
  $komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t['id_berita']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
		?>
                            
                            <div class="article-small-block">
									<div class="article-header"> <h2><?php echo"<a href='artikel-$t[id_artikel]-$t[judul_seo].html'>$t[judul]</a>" ?></h2>
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

  }  
  
  else{
  echo " 
  <article class='column'>
   <h5>Belum ada artikel pada Tag: $format_indo.</h5> 
 
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
  
    
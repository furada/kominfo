	<div class="main-content-left">
                            
							<!-- BEGIN .slider-content -->
     <script type="text/javascript" src="<?php echo "$f[folder]"; ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo "$f[folder]"; ?>/js/easySlider1.7.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true,
				numeric: true
			});
		});	
		
	</script>
    
    <link href="<?php echo "$f[folder]"; ?>/css/screen.css" rel="stylesheet" type="text/css" media="screen" />	
							<div id="slider">
								<ul>
                                
                                <?php
								
 $terkini=mysql_query("SELECT * FROM gallery2 ORDER BY id_gallery desc LIMIT 8");							
  while($t=mysql_fetch_array($terkini)){      
  if ($t['gbr_gallery']!=''){
  echo "<li>  <p>$t[jdl_gallery]</p> 
  <img alt='$t[jdl_gallery]' src='img_galeri2/$t[gbr_gallery]' width='680' height='400' >
  <p>$t[jdl_gallery]</p>
  </li>

  ";}
  
  else{	
  echo "<li>    
 
  <img alt='$t[judul]' src='img_galeri2/nopic.jpg'></li>";}
  
 }
  ?>
                                
									
								</ul>
                                	</div>
							<!-- END .slider-content -->
					

							<ul class="slider-controls"></ul>
                           
						
						<!-- END .slider-container -->

    <div class="main-content-split">
<div class="content-panel">
							  <div class="panel-header"> <b style="background:#f07f07;"><span class="icon-text">&#9871;</span>BERITA TERBARU</b>
							    <div class="top-right"><a href="kategoriartikel-1-berita.html">LIHAT SEMUA BERITA</a></div>
						      </div>
							  <div class="panel-content">
                              
							    <div class="video-blocks">
                                
							      <div class="video-left">
							        <div class="video-large">
                                      <?php
  $main=mysql_query("SELECT * FROM kategoriartikel WHERE aktif='Ya' and id_kategoriartikel=1 order by id_kategoriartikel limit 1");
  while($r=mysql_fetch_array($main)){
  $sub=mysql_query("SELECT * FROM kategoriartikel, artikel  
                  WHERE kategoriartikel.id_kategoriartikel=artikel.id_kategoriartikel 
                  AND artikel.id_kategoriartikel=$r[id_kategoriartikel] order by id_artikel desc limit 1,4");
							
  $sub2=mysql_query("SELECT * FROM kategoriartikel, artikel  
                    WHERE kategoriartikel.id_kategoriartikel=artikel.id_kategoriartikel 
                   AND artikel.id_kategoriartikel=$r[id_kategoriartikel] order by id_artikel desc limit 1");				
  $t=mysql_fetch_array($sub2);
  $tgl = tgl_indo($t['tanggal']);
  $baca = $t[dibaca]+1;		
  $komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t['id_artikel']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar); ?>
                                    
                                 <div class="article-photo"> <span class="image-hover"> <span class="drop-icons"><span class="icon-block"><a href="<?php echo"artikel-$t[id_artikel]-$t[judul_seo].html";?>" title="Read Article" class="icon-link legatus-tooltip">&nbsp;</a></span> </span> 
                              <?php
  
  if ($t['gambar']!=''){
  echo " <a href=artikel-$t[id_artikel]-$t[judul_seo].html><img src='img_artikel/small_$t[gambar]' alt='$t[judul]' class='setborder' width='330' height='300'> </span> </div></a>
  ";} 
  else{	
  echo "					
  <a href=artikel-$t[id_artikel]-$t[judul_seo].html><img src='img_artikel/nopic.jpg' class='setborder'  alt='$t[judul]'></a> </span> </div>
 ";}    
  $isi_artikel =(strip_tags($t['isi_artikel']));
  $isi = substr($isi_artikel,0,180); 
  $isi = substr($isi_artikel,0,strrpos($isi," "));
  echo "
  <h2><a href=artikel-$t[id_artikel]-$t[judul_seo].html>$t[judul]</a></h2>
  <div class='article-content'>
  <p>$isi ...</p>
  </div>
  
  <span class='date'><a href='#'>$t[hari], $tgl - $t[jam] WIB</a></span>
 </div>
</div>


  <div class='video-right'>
   ";
		              	        
  while($w=mysql_fetch_array($sub)){
  $tgl = tgl_indo($w['tanggal']);
  $judul = $w['judul'];
  
  echo "<div class='video-small'>
	<div class='video-image'>";
  
  if ($w['gambar']!=''){
  echo "
  <a href=artikel-$w[id_artikel]-$w[judul_seo].html><img  src='img_artikel/small_$w[gambar]' class='setborder' width='155' height='120' alt='$w[judul]'></a>";}
  else{	
  echo "
  <a href=artikel-$w[id_artikel]-$w[judul_seo].html><img src='img_artikel/nopic.jpg' height='120' alt='$w[judul]' class='setborder'></a>";}
  
  echo "<h2><a href=artikel-$w[id_artikel]-$w[judul_seo].html>$judul</a></h2><span class='date'><a href='#'>$w[hari], $tgl</a></span></div></div> ";}
								
  echo "	";} 			
  ?>                   
  </div>
  
							      <div class="clear-float"></div>
						        </div>
						      </div>
                              
							  <!-- END .content-panel -->
						  </div>
                          
                          
                          <div class="content-panel">
                          
<div class="banner">
								<div class="banner-block">
                            <center>
                             <?php
 /* $iklantengah_home=mysql_query("SELECT * FROM iklantengah_home WHERE aktif='Ya' 
  ORDER BY id_iklantengah_home DESC LIMIT 3,3");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='img_iklantengah_home/$b[gambar]' width='220'  /></a>
  ";} */ ?></center>
						</div>
						  <!-- END .banner -->
						  </div>
                          </div>
                            
                            
                            
                          
							<div class="main-split-left">
								<!-- BEGIN .article-big-block --><!-- BEGIN .content-panel --><!-- BEGIN .article-big-block --><!-- BEGIN .article-big-block --><!-- BEGIN .article-big-block --><!-- BEGIN .content-panel -->
								<div class="content-panel">
									<div class="panel-header">
                                    
                                    <?php
  $main=mysql_query("SELECT * FROM kategoriartikel WHERE aktif='Ya' and id_kategoriartikel=2 order by id_kategoriartikel limit 1");
  while($r=mysql_fetch_array($main)){
  echo "
 	
 ";
					
  $sub=mysql_query("SELECT * FROM kategoriartikel, artikel  
                            WHERE kategoriartikel.id_kategoriartikel=artikel.id_kategoriartikel 
                  AND artikel.id_kategoriartikel=$r[id_kategoriartikel] order by id_artikel desc limit 1,7");
							
  $sub2=mysql_query("SELECT * FROM kategoriartikel, artikel  
                            WHERE kategoriartikel.id_kategoriartikel=artikel.id_kategoriartikel 
                   AND artikel.id_kategoriartikel=$r[id_kategoriartikel] order by id_artikel desc limit 1");	
  $t=mysql_fetch_array($sub2);
  $tgl = tgl_indo($t['tanggal']);
  $baca = $t[dibaca]+1;		
  $komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t['id_artikel']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
  ?>
                                    
										<b style="background:#f07f07;"><span class="icon-text">&#9871;</span>Kegiatan DisKominfo</b>
										<div class="top-right"><a href="kategoriartikel-<?php echo"$r[id_kategoriartikel]-$r[kategoriartikel_seo]" ?>.html">Lihat Arsip</a></div>
									</div>
                               
									<div class="panel-content">
                                    
                                    <div class="article-big-block">
                                        <?php
  echo"
  <div class='article-photo'>
	<span class='image-hover'>
		<span class='drop-icons'>
			<span class='icon-block'><a href='artikel-$t[id_artikel]-$t[judul_seo].html' title='Read Article' class='icon-link legatus-tooltip'>&nbsp;</a>
			</span>
			</span> ";
  if ($t['gambar']!=''){
  echo "	
  <a href=artikel-$t[id_artikel]-$t[judul_seo].html><img src='img_artikel/small_$t[gambar]' width='330' alt='$t[judul]'></a></span></div>";}
  else{	
  echo "
  <a href=artikel-$t[id_artikel]-$t[judul_seo].html><img class='setborder' src='img_artikel/nopic.jpg'  alt='$t[judul]'></a></span></div>
  ";}
            
  $isi_artikel =(strip_tags($t['isi_artikel']));
  $isi = substr($isi_artikel,0,180); 
  $isi = substr($isi_artikel,0,strrpos($isi," "));
	
  echo "
  <div class='article-header'><h2><a href=artikel-$t[id_artikel]-$t[judul_seo].html>$t[judul]</a></h2></div>
<div class='article-content'><p>$isi ...</p></div>
  
  <div class='article-links'><a href='artikel-$t[id_artikel]-$t[judul_seo].html#comments' class='article-icon-link'><span class='icon-text'></span>$total_komentar komentar</a><a  class='article-icon-link'><span class='icon-text'></span>$t[hari], $tgl - $t[jam] WIB</div></div>
  
  <ul class='article-array content-category'>
  ";
		              	        
  while($w=mysql_fetch_array($sub)){
  $tgl = tgl_indo($w['tanggal']);
  $judul = $w['judul']; 
  echo "<li>
  <a href=artikel-$w[id_artikel]-$w[judul_seo].html>$judul</a><br>
   <a href='artikel-$t[id_artikel]-$t[judul_seo].html#comments' class='comment-icon'>$total_komentar komentar</a>
  <a href='#' class='comment-icon'>$w[hari], $tgl</a></li>
 
  ";}
								
  echo "</ul>";} 			
  ?>  						
										<!-- END .article-big-block -->
									
									</div>
								<!-- END .content-panel -->
							  </div>
								
							<!-- END .main-split-left -->
				      </div>
							
							<!-- BEGIN .main-split-right -->
						  <div class="main-split-right">


<div class="content-panel">
									
			  <div class="panel-header">
              
               <?php
  $main=mysql_query("SELECT * FROM kategoriartikel WHERE aktif='Ya'  and id_kategoriartikel=3 order by id_kategoriartikel limit 1");
  while($r=mysql_fetch_array($main)){
 
					
  $sub=mysql_query("SELECT * FROM kategoriartikel, artikel  
                            WHERE kategoriartikel.id_kategoriartikel=artikel.id_kategoriartikel 
                  AND artikel.id_kategoriartikel=$r[id_kategoriartikel] order by id_artikel desc limit 1,7");
							
  $sub2=mysql_query("SELECT * FROM kategoriartikel, artikel  
                            WHERE kategoriartikel.id_kategoriartikel=artikel.id_kategoriartikel 
                   AND artikel.id_kategoriartikel=$r[id_kategoriartikel] order by id_artikel desc limit 1");	
  $t=mysql_fetch_array($sub2);
  $tgl = tgl_indo($t['tanggal']);
  $baca = $t[dibaca]+1;		
  $komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t['id_artikel']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
  ?>
										<b style="background:#f07f07;"><span class="icon-text">&#9871;</span>Ragam</b>
									    <div class="top-right"><a href="kategoriartikel-<?php echo"$r[id_kategoriartikel]-$r[kategoriartikel_seo]" ?>.html">Lihat Arsip</a></div>
			  </div>
									<div class="panel-content">
									  <!-- BEGIN .article-big-block -->
									  
                                      <div class="article-big-block">
                                       <?php
  echo"
  <div class='article-photo'>
	<span class='image-hover'>
		<span class='drop-icons'>
			
			<span class='icon-block'><a href='artikel-$t[id_artikel]-$t[judul_seo].html' title='Read Article' class='icon-link legatus-tooltip'>&nbsp;</a>
			</span>
			</span> ";
  if ($t['gambar']!=''){
  echo "	
  <a href=artikel-$t[id_artikel]-$t[judul_seo].html><img src='img_artikel/small_$t[gambar]' width='330' alt='$t[judul]'></a></span></div>";}
  else{	
  echo "
  <a href=artikel-$t[id_artikel]-$t[judul_seo].html><img class='setborder' src='img_artikel/nopic.jpg'  alt='$t[judul]'></a></span></div>
  ";}
            
  $isi_artikel =(strip_tags($t['isi_artikel']));
  $isi = substr($isi_artikel,0,180); 
  $isi = substr($isi_artikel,0,strrpos($isi," "));
	
  echo "
  <div class='article-header'><h2><a href=artikel-$t[id_artikel]-$t[judul_seo].html>$t[judul]</a></h2></div>
<div class='article-content'><p>$isi ...</p></div>
  
  <div class='article-links'><a href='artikel-$t[id_artikel]-$t[judul_seo].html#comments' class='article-icon-link'><span class='icon-text'></span>$total_komentar komentar</a><a  class='article-icon-link'><span class='icon-text'></span>$t[hari], $tgl - $t[jam] WIB</div></div>
  
  <ul class='article-array content-category'>
  ";
		              	        
  while($w=mysql_fetch_array($sub)){
  $tgl = tgl_indo($w['tanggal']);
  $judul = $w['judul']; 
  echo "<li>
  <a href=artikel-$w[id_artikel]-$w[judul_seo].html>$judul</a>
  <a href='#' class='comment-icon'>$w[hari], $tgl</a>
  <a href='artikel-$w[id_artikel]-$w[judul_seo].html.html#comments' class='comment-icon'><span class='icon-text'></span>$total_komentar komentar</a> </li>
  ";}
								
  echo "</ul>";} 			
  ?>  						
                                      
			  </div>
									<!-- END .content-panel -->
						    </div>
							  <!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .article-small-block --><!-- BEGIN .content-panel --><!-- END .main-split-right -->
							</div>
							
							<div class="clear-float"></div>


						<!-- END .main-content-split -->
						</div>
						
						<!-- BEGIN .main-nosplit -->
						
                        
                        
                        <div class="main-nosplit">
							<div class="banner">
								<div class="banner-block">
                            <center>
                             <?php
							 /*
  $iklantengah_home=mysql_query("SELECT * FROM iklantengah_home WHERE aktif='Ya' 
  ORDER BY id_iklantengah_home DESC LIMIT 3");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='img_iklantengah_home/$b[gambar]'  /></a>
  ";} */?></center>
						</div>
						  <!-- END .banner -->
						  </div>



<div class="main-content-split">

							<!-- BEGIN .content-panel -->
                            <div class="main-split-left">
                            
						  <div class="content-panel">
								<div class="panel-header">
                               
									<b style="background:#f07f07;"><span class="icon-text">&#9871;</span>Perundang-Undangan</b>
									<div class="top-right"><a href="kategoriartikel-<?php echo"$t[id_kategoriartikel]-$t[kategoriartikel_seo]" ?>.html">Lihat Arsip</a></div>
								</div>
								<div class="panel-content">
                                
                                
<ul class="article-array content-category">

 <?php    
  $terkini2=mysql_query("SELECT * FROM artikel WHERE aktif='Y' and id_kategoriartikel=4 ORDER BY id_artikel DESC LIMIT 12");
  $t2=mysql_fetch_array($terkini);
  
  while($t2=mysql_fetch_array($terkini2)){
  $tgl = tgl_indo($t2['tanggal']);
  $baca = $t2[dibaca]+1;		
  
  $komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t2['id_artikel']."'";
  $zalkomentar = mysql_query($komentar);
  $total_komentar = mysql_num_rows($zalkomentar);
  $isi_artikel =(strip_tags($t2['isi_artikel']));
  $isi = substr($isi_artikel,0,300); 
  $isi = substr($isi_artikel,0,strrpos($isi," ")); 
   ?>

                                     <?php
  echo "
 <li>
  <a href=artikel-$t2[id_artikel]-$t2[judul_seo].html>$t2[judul]</a>
<br></li>
  ";}
  ?>			
       </ul>               

								</div>
							<!-- END .content-panel -->
							</div>

</div>

<div class="main-split-right">

<div class="content-panel">
								<div class="panel-header">
                             
                                
									<b style="background:#f07f07;"><span class="icon-text">&#9871;</span>Agenda </b>
									<div class="top-right"><a href="agenda.html">Lihat Arsip</a></div>
								</div>
								<div class="panel-content">
<ul class="article-array content-category">
                                     <?php  
  
  $agenda=mysql_query("SELECT * FROM agenda  ORDER BY id_agenda DESC LIMIT 6");
  while($a=mysql_fetch_array($agenda)){
  $tgl_mulai = tgl_indo($a[tgl_mulai]);
  $tgl_selesai = tgl_indo($a[tgl_selesai]);
  $isi_agenda = strip_tags($a['isi_agenda']);
  $isi = substr($isi_agenda,0,50);
  $isi = substr($isi_agenda,0,strrpos($isi," ")); 
  
  echo "<li>
  
  <h5 class='bold'><a href='agenda-$a[id_agenda]-$a[tema_seo].html'><span class='txthover'>$a[tema]</span></a></h5>
  <p>'$isi ...'</p>
  <p>
  <span class='date'>$a[tanggal_agenda]</span>
  <span class='venu'>$a[tempat]</span>
  </p>
  
  </li>";}
  ?>			
       </ul>               

								</div>
							<!-- END .content-panel -->
							</div>
</div>

</div>
<div class="clear-float"></div>
							  <!-- BEGIN .content-panel -->
							  <!-- BEGIN .content-panel --><!-- BEGIN .banner -->
							  
							  
							  
							  <!-- BEGIN .content-panel -->
						  </p>
							<div class="content-panel">
                            
                            
                            <div class="panel-header">
									<b style="background:#f07f07;"><span class="icon-text">&#9871;</span>GALERI </b>
									<div class="top-right"><a href="semua-album.html">Lihat Arsip</a></div>
							  </div>
                            
                            
                            
                            <div class="video-left">
                            
                            <?php    
  
  $album= mysql_query("SELECT *
  FROM  gallery 
  ORDER BY id_gallery DESC LIMIT 5");
  
  while($w=mysql_fetch_array($album)){
  $jdl_gallery=($w[jdl_gallery]);
  if ($w['gbr_gallery']!=''){  
  ?>
<a href="img_galeri/<?php echo $w['gbr_gallery']  ;?>" class="highslide" onclick="return hs.expand(this,
                { outlineType: 'rounded-white' })"> 
                 <img src="img_galeri/kecil_<?php echo $w['gbr_gallery']  ;?>" alt="<?php echo $w['id_gallery']?>" width="128" height="100" title="Click to enlarge" />
        </a>
        <div  class="highslide-caption"> 
        <?php echo $w['keterangan'] ;?>
    	</div>
        
<?php // echo"  <img height='120'  src='img_galeri/kecil_$w[gbr_gallery]'  alt='$w[jdl_gallery]' class='setborder'></span>";}
  }
  }
  ?>			
    			       
					          </div>
 
						  </div>
							
						</div>
						
                        
					<!-- END .main-content-left -->
					</div>
						
                        
                        
                        
                        
                        
<!-- BEGIN .main-content-right -->
					
                    
                    
            
  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_home.php";?>
  <!--========= AKHIR SIDEBAR =================-->		
                    
					
				
					
				
	
								
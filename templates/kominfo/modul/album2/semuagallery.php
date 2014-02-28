  
   <div class="main-content-left">  	
						<div class="content-article-title">
	<?php echo " <h2>FOTO KOLASE</h2>";?>
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
                                                       
  <script type="text/javascript" src="<?php echo "$f[folder]"; ?>/highslide/highslide.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]"; ?>/highslide/highslide.css" /> 

<script type="text/javascript" src="<?php echo "$f[folder]"; ?>/script/xfade2.js"></script>
<link rel="stylesheet" href='<?php echo "$f[folder]"; ?>/script/slideshow.css' type="text/css" />

<script type="text/javascript">
    hs.graphicsDir = '<?php echo "$f[folder]"; ?>/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script> 
							<?php          
  
  // Tentukan kolom
  $col = 4;
$a = mysql_query("SELECT * FROM gallery2 ORDER BY id_gallery ");
/* $a = mysql_query("SELECT *  jdl_album, album.id_album, gbr_album, album_seo,  
                  COUNT(gallery.id_gallery) as jumlah 
                  FROM album LEFT JOIN gallery 
                  ON album.id_album=gallery.id_album 
                  WHERE album.aktif='Y'  
                  GROUP BY jdl_album");
  */
  echo "<table border='0' ><tr>";
  
  
  $cnt = 0;
  while ($w = mysql_fetch_array($a)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
  }
  $cnt++;


 echo "<td align=center valign=top width='150'><br />"; ?>
  <a href="img_galeri2/<?php echo $w['gbr_gallery']  ;?>" class="highslide" onclick="return hs.expand(this,
                { outlineType: 'rounded-white' })"> 
                 <img src="img_galeri2/<?php echo $w['gbr_gallery']  ;?>" alt="<?php echo $w['id_gallery']?>" width="150" height="100" title="Click to enlarge" />
        </a><div  class="highslide-caption"> 
        <?php  echo $w['keterangan'] ;?>
    	</div>
	
 
 <?php
}
echo "</tr></table>";
           


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

						
					<!-- END .main-content-left -->
</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	

  
  
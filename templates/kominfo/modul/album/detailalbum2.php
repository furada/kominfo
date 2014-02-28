   <?php
   $sq = mysql_query("SELECT * from album where id_album='".$val->validasi($_GET['id'],'sql')."'");
  $n = mysql_fetch_array($sq);
   ?>
   
   <div class="main-content-left">  	
						<div class="content-article-title">
	<?php echo "  <h2><a href=semua-album.html>Album</a> / $n[jdl_album] </h2>";?>
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
  $col = 5;

  $g = mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($g)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
    }
    $cnt++;

    echo "<td align=center valign=top><br />"; ?>
	
	
	  <a href="img_galeri/<?php echo $w['gbr_gallery']  ;?>" class="highslide" onclick="return hs.expand(this,
                { outlineType: 'rounded-white' })"> 
                 <img src="img_galeri/kecil_<?php echo $w['gbr_gallery']  ;?>" alt="<?php echo $w['id_gallery']?>" width="150" height="100" title="Click to enlarge" />
        </a>
        <div  class="highslide-caption"> 
        <?php  echo $w['keterangan'] ;?>
    	</div>
	
	
	<?php /* echo"
          <a data-rel='prettyPhoto'   href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]'>
          <img alt='galeri' src='img_galeri/$w[gbr_gallery]' width='150px' class='frame'/></a><br />
          <a href=#><b>$w[jdl_gallery]</b></a></td>"; */
  }
  echo "</td></tr></table> <hr size='1' color='#d9d9d9'><br />";
  }else{
    echo "<p>Belum ada foto.</p>";
  }
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

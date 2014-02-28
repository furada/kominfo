  
   <div class="main-content-left">  	
						<div class="content-article-title">
	<?php echo " <h2>ALBUM</h2>";?>
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
  
  // Tentukan kolom
  $col = 4;

  $a = mysql_query("SELECT jdl_album, album.id_album, gbr_album, album_seo,  
                  COUNT(gallery.id_gallery) as jumlah 
                  FROM album LEFT JOIN gallery 
                  ON album.id_album=gallery.id_album 
                  WHERE album.aktif='Y'  
                  GROUP BY jdl_album");
  echo "<table border='0' ><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($a)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
  }
  $cnt++;


 echo "<td align=center valign=top width='150'><br />
    <a href='album-$w[id_album]-$w[album_seo].html'>
    <img src='img_album/kecil_$w[gbr_album]' border=2px width=130 height=100 class=frame></a><br />
    $w[jdl_album]<br />($w[jumlah] Foto)<br /></td>";
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

  
  
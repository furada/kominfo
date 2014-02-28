  
  
  
  <!--========= DETAIL ALBUM ========================-->
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
			
  <?php
  $sq = mysql_query("SELECT * from album where id_album='".$val->validasi($_GET['id'],'sql')."'");
  $n = mysql_fetch_array($sq);
  $tgl_posting   = tgl_indo($n[tgl_posting]);
  $hits = $n[hits_album]+1;
  mysql_query("UPDATE album SET hits_album='$hits' where id_album='".$val->validasi($_GET['id'],'sql')."'");
  
  echo "
  <h4 class='cat-title mb25'>$n[jdl_album]</h4>
  
  <div class='post-meta'>
  <span>$n[hari], $tgl - $n[jam] WIB</span> <span class style=\"color:#fc7100;\">|</span>
  <span>dilihat: $hits pengunjung</span> </div>
  
  <div class='addthis_toolbox addthis_default_style'>
  <a class='addthis_button_preferred_1'></a>
  <a class='addthis_button_preferred_2'></a>
  <a class='addthis_button_preferred_3'></a>
  <a class='addthis_button_preferred_4'></a>
  <a class='addthis_button_compact'></a>
  <a class='addthis_counter addthis_bubble_style'></a>
  </div>
  <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-504c13fd103cdd62'></script>
  
  <div class='clear'></div>
  <div class='line'></div>
  $n[keterangan] 
  <div class='clear'></div>";
  
  ?>
			
  
  <?php
  echo " 
  <div id='gallery' class='ad-gallery'>      			    
  <div class='ad-image-wrapper'></div>
  <div class='ad-nav'>
  <div class='ad-thumbs'>
  <ul class='ad-thumb-list'>";

  $p      = new GaleriFoto;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $col = 3;
	
  $g = mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC LIMIT $posisi,$batas");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {
  $cnt = 0;
  while ($w = mysql_fetch_array($g)) {
  if ($cnt >= $col) {
  $cnt = 0; }
  $cnt++;

  echo "
  <li>
  <a href='img_galeri/$w[gbr_gallery]'>
  <img src='img_galeri/kecil_$w[gbr_gallery]' title='$w[jdl_gallery]' 
  longdesc='$w[keterangan]'></a>
  </li>";}

  echo "</ul>
  </div></div></div>";

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]'"));}
  
  
  else{
  echo "<br/><div class='blumada2'><h4>Belum ada foto pada halaman ini.</h4></div></ul>
  </div></div></div>";}
  

  ?>

  <?php
  $qp = mysql_query("select id_album, jdl_album, album_seo from
  album where id_album < '".$val->validasi($_GET['id'],'sql')."' order by id_album desc limit 1");
  $jp = mysql_num_rows($qp);
  $tp = mysql_fetch_array($qp);
  
  $qn = mysql_query("select id_album, jdl_album, album_seo from
  album where id_album > '".$val->validasi($_GET['id'],'sql')."' order by id_album asc limit 1");
  $jn = mysql_num_rows($qn);
  $tn = mysql_fetch_array($qn);
  
  echo " <div class='post-navigation'>
  <div class='clear'></div> ";
  
  if($jp <> 0) {
  echo "<div class='post-previous'><a href='album-$tp[id_album]-$tp[album_seo].html' rel='prev'>
  <span>Sebelumnya:</span>$tp[jdl_album]</a></div>";}
 
  if($jn <> 0) {
  echo "<div class='post-next'><a href='album-$tn[id_album]-$tn[album_seo].html' rel='next'>
  <span>Selanjutnya:</span> $tn[jdl_album]</a></div>";}
  ?>
  
  <?php
  $sq = mysql_query("SELECT * from album where id_album='".$val->validasi($_GET['id'],'sql')."'");
  $n = mysql_fetch_array($sq);
  echo "
  <div class='clear'></div>
  <div class='fb-comments' data-href='$iden[url]/album-$n[id_album]-$n[album_seo].html' data-num-posts='2' mobile='false'> 
  </div>";  
   ?>
  
  
  
  </div>
  </section>
  <!--========= AKHIR DETAIL ALBUM ========================-->
  

  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_album.php";?>
  <!--========= AKHIR SIDEBAR =================-->			

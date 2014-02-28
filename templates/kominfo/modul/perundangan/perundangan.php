
	

  <!--================= DOWNLOAD AREA ========================-->
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
  <h4 class='cat-title mb25'>Perundangan</h4>


  <?php
  $p      = new Download;
  $batas  = 30;
  $posisi = $p->cariPosisi($batas);
  
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
  
  echo "
  <article>		
  <ul class='bullet-daftar'>"; 

  $sql = mysql_query("SELECT * FROM perundangan  ORDER BY id_download DESC LIMIT $posisi,$batas");		  
  while($d=mysql_fetch_array($sql)){
  

  echo "<li><a href='terasconfig/perundangan.php?file=$d[nama_file]'>$d[judul]</a>
  <span class style=\"color:#999;font-size:12px;padding-left:0px;\">( didownload: $d[hits] x )</span></li>";}
				
			
  

  echo "</ul> 
  </article> <br/><div class='clear'></div>
  <div class='line'></div> ";
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM perundangan"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[haldownload], $jmlhalaman);
  
  
  echo " 		
  <div class='pagenation clearfix'>
  <ul class='no-bullet'>$linkHalaman</ul>
  </div>";
  
  
  
  // IKLAN TENGAH DALAM//////////////////////////////////////////////////////////////////////////
  $iklantengah_home=mysql_query("SELECT * FROM iklantengah_dalam WHERE aktif='Ya'
  ORDER BY rand() DESC LIMIT 1");
  while($b=mysql_fetch_array($iklantengah_home )){
  echo "
  <div class='ads-middle'>
  
  
  <div style='width:620px;height:120px;position:relative;'>
  <div style='position:absolute; z-index:1;'>
  
  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' 
  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='620' height='120'>
  <param name='movie' value='img_iklantengah_dalam/$b[gambar]'' />
  <param name='quality' value='high' />
  <param name='wmode' value='transparent'>
  <embed src='img_iklantengah_dalam/$b[gambar]' quality='high' type='application/x-shockwave-flash' width='620' height='120' 
  wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' />
  </object>
  
  </div>
  <div style='position:relative; z-index:2;'>
  <a href='$b[url]' target='_blank' title='$b[judul]'><img src='$f[folder]/images/spacer.png' width='620' height='120'/></a>
  </div>
  </div>  
  
  </div>";}
  ////////////////////////////////////////////////////////////////////////////////////////////////////
  ?>
  
  </section>	
  <!--================= AKHIR DOWNLOAD AREA ========================-->



  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_download.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  

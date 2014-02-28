
	

  <!--================= KATEGORI DOWNLOAD ========================-->
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
  
  <!--========= HEADER  ========================-->
  <img src=<?php echo "$f[folder]/images/headers/header_default.jpg" ?>><br />
  <?php
  $sq = mysql_query("SELECT nama_kategoridownload from kategoridownload where id_kategoridownload='".$val->validasi($_GET['id'],'sql')."'");
  $n = mysql_fetch_array($sq);
  echo " 
  <h4 class='cat-title mb25'>$n[nama_kategoridownload]</h4>";
  ?>
  <!--========= AKHIR HEADER  ========================-->
  
  <?php
  $p      = new KategoriDownload;
  $batas  =30;
  $posisi = $p->cariPosisi($batas);
  
  $sql   = "SELECT * FROM download WHERE id_kategoridownload='".$val->validasi($_GET['id'],'sql')."'
  ORDER BY id_download DESC LIMIT $posisi,$batas";		 

  $hasil = mysql_query($sql);
  $jumlah = mysql_num_rows($hasil);
  
  echo "
  <article>		
  <ul class='bullet-daftar'>"; 

  if ($jumlah > 0){
  while($r=mysql_fetch_array($hasil)){

  echo "<li><a href='terasconfig/downlot.php?file=$r[nama_file]'>$r[judul]</a>
  <span class style=\"color:#999;font-size:12px;padding-left:0px;\">( didownload: $r[hits] x )</span></li>";}
				
  echo "</ul> 
  </article> <br/><div class='clear'></div>
  <div class='line'></div> ";
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM download WHERE id_kategoridownload='".$val->validasi($_GET['id'],'sql')."'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategoridownload], $jmlhalaman);
  
  
  echo " 		
  <div class='pagenation clearfix'>
  <ul class='no-bullet'>$linkHalaman</ul>
  </div>";}
  
  else{
  echo "
  <h5>Tidak ada file pada $n[nama_kategoridownload]</h5>
  <br/><div class='clear'></div>
  <div class='line'></div>";}
  
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
  <!--================= AKHIR KATEGORI DOWNLOAD ========================-->



  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_download.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  

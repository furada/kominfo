    
  <!--================= HASIL PENCARIAN ========================-->
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
  <h4 class='cat-title mb25'>HASIL PENCARIAN PERUNDANGAN</h4>

 <form method="POST" action="hasilcari.html">
 
<table width="350">
<tr>
 <td><input type='text' name='kata' size='30'></td>
 <td> <input type='submit' value='Cari Perundangan'></td>
</tr>
</table>
  </form>
 <!--================= PENCARIAN ALA GOOGLE========================-->
  <?php //include "cari.php";?><br/><br/>
 <!--================= AKHIR PENCARIAN ALA GOOGLE ================-->
 
  <?php
  $kata = trim($_POST['kata']);
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM perundangan WHERE " ;
  for ($i=0; $i<=$jml_kata; $i++){
  $cari .= "nama_file LIKE '%$pisah_kata[$i]%' or judul LIKE '%$pisah_kata[$i]%'";
  if ($i < $jml_kata ){
  $cari .= " OR "; } }
  
  $cari .= " ORDER BY id_download DESC ";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);
  
  if ($ketemu > 0){
  echo "
  <h5>Ditemukan <font style='background-color:#fc7100;color:#fff;'><b>$ketemu</b></font> pencarian 
  dengan kata <font style='background-color:#fc7100;color:#fff;'><b>$kata</b></font></h5>"; 
 
  echo "   <article><ul class='bullet-daftar'>"; 
       
  while($t=mysql_fetch_array($hasil)){
  //$tgl = tgl_indo($t[tanggal]);
  //$baca = $t[dibaca]+1;		
  //$komentar = "SELECT * FROM komentar WHERE id_artikel = '".$t['id_artikel']."'";
  //$zalkomentar = mysql_query($komentar);
  //$total_komentar = mysql_num_rows($zalkomentar);

  echo "<li><a href='terasconfig/perundangan.php?file=$t[nama_file]'>$t[judul]</a>
  <span class style=\"color:#999;font-size:12px;padding-left:0px;\">( didownload: $t[hits] x )</span></li>";}
				
  echo "</ul> 
  </article> <br/><div class='clear'></div>
  <div class='line'></div> ";
  
 }
 
   else{
  echo " 
  <h5>Tidak ditemukan pencarian dengan kata <font style='background-color:#fc7100;color:#fff;'><b>$kata</b> </h5>   
  <br/><div class='clear'></div>
  <div class='line'></div>";}
  
 ?>
   <!--========= AKHIR PENCARIAN  ========================-->
<!--  IKLAN TENGAH DALAM////////////////////////////////////////////////////////////////////////// -->
 <?php  $iklantengah_home=mysql_query("SELECT * FROM iklantengah_dalam WHERE aktif='Ya'
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
  
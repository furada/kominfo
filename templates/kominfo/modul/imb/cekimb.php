

  <!--========= IMB  =================-->			
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
				
  <?php
  $detail=mysql_query("SELECT * FROM imb where noreg=$_POST[cek] ");
  $d   = mysql_fetch_array($detail);
  $tanggal  = tgl_indo($d[tgl]);
  $noreg=$d[noreg];
  $status  = $d[statusberkas];
  $baca = $d[dibaca]+1;
  mysql_query("UPDATE imb SET dibaca='$baca' ORDER BY id='".$val->validasi($_GET['id'],'sql')."'");
 
  echo "  						
  <h1 class='post-title4'>CEK IMB</h1>
  
  <div class='post-meta'>
  <span>$d[nama_lengkap]</span> <span class style=\"color:#fc7100;\">|</span>
  <span>$d[hari], $tgl - $d[jam] WIB</span> <span class style=\"color:#fc7100;\">|</span>
  <span>dibaca: $baca pembaca</span> 
  </div>

	
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
  <div class='line'></div>";
				

  //if ($d[gambar]!=''){
//  echo "  <div class='gambar2'><img src='img_teraskreasi/$d[gambar]' alt='$d[judul]' class='gambar'> </div>";} 
 
  
  
  //echo "$d[isi_profil]
  echo "
  <div class='contact-form comment cleafix'>
  <h4>MELIHAT STATUS PENGURUSAN IMB</h4>
  <form  name='form1' method='post' action=''>
  <table>

  <tr>
   <td>Masukkan Nomor Registrasi</td>
   <td><input type='text' name='cek' size='40'></td>
   <td><input type='submit' value='cek status' ></td>
  </tr>
  
   
</form>"; ?>

<?php
  $reg=$_POST['cek'];
 
 
 if (isset ($_POST['cek'])){
echo"No registrasi anda : <b>$noreg</b> Status Registrasi Anda adalah : <b>$status</b> <br>
	";
  }
  
  
  else
  {
	  echo "";
	  
  }
  
  echo "
   <br>
   </td>
  </tr>  
  </table>
  </div>
  <div class='clear'></div>
  <div class='line'></div>	
  </section>";  
  ?>		
  
  	
  <!--========= AKHIR PROFIL  =================-->			

  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  

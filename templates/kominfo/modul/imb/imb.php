

  <!--========= IMB  =================-->			
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left singlepost">
				
  <?php
  $detail=mysql_query("SELECT * FROM profil,users where id_profil=6 ORDER BY id_profil DESC");
  $d   = mysql_fetch_array($detail);
  $tanggal  = tgl_indo($d[tanggal]);
  $baca = $d[dibaca]+1;
  mysql_query("UPDATE profil SET dibaca='$baca' ORDER BY id_profil='".$val->validasi($_GET['id'],'sql')."'");
 
  echo "  						
  <h1 class='post-title4'>Simulasi IMB</h1>
  
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
  <h4>SIMULASI PERHITUNGAN RETRIBUSI IMB </h4>
  <form  name='form1' method='post' action=''>
  <table>
   <tr>
   <td colspan='3'>Pilih Fungsi Bangunan <select name='fungsi'>
   <option  value=''>Pilih Fungsi Bangunan</option>
   <option  value='hunian'>Hunian</option>
   <option  value='usaha'>Usaha</option>
   </select>
   </td>
  </tr>
  <tr>
   <td>Masukkan Luas Bangunan</td>
   <td><input type='text' name='lb' size='10'></td>
   <td>m<sup>2</sup></td>
  </tr>
   <tr>
   <td colspan='3'>Masukkan Ukuran Tanah:</td>
  </tr>
  <tr>
   <td>Panjang </td>
   <td><input type='text' name='panjang' size='10'></td>
   <td>m</td>
  </tr>
   <tr>
   <td>Lebar  </td>
   <td><input type='text' name='lebar' size='10'></td>
   <td>m</td>
  </tr>
     <tr><td ></td>
   <td ><input type='submit' value='hitung'></td><td ></td>
  </tr>
    <tr>
   <td colspan='3'>
   
</form>"; ?>

<?php
  $fungsi=$_POST['fungsi'];
  $luas=$_POST['lb'];
  $pjg=$_POST['panjang'];
  $lbr=$_POST['lebar'];
  //menghitung rppbg luas bangunan x 0.375 x 27.500 x 1
  $hunian=$luas*0.375*27500;
  
  //menghitung luas pagar
  $luaspagar=($pjg+$pjg+$lb+$lbr)*2;
  //menghitung retribusi pagar standar 133m2 x 0.2 x 27500 x 1 = 731.500
  $pagar=731500;
  //$pagar=$luaspagar*0.2*27500;
  
  //menghitung carport sudah standar 18m X 0,1 X 27.500X1=49500
  $carport=49500;
  //menghitung retribusi pagar + carport
  $retribusi=$hunian+$pagar+$carport;
  $ttl1=number_format($hunian);
  $ttl2=number_format($pagar);
  $ttl3=number_format($carport);
  $ttl4=number_format($retribusi);
 
 
 if ($_POST["fungsi"] == "hunian") {

echo"RETRIBUSI IMB UNTUK HUNIAN<br>
Luas Bangunan anda : $luas <br>
Ukuran Tanah : Panjang : $pjg  Lebar : $lbr <br>
<br> Retribusi Hunian  <b>Rp $ttl1 </b><br>
  
   Pagar : <b>Rp $ttl2</b><br>
    Carport : <b>Rp $ttl3</b><br>
	--------------------------------------<br>
	Total Retribusi adalah <b> Rp $ttl4</b>
	";
  }
  
  elseif($_POST["fungsi"] == "usaha") {   
  $luas=$_POST['lb'];
  $pjg=$_POST['panjang'];
  $lbr=$_POST['lebar'];
  //menghitung rppbg luas bangunan x 0.375 x 27.500 x 1
  $usaha=$luas*2.415*27500;
  
  //pagar tidak dihitung
  
  //menghitung perkerasan sudah standar 18m X 0,1 X 27.500X1=49500
  $perkerasan=96250;
  //menghitung retribusi pagar + carport
  $retribusi=$usaha+$perkerasan;
  $ttl1=number_format($usaha);
  $ttl2=number_format($perkerasan);
  $ttl3=number_format($retribusi);
  
	  echo"RETRIBUSI IMB UNTUK USAHA<br>
	  Luas Bangunan anda : $luas <br>
Ukuran Tanah : Panjang : $pjg  Lebar : $lbr <br>
<br> Retribusi Usaha  <b>Rp $ttl1 </b><br>
  
   Pagar : <b>-</b><br>
    Perkerasan : <b>Rp $ttl2</b><br>
	--------------------------------------<br>
	Total Retribusi adalah <b> Rp $ttl3</b>";

  }
  else
  {
	  echo "";
	  
  }
  
  ?>
  
  <?php echo "
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
  

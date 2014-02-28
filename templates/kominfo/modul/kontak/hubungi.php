

  <!--=============== HUBUNGI KAMI ===================================-->	
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left">
  <h1 class="post-title">Alamat & Peta Lokasi</h1>

  <?php
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
  
  echo "
  <div class='alamat2'>$iden[alamat]</div>
  <div class='alamat'>Email: $iden[email], Telp: $iden[no_telp]</div>
  <div class='alamat'>Hari Kerja: $iden[hari_kerja], Jam Kerja: $iden[jam_kerja]</div><br/>
  
  <h5 class='post-title3'>Online Support</h5>";
  $ym=mysql_query("select * from mod_ym order by id desc");
  while($t=mysql_fetch_array($ym)){
  
  echo "
  <div class='userym2'><div class='userym'>$t[nama] :</div> 
  <div class='ymikon'>
  <a href='ymsgr:sendIM?$t[username]'>
  <img src='http://opi.yahoo.com/online?u=$t[username]&amp;m=g&amp;t=1' border='0' height='16' width='64'></a>
  </div>
  </div>";} 
  ?>
  
  <?php
  $pet=mysql_fetch_array(mysql_query("SELECT * FROM peta"));	
  echo " <div class='clear'></div>
  <div class='line'></div>
  
  
  <div class='clear'></div>
  <div class='line'></div>		
  <br>
  
  <h3 class='post-title'>Form Hubungi Kami </h3>
  <div class='contact-form comment cleafix'>
  <form id='teraskreasi-form' action='aksi-hubungi.html' method=POST onSubmit=\"return validasi(this)\">
 
  <label>Nama</label>
  <input required  name='nama' type='text' id='nama' size=70><br/>
  
  <label>Email</label>
  <input required name='email' type='text' id='email' size=70><br/>
  
  <label>Subjek</label>
  <input required name='subjek' type='text' id='subjek' size=70><br/>
  
  <label>Pesan</label>
  <textarea required  name='pesan' class='twelve column' id='pesan'></textarea>

  <input required name='kode' size=6 maxlength=6  type='text' id='kode'>
  <div class='captcha'>
  <img id='captcha' src='terasconfig/captcha.php' border='0' ><a href='JavaScript: captcha();'>
  <img border='0' alt='' src='terasconfig/refresh.png' align='top'></a>
  </div>
  
  <input type='submit' value='KIRIM PESAN'>
  <input type=hidden name=id value=$d[id_artikel]>
  </form>
  </div>"; 
  ?>
  <br><br><br>
  </section>
  <!--================================ AKHIR HUBUNGI KAMI ===================================-->	



  <!--========= SIDEBAR ========================-->
  <?php // include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  

 
 
 
  <section class="inner-container clearfix">
  <section id="content" class="eight column row pull-left">
		

  <?php
  
  $nama=trim($_POST[nama]);
  $email=trim($_POST[email]);
  $subjek=trim($_POST[subjek]);
  $pesan=trim($_POST[pesan]);
  
  $teraskreasi=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

  if (empty($nama)){
  echo "<span class='new-comment-heading'>Anda belum mengisikan NAMA</span>
  <a href=javascript:history.go(-1)><input type='submit' 
  class='contact-form-button' value='Ulangi Lagi' name='submit'/></a>";}
		  
  elseif (empty($email)){
  echo "<span class='new-comment-heading'>Anda belum mengisikan EMAIL</span>
  <a href=javascript:history.go(-1)><input type='submit' 
  class='contact-form-button' value='Ulangi Lagi' name='submit'/></a>";}
		  

  elseif (empty($subjek)){
  echo "<span class='new-comment-heading'>Anda belum mengisikan SUBJEK</span>
  <a href=javascript:history.go(-1)><input type='submit' 
  class='contact-form-button' value='Ulangi Lagi' name='submit'/></a>";}
  
  elseif (empty($pesan)){
  echo "<span class='new-comment-heading'>Anda belum mengisikan PESAN</span>
  <a href=javascript:history.go(-1)><input type='submit' 
  class='contact-form-button' value='Ulangi Lagi' name='submit'/></a>";}
  
  else{
  if(!empty($_POST['kode'])){
  if($_POST['kode']==$_SESSION['captcha_session']){

  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");
 
 
  echo " 
  <h4>Terima Kasih</h4>
  <p><b>Anda telah menghubungi $teraskreasi[nama_website], kami segera merespon pesan anda.</b></p>";
   
   
   $kepada = "$teraskreasi[email]"; 
   $judul = "Ada Pesan di $teraskreasi[nama_website]";
   $pesan = "Baru saja ada yang kirim pesan di $teraskreasi[nama_website]\n"; 
   $pesan .= "Cek Administrator: $teraskreasi[url]/editweb"; 
   mail($kepada,$judul,$pesan,"From: $teraskreasi[email]\n Content-type:text/html\r\n"); }
  
  else{
  echo "<h5>Kode yang Anda masukkan tidak cocok !</h5>
  <a href=javascript:history.go(-1)><input type='submit' class='button-gray' value='Ulangi Lagi' name='submit'/>
  </a>";}}
  
  else{
  echo "<span class='new-comment-heading'>Anda belum memasukkan kode</span>
  <a href=javascript:history.go(-1)><input type='submit' 
  class='contact-form-button' value='Ulangi Lagi' name='submit'/></a>";}}
    
  echo "</section>"; 
		  
  ?>

  <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_agenda.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  
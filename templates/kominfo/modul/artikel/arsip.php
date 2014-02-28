
	

   <div class="main-content-left">
						<div class="content-article-title"> 
                         <?php
  $artikel = mysql_query("SELECT * FROM artikel WHERE MONTH(tanggal)='$_GET[bulan]' AND YEAR(tanggal)='$_GET[tahun]'"); 
  $jml_artikel = mysql_num_rows($artikel);
 

  echo "
  <h2>$jml_artikel Arsip Artikel ".getBulan($_GET[bulan])." ".$_GET['tahun']."</h2>";
  
 ?>
						</div>
			
  <div class="main-article-content">
							
                            
                            
    <div class="article-small-block"> <?php echo"<h3>Cari Arsip Artikel lainnya: </h3><select id='bulan-tahun' onchange='archive()'>";	?>  
	  <div class="article-header"> 
			</div>
 <?php
							
						
   $archive = mysql_query("SELECT DISTINCT(MONTH(tanggal)) as bulan, YEAR(tanggal) as tahun FROM artikel ORDER BY tahun DESC,bulan DESC");
  while($r = mysql_fetch_array($archive)){
  if($_GET[bulan]==$r[bulan] AND $_GET[tahun] == $r[tahun]){
  $select = "selected";}
  else{
  $select = "";}
  echo "<br><option value='$r[bulan]-$r[tahun]' $select>".getBulan($r[bulan])." $r[tahun]</option>";}
  echo "</select>
  "; 

  echo "
 <br/><div class='clear'></div>
  <div class='line'></div> ";
 
		?>       
		<!-- END .article-small-block -->
	</div>
                   
                          
							
							<div class="article-photo">
							  
							</div>
							
							<!-- BEGIN .article-controls -->
							
							<!-- BEGIN .shortcode-content -->
							<div class="shortcode-content">
	  <section class="row">
      
 
                            <ul>
                                  <?php
								   while($b = mysql_fetch_array($artikel)){
  echo "<li><a href='artikel-$b[id_artikel]-$b[judul_seo].html'>$b[judul]</a></li>";}
								  ?>
										</ul>    
                                
							<!-- END .shortcode-content -->
							</div>
  </div>

						<!-- BEGIN .main-nosplit --><!-- BEGIN .main-nosplit -->

  <!-- END .main-content-left -->
</div>
                     <!--========= SIDEBAR ========================-->
  <?php include "$f[folder]/modul/sidebar/sidebar_detail.php";?>
  <!--========= AKHIR SIDEBAR =================-->	
  
    
 
 
 
 
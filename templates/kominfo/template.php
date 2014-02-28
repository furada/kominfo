<?php 
  error_reporting(0);
  $theme=mysql_fetch_array(mysql_query("SELECT * FROM templates"));
  ?>
<!DOCTYPE HTML>
<!-- BEGIN html -->
<html lang = "en">
	<!-- BEGIN head --><head>
		 <title><?php include "terasconfig/kominfo_titel.php"; ?></title>
		<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="" />
        <meta name="description" content="<?php include "terasconfig/kominfo1.php"; ?>">
 		 <meta name="keywords" content="<?php include "terasconfig/kominfo2.php"; ?>">
   <meta name="author" content="Dinas Komunikasi Provinsi Sumut" "http://sumutprov.go.id">
  <meta http-equiv="imagetoolbar" content="no">
  <meta name="language" content="Betawi-Indonesia">
  <meta name="revisit-after" content="7">
  <meta name="webcrawlers" content="all">
  <meta name="rating" content="general">
  <meta name="spiders" content="all">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo "$f[folder]"; ?>/images/favicon.ico" type="image/x-icon" />
		<!-- Stylesheets -->
		<link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css/reset.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css/main-stylesheet.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css/shortcode.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css/fonts.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css/retina.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css/foundation2.css" />
         <link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css2/dzscalendar.css" />
         <link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css2/dzstooltip.css" />
       <link rel="stylesheet" href="<?php echo "$f[folder]/css/jquery.ad-gallery.css" ?>" type="text/css" />
 
    
    
<!--[if lte IE 8]>
		<link type="text/css" rel="stylesheet" href="css/ie-transparecy.css" />
		<![endif]-->
		<!-- <link type="text/css" id="style-responsive" rel="stylesheet" media="screen" href="<?php echo "$f[folder]"; ?>/css/responsive/desktop.css" />
		<!-- Scripts -->
		
       <link href="//fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">

		<script type="text/javascript">
		
			// Legatus Slider Options
			var _legatus_slider_autostart = true;	// Autostart Slider (false / true)
			var _legatus_slider_interval = 5000;	// Autoslide Interval (Def = 5000)
			var _legatus_slider_loading = true;		// Autoslide With Loading Bar (false / true)
		</script>
		<link type="text/css" rel="stylesheet" href="<?php echo "$f[folder]"; ?>/css/demo-settings.css" />
         <link rel="shortcut icon" href="favicon.png" />
  		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="terasconfig/rss.xml" />
        
	<!-- END head -->
	</head>
	<!-- BEGIN body -->
	<body>
		<!-- BEGIN .boxed -->
		<!-- <div class="boxed active"> -->
		<div class="boxed active">
			
			<!-- BEGIN .header -->
			<div class="header">
				
				<!-- BEGIN .header-very-top -->
				<div class="header-very-top">
					<div class="wrapper">
						
						<div class="left">
							<ul class="very-top-menu">
                            <li><a href="index.php" class="icon-text">&#8962;</a></li>
                            <?php
  function get_menu($data, $parent = 0) {
  static $i = 1;
  $tab = str_repeat(" ", $i);
  if ($data[$parent]) {
  $html = "$tab<li>";
  $i++;
  foreach ($data[$parent] as $v) {
  $child = get_menu($data, $v->id_menu);
  $html .= "$tab<li>";
  $html .= '<a href="'.$v->link.'"><span>'.$v->nama_menu.'</span></a>';
  if ($child) {
  $i--;
  $html .= "<ul class='sub-menu'>$child";
  $html .= "$tab</ul>";}
  $html .= '</li>';}
  $html .= "$tab</li>";
  return $html;}
  else {
  return false;}}
  
  $result = mysql_query("SELECT * FROM menu WHERE aktif='Ya' ORDER BY id_menu");
  while ($row = mysql_fetch_object($result)) {
  $data[$row->id_parent][] = $row; }
  $menu = get_menu($data);
  echo "$menu";
  ?>
								
							</ul>
						</div>

						<div class="right">
							<div class="weather-report">
							
								
						  </div>
						</div>

						<div class="clear-float"></div>
						
					</div>
					<div class="double-split"></div>
				<!-- END .header-very-top -->
				</div>

				<!-- BEGIN .header-middle -->
				<div class="header-middle">
					<div class="wrapper">
						
						<!-- <div class="logo-text">
							<h1><a href="index.html">LEGATUS</a></h1>
						</div> -->
						
						<div class="logo-image">
							
                             <?php
  $logo=mysql_query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1");
  while($b=mysql_fetch_array($logo)){
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
   echo "<a href='$iden[url]'><img src='img_logo/logo.png'/></a>
  ";}
  ?>
						</div>

						<div class="banner">
							<div class="banner-block"> 
                             <?php
  $iklanheader=mysql_query("SELECT * FROM iklanheader  WHERE aktif='Ya' ORDER BY id_iklanheader DESC LIMIT 1");
  while($b=mysql_fetch_array($iklanheader)){
  echo "
  <a href='$b[url]'' target='_blank' title='$b[judul]' class='tooltip'>
  <img src='img_iklanheader/$b[gambar]' border=0 width=420 height=62></a>
";}?>       <div class="banner-info">
								
							</div>
                            </div>
							
						</div>

						<div class="clear-float"></div>
						
					</div>
				<!-- END .header-middle -->
				</div>

				<!-- BEGIN .header-menu -->
				<div class="header-menu thisisfixed">
					<div class="wrapper">						
						<ul class="main-menu"> 
                        
                        
                                                                       <?php
  function get_menu2($data2, $parent2 = 0) {
  static $i = 1;
  $tab2 = str_repeat(" ", $i);
  if ($data2[$parent2]) {
  $html2 = "$tab<li>";
  $i++;
  foreach ($data2[$parent2] as $v) {
  $child = get_menu2($data2, $v->id_menu);
  $html2 .= "$tab<li  style='background:#264c84;color:#264c84;'>";
  $html2 .= '<a href="'.$v->link.'">'.$v->nama_menu.'</a>';
  if ($child) {
  $i--;
  $html2 .= "<ul class='sub-menu'>$child";
  $html2 .= "$tab</ul>";}
  $html2 .= '</li>';}
  $html2 .= "$tab</li>";
  return $html2;}
  else {
  return false;}}
  
  $result2 = mysql_query("SELECT * FROM menu2 WHERE aktif='Ya' ORDER BY id_menu");
  while ($row2 = mysql_fetch_object($result2)) {
  $data2[$row2->id_parent][] = $row2; }
  $menu2 = get_menu2($data2);
  echo "$menu2";
  ?>
            
						</ul>

						<div class="right menu-search">
							<form action="pencarian.html" method="POST">
								<input type="text" placeholder="Search something.." name="kata"  value="cari" />
								<input type="submit" class="search-button" value="&nbsp;" />
							</form>
						</div>
						
						<div class="clear-float"></div>

					</div>
				<!-- END .header-menu -->
				</div>
				

				<!-- BEGIN .header-undermenu -->
				<div class="header-undermenu">
					<div class="wrapper">
						
						<ul class="secondary-menu">
							<li><a href="semua-artikel.html">Artikel Berita</a></li>
							<li><a href="agenda.html">Kalender Acara</a></li>
							<li><a href="kategoriartikel-2-pengumuman.html">Pengumuman</a></li>
						</ul>
						
						<div class="clear-float"></div>

					</div>
				<!-- END .header-undermenu -->
				</div>
				
			<!-- END .header -->
			</div>
			
			<!-- BEGIN .content -->
			<div class="content">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<!-- BEGIN .breaking-news -->
					
						
					<!-- BEGIN .main-content-left -->
															
						<!-- BEGIN .main-content-split -->
					
							
							<!-- BEGIN .main-split-left -->
							<!--========= KONTEN ========================-->
  <?php include "konten.php";?>
  <!--========= AKHIR KONTEN =================-->
		<div class="clear-float"></div>
			<!-- END .wrapper -->
				</div>
				
			<!-- BEGIN .content -->
			</div>
			<!-- BEGIN .footer -->
			<div class="footer">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					

					<!-- BEGIN .breaking-news --><!-- BEGIN .footer-content -->
				  <div class="footer-content">
						
						<div class="footer-menu">
                       <ul> 
                     
							</ul>
						</div>
						
                        
					<!-- END .footer-content -->
					</div>

					
				<!-- END .wrapper -->
				</div>
            <div class="bawah">
                        
						<div class="left">&copy; 2014 <b>Dinas Komunikasi dan Informatika Provinsi Sumut</b> | Peta Situs<br>

</div>
						
						
						
						<div class="clear-float"></div>
						
                        </div>
				
			<!-- END .footer -->
			</div>
			
		<!-- END .boxed -->
		</div>
		<script type="text/javascript" src="<?php echo "$f[folder]"; ?>/jscript/orange-themes-responsive.js"></script>
		<script type="text/javascript" src="<?php echo "$f[folder]"; ?>/jscript/scripts.js"></script>
		<!-- For Demo Only -->
		<script type="text/javascript" src="<?php echo "$f[folder]"; ?>/jscript/jquery-ui.min.js"></script>
        
        
        
         <script src="<?php echo "$f[folder]/js5/jquery.totemticker.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js5/jquery.totemticker.min.js" ?>" type="text/javascript"></script>
  <script type="text/javascript">
		$(function(){
			$('#vertical-ticker').totemticker({
				row_height	:	'100px',
				next		:	'#ticker-next',
				previous	:	'#ticker-previous',
				stop		:	'#stop',
				start		:	'#start',
				mousestop	:	true,
			});
		});
	</script>
      
        
  <script type="text/javascript">
  $(function() {
    $('img.image1').data('ad-desc', 'Whoa! This description is set through elm.data("ad-desc") instead of using the longdesc attribute.<br>And it contains <strong>H</strong>ow <strong>T</strong>o <strong>M</strong>eet <strong>L</strong>adies... <em>What?</em> That aint what HTML stands for? Man...');
    $('img.image1').data('ad-title', 'Title through $.data');
    $('img.image4').data('ad-desc', 'This image is wider than the wrapper, so it has been scaled down');
    $('img.image5').data('ad-desc', 'This image is higher than the wrapper, so it has been scaled down');
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
  });
  </script>
	
  <script src="<?php echo "$f[folder]/js4/jquery.js" ?>" type="text/javascript"></script> 
        
	 <script src="<?php echo "$f[folder]/js4/dzscalendar.js" ?>" type="text/javascript"></script>
  <script>
  jQuery(document).ready(function($){
  $('#tr1').dzscalendar({
  start_month: ' <?=date("m")?>' 
  ,start_year: '<?=date("Y")?>'
  });
  })
  </script>
	<!-- END body -->
	</body>
<!-- END html -->
</html>
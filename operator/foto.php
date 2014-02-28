 <?php
include "../config/koneksi.php";
$a=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'"));
echo "<img width=50 height=50 src='../img_user/$a[foto]' class='img-polaroid'>"; 
?>
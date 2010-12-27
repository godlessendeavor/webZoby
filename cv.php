<?php
	session_start();
	include("utils/lang.php"); //detecting language
	if (!isset($_GET["page"])){$_GET["page"] = "cv_start";}
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include($dr.'/languages/texts_'.$_SESSION["idioma"].'.php');
	include('utils/http.php');
	ifNotModifiedSince(setLastModified()); // send http header if-modified-since
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $home_title;?></title>
<meta name="Keywords" content="thrash F1" http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="css/cvstyle.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="js/googleAnalytics.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>

<body class="main">

<div id="container">
  <div id="menu">
    <h3>Menu</h3>

    <table class="Menu">
    <tr><td><a href="cv.php?page=cv_start"><?php echo $cv_start_link;?> </a></td></tr>
    <tr><td><a href="cv.php?page=cv_profile"><?php echo $cv_profile_link;?></a></td></tr>
    <tr><td><a href="cv.php?page=cv_contact"><?php echo $cv_contact_link;?></a></td></tr>
    <tr><td><a href="homepage.php"><?php echo $cv_home_link;?></a></td></tr>
    </table>

 </div> <!-- end #menu -->
  <div id="mainContent">
  	<div id="langFlags">
    	<a title="Cambia a galego" href="cv.php?idioma=gl<?php echo '&page='.$_GET['page']?>"><img src="graphix/gflag.jpg" alt="galego" /></a>
    	<a title="Change to English" href="cv.php?idioma=en<?php echo '&page='.$_GET['page']?>"><img src="graphix/ukflag.jpg" alt="english" /></a>
    	<a title="Cambia a Espa&ntilde;ol" href="cv.php?idioma=es<?php echo '&page='.$_GET['page']?>"><img src="graphix/sflag.jpg" alt="espanhol" /></a>
    </div>
    <h1>Jos&eacute; Luis Villar Bardanca</h1>
    <br /><br />
	<?php 
		echo $$_GET['page']; //calling the variable pointed by cv_($page)
	?>

  </div><!-- end #mainContent -->
 </div>
  
</body>
</html>
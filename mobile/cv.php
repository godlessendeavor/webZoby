<?php
	session_start();
	if (!isset($_GET["idioma"])){$_GET["idioma"] = "en";}
	if (!isset($_GET["page"])){$_GET["page"] = "cv_start";}
	// Ahora incluimos la plantilla de idioma correspondiente al idioma que toque:
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include($dr.'/languages/texts_'.$_GET["idioma"].'.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $home_title;?></title>
<meta name="Keywords" content="thrash F1" http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="css/cvstyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>

<body class="main">

<div id="container">
  <div id="menu">
    <h3>Menu</h3>

    <table class="Menu">
    <tr><td><a href="cv.php?page=cv_start<?php echo '&idioma='.$_GET['idioma']?>"><?php echo $cv_start_link;?> </a></td></tr>
    <tr><td><a href="cv.php?page=cv_profile<?php echo '&idioma='.$_GET['idioma']?>"><?php echo $cv_profile_link;?></a></td></tr>
    <tr><td><a href="cv.php?page=cv_contact<?php echo '&idioma='.$_GET['idioma']?>"><?php echo $cv_contact_link;?></a></td></tr>
    <tr><td><a href="homepage.php<?php echo '?idioma='.$_GET['idioma']?>"><?php echo $cv_home_link;?></a></td></tr>
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
  <!-- end #mainContent --></div>
	<br class="clearfloat" />
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
<!-- end #container --></div>

</body>
</html>
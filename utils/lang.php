<?php
	//detect if the language is passed by URL and puts it into SESSION
    if ( isset($_GET['idioma']) ) {
	    $_SESSION['idioma'] = $_GET['idioma'];
	}else if ( isset($_SESSION['idioma']) ) {
        $lang = $_SESSION['idioma'];
    }else{
		$_SESSION['idioma'] = 'en';
	}
?>
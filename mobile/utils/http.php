<?php

/**
 * @author thrasher
 * @copyright 2009
 */

function redirect($url) {
	
	if (!headers_sent()) {
		header('Location: http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $url);
	} else {
		die('No se pudo redireccionar. Cabeceras ya enviadas.');
		}
}
?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37
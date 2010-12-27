<?php
function error($numero,$texto){
	$ddf = fopen('logs/errors.log','a');
	fwrite($ddf,"[".date("r")."] Error $numero: $texto \r\n");
	fclose($ddf);
}
set_error_handler('error');
?>  [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37
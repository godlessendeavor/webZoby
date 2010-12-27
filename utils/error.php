<?php
function error($numero,$texto){
	$ddf = fopen('logs/errors.log','a');
	fwrite($ddf,"[".date("r")."] Error $numero: $texto \r\n");
	fclose($ddf);
}
set_error_handler('error');
?>
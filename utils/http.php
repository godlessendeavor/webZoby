<?php

/**
 * @author thrasher
 * @copyright 2009
 */

function redirect($url) {
	
	if (!headers_sent()) {
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $url);
	} else {
		die('No se pudo redireccionar. Cabeceras ya enviadas.');
		}
}

function setLastModified($last_modified=NULL)
{
    $page_modified=getlastmod();
    
    if(empty($last_modified) || ($last_modified < $page_modified))
    {
        $last_modified=$page_modified;
    }
    $header_modified=filemtime(__FILE__);
    if($header_modified > $last_modified)
    {
        $last_modified=$header_modified;
    }
    header('Last-Modified: ' . date("r",$last_modified));
    return $last_modified;
}

function ifNotModifiedSince($last_modified)
{
    if(array_key_exists("HTTP_IF_MODIFIED_SINCE",$_SERVER))
    {
        $if_modified_since=strtotime(preg_replace('/;.*$/','',$_SERVER["HTTP_IF_MODIFIED_SINCE"]));
        if($if_modified_since >= $last_modified)
        {
            header("HTTP/1.0 304 Not Modified");
        }
    }
}


?>
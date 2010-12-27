<?php
	$dr=$_SERVER['DOCUMENT_ROOT'];
    include($dr."/utils/error.php");
	//CONNECT TO DATABASE
	function dbConnect($database){
		if(!($link=mysql_connect(HOST,USR,PSWD))){
			error("own","Error conectando a la base de datos");
			die("Error conectando a la base de datos.");
		}
		if (!mysql_select_db($database,$link)){
			error("own","Error seleccionando la base de datos");
			die("Error seleccionando la base de datos.");
		} 
		return $link;
	}
	
	//FUNCTION THAT RETURNS THE NUMBER OF ITEMS IN A DATABASE
    function countItems($link,$table){
		$result=mysql_query("select count(*) from ".$table,$link) or die(mysql_error());
		$itemCount = mysql_fetch_array($result);	
		mysql_free_result($result);
		return $itemCount[0];	
	}	
	
	//CLOSING DATABASE
	function closeDB($link){
		mysql_close($link);
	}
	
	function codeChars($strIn){
	    $strOut=htmlentities($strIn);
		//$strOut=htmlentities($strIn,ENT_QUOTES,"UTF-8");
		$strOut=str_ireplace("\n","<br>",$strOut);
		$strIn=str_ireplace("\r","",$strOut);
		return($strOut);	
	}
	function decodeChars($strIn){
		//$strIn = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $strIn);
    	//$strIn = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $strIn);
    	// replace literal entities
    	//$trans_tbl = get_html_translation_table(HTML_ENTITIES);
    	//$trans_tbl = array_flip($trans_tbl);
        //$strOut= strtr($string, $trans_tbl);
		//$strOut=html_entity_decode($strIn);
		$strOut=html_entity_decode($strIn,ENT_QUOTES,"UTF-8");
		$strOut=str_ireplace("<br>","\n",$strOut);
		return($strOut);
	}
?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37
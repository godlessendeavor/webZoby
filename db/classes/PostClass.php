<?php

/**
 * @author thrasher
 * @copyright 2009
 */

class Post{
	var $id;
	var $title;
	var $style;
	var $topic;
	var $special;
	var $date;
	var $file;
	var $text;
	
	function setPost($array){
		$this->id=$array["id"];
		$this->title=$array["title"];
		$this->style=$array["style"];
		$this->topic=$array["topic"];
		$this->special=$array["special"];
		$this->date=$array["date"];
		$this->file=$array["file"];
		$this->text=$array["text"];
	}
	function codeChars($coding){
		$this->title=htmlentities($this->title,ENT_NOQUOTES, $coding);
		$this->title=str_ireplace("\n","<br>",$this->title);
		$this->title=str_ireplace("\r","",$this->title);
		$this->style=htmlentities($this->style,ENT_NOQUOTES, $coding);
		$this->style=str_ireplace("\n","<br>",$this->style);
		$this->style=str_ireplace("\r","",$this->style);
		$this->topic=htmlentities($this->topic,ENT_NOQUOTES, $coding);
		$this->topic=str_ireplace("\n","<br>",$this->topic);
		$this->topic=str_ireplace("\r","",$this->topic);
		$this->special=htmlentities($this->special,ENT_NOQUOTES, $coding);
		$this->special=str_ireplace("\n","<br>",$this->special);
		$this->special=str_ireplace("\r","",$this->special);
		$this->file=htmlentities($this->file,ENT_NOQUOTES, $coding);		
		$this->file=str_ireplace("\n","<br>",$this->file);
		$this->file=str_ireplace("\r","",$this->file);
		$this->text=htmlentities($this->text,ENT_NOQUOTES, $coding);
		$this->text=str_ireplace("\n","<br>",$this->text);
		$this->text=str_ireplace("\r","",$this->text);
	}
	function decodeChars($coding){
		$this->text=str_ireplace('\"','"',$this->text);
		$this->title=str_ireplace('\"','"',$this->title);
		$this->style=str_ireplace('\"','"',$this->style);
		$this->topic=str_ireplace('\"','"',$this->topic);
		$this->special=str_ireplace('\"','"',$this->special);
		$this->file=str_ireplace('\"','"',$this->file);
		$this->title=html_entity_decode($this->title,ENT_NOQUOTES,$coding);
		$this->style=html_entity_decode($this->style,ENT_NOQUOTES,$coding);
		$this->topic=html_entity_decode($this->topic,ENT_NOQUOTES,$coding);
		$this->special=html_entity_decode($this->special,ENT_NOQUOTES,$coding);
		//$this->date=html_entity_decode($this->date,ENT_QUOTES,$coding);
		$this->file=html_entity_decode($this->file,ENT_NOQUOTES,$coding);
		$this->text=html_entity_decode($this->text,ENT_NOQUOTES,$coding);
	}
	function decodeHTML($coding){
		$this->decodeChars($coding);
		$this->title=str_ireplace("<br>","\n",$this->title);
		$this->style=str_ireplace("\n","<br>",$this->style);
		$this->topic=str_ireplace("\n","<br>",$this->topic);
		$this->special=str_ireplace("\n","<br>",$this->special);
		$this->file=str_ireplace("\n","<br>",$this->file);
		$this->text=str_ireplace("\n","<br>",$this->text);
		$this->text=str_ireplace("\r","",$this->text);
	}
	
}


?>
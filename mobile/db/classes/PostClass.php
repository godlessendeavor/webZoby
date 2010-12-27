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
}

?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37
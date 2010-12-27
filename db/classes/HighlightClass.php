<?php

/**
 * @author thrasher
 * @copyright 2009
 */

class Highlight{
    var $id;
	var $name;
	var $url;
	var $comment;
	var $type;
	var $date;

	
	function setHighlight($array){
        $this->id=$array["id"];
		$this->name=$array["name"];
		$this->url=$array["url"];
		$this->comment=$array["comment"];
		$this->type=$array["type"];
		$this->date=$array["date"];
	}
}

?>
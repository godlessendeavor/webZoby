<?php

/**
 * @author thrasher
 * @copyright 2009
 */

class Doc{
	var $id;
	var $title;
	var $loc;
	var $theme;
	var $comments;
	
	
	function setDoc($array){
		$this->id=$array["id"];
		$this->title=$array["title"];
		$this->loc=$array["loc"];
		$this->theme=$array["theme"];
		$this->comments=$array["comments"];
	}
	
	function setDocWithoutNames($array){
		$this->id=$array[0];
		$this->title=$array[1];
		$this->loc=$array[2];
		$this->theme=$array[3];
		$this->comments=$array[4];		
	}
}

?>
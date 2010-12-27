<?php

/**
 * @author thrasher
 * @copyright 2009
 */

class Music{
	var $id;
	var $group;
	var $title;
	var $style;
	var $year;
	var $loc;
	var $copy;
	var $type;
	var $mark;
	var $review;
	
	
	function setMusic($array){
		$this->id=$array["Id"];
		$this->group=$array["groupName"];
		$this->title=$array["title"];
		$this->style=$array["style"];
		$this->year=$array["year"];
		$this->loc=$array["loc"];
		$this->copy=$array["copy"];
		$this->type=$array["type"];
		$this->mark=$array["mark"];
		$this->review=$array["review"];
	}
	function setMusicWithoutNames($array){
		$this->id=$array[0];
		$this->group=$array[1];
		$this->title=$array[2];
		$this->style=$array[3];
		$this->year=$array[4];
		$this->loc=$array[5];
		$this->copy=$array[6];
		$this->type=$array[7];
		$this->mark=$array[8];
		$this->review=$array[9];
	}
}

?>
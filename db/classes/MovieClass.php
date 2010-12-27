<?php

/**
 * @author thrasher
 * @copyright 2009
 */

class Movie{
	var $id;
	var $title;
	var $director;
	var $year;
	var $loc;
	var $other;
	
	
	function setMovie($array){
		$this->id=$array["Id"];
		$this->title=$array["title"];
		$this->director=$array["director"];
		$this->year=$array["year"];
		$this->loc=$array["loc"];
		$this->other=$array["other"];
	}
	
	function setMovieWithoutNames($array){
		$this->id=$array[0];
		$this->title=$array[1];
		$this->director=$array[2];
		$this->year=$array[3];
		$this->other=$array[4];
		$this->loc=$array[5];
		
	}
}

?>
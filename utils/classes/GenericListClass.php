<?php

/**
 * @author thrasher
 * @copyright 2009
 */
class GenericList {
	public $list;
	public $cant;
	
	function __construct(){
		$this->cant=0;
	}
	
	function addItem ($item) {
		$this->cant++;
		$this->list[$this->cant] = $item;
	}
	
	function removeItem ($pos) {
		if ($this->list[$pos] < $this->cant) {
			for($count=$pos;$count<=$this->cant;$count++){
				$this->list[$count]=$this->list[$count+1];
			}
		$this->cant--;
		return true;
		} else {
			return false;
		}
	}
}


?>
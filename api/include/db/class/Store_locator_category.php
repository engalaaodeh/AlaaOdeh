<?php

class Store_locator_category extends MySqlTable
{

var $id;
var $name;
var $marker_icon;

function Store_locator_category() {
	parent::MySqlTable($GLOBALS['db_table_name_category']);
}


function loadIntoArray() {
	$array = array();
	$array["id"] = $this->id;
	$array["name"] = $this->name;
	$array["marker_icon"] = $this->marker_icon;
	return $array;
}


// ##### SET PUBLIC METHODS ##### //

function setId($id) {
	$this->id = $id;
}
function setName($name) {
	$this->name = $name;
}
function setMarker_icon($marker_icon) {
	$this->marker_icon = $marker_icon;
}

} // end of class

?>
<?php
include('include/webzone.php');

$feed = $_GET['feed'];

if($feed=='stores') {
	$page_number = $_GET['page_number'];
	$nb_display = $_GET['nb_display'];
	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	$distance_unit = $_GET['distance_unit'];
	$max_distance = $_GET['max_distance'];
	$category_id = $_GET['category_id'];
	$city = $_GET['city'];
	$q = $_GET['q'];
	
	if($page_number=='') $page_number=1;
	if($nb_display=='') $nb_display=5;
	
	$stores = get_stores_list(array('page_number'=>$page_number, 'nb_display'=>$nb_display, 'lat'=>$lat, 'lng'=>$lng, 
	'distance_unit'=>$distance_unit, 'max_distance'=>$max_distance, 'category_id'=>$category_id, 'city'=>$city, 'q'=>$q));
	
	$nb_stores = get_nb_stores(array('distance_unit'=>$distance_unit, 'max_distance'=>$max_distance, 'lat'=>$lat, 'lng'=>$lng,
	'category_id'=>$category_id, 'city'=>$city, 'q'=>$q));
	
	$display['list'] = $stores;
	$display['nb_stores'] = $nb_stores;
	$display = json_encode($display);
	print_r($display);
}

//get store details
elseif($feed=='store') {
	$id = $_GET['id'];
	$store = get_store($id);
	$display = json_encode($store);
	print_r($display);
}

//get store categories
elseif($feed=='categories') {
	$id = $_GET['id'];
	$categories = get_categories($id);
	$display = json_encode($categories);
	print_r($display);
}

else {
	echo 'This is the correct URL of the Store Locator API !';
}

?>
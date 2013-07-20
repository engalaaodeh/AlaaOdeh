<?php

function display_home() {
	?>
	<ul data-role="listview" data-theme="d" data-inset="true">
		<li data-role="list-divider">Stores</li>
		<li><a href="#" id="displayStoresListBtn">Stores List</a></li>
		<li><a href="#" id="displayMapBtn">Stores Map</a></li>
		<li><a href="#" id="displayCategoriesListBtn">Categories</a></li>
	</ul>
	
	<ul data-role="listview" data-theme="d" data-divider-theme="d" data-inset="true">
		<li data-role="list-divider">Search</li>
		<li><a href="#searchByAddressPage">Search by address</a></li>
	</ul>
	
	<center>
	<h3>More mobile apps</h3>
	<a href="http://yougapi.com/products/mobile/photos_gallery/" rel="external"><img src="./include/graph/mobile-photos-gallery-mini.png" style="margin-right:5px; margin-bottom:10px;" /></a>
	<a href="http://yougapi.com/products/mobile/youtube_mobile/" rel="external"><img src="./include/graph/youtube-mobile-mini.png" style="margin-right:5px; margin-bottom:10px;" /></a>
	<a href="http://yougapi.com/products/mobile/facebook_mobile/" rel="external"><img src="./include/graph/facebook-mobile-mini.png" style="margin-right:5px; margin-bottom:10px;" /></a>
	<a href="http://yougapi.com/products/mobile/twitter_mobile/" rel="external"><img src="./include/graph/twitter-mobile-mini.png" style="margin-right:5px; margin-bottom:10px;" /></a>
	<a href="http://yougapi.com/products/mobile/store_locator/" rel="external"><img src="./include/graph/mobile-store-locator-mini.png" style="margin-right:5px; margin-bottom:10px;" /></a>
	</center>
	
	<br>
	
	<hr>
	<small>Powered by <a href="http://yougapi.com/mobile/" rel="external">Yougapi Mobile</a> - 
	<a href="http://codecanyon.net/item/mobile-store-locator/239351?ref=yougapi">Download this app</a></small>
	<?php
}

function display_categories_list($categories_list) {
	
	$display .= '<ul data-role="listview" data-theme="d">';
	$display .= '<li data-role="list-divider">Categories</li>';
	for($i=0; $i<count($categories_list); $i++) {
		$display .= '<li><a href="javascript:" class="displayStoresListByCategoryBtn" id="'.$categories_list[$i]['id'].'">';
		if($categories_list[$i]['marker_icon']!='') $display .= '<img src="'.$categories_list[$i]['marker_icon'].'" class="ui-li-icon">';
		$display .= $categories_list[$i]['name'];
		$display .= '<span class="ui-li-count"><font color="red"><small>'.$categories_list[$i]['nb'].'</small></font></span>';
		$display .= '</a></li>';
	}
	$display .= '</ul>';
	
	return $display;
}

function display_store_details($store) {
	if($store[0]['name']!='') $display .= '<h2 style="padding-top:0px; margin-top:0px;">'.$store[0]['name'].'</h2>';
	if($store[0]['logo']!='') $display .= '<p><img src="'.$store[0]['logo'].'"></p>';
	if($store[0]['address']!='') $display .= '<p>'.$store[0]['address'].'</p>';
	
	if($store[0]['open_time']!='' && $store[0]['close_time']!='') {
		$display .= "It's ".date('H:i', time());
		if(date('H', time())>$store[0]['open_time'] && date('H', time())<$store[0]['close_time']) $display .= ' <b>Open</b>';
		else $display .= ' <b>Closed</b>';
	}
	
	if($store[0]['url']!='') $display .= '<p>Url: <a href="'.$store[0]['url'].'" target="_blank">'.$store[0]['url'].'</a></p>';
	if($store[0]['tel']!='') $display .= '<p>Tel: <a href="tel:'.$store[0]['tel'].'">'.$store[0]['tel'].'</a></p>';
	if($store[0]['email']!='') $display .= '<p>Email: <a href="mailto:'.$store[0]['email'].'">'.$store[0]['email'].'</a></p>';
	if($store[0]['description']!='') $display .= '<p>'.$store[0]['description'].'</p>';
	return $display;
}

function getStoresDisplay($data, $page_number, $nb_display) {
	$nb_stores = $data['nb_stores'];
	$list = $data['list'];
		
	$display .= '<ul data-role="listview" data-theme="d">';
	$display .= '<li data-role="list-divider" data-theme="a"><span id="current_address"></span><span class="ui-li-count">'.$nb_stores.'</span></li>';
	for($i=0; $i<count($list); $i++) {
		$id = $list[$i]['id'];
		$name = $list[$i]['name'];
		$logo = $list[$i]['logo'];
		$address = $list[$i]['address'];
		$distance = $list[$i]['distance'];
		$created = $list[$i]['created'];
		$open_time = $list[$i]['open_time'];
		$close_time = $list[$i]['close_time'];
		
		$display .= '<li><a href="javascript:" class="displayStoreDetails" id="'.$id.'">';
		if($logo!='') $display .= '<img src="'.$logo.'" style="margin-top:18px;">';
		$display .= '<h3>'.$name;
		$display .= '</h3>';
		
		$display .= '<p>'.$address.'</p>';
		$display .= '<p><font color="red"><small>'.ceil($distance).' '.$GLOBALS['distance_unit'].'</small></font></p>';
		$display .= '</a></li>';
	}
	$display .= '</ul><br>';
	
	$display .= '<div data-role="controlgroup" data-type="horizontal" data-theme="a" style="text-align:right;" >';
		
		if($GLOBALS['pro_version']==1) $display .= '<a id="displayOnMapBtn" href="javascript:" data-role="button">'.$GLOBALS['lang']['display_on_map'].'</a> ';
		
		if($page_number>1) $display .= '<a href="javascript:" id="displayStoresListNextPreviousBtn" page_number="'.($page_number-1).'" data-role="button" data-icon="arrow-l" data-theme="d">'.$GLOBALS['lang']['pagination_previous'].'</a>';
		$display .= '<a href="javascript:" data-role="button" data-theme="d"><span id="pageNumberReload">'.$page_number.'</span></a>';
		if($nb_stores>($page_number*$nb_display)) $display .= '<a href="javascript:" id="displayStoresListNextPreviousBtn" page_number="'.($page_number+1).'" data-role="button" data-icon="arrow-r" data-theme="d">'.$GLOBALS['lang']['pagination_next'].'</a>';
	
	$display .= '</div>';
	
	return $display;
}

?>
<?php
include('../api/include/webzone.php');

$id = $_GET['id'];

$s1 = new Store_locator();
$store = $s1->loadByFields('id',$id);

if($store[0]['lat']!=''&&$store[0]['lng']!='') $jsOnReady = "load_thumbnail_map('".$store[0]['lat']."', '".$store[0]['lng']."')";

$t1 = new Template_class_admin();
$t1->setPageName('Edit a store');
$t1->setMetaTags(array('title'=>'', 'description'=>''));
$t1->addJsOnReady($jsOnReady);
$t1->displayHeader();

$c1 = new Store_locator_category();
$list = $c1->selectAll(array('order'=>'id DESC'));
for($i=0; $i<count($list); $i++) {
	$list_tab[$list[$i]['id']] = $list[$i]['name'];
}

echo '<div id="geocode_section" style="display:none;">';
echo '<form>';
echo 'Please type your full address: <input type="text" id="location2geocode" style="width:360px;">
<br><br><input id="geocode_address_btn" type="submit" value="Geocode and continue">';
echo '</form>';
echo '</div>';

echo '<div id="address_thumbnail" style="margin-bottom:10px;"></div>';

echo '<div id="form_section">';

//form
$criteria['fields'][] = array('name'=>'category_id', 'title'=>'Category:', 'type'=>'select', 'select_values'=>$list_tab, 'value'=>$store[0]['category_id']);
$criteria['fields'][] = array('name'=>'name', 'title'=>'Name:', 'value'=>$store[0]['name']);
$criteria['fields'][] = array('name'=>'address', 'title'=>'Address:', 'value'=>$store[0]['address']);
$criteria['fields'][] = array('name'=>'logo', 'title'=>'Logo url:', 'value'=>$store[0]['logo']);
$criteria['fields'][] = array('name'=>'url', 'title'=>'Website url:', 'value'=>$store[0]['url']);
if($GLOBALS['pro_version']==1) $criteria['fields'][] = array('name'=>'marker_icon', 'title'=>'Marker icon url:', 'value'=>$store[0]['marker_icon']);
$criteria['fields'][] = array('name'=>'description', 'title'=>'Description:', 'type'=>'textarea', 'rows'=>'5', 'value'=>$store[0]['description']);
$criteria['fields'][] = array('name'=>'tel', 'title'=>'Tel:', 'value'=>$store[0]['tel']);
$criteria['fields'][] = array('name'=>'email', 'title'=>'Email:', 'value'=>$store[0]['email']);
$criteria['fields'][] = array('name'=>'open_time', 'title'=>'Open time:', 'value'=>$store[0]['open_time']);
$criteria['fields'][] = array('name'=>'close_time', 'title'=>'Close time:', 'value'=>$store[0]['close_time']);
$criteria['fields'][] = array('name'=>'city', 'title'=>'City:', 'value'=>$store[0]['city']);
$criteria['fields'][] = array('name'=>'country', 'title'=>'Country:', 'value'=>$store[0]['country']);
$criteria['fields'][] = array('name'=>'lat', 'value'=>$store[0]['lat']);
$criteria['fields'][] = array('name'=>'lng', 'value'=>$store[0]['lng']);
$criteria['submit'] = array('name'=>'edit', 'value'=>'Edit store');

echo '<div>';

if($_POST[$criteria['submit']['name']]) {
	
	$values = get_post_values($criteria['fields'], $_POST);
	
	$s1 = new Store_locator();
	
	$criteria = array('category_id'=>$values['category_id'], 'name'=>$values['name'], 'address'=>$values['address'], 'logo'=>$values['logo'], 'marker_icon'=>$values['marker_icon'], 'url'=>$values['url'],
	'description'=>$values['description'],'tel'=>$values['tel'],'email'=>$values['email'],
	'open_time'=>$values['open_time'], 'close_time'=>$values['close_time'],
	'city'=>$values['city'],'country'=>$values['country'],
	'lat'=>$values['lat'],'lng'=>$values['lng']);
	$s1->updateByFields($criteria, $id);
	
	echo '<script>';
	echo 'window.location="./list.php";';
	echo '</script>';
}

else {
	echo '<div style="width:600px;">';
	display_forms($criteria);
	echo '</div>';
}

$t1->displayFooter();
?>
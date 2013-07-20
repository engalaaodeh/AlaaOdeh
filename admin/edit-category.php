<?php
include('../api/include/webzone.php');

$id = $_GET['id'];

$c1 = new Store_locator_category();
$category = $c1->loadByFields('id',$id);

$t1 = new Template_class_admin();
$t1->setPageName('Edit a category');
$t1->setMetaTags(array('title'=>'', 'description'=>''));
$t1->addJsOnReady($jsOnReady);
$t1->displayHeader();


echo '<div id="form_section">';

//form
$criteria['fields'][] = array('name'=>'name', 'title'=>'Name:', 'value'=>$category[0]['name']);
if($GLOBALS['pro_version']==1) $criteria['fields'][] = array('name'=>'marker_icon', 'title'=>'Marker icon:', 'value'=>$category[0]['marker_icon']);
$criteria['fields'][] = array('name'=>'category_id', 'type'=>'hidden', 'value'=>$id);
$criteria['submit'] = array('name'=>'edit', 'value'=>'Edit store');

echo '<div>';

if($_POST[$criteria['submit']['name']]) {
	
	$values = get_post_values($criteria['fields'], $_POST);
	
	$criteria = array('name'=>$values['name'], 'marker_icon'=>$values['marker_icon']);
	$c1->updateByFields($criteria, $id);
	
	echo '<script>';
	echo 'window.location="./categories.php";';
	echo '</script>';
	
}

else {
	echo '<div style="width:600px;">';
	display_forms($criteria);
	echo '</div>';
}

$t1->displayFooter();
?>
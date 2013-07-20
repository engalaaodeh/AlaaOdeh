<?php
$criteria = stripslashes($_POST['criteria']);
$criteria = json_decode($criteria, true);

$feed = $criteria['feed'];
$page_number = $criteria['page_number'];
$nb_display = $criteria['nb_display'];
$address = $criteria['address'];
$lat = $criteria['lat'];
$lng = $criteria['lng'];
$category_id = $criteria['category_id'];
$city = $criteria['city'];
$q = $criteria['q'];

//API call
$apiCriteria['feed'] = $feed;
$apiCriteria['page_number'] = $page_number;
$apiCriteria['nb_display'] = $nb_display;
$apiCriteria['address'] = urlencode($address);
$apiCriteria['lat'] = $lat;
$apiCriteria['lng'] = $lng;
$apiCriteria['distance_unit'] = $GLOBALS['distance_unit'];
$apiCriteria['category_id'] = $category_id;
$apiCriteria['city'] = $city;
$apiCriteria['q'] = $q;
$url = getAPICallUrl($apiCriteria);

//Get data from API
$data = getDataFromUrl($url);
$data2 = json_decode($data, true);

$stores = getStoresDisplay($data2, $page_number, $nb_display);

$display['display'] = $stores;

$display = json_encode($display);
echo $display;
?>

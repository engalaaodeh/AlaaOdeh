<?php
$criteria = stripslashes($_POST['criteria']);
$criteria = json_decode($criteria, true);

$feed = $criteria['feed'];
$id = $criteria['id'];

//API call
$apiCriteria['feed'] = $feed;
$apiCriteria['id'] = $id;
$url = getAPICallUrl($apiCriteria);

//Get data from API
$data = getDataFromUrl($url);
$data = json_decode($data, true);

$store = display_store_details($data);

$display['display'] = $store;
$display['lat'] = $data[0]['lat'];
$display['lng'] = $data[0]['lng'];
$display['marker_content'] = '<div class="map_infowindow">'.$data[0]['name'].'<br>'.$data[0]['address'].'</div>';

$display = json_encode($display);
echo $display;
?>

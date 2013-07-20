<?php
//get the categories list from the API
$url = getAPICallUrl(array('feed'=>'categories'));
$data = getDataFromUrl($url);
$categories_list = json_decode($data, true);

$display = display_categories_list($categories_list);

echo $display;

?>
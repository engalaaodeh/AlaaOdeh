<?php
include_once('include/webzone.php');

if(@$_GET['p']=='displayHome') include('views/ajax_display_home.php');
elseif(@$_GET['p']=='displayStoresList') include('views/ajax_display_stores_list.php');
elseif(@$_GET['p']=='displayCategoriesList') include('views/ajax_display_categories_list.php');
elseif(@$_GET['p']=='displayStoresMap') include('views/ajax_display_stores_map.php');
elseif(@$_GET['p']=='displayStoreDetails') include('views/ajax_display_store_details.php');
elseif(@$_GET['p']=='displayStoreListMap') include('views/ajax_display_stores_list_map.php');
else echo 'Silence is golden.';

?>
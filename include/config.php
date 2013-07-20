<?php
/*
App settings
*/

//App URL (no slash at the end). Ex: http://yougapi.com/products/mobile/store_locator
$GLOBALS['app_url'] = 'http://localhost/store_locator';

// API full link
$GLOBALS['api_url'] = $GLOBALS['app_url'].'/api/';

//Number of stores to display per page in the list results
$GLOBALS['nb_display'] = '5';

//Number of stores to display on the Map by default
$GLOBALS['nb_display_map'] = '5';

//distance unit possible values: miles, km
$GLOBALS['distance_unit'] = 'km';

//custom icon to use as a marker - Leave empty to use the default Google Maps icon
$GLOBALS['marker_icon'] = '';

//custom marker for the current position
$GLOBALS['marker_icon_current'] = 'include/graph/icons/marker-current.png';

//Create your own theme on: http://jquerymobile.com/themeroller/ using swatches from A to E
//Place your theme folder and reference its CSS file here bellow
//Example: include/css/themes/candy/jquery.mobile-1.3.1.css
//$GLOBALS['custom_theme_css'] = 'include/css/themes/water/jquery.mobile-1.3.1.css';

/*
Optional parameters
*/
$GLOBALS['google_analytics'] = '';

//languages
$GLOBALS['lang']['map_api_lang'] = 'en'; //possible values: en, fr, es, etc... (en by default) - Used for directions
$GLOBALS['lang']['back_btn_label'] = 'Back';
$GLOBALS['lang']['pagination_next'] = 'Next';
$GLOBALS['lang']['pagination_previous'] = 'Previous';
$GLOBALS['lang']['display_on_map'] = 'Display on Map';
$GLOBALS['lang']['map'] = 'Map';
$GLOBALS['lang']['streetview'] = 'Streetview';

$GLOBALS['pro_version'] = 1;

?>
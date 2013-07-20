<?php

function getAPICallUrl($criteria) {
	$url = $GLOBALS['api_url'].'?key='.$GLOBALS['api_key'];
	foreach ($criteria as $i => $v) {
		$url .= '&'.$i.'='.$v;
	}
	return $url;
}

?>
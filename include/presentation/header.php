<!DOCTYPE html> 
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no; target-densityDpi=device-dpi"/>
	-->
	<title>Mobile Store Locator</title>
	
	<?php
	if($GLOBALS['custom_theme_css']!='') {
		?>
		<link rel="stylesheet" href="<?php echo $GLOBALS['custom_theme_css']; ?>" />
		<link rel="stylesheet" href="include/css/jquery.mobile.structure-1.3.1.min.css" />
		<?php
	}
	else {
		?>
		<link rel="stylesheet" href="include/css/jquery.mobile-1.3.1.min.css" />
		<?php
	}
	?>
	
	<link rel="stylesheet" href="include/css/style.css" />
	
	<script type='text/javascript'> 
	/* <![CDATA[ */
	var App = {
		ajaxurl: "<?php echo $GLOBALS['app_url']; ?>", nb_display: <?php echo $GLOBALS['nb_display']; ?>, 
		nb_display_map: <?php echo $GLOBALS['nb_display_map']; ?>,
		marker_icon: "<?php echo $GLOBALS['marker_icon']; ?>", 
		marker_icon_current: "<?php echo $GLOBALS['marker_icon_current']; ?>"
	};
	/* ]]> */
	</script>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="include/js/script.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=true&language=<?php echo $GLOBALS['lang']['map_api_lang']; ?>"></script>
	<script src="include/js/map.js"></script>
	<script src="include/js/jquery.mobile-1.3.1.min.js"></script>
	
	<script>
	$(document).ready(function() {
		<?php echo $js_on_ready; ?>
		$.mobile.page.prototype.options.backBtnText = '<?php echo $GLOBALS['lang']['back_btn_label']; ?>';
	});
	</script>
	
	<?php
	if($GLOBALS['google_analytics']!='') {
	?>
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '<?php echo $GLOBALS['google_analytics']; ?>']);
	  _gaq.push(['_trackPageview']);
	 
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	<?php
	}
	?>
	
</head>

<body>
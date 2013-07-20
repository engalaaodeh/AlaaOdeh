
<div data-role="header" data-theme="d">

	<div style="padding:5px; margin-bottom:10px;">
		
		<div style="text-align:center;">
		<img src="include/graph/icons/map.png" style="vertical-align:middle; margin-right:5px;"> Locator <small>v2.2</small>
		</div>
		
		<div style="position:absolute;right:10px;top:0em;">
		<a href="<?php echo $GLOBALS['app_url']; ?>" rel="external" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
		</div>
		
	</div>
	
	<?php
	
	if($storeDetailPageFlag==1) {
		echo '<div data-role="navbar">';
			echo '<ul>';
				echo '<li><a href="javascript:" id="displayMapDetailBtn">'.$GLOBALS['lang']['map'].'</a></li>';
				echo '<li><a href="javascript:" id="displayStreetviewBtn">'.$GLOBALS['lang']['streetview'].'</a></li>';
			echo '</ul>';
		echo '</div>';	
	}
	
	?>
	
</div>


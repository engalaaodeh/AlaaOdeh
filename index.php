<?php
include('include/webzone.php');

$js_on_ready = "detectLocation(); displayHome();";

include('include/presentation/header.php');
?>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="homePage">
	
	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content">
		<div id="homeContent"></div>
	</div>
	
</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="listPage">
	
	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content">
		<div id="listContent"></div>
	</div>
	
</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="categoriesPage">
	
	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content">
		<div id="categoriesContent"></div>
	</div>
	
</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="mapPage" style="width:100%; height:100%;">

	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content" style="width:100%; height:100%; padding:0;">
		
		<div style="position:absolute; width:100%; height:95%;">
			<div id="map_mobile" style="width:100%; height: 100%;"></div>
		</div>
		
	</div>
	
</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="mapDetailPage" style="width:100%; height:100%;">

	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content" style="width:100%; height:100%; padding:0;">
		<div style="position:absolute; width:100%; height:100%;">
			<?php
			if($GLOBALS['pro_version']==1) {
			?>
				<div style="padding:10px;"><span id="store_map_current_address"></span> <span id="get_directions_link"><a href="javascript:" id="display_directions_btn">Get directions</a></span></div>
				<div id="directions_panel" style="display:none; padding:10px;"></div>
			<?php
			}
			?>
			<div id="map_mobile_detail" style="width:100%; height:100%; padding:0;"></div>
		</div>
	</div>

</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="streetviewPage" style="width:100%; height:100%;">

	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content" style="width:100%; height:100%; padding:0;">
		<div style="position:absolute; width:100%; height:100%;">
			<div id="streetview" style="width:100%; height:100%; padding:0;"></div>
		</div>
	</div>

</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="storeDetailPage">
	
	<?php
	$storeDetailPageFlag=1;
	include('include/presentation/header_mobile.php');
	$storeDetailPageFlag=0;
	?>
	
	<div data-role="content">
		
		<div id="storeDetailContent"></div>
		
	</div>

</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="searchByAddressPage">

	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content">
		
		<div data-role="fieldcontain">
			<form>
			    <center><h2>Search by address</h2></center>
			    <input type="search" name="address" id="address" value="" />
				<p><input type="submit" id="searchStoresByAddressBtn" data-role="button" data-theme="a" value="Search"></p>
			</form>
		</div>
		
	</div>

</div>

<div data-role="page" data-add-back-btn="true" data-theme="b" id="searchByNamePage">

	<?php
	include('include/presentation/header_mobile.php');
	?>
	
	<div data-role="content">
		
		<div data-role="fieldcontain">
			<form>
			    <center><h2>Search by name</h2></center>
			    <input type="search" name="q" id="q" value="" />
				<p><input type="submit" id="searchStoresByNameBtn" data-role="button" data-theme="a" value="Search"></p>
			</form>
		</div>
		
	</div>

</div>

<?php
include('include/presentation/footer.php');
?>
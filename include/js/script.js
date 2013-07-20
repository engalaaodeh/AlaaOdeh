var loading_img = '<img src="./include/graph/icons/ajax-loader.gif">';

function displayHome() {
	$('#homeContent').html(loading_img);
	$.ajax({
	  type: 'POST',
	  url: 'process.php?p=displayHome',
	  success: function(msg){
	  	$('#homeContent').html(msg).trigger('create');
	  }
	});
}

$(document).on('click', '#displayStoresListBtn', function(event) {
	event.preventDefault();
	$.mobile.changePage("#listPage");
	var page_number=1;
	displayStoresList({"feed":"stores", "page_number":page_number, "nb_display":App.nb_display, "lat":App.lat, "lng":App.lng});
});

$(document).on('click', '#displayCategoriesListBtn', function(event) {
	event.preventDefault();
	$.mobile.changePage("#categoriesPage");
	displayCategoriesList();
});

$(document).on('click', '.displayStoresListByCategoryBtn', function(event) {
	event.preventDefault();
	var category_id = $(this).attr('id');
	$.mobile.changePage("#listPage");
	page_number=1;
	$('#listContent').html('');
	var criteria = {"feed":"stores", "page_number":page_number, "nb_display":App.nb_display, "lat":App.lat, "lng":App.lng, "category_id":category_id};
	jQuery('body').data('stores_list_criteria', criteria);
	displayStoresList(criteria);
});

$(document).on('click', '#displayStoresListNextPreviousBtn', function(event) {
	event.preventDefault();
	$('#pageNumberReload').html(loading_img);
	var criteria = jQuery('body').data('stores_list_criteria');
	criteria.page_number = $(this).attr('page_number');
	jQuery('body').data('stores_list_criteria', criteria);
	displayStoresList(criteria);
});

function strpos(haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}

$(document).on('click', '#searchStoresByAddressBtn', function(event) {
	event.preventDefault();
	var address = $('#address').val();
	
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode( {'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
	  	var latLng = String(results[0].geometry.location);
	  	latLng = latLng.substr(1);
	  	var pos = strpos(latLng, ',');
	  	lat = latLng.substr(0,pos);
	  	var pos2 = strpos(latLng, ')');
	  	latLng = latLng.substr(0,pos2);
	  	lng = latLng.substr((pos+2));
	  	
		var page_number=1;
		$.mobile.changePage("#listPage");
		$('#listContent').html('');
		App.search_flag = 1;
		displayStoresList({"feed":"stores", "page_number":page_number, "nb_display":App.nb_display, "lat":lat, "lng":lng, "address":address});
	  }
	});
});

$(document).on('click', '#searchStoresByNameBtn', function(event) {
	event.preventDefault();
	var q = $('#q').val();
	var page_number=1;
	$.mobile.changePage("#listPage");
	$('#listContent').html('');
	var criteria = {"feed":"stores", "page_number":page_number, "nb_display":App.nb_display, "lat":App.lat, "lng":App.lng, "q":q};
	jQuery('body').data('stores_list_criteria', criteria);
	displayStoresList(criteria);
});

$(document).on('click', '.displayStoreDetails', function(event) {
	event.preventDefault();
	var id = $(this).attr('id');
	$.mobile.changePage("#storeDetailPage");
	displayStoreDetails({"feed":"store", "id":id});
});

function displayStoreDetails(criteria) {
	$('#storeDetailContent').html(loading_img);
	$.ajax({
	  type: 'POST',
	  url: 'process.php?p=displayStoreDetails',
	  dataType: 'json',
	  data: 'criteria=' + JSON.stringify(criteria),
	  success: function(msg){
	  	$('#storeDetailContent').html(msg.display);
	  	$('#storeDetailPage').trigger('create');
	  	//save store data
	  	App.store_lat = msg.lat;
	  	App.store_lng = msg.lng;
	  	App.marker_content = msg.marker_content;
	  }
	});
}

function displayStoresList(criteria) {
	if($('#listContent').html()=='') $('#listContent').html(loading_img);
	jQuery('body').data('stores_list_criteria', criteria);
	$.ajax({
	  type: 'POST',
	  url: 'process.php?p=displayStoresList',
	  dataType: 'json',
	  data: 'criteria=' + JSON.stringify(criteria),
	  success: function(msg){
	  	$('#listContent').html(msg.display);
	  	
	  	if(App.search_flag==1) {
		  	App.search_flag='';
		  	$('#current_address').html(criteria.address);
	  	}
	  	else {
		  	$('#current_address').html(App.current_address);
	  	}
	  	
	  	$('#listPage').trigger('create');
	  }
	});
}

function displayCategoriesList() {
	if($('#categoriesContent').html()=='') $('#categoriesContent').html(loading_img);
	$.ajax({
	  type: 'POST',
	  url: './process.php?p=displayCategoriesList',
	  success: function(msg){
	  	$('#categoriesContent').html(msg);
	  	$('#categoriesPage').trigger('create');
	  }
	});
}

$(document).on('click', '#displayOnMapBtn', function(event) {
	event.preventDefault();
	
	$.mobile.changePage("#mapPage");
	$('#map_mobile').html(loading_img);
});

/*
START Maps display
*/

$(document).on('click', '#displayMapBtn', function(event) {
	event.preventDefault();
	var criteria = {"feed":"stores", "page_number":1, "nb_display":App.nb_display_map, "lat":App.lat, "lng":App.lng};
	jQuery('body').data('stores_list_criteria', criteria);
	
	$('#map_mobile').html(loading_img);
	$.mobile.changePage("#mapPage");
});

$(document).on('pageshow', '#mapPage', function (event) {
	Map_param.zoom=5;
	search_locations(jQuery('body').data('stores_list_criteria'));
});

$(document).on('click', '#displayMapDetailBtn', function(event) {
	event.preventDefault();
	$('#map_mobile_detail').css('display','block');
	$('#get_directions_link').css('display','block');
	$('#store_map_current_address').html('Current location: '+App.current_address);
	$('#directions_panel').css('display','none');
	$.mobile.changePage("#mapDetailPage");
	Map_param.zoom=15;
	init_basic_map('map_mobile_detail', App.store_lat, App.store_lng, App.marker_content);
});

$(document).on('click', '#displayStreetviewBtn', function(event) {
	event.preventDefault();
	$.mobile.changePage("#streetviewPage");
	displayStreetView(App.store_lat, App.store_lng, 'streetview');
});
google.maps.visualRefresh = true;
var Map_param = {};
var map;
var markers = [];
var infoWindow;
var panorama;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var markerArray = [];

function detectLocation() {
	if (navigator.geolocation) {
  		navigator.geolocation.getCurrentPosition(detectionSuccess, detectionError, {maximumAge:Infinity});
	}
}

function detectionSuccess(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	App.lat = lat;
	App.lng = lng;
	var latlng = new google.maps.LatLng(lat, lng);
	var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          App.current_address = results[0].formatted_address;
        }
      } else {
        //alert("Geocoder failed due to: " + status);
      }
    });
}

function detectionError(msg) {
	//alert(msg);
}

$(document).on('click', '#display_directions_btn', function(event) {
	event.preventDefault();
	$('#map_mobile_detail').css('display','none');
	$('#get_directions_link').css('display','none');
	$('#directions_panel').css('display','block').html('Loading...');
	calcRoute();
});

function calcRoute() {
	
	//clear out the array
	for (i = 0; i < markerArray.length; i++) {
		markerArray[i].setMap(null);
	}
	
	var start = App.lat+','+App.lng;
	//var start = 'NY';
	var end = App.store_lat+','+App.store_lng;
	
	var request = {
	    origin:start,
	    destination:end,
	    travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
	
	directionsService.route(request, function(response, status) {
	  if (status == google.maps.DirectionsStatus.OK) {
	    directionsDisplay.setDirections(response);
	    showSteps(response, start, end);
	  }
	  else {
	  	$('#directions_panel').html('<br><b>The distance is too far to get directions</b>');
	  }
	});
}

function showSteps(directionResult, start, end) {
	var myRoute = directionResult.routes[0].legs[0];
	var steps='';
	var start_loc='';
	var end_loc='';
	for (var i = 0; i < myRoute.steps.length; i++) {
	  //alert(myRoute.steps[i].start_location + ' --- ' + myRoute.steps[i].end_location);
	  start_loc = myRoute.steps[i].start_location;
	  start_loc = String(start_loc);
	  start_loc = start_loc.substr(1);
	  start_loc = start_loc.replace(')', '');
	  start_loc = start_loc.replace(' ', '');
	  steps += '%7C'+ start_loc;
	  
	  end_loc = myRoute.steps[i].end_location;
	  end_loc = String(end_loc);
	  end_loc = end_loc.substr(1);
	  end_loc = end_loc.replace(')', '');
	  end_loc = end_loc.replace(' ', '');
	  //steps += '%7C'+ end_loc;
	}
	
	var static_map = 'http://maps.googleapis.com/maps/api/staticmap?path=color:0x0000ff%7Cweight:5%7C'+start+steps+'%7C'+end+'&markers=color:green%7Clabel:A%7C'+start+'&markers=color:red%7Clabel:B%7C'+end+'&size=250x250&sensor=false';
	static_map = '<img src="'+static_map+'">';
	$('#directions_panel').html(static_map);
}

function init_basic_map2() {
	map = new google.maps.Map(document.getElementById('map_mobile'), {
		//center: new google.maps.LatLng(App.lat, App.lng),
		zoom: Map_param.zoom,
		scrollwheel: false,
		zoomControl: true,
		panControl: false,
		streetViewControl: false,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		},
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});
	
	infoWindow = new google.maps.InfoWindow();
	
	$('#map_mobile').animate({width:'100%', height:'100%'}, 
	function() { 
		google.maps.event.trigger(map, 'resize');
	});
}

function init_basic_map(dom,lat,lng,marker_text) {
	var latlng = new google.maps.LatLng(
		parseFloat(lat),
		parseFloat(lng)
	);
	
	map = new google.maps.Map(document.getElementById(dom), {
		center: new google.maps.LatLng(lat, lng),
		scrollwheel: false,
		zoomControl: true,
		panControl: false,
		streetViewControl: false,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		},
		zoom: Map_param.zoom,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});
	
    directionsDisplay = new google.maps.DirectionsRenderer({
        'map': map,
        'preserveViewport': true,
        'draggable': true
    });
    directionsDisplay.setPanel(document.getElementById("directions_panel"));
    
	createMarker(latlng, lat, lng, marker_text);
	infoWindow = new google.maps.InfoWindow();
	
	//resize to make the map load correctly the second time...
	$('#'+dom).animate({width:'100%', height:'100%'}, 
	function() { 
		google.maps.event.trigger(map, 'resize');
		map.setCenter(new google.maps.LatLng(lat, lng));
	});
}

function search_locations(criteria) {
	
	jQuery.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'process.php?p=displayStoreListMap',
		data: 'criteria=' + JSON.stringify(criteria),
		success: function(msg) {
			
			init_basic_map2();
			
			var locations = msg.locations;
			var markersContent = msg.markersContent;
			var bounds = new google.maps.LatLngBounds();
			
			clearLocations();
			
			var latlng_current = new google.maps.LatLng(
				parseFloat(App.lat),
				parseFloat(App.lng)
			);
			createMarker(latlng_current, App.lat, App.lng, 'Current location', App.marker_icon_current);
			
			for (var i=0; i<locations.length; i++) {
				var name = locations[i]['name'];
				var address = locations[i]['address'];
				var distance = parseFloat(locations[i]['distance']);
				var marker_icon = locations[i]['marker_icon'];
				var latlng = new google.maps.LatLng(
					parseFloat(locations[i]['lat']),
					parseFloat(locations[i]['lng'])
				);
				createMarker(latlng, locations[i]['lat'], locations[i]['lng'], markersContent[i], marker_icon);
				
				bounds.extend(latlng);
	       	}
	       	
	       	if(locations.length>1) {
	       		map.fitBounds(bounds);
	       	}
	       	else {
				map.setCenter(bounds.getCenter());
				map.setZoom(15);
	       	}
	       	
	       	//alert(123);
		}
	});
	
}

function clearLocations() {
	infoWindow.close();
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(null);
	}
	markers.length = 0;
}

function createMarker(latlng, lat, lng, html, icon) {
	if(icon===undefined||icon=='') {
		var icon = App.marker_icon;
	}
	var marker = new google.maps.Marker({
		map: map,
		position: latlng,
		icon: icon,
	});
	google.maps.event.addListener(marker, 'click', function() {
		infoWindow.setContent(html);
		infoWindow.open(map, marker);
	});
	markers.push(marker);
}

function displayStreetView(lat,lng, dom) {
	var latlng = new google.maps.LatLng(lat,lng);
	
	var panoramaOptions = {
	  position: latlng,
	  panControl: true,
	  linksControl: true,
	  enableCloseButton: true,
	  disableDoubleClickZoom: true,
	  addressControl: false,
	  visible: true,
	  pov: {
	    heading: 270,
	    pitch: 0,
	    zoom: 1
	  }
	};
	
	$('#'+dom).empty();
	
	$('#'+dom).animate({width: '100%', height:'100%'}, 
	function() { 
		panorama = new google.maps.StreetViewPanorama(document.getElementById(dom),panoramaOptions);
	});
}

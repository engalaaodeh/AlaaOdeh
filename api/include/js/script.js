jQuery('#preview_app_btn').live('click', function(event) {
	event.preventDefault();
  	var url = jQuery(this).attr('href');
  	var width = '440';
  	var height = '680';
	window.open(url, "", "scrollbars=yes,menubar=no,toolbar=no,resizable=no,width="
    + width + ",height=" + height + ",left=" +
	((screen.width - 760)/2) + ",top=" + ((screen.height - 850)/2) );
});

$('#geocode_address_btn').live('click', function(event) {
	event.preventDefault();
	
	var address = $('#location2geocode').val();
	
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode( {'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
	  	//lat = results[0].geometry.location.Ha;
	  	//lng = results[0].geometry.location.Ia;
	  	
	  	var latLng = String(results[0].geometry.location);
	  	
	  	var city = results[0].address_components[0].long_name;
	  	var country = results[0].address_components[3].long_name;
	  	
	  	latLng = latLng.substr(1);
	  	var pos = strpos(latLng, ',');
	  	lat = latLng.substr(0,pos);
	  	var pos2 = strpos(latLng, ')');
	  	latLng = latLng.substr(0,pos2);
	  	lng = latLng.substr((pos+2));
	  	
	  	if(lat!=''&&lng!='') {
	  		var img = '<img src="http://maps.google.com/maps/api/staticmap?center='+lat+','+lng+'&zoom=15&size=300x200&markers=color:red|label:P|'+lat+','+lng+'&sensor=false" style="margin-right:20px;"><a href="#" id="edit_address_btn">Edit address</a>';
	  		$('#address_thumbnail').html(img);
	  		$('#address').val(address);
	  		//$('#address').attr('disabled', 'disabled');
			$('#geocode_section').hide();
			$('#form_section').show();
			$('#lat').val(lat);
			$('#lng').val(lng);
			$('#city').val(city);
			$('#country').val(country);
	  	}
	  }
	  else {
	  		alert('Please enter a valid address');
	  }
	});
});

$('#edit_address_btn').live('click', function(event) {
	event.preventDefault();
	$('#form_section').hide();
	$('#geocode_section').show();
	$('#address_thumbnail').html('');
	$('#location2geocode').val($('#address').val());
});

function load_thumbnail_map(lat, lng) {
	var img = '<img src="http://maps.google.com/maps/api/staticmap?center='+lat+','+lng+'&zoom=15&size=300x200&markers=color:red|label:P|'+lat+','+lng+'&sensor=false" style="margin-right:20px;"><a href="#" id="edit_address_btn">Edit address</a>';
	$('#address_thumbnail').html(img);
}

function strpos(haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}
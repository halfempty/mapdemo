var infowindow = new google.maps.InfoWindow();
var pinkmarker = new google.maps.MarkerImage('/wp-content/themes/mapdemo/pink_Marker.png', new google.maps.Size(20, 34) );
var shadow = new google.maps.MarkerImage('/wp-content/themes/mapdemo/shadow.png', new google.maps.Size(37, 34) );

function initialize() {
	map = new google.maps.Map(document.getElementById('map'), { 
		zoom: 12, 
		center: new google.maps.LatLng(38.898748, -77.037684), 
		mapTypeId: google.maps.MapTypeId.ROADMAP 
	});

	for (var i = 0; i < locations.length; i++) {  
		var marker = new google.maps.Marker({
	    	position: locations[i].latlng,
			icon: pinkmarker,
			shadow: shadow,
			map: map
		});
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
		  return function() {
		    infowindow.setContent(locations[i].info);
		    infowindow.open(map, marker);
		  }
		})(marker, i));
	}

}
var address;
var lati;
var longi;
var subid;
var sub_name;
$(window).load(function() {
	"use strict";
	
});

function initMap() {
	console.log('fired');
var roadAtlasStyles = [
  {
      "featureType": "road.highway",
      "elementType": "geometry",
      "stylers": [
        { "saturation": -100 },
        { "lightness": -8 },
        { "gamma": 1.18 }
      ]
  }, {
      "featureType": "road.arterial",
      "elementType": "geometry",
      "stylers": [
        { "saturation": -100 },
        { "gamma": 1 },
        { "lightness": -24 }
      ]
  }, {
      "featureType": "poi",
      "elementType": "geometry",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
      "featureType": "administrative",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
      "featureType": "transit",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
      "featureType": "water",
      "elementType": "geometry.fill",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
      "featureType": "road",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
      "featureType": "administrative",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
      "featureType": "landscape",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
      "featureType": "poi",
      "stylers": [
        { "saturation": -100 }
      ]
  }, {
  }
            ]; 
			
	var sharq = {
		info: '<div class="map-dtl"><h4>FAWSEC Educational Company</h4><p>Hawally - Beirut Street - Behind Dar Al-Shifa Hospital<br/>Tel: +965 22052888</p><p><a href="https://www.google.com/maps/dir//FAWSEC+Educational+Company,+Beirut+Street,+Al+Kuwayt,+Kuwait/@29.3342,48.018687,15z/data=!4m8!4m7!1m0!1m5!1m1!1s0x3fcf9c8b7c29bd73:0xc1287bc3b9b8dcf0!2m2!1d48.018687!2d29.3342" target="_blank">Get Direction</a></p></div>',
					
		lat:29.3342,
		long:48.018687
	};

	var locations = [
      [sharq.info, sharq.lat, sharq.long, 0],
    ];
	
	
	var mapOptions = {
		zoom:11,
		center: new google.maps.LatLng(locations[0][1], locations[0][2]),
		mapTypeControlOptions: {
			mapTypeId: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
		}
	};
	map = new google.maps.Map(document.getElementById('map'),
		mapOptions);

	var styledMapOptions = {
		
	};

	//var usRoadMapType = new google.maps.StyledMapType(roadAtlasStyles, styledMapOptions);
	var usRoadMapType = new google.maps.StyledMapType(styledMapOptions);

	map.mapTypes.set('usroadatlas', usRoadMapType);
	map.setMapTypeId('usroadatlas');
	
	var marker, i;
	var companyImage = new google.maps.MarkerImage('images/mapMarker.png',
			new google.maps.Size(30,41),
			new google.maps.Point(0,0),
			new google.maps.Point(15,41)
		);
				
	var infowindow = new google.maps.InfoWindow({});

	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			icon: companyImage
		});

		google.maps.event.addListener(marker, 'click', (function (marker, i) {
			return function () {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
			}
		})(marker, i));
	}
}
$(window).resize(function() {
	initMap()
});
$(window).ready(function(){
	//initMap();
});


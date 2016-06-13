(function($) {
	function initialize() {
		var mapCanvas = document.getElementById('map-canvas');
		var mapOptions = {
			center: new google.maps.LatLng(44.5403, -78.5463),
			zoom: 1,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false,
			zoomControl: false,
			scrollwheel: false,
			mapTypeControl: false,
			styles: [
				{
					"featureType": "water",
					"stylers": [
						{ "saturation": 40 },
						{ "color": "#303669" }
					]
				},{
					"featureType": "administrative",
					"elementType": "labels.text",
					"stylers": [
						{ "visibility": "off" }
					]
				},{
					"featureType": "landscape",
					"elementType": "geometry.fill",
					"stylers": [
						{ "color": "#fff8eb" },
						{ "visibility": "on" }
					]
				},{
					"stylers": [
						{ "saturation": -100 }
					]
				}
			]
		}
		var map = new google.maps.Map(mapCanvas, mapOptions);

		var lineSymbol = {
			path: 'M 0,-1 0,1',
			strokeOpacity: 1,
			scale: 4
		};

		var flightPlanCoordinates = [
			new google.maps.LatLng(-37.769499, 144.953243),
			new google.maps.LatLng(53.253571, -1.425744),
			new google.maps.LatLng(40.776154, -73.969059),
			new google.maps.LatLng(-37.769499, 144.953243)
		];

		var flightPath = new google.maps.Polyline({
			path: flightPlanCoordinates,
			geodesic: true,
			icons: [{
				icon: lineSymbol,
				offset: '0',
				repeat: '20px'
			}],
			strokeColor: '#ec509a',
			strokeOpacity: 0,
			strokeWeight: 3
		});

		flightPath.setMap(map);
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
})(jQuery);
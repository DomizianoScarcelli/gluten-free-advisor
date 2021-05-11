var urlParams = new URLSearchParams(location.search);
$(document).ready(function () {
	if (urlParams.get('range')) {
		$('#distance-slider').val(parseInt(urlParams.get('range')));
	}
	$('#distance-slider-value').text($('#distance-slider').val() + 'km');
});

function updateDistance() {
	$('#distance-slider-value').text($('#distance-slider').val() + 'km');
	updateQueryString();
	setTimeout(() => {
		location.search = urlParams;
	}, 3000);
}

function updateQueryString() {
	if (urlParams.get('range')) {
		urlParams.delete('range');
	}
	urlParams.append('range', $('#distance-slider').val());
}

//This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
//Source: https://stackoverflow.com/questions/18883601/function-to-calculate-distance-between-two-coordinates
function getDistance(lat1, lon1, lat2, lon2) {
	var R = 6371; // km
	var dLat = toRad(lat2 - lat1);
	var dLon = toRad(lon2 - lon1);
	var lat1 = toRad(lat1);
	var lat2 = toRad(lat2);

	var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	var d = R * c;
	return d;
}

// Converts numeric degrees to radians
function toRad(Value) {
	return (Value * Math.PI) / 180;
}

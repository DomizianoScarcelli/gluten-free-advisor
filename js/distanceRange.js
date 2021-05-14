var urlParams = new URLSearchParams(location.search);
$(document).ready(function () {
	if (urlParams.get('range')) {
		$('#distance-slider').val(parseInt(urlParams.get('range')));
	}
	$('#distance-slider-value').text($('#distance-slider').val() + 'km');

	for (var element of document.getElementsByClassName('card mb-3')) {
		displayDistance(element);
	}
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
/**
 * Invia le coordinate al server in modo che possano essere usate tramite php.
 * @param {*} latitude
 * @param {*} longitude
 */
function sendCoordinatesToServer(latitude, longitude) {
	$.ajax({
		type: 'POST',
		url: 'dbManager/dbSearchFromQuery.php',
		data: {
			latitude: latitude,
			longitude: longitude,
		},
		success: function (response) {
			console.log('Inviato corretamente ' + latitude + longitude);
		},
	});
}
/**
 * Localizza l'utente e chiama la funzione per inviare le coordinate al server.
 */
function geoFindMe() {
	let success = (position) => {
		latitude = position.coords.latitude;
		longitude = position.coords.longitude;
		//sendCoordinatesToServer(latitude, longitude);
	};
	let error = () => {
		alert('Errore geolocalizzazione non disponibile nel tuo Browser');
	};
	navigator.geolocation.getCurrentPosition(success, error);
}
/**
 * Calcola la distanza lato client dopo aver caricato la pagina e la mostra nelle carte.
 * Sarebbe meglio calcolare la distanza lato server via PHP ma non riesco e quindi questo è l'unico modo.
 * @param {*} element
 */
function displayDistance(element) {
	let success = (position) => {
		latitude = position.coords.latitude;
		longitude = position.coords.longitude;
		latLon = element.getElementsByClassName('card-text distance')[0].getAttribute('value').split(',');
		lat = latLon[0];
		lon = latLon[1];
		distance = Math.round(getDistance(latitude, longitude, lat, lon) * 100) / 100;
		element.getElementsByClassName('card-text distance')[0].innerHTML = `<small class='text-muted'>${distance}km da te</small>`;
	};
	let error = () => {
		alert('Errore geolocalizzazione non disponibile nel tuo Browser');
	};

	navigator.geolocation.getCurrentPosition(success, error);
}

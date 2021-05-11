/**
 * Tutto il codice che riguarda il pulsante nella home page relativo all'aggiunta di un nuovo ristorante.
 * (L'interazione con il databse viuene effettuata nel file dbManager/dbAddPendingRestaurant.php)
 */
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBmqK5XJ_5rt1y9jHSZQdfq1h-Hm-4rLHk&callback=initMap';
script.async = true;

const submitRestaurantButton = document.getElementById('submit-restaurant-button');
const restaurantName = document.getElementById('restaurant-name');
const restaurantCity = document.getElementById('restaurant-address');
const closeButton = document.getElementById('close-button');
const modalBody = document.getElementById('modal-body');
const originalHtml = modalBody.innerHTML;

window.initMap = function () {};

function checkRequired() {
	//Controlla che i campi required siano stai effettivamente compilati
}

function addressNotKnown() {
	$('#indirizzo').text('Città*');
	$('#address-tip').remove();
	$('#restaurant-address').attr('placeholder', 'es. Roma');
}

submitRestaurantButton.addEventListener('click', () => {
	if (submitRestaurantButton.value == 'Chiudi') {
		submitRestaurantButton.setAttribute('data-dismiss', 'modal');
		submitRestaurantButton.setAttribute('Aria-label', 'Close');
		reset();
	} else {
		sendRestaurantData();
		submit();
		submitRestaurantButton.removeAttribute('data-dismiss');
		submitRestaurantButton.removeAttribute('Aria-label');
	}
});

closeButton.addEventListener('click', () => {
	reset();
});

restaurantName.addEventListener('keypress', (event) => {
	if (event.key === 'Enter') {
		sendRestaurantData();
		submit();
	}
});
restaurantCity.addEventListener('keypress', (event) => {
	if (event.key === 'Enter') {
		sendRestaurantData();
		submit();
	}
});

function submit() {
	console.log(`Nome: ${restaurantName.value}, Città: ${restaurantCity.value}`);
	modalBody.innerHTML = `
        <p style="text-align:center;" >Grazie per averci suggerito un ristorante, procederemo ad aggiungerlo dopo una rapida verifica.</p>
    `;
	submitRestaurantButton.value = 'Chiudi';
	submitRestaurantButton.innerHTML = 'Chiudi';
}

function reset() {
	//Attende un po' prima di resettare i valori così non si vedono i cambiamenti nell'interfaccia
	setTimeout(() => {
		submitRestaurantButton.value = '';
		submitRestaurantButton.innerHTML = 'Invia';
		modalBody.innerHTML = originalHtml;
		restaurantName.value = '';
		restaurantCity.value = '';
	}, 500);
}

function sendPendingRestaurantData() {
	var name = $('#restaurant-name').val();
	var city = $('#restaurant-city').val();
	if (!(typeof name == 'undefined' && typeof city == 'undefined')) {
		$.ajax({
			type: 'POST',
			url: 'dbManager/dbAddPendingRestaurant.php',
			data: {
				name: name,
				city: city,
			},
		});
	}
}

function sendRestaurantData() {
	var name = $('#restaurant-name').val();
	var address = $('#restaurant-address').val();
	var image = $('#restaurant-image').files;
	console.log(image);
	var description = $('#restaurant-description').val();
	var tags = [];
	for (checkbox of document.getElementsByClassName('modal-form-checkbox')) {
		if (checkbox.checked) {
			tags.push(checkbox.value);
		}
	}
	//Converte indirizzo in coppia di coordinate ed effettua l'ajax
	addressLocate(address, (searchLatLng) => {
		//Ajax
		$.ajax({
			type: 'POST',
			url: 'dbManager/dbAddRestaurant.php',
			data: {
				name: name,
				address: address,
				latitude: searchLatLng[0],
				longitude: searchLatLng[1],
				image: image,
				description: description,
				tags: tags,
			},
			success: (data) => {
				alert(data);
			},
		});
	});
}

function addressLocate(address, callback) {
	axios
		.get('https://maps.googleapis.com/maps/api/geocode/json', {
			params: {
				address: address,
				key: 'AIzaSyBmqK5XJ_5rt1y9jHSZQdfq1h-Hm-4rLHk',
			},
		})
		.then((response) => {
			var latitude = response.data.results[0].geometry.location.lat;
			var longitude = response.data.results[0].geometry.location.lng;
			latLng = [latitude, longitude];
			callback(latLng);
		})
		.catch((error) => {
			console.log(error);
		});
}

document.head.appendChild(script);

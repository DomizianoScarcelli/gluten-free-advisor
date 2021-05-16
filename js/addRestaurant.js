/**
 * Tutto il codice che riguarda il pulsante nella home page relativo all'aggiunta di un nuovo ristorante.
 * (L'interazione con il databse viuene effettuata nel file dbManager/dbAddPendingRestaurant.php e dbManager/dbAddRestaurant.php)
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
/**
 * Viene triggerato quando l'utente clicca il pulsante "Non conosci l'indirizzo?".
 * In questo modo l'utente può inserire la città invece dell'indirizzo preciso.
 * In caso il pulsante sia già stato cliccato e viene cliccato di nuovo, allora viene effettuato un reset e l'utente può di nuovo inserire l'indirizzo.
 */
function addressNotKnown() {
	//Se il pulsante è già stato premuto
	if ($('#indirizzo').attr('value') == 'citta') {
		$('#indirizzo').attr('value', 'indirizzo');
		$('#indirizzo').text('Indirizzo*');
		$('#restaurant-address').attr('placeholder', 'es. Via delle Pantanelle 34');
		$('#address-tip').text("Non conosci l'indirizzo?");
	} else {
		$('#indirizzo').text('Città*');
		$('#indirizzo').attr('value', 'citta');
		$('#address-tip').text("Conosci l'indirizzo preciso?");
		$('#restaurant-address').attr('placeholder', 'es. Roma');
	}
}

submitRestaurantButton.addEventListener('click', () => {
	//Se il pulsante è già stato premuto, allora chiudi il form modale e resetta i campi.
	if (submitRestaurantButton.value == 'Chiudi') {
		// submitRestaurantButton.removeAttribute('data-dismiss');
		// submitRestaurantButton.removeAttribute('Aria-label');
		// reset();
		location.reload();
	} else {
		//Altrimenti invia i dati tramite il submbit.
		if ($('#restaurant-name').val() == '' || $('#restaurant-address').val() == '') {
			alert('Nome ed indirizzo sono obbligatori!');
			return;
		}
		if ($('#restaurant-image').val() == '') {
			addPending();
			submitRestaurantButton.removeAttribute('data-dismiss');
			submitRestaurantButton.removeAttribute('Aria-label');
			return;
		} else {
			if ($('#indirizzo').attr('value') == 'citta') {
				addPending();
				return;
			}
		}
		console.log('ristorante aggiunto');
		submit();
		submitRestaurantButton.removeAttribute('data-dismiss');
		submitRestaurantButton.removeAttribute('Aria-label');
	}
});

closeButton.addEventListener('click', () => {
	// reset();
	location.reload();
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
/**
 * Mostra il messaggio di conferma aggiunta del ristorante dopo una fase di verifica.
 * Viene triggerato secondo le regole di sendPendingRestaurantData().
 */
function addPending() {
	console.log('Pending');
	sendPendingRestaurantData();
	console.log(`Nome: ${restaurantName.value}, Città: ${restaurantCity.value}`);
	modalBody.innerHTML = `
        <p style="text-align:center;" >Grazie per averci suggerito un ristorante, procederemo ad aggiungerlo dopo una rapida verifica.</p>
    `;
	submitRestaurantButton.value = 'Chiudi';
	submitRestaurantButton.innerHTML = 'Chiudi';
}
/**
 * Mostra il messaggio di conferma aggiunta del ristorante.
 * Viene triggerato secondo le regole di sendRestaurantData().
 */
function submit() {
	console.log('Added');
	sendRestaurantData();
	modalBody.innerHTML = `
        <p style="text-align:center;" >Grazie per averci suggerito un ristorante, il ristorante è stato aggiunto alla lista dei ristoranti, clicca QUI per vedere la pagina!</p>
    `;
	submitRestaurantButton.value = 'Chiudi';
	submitRestaurantButton.innerHTML = 'Chiudi';
}
/**
 * Resetta le componenti del form.
 * Attualmente non ricarica le componenti generate da vue.js e quindi al suo posto viene effettuato un semplice reload della schermata.
 */
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
/**
 * Viene triggerato quando non vengono aggiunte abbastanza informazioni nel form. Il ristorante viene aggiunto nel database in una tabella relativa ai ristoranti da
 * verificare e verrà aggiunto a mano in un seguente momento.
 */
function sendPendingRestaurantData() {
	//TODO questa era solo una prova, inserisci gli effettivi valori del form.
	//TODO vedi come gestire le immagini inserite.
	var name = $('#restaurant-name').val();
	if ($('#indirizzo').attr('value') == 'citta') {
		var citta = $('#restaurant-address').val();
		var address = null;
	} else {
		var citta = null;
		var address = $('#restaurant-address').val();
	}
	var image = $('#restaurant-image').files;
	var description = $('#restaurant-description').val();
	var tags = [];
	for (checkbox of document.getElementsByClassName('modal-form-checkbox')) {
		if (checkbox.checked) {
			tags.push(checkbox.value);
		}
	}
	//Converte indirizzo in coppia di coordinate ed effettua l'ajax
	if (address) {
		addressLocate(address, (searchLatLng) => {
			//Ajax
			$.ajax({
				type: 'POST',
				url: 'dbManager/dbAddPendingRestaurant.php',
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
	} else {
		$.ajax({
			type: 'POST',
			url: 'dbManager/dbAddPendingRestaurant.php',
			data: {
				name: name,
				citta: citta,
				image: image,
				description: description,
				tags: tags,
			},
			success: (data) => {
				alert(data);
			},
		});
	}
}
/**
 * Viene triggerato quando tutte le informazioni necessarie vengono inserite nel form. Tali informazioni sono: Nome e indirizzo e immagini.
 * In questo caso il ristorante viene immediatamente inserito all'interno del database dei ristoranti.
 */
function sendRestaurantData() {
	var formData = new FormData();
	//TODO vedi come gestire le immagini inserite.
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
	//insert into formData
	formData.append('name', name);
	formData.append('address', address);
	formData.append('description', description);
	formData.append('tags', tags);

	var files = $('#restaurant-image')[0].files;
	for (file of files) {
		formData.append('file[]', file);
	}

	//Converte indirizzo in coppia di coordinate ed effettua l'ajax
	addressLocate(address, (searchLatLng) => {
		formData.append('latitude', searchLatLng[0]);
		formData.append('longitude', searchLatLng[1]);
		//Ajax
		$.ajax({
			type: 'POST',
			url: 'dbManager/dbAddRestaurant.php',
			data: formData,
			contentType: false,
			processData: false,
			success: (data) => {
				console.log(data);
			},
		});
	});
}
/**
 * Utilizzando le google api, converte un indirizzo in una coppia di coordinate, chiama poi una funzione il cui compito è quello di eseguire delle
 * azioni sulle coordinate restituite.
 * @param {*} address l'indirizzo, sotto forma di stringa, da convertire.
 * @param {*} callback la funzione che opera sulle coordinate.
 */

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

//Inserisce lo script nell'head per far funzionare le Google API.
document.head.appendChild(script);

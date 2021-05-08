/**
 * Tutto il codice che riguarda il pulsante nella home page relativo all'aggiunta di un nuovo ristorante.
 * (L'interazione con il databse viuene effettuata nel file dbManager/dbAddPendingRestaurant.php)
 */

//Ci sono dei bug che non fanno funzionare alcune cose.
const submitRestaurantButton = document.getElementById('submit-restaurant-button');
const restaurantName = document.getElementById('restaurant-name');
const restaurantCity = document.getElementById('restaurant-address');
const closeButton = document.getElementById('close-button');
const modalBody = document.getElementById('modal-body');
const originalHtml = modalBody.innerHTML;

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

function sendRestaurantData() {
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

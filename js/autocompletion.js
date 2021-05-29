var autocomplete;
/**
 * Funzione che permette l'inzializzazione dell'autocompletamento dell'indirizzo.
 */
function initFunction() {
	autocomplete = new google.maps.places.Autocomplete(document.getElementById('restaurant-address'), {
		types: ['address'],
		componentRestrictions: { country: ['IT'] },
		fields: ['name'],
	});
}

//Modifica il border-radiuso della casella di input dell'indirizzo in modo da rendere il design più uniforme con il
//dropdown dell'autocompletamento.
$('#restaurant-address').on('input', () => {
	if ($('#restaurant-address').val() == '') {
		$('#restaurant-address').css('border-radius', '12px');
	} else {
		$('#restaurant-address').css('border-radius', '12px 12px 0 0');
	}
});

var urlParams = new URLSearchParams(location.search);
$(document).ready(function () {
	if (urlParams.get('range')) {
		$('#distance-slider').val(parseInt(urlParams.get('range')));
	}
	$('#distance-slider-value').text($('#distance-slider').val() + 'km');
});

/**
 * Quando l'utente scorre lo slider, viene aggiornata la distanza selezionata.
 */
function updateShownDistance() {
	$('#distance-slider-value').text($('#distance-slider').val() + 'km');
}
/**
 * Quando l'utente rilascia il mouse dallo slider (onChange), viene inserita la querystring per filtare i ristoranti secondo la distanza selezionata.
 */
function updateQueryString() {
	if (urlParams.get('range')) {
		urlParams.delete('range');
	}
	urlParams.append('range', $('#distance-slider').val());
	location.search = urlParams;
}

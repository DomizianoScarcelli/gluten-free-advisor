var urlParams = new URLSearchParams(location.search);
$(document).ready(function () {
	if (urlParams.get('range')) {
		$('#distance-slider').val(parseInt(urlParams.get('range')));
	}
	$('#distance-slider-value').text($('#distance-slider').val() + 'km');
});

/**
 * Dopo 3 secondi dall'input dell'utente, inserisce il range di distanza selezionato all'interno della querystring
 */
function updateDistance() {
	$('#distance-slider-value').text($('#distance-slider').val() + 'km');
	if (urlParams.get('range')) {
		urlParams.delete('range');
	}
	urlParams.append('range', $('#distance-slider').val());
	location.search = urlParams;
}

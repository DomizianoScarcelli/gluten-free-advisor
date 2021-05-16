var autocomplete;
function initFunction() {
	autocomplete = new google.maps.places.Autocomplete(document.getElementById('restaurant-address'), {
		types: ['address'],
		componentRestrictions: { country: ['IT'] },
		fields: ['name'],
	});
}

$('#restaurant-address').on('input', () => {
	if ($('#restaurant-address').val() == '') {
		$('#restaurant-address').css('border-radius', '12px');
	} else {
		$('#restaurant-address').css('border-radius', '12px 12px 0 0');
	}
});
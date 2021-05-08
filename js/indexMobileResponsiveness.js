/**
 * Non viene usato attualmente
 */
$(window).on('resize', () => {
	var win = $(this); //this = window
	if (win.width() < 980) {
		//Rendi la larghezza dell'header e del suo contenuto 100% e responsive

		//Reponsiveness per i filtri
		if (!$('#filter-container-after').length) {
			$('#Panini').after('<div class="row" id="filter-container-after">');
			$('#filter-container').css('justify-content', 'space-evenly');
		}
		//Responsiveness per 'i nostri consigli'
		$('#our-suggestions').css('text-align', 'center');

		//Responsiveness per 'i ristoranti vicino a te'
		$('#nearby-suggestions').css('text-align', 'center');
		$('#nearby-suggestions').css('padding-left', '');
		$('#nearby-suggestions-container').removeClass('row');
		$('#nearby-suggestions-description-container').css('width', '100%');
		$('#nearby-suggestions-card-list').removeClass('row-cols-3');
		$('#nearby-suggestions-card-list').addClass('row-cols-auto');
		$('.col.last').css('padding-top', '');

		//Se è stato generato il bottone per la ricerca, allora modifica la sua larghezza in modo
		//da prendere l'intero schermo.
		if ($('#searchButton').length) {
			$('#search-container').css('flex-direction', 'column');
			$('#search-container').css('justify-content', 'space-evenly');
			$('#searchButton').css('width', '85%');
		}
	}

	//Reset fitri
	if (win.width() > 980) {
		if ($('#filter-container-after').length) {
			$('#filter-container-after').remove();
			$('#filter-container').css('justify-content', 'space-around');
		}
		//Reset per 'i nostri consigli'
		$('#our-suggestions').css('text-align', '');

		//Responsiveness per 'i ristoranti vicino a te'
		$('#nearby-suggestions').css('text-align', '');
		$('#nearby-suggestions').css('padding-left', '6rem');
		$('#nearby-suggestions-container').addClass('row');
		$('#nearby-suggestions-description-container').css('width', '18rem');
		$('#nearby-suggestions-card-list').removeClass('row-cols-auto');
		$('#nearby-suggestions-card-list').addClass('row-cols-3');
		$('.col.last').css('padding-top', '2rem');

		if ($('#searchButton').length) {
			$('#search-container').css('flex-direction', 'row');
			$('#search-container').css('justify-content', 'center');
			$('#searchButton').css('width', '');
		}
	}
});

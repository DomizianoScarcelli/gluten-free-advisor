/**
 * Codice per effettuare la ricerca dei ristoranti. Le parole chiave vengono inserite nella searchbare nella home e, tramite una querystring, vengono
 * condivise nella search-page, viene effettuata una query al database e vengono mostrati nella search-page i risulati.
 */
const searchbar = document.getElementById('searchbar');

var urlParams = new URLSearchParams(location.search);

searchbar.addEventListener('keypress', (event) => {
	if (event.key === 'Enter') {
		search();
	}
});

/**
 * Setta la querystring se in index, prende le info dalla querystring ed effettua una ricerca nel database mostrando i risultati nella search-page
 */
function search() {
	if (location.pathname == '/index.php' || location.pathname == '/') {
		//Se siamo nell'index allora setta la querystring
		//Genera querystring
		urlParams.append('query', searchbar.value);
		//Reindirizza in search-page.php/querystring
		let url = new URL(location.origin + '/search-page.php?' + urlParams);
		location.href = url;
	} else {
		//Altrimenti prendi i valori dalla querystring
		urlParams.delete('query');
		urlParams.append('query', searchbar.value);
		location.search = urlParams;
	}
}

/**
 * Animazione che fa comparire e sparire il bottone di ricerca a seconda se ci sia o meno testo nella barra di ricerca
 */
$('#searchbar').on('input', function (e) {
	if (searchbar.value == '' && document.getElementById('searchButton')) {
		$('#searchButton').hide(300);
		setTimeout(() => {
			$(document.getElementById('searchButton')).remove();
		}, 300);
		$('#search-container').css('height', '15rem');
	} else if (searchbar.value != '' && !document.getElementById('searchButton')) {
		if (location.pathname == '/index.php' || location.pathname == '/') {
			let button = `<button class="btn search-btn" style="display:none;" id="searchButton" onclick='search()'>Ricerca</button>`;
			$(button).appendTo(document.getElementById('search-container')).show(300);
			$('#search-container').css('height', '18rem');
		} else {
			let button = `<button class="btn search-btn invert-btn" style="display:none;" id="searchButton" onclick='search()'>Ricerca</button>`;
			$(button).appendTo(document.getElementById('header')).show(300);
		}
	}
});

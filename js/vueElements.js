/**
 * Oggetto Vue per i filtri rapidi nella home page.
 */
var quickFilters = new Vue({
	el: '#filter-container',
	data: {
		filters: [
			{ name: 'Pizza', color: 'black' },
			{ name: 'Pasta', color: 'black' },
			{ name: 'Panini', color: 'black' },
			{ name: 'Dolci', color: 'black' },
			{ name: 'Sushi', color: 'black' },
			{ name: 'Gelato', color: 'black' },
		],
	},
	methods: {
		/**
		 * Inserisce il filtro nella querystring quando questo viene cliccato, e reinderizza l'utente nella search-page.
		 * @param {*} filter
		 */
		redirect: (filter) => {
			urlParams.append('Piatti[]', filter.name);
			//Inserisce i parametri all'interno della url e ricarica la pagina per effettuare il redirect
			let url = new URL(location.origin + '/search-page.php?' + urlParams);
			location.href = url;
		},
		//Rende l'immagine del filtro bianca quando si passa sopra con il mouse.
		whiteImage: (filter) => {
			filter.color = 'white';
		},
		//Resetta l'immagine del filtro a nera quando si toglie il mouse dal filtro.
		blackImage: (filter) => {
			filter.color = 'black';
		},
	},
});

/**
 * Oggetto Vue per la lista dei ristoranti suggeriti nella home page.
 */
var restaurantSuggestions = new Vue({
	el: '#restaurant-suggestion',
	data: {
		restaurants: [
			{
				title: 'Lievito 72',
				address: 'Via del Forte Braschi, 82a, Roma, RM, Italia',
				image: 'img/upload/lievito-1.jpg',
				id: 76,
			},
			{
				title: 'Fratelli la Bufala',
				address: 'Viale di Tor di Quinto, 35, 00191 Roma, RM, Italia',
				image: 'img/upload/bufala-1.jpg',
				id: 87,
			},
			{
				title: 'Mama Eat Roma',
				address: 'Via di S. Cosimato, 7/9, 00153 Roma RM',
				image: 'img/upload/mama-1.jpg',
				id: 77,
			},
			{
				title: 'Cajo & Gajo',
				address: 'Piazza San Callisto, 10, 00153 Roma',
				image: 'img/upload/a.jpg',
				id: 89,
			},
		],
	},
});

/**
 * Oggetto Vue per la sidebar presente nella searchpage. L'oggetto viene inoltre utilizzato per renderizzare i filtri asseribili nel form modale di aggiunta del ristorante.
 */
var filterCheckboxes = new Vue({
	el: '#filter-checkboxes',
	data: {
		elements: [
			{
				title: 'Servizi del ristorante',
				values: ['Consegna a domicilio', 'Da asporto', 'Consumazione sul posto', 'Cucina separata'],
				modalFormDescription: 'Di quali servizi è dotato il ristorante?',
				type: 'checkbox',
			},
			{
				title: 'Prezzo',
				values: ['Economico', 'Nella media', 'Raffinato'],
				modalFormDescription: 'Come descriveresti il prezzo del ristorante?',
				type: 'radio',
			},
			{
				title: 'Piatti',
				values: ['Pizza', 'Pasta', 'Panini', 'Dolci', 'Sushi', 'Gelato'],
				modalFormDescription: 'Che piatti offre il ristorante?',
				type: 'checkbox',
			},
			{
				title: 'Restrizioni alimentari',
				values: ['Per vegetariani', 'Per vegani'],
				modalFormDescription: 'Il ristorante offre delle opzioni per diete alternative?',
				type: 'checkbox',
			},
		],
	},
	methods: {
		/**
		 * Inserisce e rimuove dalla querystring i vari filtri.
		 * @param {*} element
		 * @param {*} value
		 */
		redirect: (element, value) => {
			formattedValue = value.replaceAll(' ', '-');
			//Se il parametro è gia stato inserito e la checkbox viene di nuovo cliccata, allora lo toglie
			if (urlParams.getAll(element.title + '[]').includes(formattedValue)) {
				removeValueQuery(element.title + '[]', formattedValue);
				//Altrimenti lo inserisce
			} else {
				urlParams.append(element.title + '[]', formattedValue);
			}
			location.search = urlParams;
		},
	},
	/**
	 * Quando l'elemento è caricato, verifica quali parametri sono presenti nella querystring e
	 * checka le checkbox corrispondenti.
	 */

	mounted: () => {
		var urlParams = new URLSearchParams(location.search);
		array = ['Servizi del ristorante', 'Prezzo', 'Piatti', 'Restrizioni alimentari'];
		for (let key of array) {
			for (let servizio of urlParams.getAll(key + '[]')) {
				document.getElementById(servizio).checked = true;
			}
		}
	},
});

/**
 *Vue object for the home filters list.
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
 * Vue object for firs restaurant list in the home page (Our restaurant suggestions)
 */
var restaurantSuggestions = new Vue({
	el: '#restaurant-suggestion',
	data: {
		restaurants: [
			{
				title: 'Lievito 72',
				address: 'Via del Forte Braschi, 82a, Roma, RM, Italia',
				image: 'img/home-restaurants/lievito-72-home.jpg',
				id: 76,
			},
			{
				title: 'Fratelli la Bufala',
				address: 'Viale di Tor di Quinto, 35, 00191 Roma, RM, Italia',
				image: 'img/upload/AF1QipMiviPmB1al2PL_Rob34-6Qh2Pwjl807ONEgn9z=s387-k-no.jpg',
				id: 87,
			},
			{
				title: 'Mama Eat Roma',
				address: 'Via di S. Cosimato, 7/9, 00153 Roma RM',
				image: 'img/home-restaurants/mama-eat-roma-home.jpg',
				id: 77,
			},
			{
				title: 'Cajo & Gajo',
				address: 'Piazza San Callisto, 10, 00153 Roma',
				image: 'img/home-restaurants/cajo-&-gajo.png',
				id: 89,
			},
		],
	},
});

/**
 * Vue object for the second restaurant list in the home page (Nearby suggestions)
 */
// var nearbyRestaurants = new Vue({
// 	el: '#nearby-suggestions-card-list',
// 	data: {
// 		restaurants: [
// 			{
// 				title: 'Lievito 72',
// 				address: 'Via del Forte Braschi, 82/A, 00167 Roma RM',
// 				image: 'img/home-restaurants/lievito-72-home.jpg',
// 			},
// 			{
// 				title: 'Ristorante Mangiafuoco Pizza&Grill',
// 				address: 'Via Chiana, 37, 00198 Roma RM',
// 				image: 'img/home-restaurants/mangiafuoco-pizza-grill-home.webp',
// 			},
// 			{
// 				title: 'Mama Eat Roma',
// 				address: 'Via di S. Cosimato, 7/9, 00153 Roma RM',
// 				image: 'img/home-restaurants/mama-eat-roma-home.jpg',
// 			},
// 			{
// 				title: 'Cajo & Gajo',
// 				address: 'Piazza San Callisto, 10, 00153 Roma',
// 				image: 'img/home-restaurants/cajo-&-gajo.png',
// 			},
// 			{
// 				title: 'Mama Eat Roma',
// 				address: 'Via di S. Cosimato, 7/9, 00153 Roma RM',
// 				image: 'img/home-restaurants/mama-eat-roma-home.jpg',
// 			},
// 			{
// 				title: 'Lievito 72',
// 				address: 'Via del Forte Braschi, 82/A, 00167 Roma RM',
// 				image: 'img/home-restaurants/lievito-72-home.jpg',
// 			},
// 		],
// 	},
// });

/**
 * Vue object for the sidebar in the search page.
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
	//Quando l'elemento è caricato, verifica quali parametri sono presenti nella querystring
	//checka le checkbox corrispondenti.
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

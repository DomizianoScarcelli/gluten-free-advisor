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
			urlParams.append('piatti', filter.name);
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
				address: 'Via del Forte Braschi, 82/A, 00167 Roma RM',
				image: 'img/home-restaurants/lievito-72-home.jpg',
			},
			{
				title: 'Ristorante Mangiafuoco Pizza&Grill',
				address: 'Via Chiana, 37, 00198 Roma RM',
				image: 'img/home-restaurants/mangiafuoco-pizza-grill-home.webp',
			},
			{
				title: 'Mama Eat Roma',
				address: 'Via di S. Cosimato, 7/9, 00153 Roma RM',
				image: 'img/home-restaurants/mama-eat-roma-home.jpg',
			},
			{
				title: 'Cajo & Gajo',
				address: 'Piazza San Callisto, 10, 00153 Roma',
				image: 'img/home-restaurants/cajo-&-gajo.png',
			},
		],
	},
});

/**
 * Vue object for the second restaurant list in the home page (Nearby suggestions)
 */
var nearbyRestaurants = new Vue({
	el: '#nearby-suggestions-card-list',
	data: {
		restaurants: [
			{
				title: 'Lievito 72',
				address: 'Via del Forte Braschi, 82/A, 00167 Roma RM',
				image: 'img/home-restaurants/lievito-72-home.jpg',
			},
			{
				title: 'Ristorante Mangiafuoco Pizza&Grill',
				address: 'Via Chiana, 37, 00198 Roma RM',
				image: 'img/home-restaurants/mangiafuoco-pizza-grill-home.webp',
			},
			{
				title: 'Mama Eat Roma',
				address: 'Via di S. Cosimato, 7/9, 00153 Roma RM',
				image: 'img/home-restaurants/mama-eat-roma-home.jpg',
			},
			{
				title: 'Cajo & Gajo',
				address: 'Piazza San Callisto, 10, 00153 Roma',
				image: 'img/home-restaurants/cajo-&-gajo.png',
			},
			{
				title: 'Mama Eat Roma',
				address: 'Via di S. Cosimato, 7/9, 00153 Roma RM',
				image: 'img/home-restaurants/mama-eat-roma-home.jpg',
			},
			{
				title: 'Lievito 72',
				address: 'Via del Forte Braschi, 82/A, 00167 Roma RM',
				image: 'img/home-restaurants/lievito-72-home.jpg',
			},
		],
	},
});

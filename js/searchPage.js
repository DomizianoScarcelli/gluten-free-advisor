var urlParams = new URLSearchParams(location.search);
/**
 * Reindirizza alla pagina del ristorante settando l'id nella querystring.
 * @param {*} element
 */
function redirectRestaurant(element) {
	var emptyUrlParams = new URLSearchParams();
	emptyUrlParams.append('id', element.id);
	emptyUrlParams.append('name', element.getAttribute('value'));
	let url = new URL(location.origin + '/ristoranti/ristoranti.php?' + emptyUrlParams);
	location.href = url;
}
/**Impedisce che venga chiamato l'evendo del div padre ed effettua la chiamata alla funzione che setta o rimuove i tag dalla querystring */
function tagClick(e, element) {
	e.stopPropagation(); //impedisce che venga chiamato l'onclick del div padre.
	setTag(element.value);
}
/**
 * Setta o rimuove i tag dalla querystring.
 * @param {*} value
 */
function setTag(value) {
	var tagMap = new Map();
	for (element of filterCheckboxes.elements) {
		tagMap.set(element.title, element.values);
	}
	tagMap = reverseMap(tagMap);
	console.log(tagMap);
	if (urlParams.getAll(tagMap.get(value) + '[]').includes(value.replaceAll(' ', '-'))) {
		console.log('pineto');
		removeValueQuery(tagMap.get(value) + '[]', value.replaceAll(' ', '-'));
	} else {
		urlParams.append(tagMap.get(value) + '[]', value.replaceAll(' ', '-'));
	}
	location.search = urlParams;
}
/**
 * Rimuove un solo valore dalla query string, non come delete(key) che elimina tutti i valori della key.
 */
function removeValueQuery(key, value) {
	array = urlParams.getAll(key).filter((el) => el != value);
	urlParams.delete(key);
	array.forEach((el) => {
		urlParams.append(key, el.replaceAll(' ', '-'));
	});
}

/**
 * Crea una nuova mappa che è l'inverso della mappa data in input,
 * dove per inverso si intende che i valori diventano chiavi e le chiavi diventano valori.
 * Se la mappa originale presenta dei valori array, la nuova mappa sarà necessariamente più grande in quanto l'array viene scomposto.
 * @param {*} map
 * @returns
 */
function reverseMap(map) {
	var reversedMap = new Map();
	for (key of map.keys()) {
		for (item of map.get(key)) {
			reversedMap.set(item, key);
		}
	}
	return reversedMap;
}

tags = buildTags();
filterByTags(tags);

/**
 * Elimina dalla pagina gli elementi che non rispettano i filtri selezionati
 * @param {*} filterTags
 */
function filterByTags(filterTags) {
	finalElements = [];
	elements = document.getElementsByClassName('card mb-3');
	for (let element of elements) {
		let tags = JSON.parse(element.getElementsByClassName('tags-container')[0].getAttribute('value'));
		if (!subset(filterTags, tags)) {
			finalElements.push(element);
		}
	}
	for (element of finalElements) {
		element.remove();
	}
}

/**
 * Ritorna un'array contenente i filtri selezionati.
 * @returns
 */
function buildTags() {
	array = ['Servizi del ristorante', 'Prezzo', 'Piatti', 'Restrizioni alimentari'];
	tagArray = [];
	for (tags of array) {
		for (tag of urlParams.getAll(tags)) {
			tagArray.push(tag);
		}
	}
	return tagArray;
}

/**
 * Ritorna true se l'array1 è incluso nell'array2
 * @param {*} array1
 * @param {*} array2
 * @returns
 */
function subset(array1, array2) {
	for (item1 of array1) {
		if (!array2.includes(item1)) {
			return false;
		}
	}
	return true;
}

function filterByDistance() {}

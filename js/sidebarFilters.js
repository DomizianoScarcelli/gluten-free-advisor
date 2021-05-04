
var urlParams = new URLSearchParams(location.search)



//Guarda quali piatti sono stati selezionati e li checka
var piatti = urlParams.getAll('piatti');
for (var i = 0; i < piatti.length; i++) {
    document.getElementById(piatti[i]).checked = true;
}

//Definisce gli array per i vari checkbox nelle sidebar
arrayServizi = ['Consegna a domicilio', 'Da asporto', 'Consumazione sul posto', 'Cucina separata'];
arrayPrezzo = ['Economico', 'Nella media', 'Raffinato'];
arrayPiatti = ['Pizza', 'Pasta', 'Panini', 'Dolci', 'Sushi', 'Gelato'];
arrayRestrizioni = ['Per vegetariani', 'Per vegani']

//Mappa gli array nelle categorie
var map = new Map();
map.set('servizi', arrayServizi);
map.set('prezzo', arrayPrezzo);
map.set('piatti', arrayPiatti);
map.set('restrizioni', arrayRestrizioni);

//Rende i filtri funzionanti: ogni filtro aggiunge una chiave nell'url
for (key of map.keys()) {
    //Attiva e disattiva i filtri relativi ad arrayServizi
    for (let servizio of map.get(key)) {
        document.getElementById(servizio.replaceAll(' ', '-')).addEventListener('click', () => {
            //Se il filtro è già attivo e viene cliccato di nuovo, allora disattivalo
            if (urlParams.getAll(key).includes(servizio.replaceAll(' ', '-'))) {
                let array = urlParams.getAll(key);
                array = array.filter((item) => { return item != servizio.replaceAll(' ', '-') });
                urlParams.delete(key);
                for (elemento of array) {
                    urlParams.append(key, elemento);
                }
                location.search = urlParams;
            }
            //Altrimenti attivalo
            else {
                urlParams.append(key, servizio.replaceAll(' ', '-'));
                location.search = urlParams;
            }

        });
    }
    for (let servizio of urlParams.getAll(key)) {
        document.getElementById(servizio).checked = true;
    }

}







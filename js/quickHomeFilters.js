const filterCards = document.getElementsByClassName('filter-card card');
var urlParams = new URLSearchParams(location.search)

for (let card of filterCards) {
    card.addEventListener('click', () => {
        urlParams.append('piatti', card.id);
        //Inserisce i parametri all'interno della url e ricarica la pagina per effettuare il redirect
        let url = new URL(location.origin + '/search-page.php?' + urlParams);
        location.href = url
    })
    //Cambia colore dell'icona del filtro quando si passa sopra con il mouse e la resetta quando si esce
    $(card).mouseover(() => {
        $(`#${card.id}-icon`).remove();
        $(`#${card.id}-body`).append(`<img class='card-icon' id='${card.id}-icon' src='img/icons/home-filters/white/${card.id}.png'></img>`)
    })
    $(card).mouseleave(() => {
        $(`#${card.id}-icon`).remove();
        $(`#${card.id}-body`).append(`<img class='card-icon' id='${card.id}-icon' src='img/icons/home-filters/black/${card.id}.png'></img>`)
    })


}


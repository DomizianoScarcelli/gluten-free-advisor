/**
 * Codice per effettuare la ricerca dei ristoranti. Le parole chiave vengono inserite nella searchbare nella home e, tramite una querystring, vengono 
 * condivise nella search-page, viene effettuata una query al database e vengono mostrati nella search-page i risulati.
 */

const searchbar = document.getElementById("searchbar");
const searchButton = document.getElementById("searchButton");
var urlParams = new URLSearchParams(location.search)

searchbar.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
        search();
    }
})

searchButton.addEventListener('click', () => {
    search();
})


function search() {
    //Genera querystring
    urlParams.append('query', searchbar.value);
    //Reindirizza in search-page.php/querystring
    window.history.replaceState({}, '', `/search-page.php?${urlParams}`);
    location.reload()
    //Ottieni dati dalla querystring
    //Effettua una query al database per prendere i ristoranti con quei dati
    //Mostra i ristoranti nella pagina
}

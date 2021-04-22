/**
 * Codice per effettuare la ricerca dei ristoranti. Le parole chiave vengono inserite nella searchbare nella home e, tramite una querystring, vengono 
 * condivise nella search-page, viene effettuata una query al database e vengono mostrati nella search-page i risulati.
 */

const searchbar = document.getElementById("searchbar");
const searchButton = document.getElementById("searchButton");

searchbar.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
        search();
    }
})

searchButton.addEventListener('click', () => {
    search();
})

function search() {
    console.log(searchbar.value);
    setQueryString();
    //Genera querystring
    //Reindirizza in search-page.php/querystring
    //Ottieni dati dalla querystring
    //Effettua una query al database per prendere i ristoranti con quei dati
    //Mostra i ristoranti nella pagina
}


function setQueryString() {
    values = searchbar.value.split(" ");
    queryString = `?key=${encodeURIComponent(searchbar.value)}`;
    location.href = location.origin + "/search-page.php" + queryString;
}
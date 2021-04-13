/*
 * Questo codice viene eseguito quando viene inserita almeno una lettera all'interno della searchbar. Mostra nella lista dei ristoranti i ristoranti nel json filtrati per la ricerca effettuata.
 */


const restaurantsList = document.getElementById("restaurants-list");
const searchbarPrimary = document.getElementById("searchbar-primary");
const searchbarSecondary = document.getElementById("searchbar-secondary");
const tipsTitle = document.getElementById("our-suggestions");
const searchContainer = document.getElementById("search-container");
const originalHTML = restaurantsList.innerHTML;



/*Carica il json contenente i ristoranti all'interno di una variabile globale*/
var loadRestaurants = async function () {
    try {
        const res = await fetch("restaurants.json");
        restaurants = await res.json();
    } catch (err) {
        console.error(err);
    }
}

/* Mostra il codice HTML originale quando entrambe le barre di ricerca sono vuote*/
var clearResearch = function () {
    if (searchbarPrimary.value == "" && searchbarSecondary.value == "") {
        tipsTitle.textContent = "I nostri consigli";
        restaurantsList.innerHTML = originalHTML;
    } else {
        tipsTitle.textContent = "Risultati ricerca rapida";

    }
};

///Dovrebbe mostrare il bottone per la ricerca
var displaySearchButton = function () {
    const buttonString = '<button class="btn btn-primary">Cerca</button>';
    if (!searchContainer.innerHTML.includes(buttonString)) {
        searchContainer.innerHTML += (buttonString);
    }

}

/* Ascolta le lettere digitate sulla barra di ricerca primaria */
searchbarPrimary.addEventListener("keyup", (e) => {
    const searchString = e.target.value.toLowerCase();
    const filteredRestaurants = restaurants.filter((restaurant) => {
        return (
            restaurant.name.toLowerCase().includes(searchString) ||
            restaurant.infos.toLowerCase().includes(searchString)
        );
    });
    displayRestaurants(filteredRestaurants);
    clearResearch();
});

/* Ascolta le lettere digitate sulla barra di ricerca secondaria */
searchbarSecondary.addEventListener("keyup", (e) => {
    const searchString = e.target.value.toLowerCase();
    const filteredRestaurants = restaurants.filter((restaurant) => {
        for (var tagIndex = 0; tagIndex < restaurant.areaTags.length; tagIndex++) {
            return restaurant.areaTags[tagIndex].toLowerCase().includes(searchString);
        }
        return restaurant.location.toLowerCase().includes(searchString)
    });
    displayRestaurants(filteredRestaurants);
    clearResearch();
});
/*Modifica il codice HTML inserendo i risulati della ricerca combinata tra la prima e la seconda barra di ricerca*/
var displayRestaurants = function (restaurants) {
    if (restaurants.length == 0) {
        restaurantsList.innerHTML = "<p>La ricerca non ha prodotto alcun risultato</p>"
    }
    else {
        const htmlString = restaurants
            .map((restaurant) => {
                return `
            <div class="col">
                <div class="card" id="mama-eat-roma">
                    <img class="card-image" src="${restaurant.imgSrc}">
                    <div class="card-body">
                        <h5 class="card-title">${restaurant.name}</h5>
                        <p class="card-address">${restaurant.location}</p>
                    </div>
                </div>
            </div>
        `;
            })
            .join("");
        restaurantsList.innerHTML = htmlString;
    }


}
/*Chiama la prima funzione*/
loadRestaurants();

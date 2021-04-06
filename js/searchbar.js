/*
 * Questo codice viene eseguito quando viene inserita almeno una lettera all'interno della searchbar. Mostra nella lista dei ristoranti i ristoranti nel json filtrati per la ricerca effettuata.
I filtri di tali ricerca sono presenti nel searchbarPrimary.addEventListener e sono messi in OR logico tra loro. 
 */


const restaurantsList = document.getElementById("restaurants-list");
const searchbarPrimary = document.getElementById("searchbar-primary");
const tipsTitle = document.getElementById("tips-title");
const originalHTML = restaurantsList.innerHTML;

searchbarPrimary.addEventListener("keyup", (e) => {
    const searchString = e.target.value.toLowerCase();
    const filteredRestaurants = restaurants.filter((restaurant) => {
        return (
            restaurant.name.toLowerCase().includes(searchString) ||
            restaurant.location.toLowerCase().includes(searchString) ||
            restaurant.infos.toLowerCase().includes(searchString)
        );
    });
    if (searchbarPrimary.value == "") {
        tipsTitle.textContent = "I nostri consigli";
        restaurantsList.innerHTML = originalHTML;
    } else {
        tipsTitle.textContent = "Risultati della ricerca";
        displayRestaurants(filteredRestaurants);

        //location.href = "#tips-title";

    }


});

async function loadRestaurants() {
    try {
        const res = await fetch("/restaurants.json");
        restaurants = await res.json();
    } catch (err) {
        console.error(err);
    }
}

function displayRestaurants(restaurants) {
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
                        <p class="card-text">${restaurant.infos}</p>
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

loadRestaurants();

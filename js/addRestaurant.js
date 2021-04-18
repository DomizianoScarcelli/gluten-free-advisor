const submitRestaurantButton = document.getElementById("submit-restaurant-button");
const restaurantName = document.getElementById("restaurant-name");
const restaurantCity = document.getElementById("restaurant-city");
const closeButton = document.getElementById("close-button");
const modalBody = document.getElementsByClassName("modal-body")[0];
const originalHtml = modalBody.innerHTML;

submitRestaurantButton.addEventListener("click", () => {
    if (submitRestaurantButton.value == "Chiudi") {
        submitRestaurantButton.setAttribute('data-dismiss', 'modal');
        submitRestaurantButton.setAttribute('Aria-label', 'Close');
        reset();
    }
    else {
        submit();
        submitRestaurantButton.removeAttribute('data-dismiss');
        submitRestaurantButton.removeAttribute('Aria-label');

    }
})

closeButton.addEventListener('click', () => {
    reset();
})

restaurantName.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
        submit();
    }
})
restaurantCity.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
        submit();
    }
})

function submit() {
    console.log(`Nome: ${restaurantName.value}, Città: ${restaurantCity.value}`);
    modalBody.innerHTML = `
        <p style="text-align:center;" >Grazie per averci suggerito un ristorante, procederemo ad aggiungerlo dopo una rapida verifica.</p>
    `
    submitRestaurantButton.value = "Chiudi";
    submitRestaurantButton.innerHTML = "Chiudi";
}

function reset() {
    //Attende un po' prima di resettare i valori così non si vede nulla
    setTimeout(() => {
        submitRestaurantButton.value = "";
        submitRestaurantButton.innerHTML = "Invia";
        modalBody.innerHTML = originalHtml;
        restaurantName.value = "";
        restaurantCity.value = "";
    }, 500);

}



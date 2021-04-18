const submitRestaurantButton = document.getElementById("submit-restaurant-button");
const restaurantName = document.getElementById("restaurant-name");
const restaurantCity = document.getElementById("restaurant-city");

submitRestaurantButton.addEventListener("click", () => {
    exectuteCode();
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
}


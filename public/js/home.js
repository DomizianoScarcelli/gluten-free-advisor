const submitRestaurantButton = document.getElementById("submit-restaurant-button");
const restaurantName = document.getElementById("restaurant-name");
const restaurantCity = document.getElementById("restaurant-city");

submitRestaurantButton.addEventListener("click", () => {
    console.log(`Nome: ${restaurantName.value}, Città: ${restaurantCity.value}`);
})



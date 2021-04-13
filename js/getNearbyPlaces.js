function geoFindMe() {
    let success = (position) => {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
    };
    let error = () => {
        alert("Errore geolocalizzazione non disponibile nel tuo Browser");
    };
    navigator.geolocation.getCurrentPosition(success, error);
}

var service;
var map;

function initMap() {
    var request = {
        location: new google.maps.LatLng(41.90975298437715, 12.349982799999998), //inserisci le variabili per le vere coordinate
        radius: '10000',
        type: ['restaurant'],
        keyword: "senza glutine"
    };

    service = new google.maps.places.PlacesService(document.createElement('div'));

    service.nearbySearch(request, (results, status) => {
        console.log(results);
        var k = 6;
        for (var i = 0; i < k; i++) {
            /* Non penso questo if funzioni correttamente*/
            if (results[i].business_status != "OPERATIONAL") {
                k++;
                continue;
            }
            request.placeId = results[i].place_id;
            service.getDetails(request, (results) => {
                displayNearbyPlaces(results)
                console.log(results)
            })
        }
    })
}

function displayNearbyPlaces(place) {
    /*Prende la foto con altezza minore in modo da evitare vari bug, però non so se è utile come cosa visto che spesso queste foto riguardano cibi e non sono l'effettiva foto del locale*/
    let minHeightPhoto = 10000;
    let minHeightPhotoIndex = 0;
    for (var i = 0; i < 10; i++) {
        if (place.photos[i].height < minHeightPhoto) {
            minHeightPhoto = place.photos[i].height;
            minHeightPhotoIndex = i;
        }
    }
    console.log(minHeightPhotoIndex);
    console.log(minHeightPhoto)

    let nearbySuggestionsCardList = document.getElementById("nearby-suggestions-card-list");
    nearbySuggestionsCardList.innerHTML += `
    <div class="col">
        <div class="card" id="lievito-72" onclick="location.href='${place.url}'">
            <img class="card-image" src="${place.photos[minHeightPhotoIndex].getUrl({ 'maxWidth': 300, 'maxHeight': 200 })}"/>
        <div class="card-body" >
                <h5 class="card-title">${place.name.split('-')[0]}</h5>
                <p class="card-address">${place.vicinity}</p>
            </ div >
        </div >
    </div >
        `
}
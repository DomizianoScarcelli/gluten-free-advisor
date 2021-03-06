<!DOCTYPE html>
<html lang="it">

<head>
    <title>Home - Gluten Free Advisor</title>
    <link rel="shortcut icon" href="img\logos\favicon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/searchbars.css">
    <link rel="stylesheet" href="css/modal-form.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/footer.css">
    <!--Javascript-->
    <script src="js/addRestaurant.js" defer></script>
    <script src="js/search.js" defer></script>
    <script src="js/autocompletion.js" defer></script>
    <script src="js/searchPage.js" defer></script>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--Responsiveness-->
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <!--Vue.js-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="js/vueElements.js" defer></script>
    <!--Axios-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <!--Google API-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmqK5XJ_5rt1y9jHSZQdfq1h-Hm-4rLHk&libraries=places&callback=initFunction" defer></script>


</head>

<body>
    <!--Page Logo-->
    <div class="head-container">
        <img src="img/logos/Risorsa 3.png" id="logo">
        <h1 id="title">
            <!--Ristoranti Gluten Free-->
        </h1>
        <!--Searchbars-->
        <div class="search-container" id="search-container">
            <input type="search" class="searchbar text-input" id="searchbar" placeholder="Cosa vorresti mangiare?">
            <!--Qui viene aggiunto il bottone per la ricerca tramite javascript-->
        </div>
    </div>


    <div class='container' id="suggestions-main-container">
        <div class="row row-cols-6 card-list filter-container" id='filter-container'>
            <!--Filtri veloci-->
            <div class='col filter-card card' v-bind:id="filter.name + '-filter'" v-on:click='redirect(filter)' v-for='filter in filters'>
                <div class='card-body flex-row no-wrap' v-bind:id="filter.name + '-body'" @mouseover='whiteImage(filter)' @mouseleave='blackImage(filter)'>
                    <h5 class='card-title'> {{filter.name}} </h5>
                    <img class='card-icon' v-bind:id="filter.name + '-icon'" v-bind:src="'img/icons/home-filters/'+ filter.color + '/' + filter.name + '.png'">
                </div>
            </div>

        </div>


        <!--I nostri consigli-->
        <div class="row card-list-title">
            <h1 class="primary-text">I nostri consigli</h1>
        </div>
        <div class="row row-cols-4 card-list" id='restaurant-suggestion'>
            <div class="col" v-for="restaurant in restaurants">
                <div class="card" v-bind:id='restaurant.id' v-bind:value='restaurant.title' onclick='redirectRestaurant(this)'>
                    <img class="card-image" :src="restaurant.image">
                    <div class="card-body">
                        <h5 class="card-title">{{restaurant.title}}</h5>
                        <p class="card-address">{{restaurant.address}}</p>
                    </div>
                </div>
            </div>
        </div>

        <!--Ristoranti nella tua zone-->
        <div class="row card-list-title">
            <h1 class="primary-text">Ristoranti vicino a te</h1>
        </div>
        <div class="row cols-2 card-list">
            <div class="col" id="nearby-suggestions-description-container">
                <p class="secondary-text" id="nearby-suggestions-description">
                    Questi sono alcuni ristoranti senza glutine che
                    abbiamo trovato nella tua zona!
                </p>
            </div>
            <div class="col">
                <div class="row row-cols-3 g-4" id="nearby-suggestions-card-list">
                    <?php include "dbManager/dbGetNearbyRestaurants.php" ?>
                </div>
            </div>
        </div>

    </div>
    <!--Pulsante per il form per aggiungere ristoranti-->
    <div id="add-restaurant-button-container">
        <div id="add-restaurant-button" data-toggle="modal" data-target="#exampleModal">
            <h1 class="primary-text light-text">Conosci un ristorante con opzioni senza glutine?</h1>
            <p class="secondary-text light-text">Compila questo piccolo form cos?? che anche gli altri possano
                trovarlo!</p>
        </div>
    </div>
    <!-- Form modale che viene mostrato quando si preme il pulsante nella home per aggiungere un nuovo risorante-->
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aggiungi un ristorante</h5>

                    <button type="button" class="close btn-close" id="close-button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container ui-front" id='modal-body'>
                    <p class='left-tip'>I campi contrassegnati da * sono obbligatori</p>
                    <div class="row cols-2">
                        <!--Colonna sinistra-->
                        <div class="col">
                            <form action="" id="form">
                                <!--Nome del ristorante-->
                                <p class="label">Nome del ristorante<sup>*</sup></p>
                                <input class='text-input' type="text" id="restaurant-name" placeholder="es. Ristorante da Pino" /><br />
                                <!--Indirizzo o citt??-->
                                <p class="label" id='indirizzo' value='indirizzo'>Indirizzo<sup>*</sup></p>

                                <input class='text-input' type="text" id="restaurant-address" placeholder="es. Via delle Pantanelle 34" />
                                <p class="tip" id='address-tip' onclick="addressNotKnown()">Non conosci l'indirizzo?</p>
                                <!--Immagini-->
                                <p class="label" id='immagini'>Immagini</p>
                                <input type="file" multiple='true' name="filename" id='restaurant-image' accept=".jpeg,.png,.jpg">
                                <!--Descrizione-->
                                <p class="label" id='descrizione'>Descrizione</p>
                                <textarea form='form' cols='30' row='20' class='text-input long-text-input' id="restaurant-description" placeholder="es. Ristorante-pizzeria con piatti italiani, anche senza glutine, in uno spazio dal design moderno e colorato."></textarea>
                        </div>

                        <!--Colonna destra-->
                        <!--Checkbox per i servizi del ristorante-->
                        <div class="col">
                            <div id='filter-checkboxes'>
                                <div v-for='element in elements'>
                                    <p class='label'> {{element.modalFormDescription}} </p>
                                    <div class='checkbox' v-for='value in element.values'>
                                        <input class='modal-form-checkbox' v-bind:type='element.type' name='servizi-ristorante' v-bind:id='"restaurant-" + value.replaceAll(" ", "-")' v-bind:value='value'>
                                        <label v-bind:for='"restaurant-" + value.replaceAll(" ", "-")' class='checkbox-label'>{{value}}</label> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn search-btn" id="submit-restaurant-button">Invia</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.html'?>

</body>

</html>
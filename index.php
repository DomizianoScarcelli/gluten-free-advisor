<!DOCTYPE html>
<html lang="it">

<head>
    <title>Home - Ristoranti Gluten Free</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/searchbars.css">
    <link rel="stylesheet" href="css/mobile/home.css">
    <link rel="stylesheet" href="css/modal-form.css">
    <!--Javascript-->
    <script src="js/addRestaurant.js" defer></script>
    <script src="js/mobileResponsiveness.js" defer></script>
    <script src="js/homeSearch.js" defer></script>
    <script src="js/addressTOCoordinates.js" defer></script>
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <!--Responsiveness-->
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">



</head>

<body class="background">
    <!--Page Logo-->
    <div class="head-container">
        <img src="img/logo.png" id="logo">
        <h1 id="title">
            <!--Ristoranti Gluten Free-->
        </h1>
        <!--Searchbars-->
        <div class="search-container" id="search-container">
            <input type="search" class="searchbar" id="searchbar" placeholder="Cosa vorresti mangiare?">
            <button class="btn" id="searchButton">Ricerca</button>
        </div>
    </div>

    <!--Ristoranti consigliati-->
    <div id="suggestions-main-container">
        <div id="filter-container">

            <div class="filter-card card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                </div>
            </div>
            <div class="filter-card card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                </div>
            </div>
            <div class="filter-card card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                </div>
            </div>
            <div class="filter-card card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                </div>
            </div>
            <div class="filter-card card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                </div>
            </div>

        </div>
        <!--I nostri consigli-->
        <?php include "assets/home/restaurant-suggestions.html"; ?>

        <!--I migliori ristoranti vicino a te-->
        <?php include "assets/home/nearby-restaurants.html"; ?>

    </div>
    <!--Pulsante per il form per aggiungere ristoranti-->
    <div id="add-restaurant-button-container">
        <div id="add-restaurant-button" data-toggle="modal" data-target="#exampleModal">
            <h1 class="primary-text light-text">Conosci un ristorante con opzioni senza glutine?</h1>
            <p class="secondary-text light-text">Compila questo piccolo form così che anche gli altri possano
                trovarlo!</p>
        </div>
    </div>
    <!--Codice PHP che inserisce il form modale modal-form.php-->
    <?php include 'assets/home/modal-form.html'; ?>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Ricerca - Gluten Free Advisor</title>
    <link rel="shortcut icon" href="img\logos\favicon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/search-page.css">
    <link rel="stylesheet" href="css/searchbars.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <!--Javascript-->
    <script src="js/search.js" defer></script>
    <script src="js/rangeSlider.js" defer></script>
    <script src="/js/click.js" defer></script>

    <!--Responsiveness-->
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
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
    <!--Vue.js-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="js/vueElements.js" defer></script>

</head>

<body class="background">
    <!--Header-->

    <div class="header" id="header">
        <img src="img/logos/Risorsa 1.png" alt="search page logo" class="header-logo" onclick="location.href = 'index.html'" />
        <input type="search" class="searchbar" id="searchbar" />
    </div>


    <div class="body-container">

        <!--Sidebar-->
        <div class="sidebar-outside-container">
            <div class="sidebar" id='filter-checkboxes'>
                <!--Range selector-->
                <div class="sidebar-inside-container">
                    <p class="sidebar-element-title">Distanza</p>
                    <input type='range' id='distance-slider' class='form-range custom-range' min='0' max='500' step='5' onchange="updateDistance()">

                    <p class='label' id='distance-slider-value'>50km</p>

                </div>
                <!--Checkbox filters-->
                <div class="sidebar-inside-container" v-for='element in elements'>
                    <p class="sidebar-element-title">{{element.title}}</p>
                    <div class='checkbox' v-for='value in element.values'>
                        <input type='checkbox' name='servizi' v-bind:id='value.replaceAll(" ", "-")' v-on:change='redirect(element, value)'>
                        <label v-bind:for='value.replaceAll(" ", "-")' class='checkbox-label'>{{value}}</label> <br>
                    </div>
                </div>
            </div>
        </div>
        <!--Carte dei ristoranti cercati-->
        <div class='cards-container'>
            <!--Genera le cards con i valori cercati all'interno del database a seconda della query effettuata-->
            <?php include "dbManager/dbSearchFromQuery.php";
            ?>




        </div>



</body>

</html>
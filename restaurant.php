<!DOCTYPE html>
<html lang='it'>

<head>

<!-- Pagina del ristorante -->
<?php echo "<title>Ristorante - {$_GET['name']}</title>"; ?> <!-- Setta in maniera dinamica il titolo della pagina con il nome del ristorante -->

    <!-- Meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <!-- Window icon -->
    <link rel="shortcut icon" href="img\logos\favicon2.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="css/review-form.css">
    <link rel="stylesheet" href="css/searchbars.css">
    <link rel="stylesheet" href="css/modal-form.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/restaurant.css">
    <link rel="stylesheet" href="css/animated-grid.css">
    <link rel="stylesheet" href="css/reviews.css">
    <link rel="stylesheet" href="css/description.css">
    <link rel="stylesheet" href="css/footer.css">
     <!-- Javascript -->
    <script src="js/search.js" defer></script>
    <script src="js/addReview.js" defer></script>
    <script src="js/editRestaurantInfo.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="../js/vueElements.js" defer></script>

</head>

<body>

    <div class="background">
        <!-- Header con la searchbar che rimanda alla search-page -->
        <div class="header" id="header">
            <img src="img/logos/Risorsa 1.png" alt="search page logo" class="header-logo" onclick="location.href = 'index.php'" />
            <input type="search" class="searchbar" id="searchbar" />
        </div>

        <div class="container risto-container mt-3">


            <!--Caricamento dinamico dei dati relativi allo specifico ristorante-->
            <?php include "dbManager/dbRestaurantFromQuery.php";
            ?>


            <!--Pulsante per aggiungere una recensione-->
            <div id="add-review-button-container">
                <div id="add-review-button" data-toggle="modal" data-target="#exampleModal">
                    <p class="secondary-text light-text">Ti ?? capitato di mangiare qui?</p>
                    <h1 class="primary-text light-text">Scrivi una recensione per questo ristorante!</h1>
                </div> 
            </div>
            <!-- Form modale per aggiungere una recensione-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Modal form header-->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Aggiungi una recensione</h5>
                            <button type="button" class="close btn-close" id="close-button" data-dismiss="modal" aria-label="Close"></button>
                        </div>                    
                        <!--Modal form body-->
                        <div class="modal-body container ui-front" id='modal-body'>
                            <p class='left-tip'>&emsp;&emsp;I campi contrassegnati da * sono obbligatori</p>

                            <div class="row cols-2">
                                <!--Prima colonna-->
                                <div class="col">
                                    <form action="" id="form">
                                    <!--Titolo della recensione-->
                                    <p class="label" id='titolo' value='titolo'>Titolo della tua recensione<sup>*</sup></p>
                                    <input class='text-input' type="text" id="review-title" placeholder="es. Splendida serata"/>                                  
                                    <!--Testo della recensione-->
                                    <p class="label" id='testo-recensione'>La tua recensione<sup>*</sup></p>
                                    <textarea form='form' cols='30' row='20' class='text-input long-text-input' id="review-text" placeholder="es. Ottimo cibo, servizio rapido e personale disponibile. Lo consiglio."></textarea>
                                </div>
                                <!--Seconda colonna-->
                                <div class="col"> 
                                    <!--Data della visita-->
                                    <p class="label" id='data'>Quando ci sei stato?<sup>*</sup></p>
                                    <input type="date" id='review-date' name="data-visita" />
                                    <!--Valutazione per lo star rating (da 1 a 5)-->
                                    <p class="label" id='valutazione'>Che punteggio daresti a questo ristorante?<sup>*</sup></p>
                                    <label class="radio">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1"> 1&emsp;
                                    </label>
                                    <label class="radio">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2"> 2&emsp;
                                    </label>
                                    <label class="radio">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3"> 3&emsp;
                                    </label>
                                    <label class="radio">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4"> 4&emsp;
                                    </label>
                                    <label class="radio">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="5"> 5&emsp;
                                    </label>
                                    <!--Username (facoltativo)-->
                                    <p class="label">Il tuo username?<br>
                                    (se NON vuoi inserire uno username, la recensione verr?? aggiunta in forma anonima)</p>
                                    <input class='text-input' type="text" id="username" placeholder="..anonimo.." /><br />
                                </div>         
                                </form>
                            </div>

                        </div>
                        <!--Modal form submit button-->
                        <div class="modal-footer">
                            <button type='button' class="btn review-btn" id="submit-review-button">Invia</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer che rimanda alla about page -->
    <?php include 'footer.html' ?>

</body>

</html>
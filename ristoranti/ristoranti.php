<!DOCTYPE html>
<html>

<head>
    <title>Ristorante - pagina descrittiva</title>
    <!--Meta tags-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width initial-scale=1.0" />

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/searchbars.css">
    <link rel="stylesheet" href="../css/modal-form.css">
    <link rel="stylesheet" href="../css/sidebar.css">

     <!--Javascript-->
    <script src="js/addRestaurant.js" defer></script>
    <script src="js/search.js" defer></script>

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <!--Bootstrap-->
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

    <link rel="stylesheet" href="ristoranti.css" type="text/css">
    <link rel="stylesheet" href="animated-grid.css" type="text/css">
    <link rel="stylesheet" href="recensioni.css" type="text/css">

     <!--Vue.js-->
     <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="js/vueElements.js" defer></script>

</head>

<body class="background text-center">

    <!--Header della pagina con searchbar 
        (probabilmente da sostituire)-->
    <nav class="navbar navbar-expand navbar-dark mynavbar">
        <div class="container-fluid">

            <a class="navbar-brand" href="">Gluten Free Advisor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about/index.html">About</a>
                    </li>
                </ul>
                <form>
                    <input class="form-control" type="text" placeholder="Search">
                </form>
            </div>

        </div>
    </nav>

    <div class="risto-container">

        <!--Caricamento dinamico dei dati relativi allo specifico ristorante-->
        <?php include "restaurantFromQuery.php";
        ?>

        <!--Container con il form per aggiungere una recensione-->
        <div class="container" id="form-ontainer">
            <div class="card" style="width= ">
                <form action="addReview.php" method="POST" name="formReview" onsubmit="">
                    <h4>Aggiungi una recensione</h4>
                    Titolo:
                    <input type="text" name="titolo-review" size="20" maxlength="20" placeholder="Aggiungi un titolo...">
                    <label for="data-visita">Data della visita:</label>
                    <input type="date" id="data-visita" name="dataVisita">
                    <br>
                    <textarea name="inputRecensione" id="textarea-recensione" cols="30" rows="5" 
                        placeholder="Scrivi qui la tua recensione..." required></textarea>
                    <br>
                    <!--
                    Valuta il ristorante con un punteggio da 1 a 5:
                    <input type="text" name="valutazione" size="10" maxlength="10"> -->
                    <button class="btn btn-lg btn-primary" name="sendButton" type="submit">Invia</button>
                    <button class="btn btn-lg btn-primary" name="resetButton" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
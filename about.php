<!DOCTYPE html>
<html lang="it">

<head>
    <title>Chi Siamo - Gluten Free Advisor</title>
    <link rel="shortcut icon" href="img\logos\favicon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/about.css">
    <!--Javascript-->
    <script src="js/about.js" defer></script>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--Responsiveness-->
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
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

</head>

<body>


    <body>
        <!--Header-->
        <div class="back-container">
            <div class="back-inner-container">
                <div class='back-icon' id='back-icon'></div>
                <div class='back-text' id='back-text'>Home</div>
            </div>
        </div>
        <div class="body-container">
            <div class="top-container">
                <div class="top-inner-container">

                    <div class='header-title'>
                        Il progetto Gluten Free Advisor
                    </div>
                    <div class='header-subtitle' onclick="document.getElementById('authors').scrollIntoView()">
                        Incontra il nostro Team!
                    </div>
                    <div class='header-text'>
                        Il progetto Gluten Free Advisor si propone in primis di realizzare uno strumento di facile
                        consultazione
                        e
                        ricerca di locali che offrano un servizio idoneo alle esigenze alimentari di persone affette da
                        celiachia e
                        intolleranza al glutine. Nasce dalla
                        collaborazione di esercenti e clienti, che possono rispettivamente richiedere di aggiungere il
                        proprio
                        locale
                        al sito
                        e condividere le proprie esperienze sotto forma di recensione, il tutto tramite appositi form.
                    </div>
                </div>
                <div class='button-container'>
                    <button class='btn btn-primary contact-us' onclick="document.getElementById('form-container').scrollIntoView()">
                        Contattaci
                    </button>
                </div>
            </div>
            <!--Sezione intermedia-->
            <div class=' row cols-3 mottos-container g-4'>
                <div class="col motto">
                    <div class="motto-icon" id='gluten-free'></div>
                    <div class="motto-title">Senza Glutine</div>
                    <div class="motto-text">I ristoranti presenti sul sito sono scelti accuratamente dal nostro Team e vengono continuamente aggiunti dalla community. </div>
                </div>
                <div class="col motto">
                    <div class="motto-icon" id='problem-free'></div>
                    <div class="motto-title" >Senza Problemi</div>
                    <div class="motto-text">Se noti che un ristorante presente sul sito non offre veramente opzioni senza glutine, contattaci e, dopo una rapida verifica, se questo è vero lo rimuoveremo!</div>
                </div>
                <div class="col motto">
                    <div class="motto-icon" id='limit-free'></div>
                    <div class="motto-title">Senza Limiti</div>
                    <div class="motto-text">Non esistono più limiti all'alimentazione, basta consultare il nostro sito per trovare velocemenete e in maniera efficente un ristorante senza glutine vicino a te, che soddisfi le tue necessità.
                    </div>
                </div>
            </div>
            <!--Sezione autori-->
            <div class="row authors-container" id='authors'>
                <div class="authors-title">
                    Il nostro Team
                </div>
            
                <div class="col author-card ">
                    <div class="author-icon"></div>
                    <div class="author-name">Domiziano Scarcelli</div>
                </div>
                <div class="col author-card ">
                    <div class="author-icon"></div>
                    <div class="author-name">Cristiana Di Tullio</div>
                </div>
            </div>
            

            <!--Sezione form di contatto-->
            <div class="contact-form-container" id='form-container'>

                <div class="contact-form-title">
                    Contattaci!
                </div>
                <form class='contact-form' method="POST" name='contact-us-form' id='contact-us-form'>
                    <div class="form-group form-row">
                        <div class="form-group">
                            <label for='name'>Nome</label>
                            <input class="form-control" type="text" name='name' id='name' required>
                        </div>
                        <div class="form-group">
                            <label for='email'>Oggetto</label>
                            <input class="form-control" type="text" name='subject' id='subject' required>
                        </div>
                        <div class="form-group">
                            <label for='email'>Email</label>
                            <input class="form-control" type="text" name='email' id='email' required>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for='message'>Messaggio</label>
                        <textarea class="form-control" name="message" id="message" cols="30" rows="10" required></textarea>
                    </div>


                </form>
                <div class="submit-button">
                    <button class='btn btn-primary contact-us inverse' onclick='sendMail()'>Invia</button>
                </div>
            </div>

        </div>
        <footer></footer>
    </body>

</html>
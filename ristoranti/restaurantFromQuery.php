<?php

    /*Questo è il codice php che prende l'id del ristorante cercato dalla url e lo usa per fare delle query
    sul database e recuperare i dati e le recensioni del ristorante specifico. */

    /*Connessione al db*/
    include "../dbManager/dbConnect.php";

    //Memorizza l'id del ristorante di cui fare la query e caricare i dati
    $id = $_GET['id'];
    $val = 0;

    //Controlla che la variabile di cui sopra non sia null
    if (!isset($id)) {
        echo "<h3>Ricerca non valida, non posso mostrarti il ristorante...</h3>";
    }

    //Controlla che la connessione sia andata a buon fine
    if (!$conn) {
        echo "<h3>Connessione al database locale fallita</h3>";
    }
    /*
    else {
        echo "<p>Ecco il ristorante che cercavi:</p>";
    }*/

    //Query che mi servono
    $q1 = "SELECT * FROM dati_ristoranti WHERE id = $id";  //Seleziona i dati del ristorante corrente (serve per nome e indirizzo)
    $q2 = "SELECT COUNT(*) FROM recensioni WHERE id_ristorante = $id"; //Conta il numero di recensioni per il ristorante corrente
    $q3 = "SELECT * FROM recensioni WHERE id_ristorante = $id order by data asc"; //Seleziona tutte le recensioni per il ristorante corrente
    $q4 = "SELECT valutazione FROM recensioni WHERE id_ristorante = $id"; /*Faccio una query a parte solo per la valutazione in modo da
    poter settare in modo opportuno il rating del ristorante, prima di iterare sulle recensioni*/

    //Esecuzione delle query sul db e memorizzazione del risultato nelle variabili $result_i
    $result1 = mysqli_query($conn, $q1);
    $result2 = mysqli_query($conn, $q2);
    $result3 = mysqli_query($conn, $q3);
    $result4 = mysqli_query($conn, $q4);
    
    if (mysqli_num_rows($result1) > 0) {

        while ($row1 = mysqli_fetch_assoc($result1)) {

            $photoarray = json_decode($row1['listaFoto']);
            $tagsarray = explode(',', str_replace(('"'), ',', $row1['tags']));

            //Codice che mette a null gli ultimi elementi di photoarray se questo contiene meno di 5 foto
            //Evita che vengano stampati errori se il ristorante ha meno d
            if (sizeof($photoarray) < 5) {
                for ($j = sizeof($photoarray); $j < 5; $j++) {
                    $photoarray[$j] = null;
                }
            }

            //NOME E INDIRIZZO DEL RISTORANTE
            echo "
                <div class='border-bottom'id='{$row1['id']}'>
                    <h3>{$row1['nome']}</h3>
                    <div class='row mb-2'>
                        <div class='col-sm'>
                            <span style='float:left'>
                            <b>Indirizzo: </b><i>{$row1['indirizzo']}</i>
                            </span>
                            <span style='float:right'>
                                Valutazione degli utenti:
                                <span>
            ";

            //Se il ristorante ha più di 0 recensioni
            if (mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {

                while ($row2 = mysqli_fetch_assoc($result2)) {

                    //STAR RATING
                    //Calcola il numero di stelle da checkare facendo la media delle valutazioni degli utenti (ognuna un numero da 1 a 5)
                    if (mysqli_num_rows($result4) > 0) {
                        while ($row4 = mysqli_fetch_assoc($result4)) {
                            $val += $row4['valutazione'];
                        }
                    }
                    $val = intdiv($val, $row2['COUNT(*)']);
                
                    //Stampa il numero giusto di stelle
                    for ($i = 0; $i < $val; $i++) {
                        echo "              
                                <span class='fa fa-star checked'></span>
                            ";
                    }

                    for (; $i < 5; $i++) {
                        echo "
                                <span class='fa fa-star'></span>
                            ";
                    }

                    echo "
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    ";

                    //GRIGLIA DI IMMAGINI
                    $num_photo = sizeof($photoarray);

                    echo "
                        
                        <!--Images grid-->
                        <div class='animated-grid'>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[0]})' onclick='openModalSlideshow();currentSlide(1)'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[1]})' onclick='openModalSlideshow();currentSlide(2)'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[2]})' onclick='openModalSlideshow();currentSlide(3)'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[3]})' onclick='openModalSlideshow();currentSlide(4)'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[4]})' onclick='openModalSlideshow();currentSlide(5)'></div>
                        </div>
                    ";

                    //MODAL SLIDESHOW
                    echo "
                        <div id='modalslides' class='modal'>
                            <span class='close-cursor' onclick='closeModalSlideshow()'>&times;</span>
                            <div class='modal-content'>  ";
                            
                                for ($k = 0; $k < $num_photo; $k++) {
                                    $index = $k + 1;
                                    echo "      <div class='slides'>
                                                    <div class='numbertext'>{$index} / {$num_photo}</div>
                                                    <img src='../img/upload/{$photoarray[$k]}' style='width:100%'>
                                                </div>
                                        ";               
                                }  
                    echo "  
                                <a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
                                <a class='next' onclick='plusSlides(1)'>&#10095;<a>
                        ";
                            
                                for ($k = 0; $k < $num_photo; $k++) {
                                    echo "      <div class='column'>
                                                    <img class='demo' src='../img/upload/{$photoarray[$k]}' onclick='currentSlide($k)' alt='slide$k'>
                                                </div>
                                        ";
                                }
                    echo "
                            </div>
                        </div>
                        ";
                    /*
                    //DETTAGLI DEL RISTORANTE
                    echo "
                            <!--Servizi del ristorante-->
                            <div class='border-top border-bottom' style='max-width: 70rem;' id='{$row1['id']}'>
                                <div class='row mt-3 mb-3 g-0 row-with-gap'>
                                    <div class='col-md-6 mr-2 card'>
                                        <div class='static-card-body'>
                                            <h3>Dettagli</h3>       
                        ";
                        
                        Checks whether description is empty or not
                        if (empty($row1['descrizione'])) {
                            echo "<p>Nesssuna descrizione purtroppo...</p>
                                        <p>
                                        <ul>      
                            ";
                        }
                        else {
                            echo "<p>{$row1['descrizione']}</p>
                                        <p>
                                        <ul>
                            ";
                        }                        

                        //Checks wheter tag list is empty or not
                        if (sizeof($tagsarray) > 0) {
                            for ($j = 1; $j < sizeof($tagsarray) - 1; $j++) {
                                echo "<li>$tagsarray[$j]</li>";
                                }
                            }
                        echo "
                                        </ul>
                                        </p>
                                        </div>
                                    </div>
                                    <div class='col-md-6 ml-2'>

                                        <div class='row text-right'>
                                            <h3>Aggiungi info</h3>
                                        </div>
                                        <div class='row'>
                                            <p>
                                            Conosci questo ristorante?
                                            Aiutaci a completare il suo profilo aggiungendo la tua esperienza!
                                            </p>
                                        </div>
                                        <div class='row'>
                                            <button>Vai al form</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            ";      */
                        
                    //RECENSIONI
                    echo "
                        <!--Intestazione Recensioni-->
                        <div class='text-center'>
                            <h3 class='mt-3'>Recensioni</h3>
                            <p>Numero di recensioni per questo ristorante: <b>{$row2['COUNT(*)']}</b></p>
                        </div>
                        ";
                }

                while ($row3 = mysqli_fetch_assoc($result3)) {

                    $datestamp = strtotime("{$row3['data']}");
                    $new_date = date("d-m-Y", $datestamp);

                    echo "
                        <div class='card mb-3' style='max-width: 70rem;' id='{$row3['id_recensione']}'>
                            <div class='row card-body'>
                                <div class='col-md-10 review-container'>
                                    <div class='title-container'>
                                        <h5>\"<b>{$row3['titolo']}</b>\"</h5>
                                        <p class='card-text'>{$row3['testo']}
                                            <br><br>
                                            <b>Data della visita:</b> $new_date
                                        </p>
                                    </div>
                                </div>
                                <div class='col-md-2 user-container'>
                                    <b>Autore:</b> <i>{$row3['username']}</i>
                                </div>
                            </div>
                        </div>
                    ";
                }
            }
            //----------Se il ristorante non ha recensioni-----------
            else {
                for ($i = 0; $i < 5; $i++) {
                    echo "
                            <span class='fa fa-star'></span>
                        ";
                }

                echo "
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--Images grid-->
                    <div class='container'>
                        <div class='animated-grid'>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[0]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[1]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[2]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[3]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[4]})'></div>
                        </div>
                    </div>
                        

                    <!--Intestazione Recensioni-->
                    <div class='container border-top border-bottom'>
                        <h3 class='mt-3'>Recensioni</h3>
                        <p>
                            Numero di recensioni per questo ristorante: <b>ancora nessuna</b>.
                            <br>
                            Aggiungi per primo una recensione compilando il form!
                        </p>
                    </div>
                ";
            }
        }
    }

    /*
                        <div class='row mb-2'>
                            <div class='col-sm'>
                                <b>Descrizione: </b> 
                        
                            /*if ($row1['descrizione'] == null) {
                                echo "Non è ancora presente una descrizione.";
                            }
                            if ($row1['descrizione']) {
                                echo "{$row1['descrizione']}";      
                            }
                    
                                </div>
                            </div>*/

    mysqli_close($conn);

?>
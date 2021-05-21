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
    $q3 = "SELECT * FROM recensioni WHERE id_ristorante = $id order by data_recensione asc"; //Seleziona tutte le recensioni per il ristorante corrente
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
                <div class='border-bottom' name='restaurant-div' id='{$row1['id']}'>
                    <h3 class='risto-title'>{$row1['nome']}</h3>
                    <div class='row mb-2'>
                        <div class='col-sm'>
                            <span >
                            <b>Indirizzo: </b><i>{$row1['indirizzo']}</i>
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

                    /*MODAL SLIDESHOW
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
                        ";  */
                    

            //DESCRIZIONE DEL RISTORANTE
            $SERVIZI_DEL_RISTORANTE = ['Consegna a domicilio', 'Da asporto', 'Consumazione sul posto', 'Cucina separata'];
            $PREZZO = ['Economico', 'Nella media', 'Raffinato'];
            $PIATTI = ['Pizza', 'Pasta', 'Panini', 'Dolci', 'Sushi', 'Gelato'];
            $RESTRIZIONI_ALIMENTARI = ['Per vegetariani', 'Per vegani'];

            echo "
                    <!--Servizi del ristorante-->
                        <div class='border-top border-bottom' style='max-width: 70rem;' id='{$row1['id']}'>
                        <div class='row cols-2 details-container'>

                            <div class='col-md-6 card'>
                            <div class='row'>
                                <h3 class='modify-h3'>Offerta del ristorante</h3>
            ";
                        
            //Controllo descrizione
            if (empty($row1['descrizione'])) {
                echo "<p>Non è ancora presente una descrizione per questo ristorante...</h3>";                                            
            }
            else {
                    echo "<p>{$row1['descrizione']}</p>";
            }

            //Apertura tag con la lista delle opzioni disponibili
            echo"           
                                </div>
                                <div class='row cols-2'> 
                                    <div class='col'>
                                        SERVIZI
                                        <br>
                                        <ul>";
                $temp = 0;
                for ($j = 1; $j < sizeof($tagsarray) - 1; $j++) {
                    if (in_array($tagsarray[$j], $SERVIZI_DEL_RISTORANTE)) {
                        echo "<li>$tagsarray[$j]</li>";
                        $temp++;
                    }
                }
                if ($temp == 0) {
                    echo "~";
                }
            echo "
                                        <!--~-->
                                        </ul>
                                    </div>
                                    <div class='col'>
                                        PIATTI
                                        <br>
                                        <ul>";
                $temp = 0;
                for ($j = 1; $j < sizeof($tagsarray) - 1; $j++) {
                    if (in_array($tagsarray[$j], $PIATTI)) {
                        echo "<li>$tagsarray[$j]</li>";
                        $temp++;
                    }
                }
                if ($temp == 0) {
                    echo "~";
                } 
            echo "
                                        <!--~-->
                                        </ul>
                                    </div>
                                </div>
                                <div class='row cols-2'>
                                    <div class='col'>
                                        RESTRIZIONI ALIMENTARI
                                        <br>
                                        <ul>";
                $temp = 0;
                for ($j = 1; $j < sizeof($tagsarray) - 1; $j++) {
                    if (in_array($tagsarray[$j], $RESTRIZIONI_ALIMENTARI)) {
                        echo "<li>$tagsarray[$j]</li>";
                        $temp++;
                    }
                }
                if ($temp == 0) {
                    echo "~";
                }               
            echo "
                                        <!--~-->
                                        </ul>
                                    </div>
                                    <div class='col'>
                                        PREZZO
                                        <br>
                                        <ul>";
                $temp = 0;
                for ($j = 1; $j < sizeof($tagsarray) - 1; $j++) {
                    if (in_array($tagsarray[$j], $PREZZO)) {
                        echo "<li>$tagsarray[$j]</li>";
                        $temp++;
                    }
                }
                if ($temp == 0) {
                    echo "~";
                }                 
            echo "
                                        <!--~-->
                                        </ul>
                                    </div>
                                </div>                    
                            </div>

                            <div class='col-md-1'>
                            </div>

                            <div class='col-md-5 modify-info' style='text-align: right'>
                                <div>
                                    <div class='row text-right'>
                                        <h3>Aggiungi informazioni</h3>
                                    </div>
                                    <div class='row'>
                                        <p>
                                        Conosci questo ristorante?
                                        <br>
                                        Aiutaci a completare il suo profilo aggiungendo la tua esperienza!
                                        </p>
                                    </div>
                                    <div class='row'>
                                        <button class='addinfo-button'>
                                            <span>Vai al form</span>
                                        </button>
                                    </div>
                                </div>
                                       
                            </div>
                        </div>
                    </div>
                ";  

            //RECENSIONI
            echo "
                <!--Intestazione Recensioni-->
                <div class='text-center'>
                    <h3 class='risto-title'>Recensioni</h3>
            ";

            if (mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {

                while ($row2 = mysqli_fetch_assoc($result2)) {

                    echo "
                            <p>Numero di recensioni per questo ristorante: <b>{$row2['COUNT(*)']}</b></p>
                        
                    ";

                    /*STAR RATING
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
                    }*/

                    echo "</div>";
                        
                    
                    while ($row3 = mysqli_fetch_assoc($result3)) {

                        $datestamp = strtotime("{$row3['data_recensione']}");
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
            } 
            else {
                echo "
                    <p>Non è stata ancora scritta nessuna recensione per questo ristorante...</p>
                    ~
                    </div>
                ";

            }

        mysqli_close($conn);

        }
    }

?>
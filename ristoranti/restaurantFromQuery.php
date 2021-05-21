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
            //print($tagsarray);

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
                     
                            <!-- Colonna vuota per allineamento -->
                            <div class='col-md-1'>
                            </div>
            ";
            //Pulsante (e relativo form) per la modifica di dati del ristorante
            echo "          
                            <!-- Colonna con il pulsante per aprire il form di modifica dati del ristorante -->
                            <div class='col-md-5 modify-info'>
                                <div>   <!-- Serve per racchiudere scritte e pulsante nella stessa entità -->
                                    <div class='row'>
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
                                        
                                        <button class='addinfo-button' data-toggle='modal' data-target='#exampleModal-2' id='edit-info-button'>
                                            <span>Vai al form</span>
                                        </button>

                                        <div class='modal fade' id='exampleModal-2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>

                                                    <!--Modal form header-->
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='exampleModalLabel-2'>Aggiungi informazioni al profilo del ristorante</h5>
                                                        <button type='button' class='close btn-close' id='close-button-2' data-dismiss='modal' aria-label='Close'></button>
                                                    </div>

                                                    <!--Modal form body-->
                                                    <div class='modal-body container ui-front' id='modal-body-2'>

                                                        <div class='row cols-2'>
                                
                                                            <!--Prima colonna-->
                                                            <div class='col'>
                                                                
                                                                <form action='' id='form-2'>

                                                                <!--Nome del ristorante-->
                                                                <p class='label'>&emsp;&emsp;&emsp;Nome del ristorante<sup>*</sup></p>
                                                                <input class='text-input' type='text' id='restaurant-name' value='{$row1['nome']}' disabled/><br />
                                                                <!--Indirizzo o città-->
                                                                <p class='label' id='indirizzo' value='indirizzo'>&emsp;&emsp;&emsp;Indirizzo<sup>*</sup></p>
                                                                <input class='text-input' type='text' id='restaurant-address' value='{$row1['indirizzo']}' disabled/>

                                                                <!--Immagini-->
                                                                <p class='label' id='immagini'>&emsp;&emsp;&emsp;Aggiungi le tue immagini</p>
                                                                <input type='file' multiple='true' name='filename' id='restaurant-image' accept='.jpeg,.png,.jpg'>
                                                                
                                                                <!--Descrizione-->
                                                                <p class='label' id='descrizione'>&emsp;&emsp;&emsp;Aggiungi/Modifica la descrizione</p>";
                                                                if ($row1['descrizione'] == '') {
                                                                    echo "<textarea form='form' cols='30' row='20' class='text-input long-text-input' id='restaurant-description' placeholder='Aggiungi per primo una recensione...'></textarea>";
                                                                }
                                                                else {
                                                                    echo "<textarea form='form' cols='30' row='20' class='text-input long-text-input' id='restaurant-description'>{$row1['descrizione']}</textarea>";
                                                                }
                                                            
                                                        echo "
                                                                                                                            
                                                            </div>

                                                            <div class='col-md-1'>
                                                            </div>
                                
                                                            <!--Terza colonna-->
                                                            <div class='col'>

                                                                <div style='text-align: left'>
                                                                    <div id='filter-checkboxes'>
                                                                        <div>
                                                                            <p class='label'> Di quali servizi è dotato il ristorante? </p>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Consegna a domicilio', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Consegna-a-domicilio' class='modal-form-checkbox' value='Consegna a domicilio' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Consegna-a-domicilio' class='modal-form-checkbox' value='Consegna a domicilio'>";
                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Consegna-a-domicilio' class='checkbox-label'>Consegna a domicilio</label> 
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Da asporto', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Da-asporto' class='modal-form-checkbox' value='Da asporto' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Da-asporto' class='modal-form-checkbox' value='Da asporto'>";

                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Da-asporto' class='checkbox-label'>Da asporto</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Consumazione sul posto', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Consumazione-sul-posto' class='modal-form-checkbox' value='Consumazione sul posto' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Consumazione-sul-posto' class='modal-form-checkbox' value='Consumazione sul posto'>";
                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Consumazione-sul-posto' class='checkbox-label'>Consumazione sul posto</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Cucina separata', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Cucina-separata' class='modal-form-checkbox' value='Cucina separata' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Cucina-separata' class='modal-form-checkbox' value='Cucina separata'>";

                                                                            }
                                                                            echo "                                                                               
                                                                                <label for='restaurant-Cucina-separata' class='checkbox-label'>Cucina separata</label>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <p class='label'> Come descriveresti il prezzo del ristorante? </p>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Economico', $tagsarray)) {
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Economico' class='modal-form-checkbox' value='Eonomico' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Economico' class='modal-form-checkbox' value='Eonomico'>";
                                                                            }
                                                                            echo "                                                                                
                                                                                <label for='restaurant-Economico' class='checkbox-label'>Economico</label>
                                                                            <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Nella media', $tagsarray)) {
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Nella-media' class='modal-form-checkbox' value='Nella media' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Nella-media' class='modal-form-checkbox' value='Nella media'>";
                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Nella-media' class='checkbox-label'>Nella media</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Raffinato', $tagsarray)) {
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Raffinato' class='modal-form-checkbox' value='Raffinato' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Raffinato' class='modal-form-checkbox' value='Raffinato'>";
                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Raffinato' class='checkbox-label'>Raffinato</label>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <p class='label'> Che piatti offre il ristorante? </p>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Pizza', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Pizza' class='modal-form-checkbox' value='Pizza' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Pizza' class='modal-form-checkbox' value='Pizza'>";
                                                                            }
                                                                            echo "   
                                                                                <label for='restaurant-Pizza' class='checkbox-label'>Pizza</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Pasta', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Pasta' class='modal-form-checkbox' value='Pasta' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Pasta' class='modal-form-checkbox' value='Pasta'>";
                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Pasta' class='checkbox-label'>Pasta</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Panini', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Panini' class='modal-form-checkbox' value='Panini' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Panini' class='modal-form-checkbox' value='Panini'>";
                                                                            }
                                                                            echo "    
                                                                                <label for='restaurant-Panini' class='checkbox-label'>Panini</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Dolci', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Dolci' class='modal-form-checkbox' value='Dolci' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Dolci' class='modal-form-checkbox' value='Dolci'>";
                                                                            }
                                                                            echo "    
                                                                                <label for='restaurant-Dolci' class='checkbox-label'>Dolci</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Sushi', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Sushi' class='modal-form-checkbox' value='Sushi' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Sushi' class='modal-form-checkbox' value='Sushi'>";
                                                                            }
                                                                            echo " 
                                                                                <label for='restaurant-Sushi' class='checkbox-label'>Sushi</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Gelato', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Gelato' class='modal-form-checkbox' value='Gelato' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Gelato' class='modal-form-checkbox' value='Gelato'>";
                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Gelato' class='checkbox-label'>Gelato</label>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <p class='label'> Il ristorante offre delle opzioni per diete alternative? </p>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Per vegetariani', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Per-vegetariani' class='modal-form-checkbox' value='Per vegetariani' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Per-vegetariani' class='modal-form-checkbox' value='Per vegetariani'>";
                                                                            }
                                                                            echo "    
                                                                                <label for='restaurant-Per-vegetariani' class='checkbox-label'>Per vegetariani</label>
                                                                                <br>
                                                                            </div>
                                                                            <div class='checkbox'>";
                                                                            if (in_array('Per vegani', $tagsarray)) {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Per-vegani' class='modal-form-checkbox' value='Per vegani' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='checkbox' name='servizi-ristorante' id='restaurant-Per-vegani' class='modal-form-checkbox' value='Per vegani'>";
                                                                            }
                                                                            echo "
                                                                                <label for='restaurant-Per-vegan' class='checkbox-label'>Per vegani</label>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>         
                                                            </form>
                                
                                                        </div>
                                                    </div>
                                                    <!--Modal form submit button-->
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn review-btn' id='submit-review-button'>Invia</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
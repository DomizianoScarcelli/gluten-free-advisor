<?php

    /*Questo è il codice php che, tramite l'id del ristorante cercato, fa delle query
    sul database e recupera i dati, le immagini e le recensioni del ristorante stesso. */

    include "dbConnect.php";

    //Memorizza l'id del ristorante
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

    //Query che estraggono i dati del ristorante e le sue recensioni
    $q1 = "SELECT * FROM dati_ristoranti WHERE id = $id";  //Seleziona i dati del ristorante corrente (serve per nome e indirizzo)
    $q2 = "SELECT COUNT(*) FROM recensioni WHERE id_ristorante = $id"; //Conta il numero di recensioni per il ristorante corrente
    $q3 = "SELECT * FROM recensioni WHERE id_ristorante = $id order by data_recensione asc"; //Seleziona tutte le recensioni per il ristorante corrente
    $q4 = "SELECT valutazione FROM recensioni WHERE id_ristorante = $id"; /*Faccio una query a parte solo per la valutazione in modo da
    poter settare in modo opportuno la valutazione complessiva del ristorante, prima di iterare sulle recensioni*/
    //Query che contano il numero di valutazioni che il ristorante ha ricevuto per ogni punteggio
    $q5 = "SELECT COUNT(*) FROM recensioni WHERE (id_ristorante = $id AND valutazione = 5)";
    $q6 = "SELECT COUNT(*) FROM recensioni WHERE (id_ristorante = $id AND valutazione = 4)";
    $q7 = "SELECT COUNT(*) FROM recensioni WHERE (id_ristorante = $id AND valutazione = 3)";
    $q8 = "SELECT COUNT(*) FROM recensioni WHERE (id_ristorante = $id AND valutazione = 2)";
    $q9 = "SELECT COUNT(*) FROM recensioni WHERE (id_ristorante = $id AND valutazione = 1)";


    //Esecuzione delle query sul db e memorizzazione del risultato nelle variabili $result_i
    $result1 = mysqli_query($conn, $q1);
    $result2 = mysqli_query($conn, $q2);
    $result3 = mysqli_query($conn, $q3);
    $result4 = mysqli_query($conn, $q4);

    $result5 = mysqli_query($conn, $q5);
    $result6 = mysqli_query($conn, $q6);
    $result7 = mysqli_query($conn, $q7);
    $result8 = mysqli_query($conn, $q8);
    $result9 = mysqli_query($conn, $q9);

    
    if (mysqli_num_rows($result1) > 0) {

        while ($row1 = mysqli_fetch_assoc($result1)) {

            $photoarray = json_decode($row1['listaFoto']);
            $tagsarray = explode(',', str_replace(('"'), ',', $row1['tags']));
            $num_photo = sizeof($photoarray);

            /* Codice che mette a null gli ultimi elementi di photoarray se questo non contiene
            *  abbastanza foto per riempire la griglia (evita che vengano stampati errori se il 
            *  ristorante ha meno di 5 foto) */
            if (sizeof($photoarray) < 5) {
                for ($j = sizeof($photoarray); $j < 5; $j++) {
                    $photoarray[$j] = null;
                }
            }

            //Nome e indirizzo del ristorante
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

            //Griglia di immagini
            echo "        
                <!-- Images grid -->
                <div class='animated-grid'>
                        <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[0]})'></div>
                        <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[1]})'></div>
                        <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[2]})'></div>
                        <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[3]})'></div>
                        <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[4]})'></div>
                </div>
            ";

            //Slideshow modale
            echo "
                <!-- Slideshow button -->
                <div id='slideshow-button-container' style='text-align: center; color: black'>
                    <div id='slideshow-button' data-toggle='modal' data-target='#ModalSlideshow'>
                        <div class='slideshow-button-text'>
                            <span style='float: left'><b>::</b></span>
                            Mostra tutte le foto
                            <span style='float: right'><b>::</b></span>
                        </div>
                    </div>
                </div>

                <!-- Modal container -->
                <div class='modal fade' id='ModalSlideshow' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body container ui-front' id='modal-body-1'>

                    <!-- Carousel -->
                    <div id='GlutenFreeSlideshow' class='carousel slide' data-ride='carousel'>
                        <!-- Carousel Indicators -->
                        <div class='carousel-indicators'>
                            <button type='button' data-bs-target='#GlutenFreeSlideshow' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>";
                            for ($i = 1; $i < $num_photo; $i++) {
                                $j = $i+1;
                                echo "
                                <button type='button' data-bs-target='#GlutenFreeSlideshow' data-bs-slide-to='$i' aria-label='Slide {$j}'></button>";
                            }
            echo "                
                        </div>
                    
                        <div class='carousel-inner'>
                            <div class='carousel-item active' data-interval='1500'> 
                                <img class='d-block w-100 img-fluid' src='../img/upload/{$photoarray[0]}' alt='Image 1'>
                            </div>";
                            for ($i = 1; $i < $num_photo; $i++) {
                                $j = $i+1;
                                echo "
                                <div class='carousel-item' data-interval='1500'>
                                    <img class='d-block w-100 img-fluid' src='../img/upload/{$photoarray[$i]}' alt='Image {$j}'>
                                </div>";
                            }

            echo "
                        </div>
                        <a class='carousel-control-prev' href='#GlutenFreeSlideshow' role='button' data-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Previous</span>
                        </a>
                        <a class='carousel-control-next' href='#GlutenFreeSlideshow' role='button' data-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Next</span>
                        </a>
                    </div>

                            </div>
                        </div>
                    </div>
                </div>

            ";

            //Offerta del ristorante
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
                        
                            //Controllo dell'esistenza di una descrizione
                            if (empty($row1['descrizione'])) {
                                echo "<p><i>Non è ancora presente una descrizione per questo ristorante...</i></h3>";                                            
                            }
                            else {
                                    echo "<p>{$row1['descrizione']}</p>";
                            }

            //Confronto e stampa dei tag corrispondenti ai vari servizi che il ristorante offre
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
                            <!-- Colonna con il pulsante del form di modifica dati del ristorante -->
                            <div class='col-md-5 modify-info'>
                                <div>   <!-- Serve per racchiudere scritte e pulsante nella stessa entità -->
                                    <div class='row'>
                                        <img src='../img/icons/add-file.svg' class='edits-icon'>
                                    </div>
                                    <div class='row'>
                                        <p class='primary-text-1 mb-0'>Aggiungi informazioni</p>
                                        <p class='secondary-text-1'>
                                        Conosci questo ristorante?
                                        <br>
                                        Arricchisci il suo profilo con la tua esperienza!
                                        </p>
                                    </div>
                                    <div class='row'>
                                        
                                        <button class='addinfo-button' data-toggle='modal' data-target='#exampleModal-2' id='add-edits-button'>
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
                                                                <input type='file' multiple='true' name='filename' id='restaurant-image-2' accept='.jpeg,.png,.jpg'>
                                                                
                                                                <!--Descrizione-->
                                                                <p class='label' id='descrizione'>&emsp;&emsp;&emsp;Aggiungi/Modifica la descrizione</p>";
                                                                if ($row1['descrizione'] == '') {
                                                                    echo "<textarea form='form' cols='30' row='20' class='text-input long-text-input' id='restaurant-description-2' placeholder='Aggiungi per primo una descrizione...'></textarea>";
                                                                }
                                                                else {
                                                                    echo "<textarea form='form' cols='30' row='20' class='text-input long-text-input' id='restaurant-description-2'>{$row1['descrizione']}</textarea>";
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
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Economico' class='modal-form-checkbox' value='Economico' checked>";
                                                                            }
                                                                            else {
                                                                                echo "<input type='radio' name='servizi-ristorante' id='restaurant-Economico' class='modal-form-checkbox' value='Economico'>";
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
                                                        <button type='button' class='btn review-btn' id='edit-info-button'>Invia</button>
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

            //Recensioni
            echo "
                <!--Intestazione Recensioni-->
                <div class='text-center'>
                    <h3 class='risto-title'>Recensioni e valutazione di \"{$row1['nome']}\"</h3>
            ";

            if (mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {

                while ($row2 = mysqli_fetch_assoc($result2)) {

                    echo "
                            <!-- Numero totale di recensioni -->
                            <p>Numero di recensioni per questo ristorante: <b>{$row2['COUNT(*)']}</b></p>
                        
                    ";

                    
                    echo " 
                    </div>
                    <div class='row cols-2'>
                        <div class='col-md-6'>
                    ";
                        
                    
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        //Codice che cambia il formato della data da yyyy-mm-dd a dd-mm-yyyy
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
                                                    <span style='float: right'>
                                                        <b>Valutazione: </b>";

                                                        for ($i = 0; $i < $row3['valutazione']; $i++) {
                                                            echo "              
                                                                    <span class='fa fa-star star-color-1 checked'></span>
                                                                ";
                                                        }
                                    
                                                        for (; $i < 5; $i++) {
                                                            echo "
                                                                    <span class='fa fa-star'></span>
                                                                ";
                                                        }
                        echo "                           
                                                    </span>
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

                    
                    echo "
                        </div>
                        ";

                    //Opinioni degli utenti
                    echo "
                        <div class='col-md-6'>
                            <div class='card'> 
                                <div class='rating-container'>
                                    <div class='rating-title'>
                                        <div>
                                            <h4>Opinioni degli utenti</h4>
                                            Valutazione complessiva:
                            ";


                            //Calcola la valutazione complessiva facendo la media delle valutazioni singole
                            if (mysqli_num_rows($result4) > 0) {
                                while ($row4 = mysqli_fetch_assoc($result4)) {
                                    $val += $row4['valutazione'];
                                }
                            }
                            $val = intdiv($val, $row2['COUNT(*)']);
                        
                            //Stampa il numero giusto di stelle sulla base del risultato precedente
                            for ($i = 0; $i < $val; $i++) {
                                echo "              
                                        <span class='fa fa-star star-color checked'></span>
                                    ";
                            }
        
                            for (; $i < 5; $i++) {
                                echo "
                                        <span class='fa fa-star'></span>
                                    ";
                            }
                    
                    echo "             
                                        </div>
                                    </div>

                                        <div>

                                            <div class='progress-group'>
                                                <div class='progress-group-bars'>
                                                    
                                                    <div class='row cols-2'>
                                                        <div class='col-sm-2 mt-1' style='text-align: right'>
                                                            <b><i>Ottimo</i></b>
                                                        </div>
                                                        <div class='col-sm-8' style='padding: 1em'>
                                                            <div class='progress' style='height: 6px; width: 100%'>
                                                                <div class='progress-bar bg-light-yellow' style='width: 100%'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-2 mt-1'>
                                                        5 / 5
                                                        </div>
                                                    </div>";
                                                    if (mysqli_num_rows($result5) >= 0) {
                                                        while ($row5 = mysqli_fetch_assoc($result5)) {
                                                        echo"
                                                                <div class='row'>
                                                                    <div class='rating-tip'>N° di recensioni: {$row5['COUNT(*)']}</div>
                                                                </div>
                                                            ";
                                                        }
                                                    }
                    echo"
                                                    
                                                </div>                                            
                                            </div>

                                            <div class='progress-group'>
                                                <div class='progress-group-bars'>
                                                    <div class='row cols-2'>
                                                        <div class='col-sm-2 mt-1' style='text-align: right'>
                                                            <b><i>Buono</i></b>
                                                        </div>
                                                        <div class='col-sm-8' style='padding: 1em'>
                                                            <div class='progress' style='height: 6px; width: 100%'>
                                                                <div class='progress-bar bg-light-yellow' style='width: 80%'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-2 mt-1'>
                                                        4 / 5
                                                        </div>
                                                    </div>";
                                                    if (mysqli_num_rows($result6) >= 0) {
                                                        while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        echo"
                                                                <div class='row'>
                                                                    <div class='rating-tip'>N° di recensioni: {$row6['COUNT(*)']}</div>
                                                                </div>
                                                            ";
                                                        }
                                                    }
                    echo"
                                                </div>                                            
                                            </div>

                                            <div class='progress-group'>
                                                <div class='progress-group-bars'>
                                                    <div class='row cols-2'>
                                                        <div class='col-sm-2 mt-1' style='text-align: right'>
                                                            <b><i>Medio</i></b>
                                                        </div>
                                                        <div class='col-sm-8' style='padding: 1em'>
                                                            <div class='progress' style='height: 6px; width: 100%'>
                                                                <div class='progress-bar bg-light-yellow' style='width: 60%'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-2 mt-1'>
                                                        3 / 5
                                                        </div>
                                                    </div>";
                                                    if (mysqli_num_rows($result7) >= 0) {
                                                        while ($row7 = mysqli_fetch_assoc($result7)) {
                                                        echo"
                                                                <div class='row'>
                                                                    <div class='rating-tip'>N° di recensioni: {$row7['COUNT(*)']}</div>
                                                                </div>
                                                            ";
                                                        }
                                                    }
                    echo"
                                                </div>                                            
                                            </div>

                                            <div class='progress-group'>
                                                <div class='progress-group-bars'>
                                                    <div class='row cols-2'>
                                                        <div class='col-sm-2 mt-1' style='text-align: right'>
                                                            <b><i>Scarso</i></b>
                                                        </div>
                                                        <div class='col-sm-8' style='padding: 1em'>
                                                            <div class='progress' style='height: 6px; width: 100%'>
                                                                <div class='progress-bar bg-light-yellow' style='width: 40%'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-2 mt-1'>
                                                        2 / 5
                                                        </div>
                                                    </div>";
                                                    if (mysqli_num_rows($result8) >= 0) {
                                                        while ($row8 = mysqli_fetch_assoc($result8)) {
                                                        echo"
                                                                <div class='row'>
                                                                    <div class='rating-tip'>N° di recensioni: {$row8['COUNT(*)']}</div>
                                                                </div>
                                                            ";
                                                        }
                                                    }
                    echo"
                                                </div>
                                            </div>

                                            <div class='progress-group'>
                                                <div class='progress-group-bars'>
                                                    <div class='row cols-2'>
                                                        <div class='col-sm-2 mt-1' style='text-align: right'>
                                                            <b><i>Pessimo</i></b>
                                                        </div>
                                                        <div class='col-sm-8' style='padding: 1em'>
                                                            <div class='progress' style='height: 6px; width: 100%'>
                                                                <div class='progress-bar bg-light-yellow' style='width: 20%'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-2 mt-1'>
                                                        1 / 5
                                                        </div>
                                                    </div>";
                                                    if (mysqli_num_rows($result9) >= 0) {
                                                        while ($row9 = mysqli_fetch_assoc($result9)) {
                                                        echo"
                                                                <div class='row'>
                                                                    <div class='rating-tip'>N° di recensioni: {$row9['COUNT(*)']}</div>
                                                                </div>
                                                            ";
                                                        }
                                                    }
                    echo"
                                                </div>                                            
                                            </div>

                                        </div>
                                    </div> 
                                
                                       
                                </div>

                            </div>
                        </div>
                    </div>
                        
                    ";
                }
            } 
            else {
                //Se non sono presenti recensioni per il ristorante viene eseguito questo ramo
                echo "
                    <p>Non è stata ancora scritta nessuna recensione per questo ristorante...</p>
                    <p>Sii il primo ad aggiungerne una!
                    <div class='row'>
                        <img src='../img/icons/not-found.svg' class='edits-icon-1'>
                    </div>
                    </div>
                ";
            }

        mysqli_close($conn);

        }
    }

?>
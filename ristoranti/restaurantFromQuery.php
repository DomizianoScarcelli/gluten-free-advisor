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
    $q3 = "SELECT * FROM utenti JOIN recensioni ON id = id_utente WHERE id_ristorante = $id order by data asc"; /*Seleziona
     gli utenti che hanno aggiunto una recensione per il ristorante corrente*/
    $q4 = "SELECT valutazione FROM recensioni WHERE id_ristorante = $id";

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
                    echo "
                        <!--Images grid-->
                        <div class='animated-grid'>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[0]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[1]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[2]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[3]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[4]})'></div>
                        </div>
                        ";                  
                    
                    //DETTAGLI DEL RISTORANTE
                    echo "
                            <!--Servizi del ristorante-->
                            <div class='border-top border-bottom'>
                                <div class='row card-body'>
                                    <div class='col-md-6>
                                        <h3 class='mt-3'>Dettagli</h3>
                        ";
                        
                        //Checks whether description is empty or not
                        if (empty($row1['descrizione'])) {
                            echo "<p>Nesssuna descrizione purtroppo...</p>";
                        }
                        else {
                            echo "<p>{$row1['descrizione']}</p>
                            <p>
                            ";
                        }                        

                        //Checks wheter tag list is empty or not
                        if (sizeof($tagsarray) > 0) {
                            for ($j = 0; $j < sizeof($tagsarray); $j++) {
                                echo "$tagsarray[$j] ";
                                }
                            }
                        echo "
                                    </p>
                                </div>
                            <div clas='col-md-6>
                            </div>
                            </div>
                            ";
                        
                        //RECENSIONI
                    echo "
                        <!--Intestazione Recensioni-->
                        <div class='border-top border-bottom text-center'>
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
                                ";
                    if ($row3['username'] == 'anonimo') {
                        echo "<b>Autore:</b> <i>{$row3['username']}_{$row3['id']}</i>";
                    }
                    else {
                        echo "<b>Autore:</b> <i>{$row3['username']}</i>";
                    }
                    echo "
                                </div>
                            </div>
                        </div>
                    ";
                }
            }
            //Se il ristorante non ha recensioni
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
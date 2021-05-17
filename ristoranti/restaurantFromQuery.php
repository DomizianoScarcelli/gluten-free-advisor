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
    else {
        echo "<p>Ecco il ristorante che cercavi:</p>";
    }

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

            print_r($row1);

            $photoarray = json_decode($row1['listaFoto']);
            $tagsarray = explode(',', $row1['tags']);

            //Codice che mette a null gli ultimi elementi di photoarray se questo contiene meno di 5 foto
            //Evita che vengano stampati errori se il ristorante ha meno d
            if (sizeof($photoarray) < 5) {
                for ($j = sizeof($photoarray); $j < 5; $j++) {
                    $photoarray[$j] = null;
                }
            }

            echo "
                <div class='border-bottom'id='{$row1['id']}'>
                    <h3>{$row1['nome']}</h3>
                    <div class='row mb-2'>
                        <div class='col-sm'>
                            <span style='float:left'>
                            <b>Indirizzo: </b><i>{$row1['indirizzo']}</i>
                            </span>
                        </div>
                        <div class='col-sm'>
                            <span style='float:right'>
                                Valutazione degli utenti:
                                <span>
            ";

            //Se il ristorante ha più di 0 recensioni
            if (mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {

                while ($row2 = mysqli_fetch_assoc($result2)) {

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

                        <!--Images grid-->
                        <div class='animated-grid'>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[0]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[1]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[2]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[3]})'></div>
                            <div class='animated-card' style='background-image:url(../img/upload/{$photoarray[4]})'></div>
                        </div>
                        ";                  
                        
                        echo "
                            <!--Servizi del ristorante-->
                            <div class='border-top border-bottom'>
                                <h3 class='mt-3'>Servizi</h3>";
                        if (sizeof($tagsarray) > 0) {
                            for ($j = 0; $j < sizeof($tagsarray); $j++) {
                                echo "$tagsarray[$j] ";
                                }
                            }
                        echo "
                            </div>

                            <!--Intestazione Recensioni-->
                            <div class='border-top border-bottom'>
                                <h3 class='mt-3'>Recensioni</h3>
                                <p>Numero di recensioni per questo ristorante: {$row2['COUNT(*)']}</p>
                            </div>
                        ";
                }

                while ($row3 = mysqli_fetch_assoc($result3)) {

                    $datestamp = strtotime("{$row3['data']}");
                    $new_date = date("d-m-Y", $datestamp);
                    //$date = date_format($datestamp, "d/m/Y H:i:s");

                    echo "
                        <div class='card mb-3' style='max-width: 70rem;' id='{$row3['id_recensione']}'>
                            <div class='row card-body'>
                                <div class='col-md-2 user-container'>
                                    Autore:
                    ";
                    if ($row3['username'] == 'anonimo') {
                        echo "<p><i>{$row3['username']}_{$row3['id']}</i></p>";
                    }
                    else {
                        echo "<p><i>{$row3['username']}</i></p>";
                    }
                    echo "
                                </div>
                                <div class='col-md-10 review-container'>
                                    <div class='title-container'>
                                        <h5>\"{$row3['titolo']}\"</h5>
                                        <p class='card-text'>{$row3['testo']}</p>
                                        <p><b>Data della visita:</b> $new_date</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <!--Recensioni vecchia versione
                                <div class='my-container'>
                                    <div class='row align-items-center'>
                                        <div class='col-sm-2'>
                                            Autore:
                                            <p>nome utente</p>
                                        </div>
                                        <div class='col-sm-9'>
                                            <h5>\"{$row3['titolo']}\"</h5>
                                            <p>{$row3['testo']}</p>
                                            <span class='date-left'>gg.mm.aa</span>
                                            <span class='date-right'>11:02</span>
                                        </div>
                                        <div class='col-sm-1'>
                                            Colonna vuota per allineamento
                                        </div>
                                    </div>
                                </div> -->
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
                        <p>Numero di recensioni per questo ristorante: 0</p>
                    </div>
                ";
            }
        }
    }

    mysqli_close($conn);

?>
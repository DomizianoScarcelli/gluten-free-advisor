<?php

    /*Questo è il codice php che prende l'id del ristorante cercato dalla url e lo usa per fare una query
    sul database che recupera i dati e le recensioni del ristorante specifico. */

    /*Connessione al db*/
    include "../dbManager/dbConnect.php";

    //Memorizza l'id del ristorante di cui fare la query e caricare i dati
    $id = $_GET['id'];

    //Controlla che la variabile di cui sopra non sia null
    if (!isset($id)) {
        echo "<h3>Ricerca non valida, non posso mostrarti il ristorante...</h3>";
    }

    if (!$conn) {
        echo "<h3>Connessione al database locale fallita</h3>";
    }
    else {
        $q1 = "SELECT * FROM dati_ristoranti WHERE id = $id";  //Seleziona i dati del ristorante corrente (serve per nome e indirizzo)
        $q2 = "SELECT COUNT(*) FROM recensioni WHERE id_ristorante = $id"; //Conta il numero di recensioni per il ristorante corrente
        $q3 = "SELECT * FROM utenti JOIN recensioni ON id = id_utente WHERE id_ristorante = $id"; /*Seleziona gli utenti che hanno aggiunto una 
                recensione per il ristorante corrente*/
        echo "<p>Ecco il ristorante che cercavi:</p>";
    }

    //Esecuzione delle query sul db e memorizzazione del risultato nelle variabili $result_i
    $result1 = mysqli_query($conn, $q1);
    $result2 = mysqli_query($conn, $q2);
    $result3= mysqli_query($conn, $q3);

    if (mysqli_num_rows($result1) > 0) {

        while ($row1 = mysqli_fetch_assoc($result1)) {
            echo "
                <div class='container border-bottom'>
                    <h3>{$row1["nome"]}</h3>
                    <div class='row mb-2'>
                        <div class='col-sm'>
                            <span class='span-left'>
                            <b>Indirizzo: </b>{$row1["indirizzo"]}
                            </span>
                        </div>
                        <div class='col-sm'>
                            <span class='span-right'>
                                Valutazione degli utenti:
                                <span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <!--Images grid-->
                <div class='container'>
                    <div class='animated-grid'>
                        <div class='animated-card' style='background-image:url(./img/lievito72_1.jpg)'></div>
                        <div class='animated-card' style='background-image:url(./img/lievito72_2.jpg)'></div>
                        <div class='animated-card' style='background-image:url(./img/lievito72_3.jpg)'></div>
                        <div class='animated-card' style='background-image:url(./img/lievito72_4.jpg)'></div>
                        <div class='animated-card' style='background-image:url(./img/lievito72_5.jpg)'></div>
                    </div>
                </div>
                ";

                if (mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {

                    while ($row2 = mysqli_fetch_assoc($result2)) {

                        //print_r($row3);   {$row4['cognome']}

                        
                        echo "
                            <!--Intestazione Recensioni-->
                            <div class='container border-top border-bottom'>
                                <h3 class='mt-3'>Recensioni</h3>
                                <p>Numero di recensioni per questo ristorante: {$row2['COUNT(*)']}</p>
                            </div>
                        ";
                    }

                    while ($row3 = mysqli_fetch_assoc($result3)) {

                            echo "

                                <!--Restyling da fare-->
                                <div class='my-container'>
                                    <div class='row align-items-center'>
                                        <div class='col-sm'>
                                            <h5>\"{$row3['titolo']}\"</h5>
                                            <p>{$row3['testo']}</p>
                                            Autore:
                                            <p>{$row3['nome']} {$row3['cognome']}</p>
                                            Data:
                                            <p>data recensione</p>
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
        }
    }

?>
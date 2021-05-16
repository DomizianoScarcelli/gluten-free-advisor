<?php

    /*Questo è il codice php che prende l'id del ristorante cercato dalla url e lo usa per fare una query
    sul database che recupera i dati e le recensioni del ristorante specifico. */

    /*Connessione al db
    include "../dbManager.dbConnect.php";*/

    //Provo a connettermi direttamente da qui, includendo il file avevo un errore
    $dbServername = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'ristoranti';

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    //Memorizza l'id del ristorante di cui fare la query e caricare i dati
    //$id = $_GET['id'];
    $id = 32; //CODICE PER DEBUGGING
    //Controlla che la variabile di cui sopra non sia null
    if (!isset($id)) {
        echo "<h3>Ricerca non valida, non posso mostrarti il ristorante...</h3>";
    }

    if (!$conn) {
        echo "<h3>Connessione al database locale fallita</h3>";
    }
    else {
        $q1 = "SELECT * FROM dati_ristoranti WHERE id == $id";
        $q2 = "SELECT * FROM recensioni WHERE id_ristorante == $id";
        echo "<p>Ecco il ristorante che cercavi:</p>";
    }

    $result = mysqli_query($conn, $q1);

    //Il seguente if fallisce, pare che debba valutare un mysqli_num_results(false) e non gli piace
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            echo "
                <div class='container border-bottom'>
                    <h3>{$row["nome"]}</h3>
                    <div class='row mb-2'>
                        <div class='col-sm'>
                            <span class='span-left'>
                            <b>Indirizzo: </b>{$row["indirizzo"]}
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
            
            ";
        }
    }

    echo "batti un colpo se arrivi fin qui";


/*
<!--Intestazione Ristorante-->


        <!--Images grid-->
        <div class="container">
            <div class="animated-grid">
                <div class="animated-card" style="background-image:url('./img/lievito72_1.jpg')"></div>
                <div class="animated-card" style="background-image:url('./img/lievito72_2.jpg')"></div>
                <div class="animated-card" style="background-image:url('./img/lievito72_3.jpg')"></div>
                <div class="animated-card" style="background-image:url('./img/lievito72_4.jpg')"></div>
                <div class="animated-card" style="background-image:url('./img/lievito72_5.png')"></div>
            </div>
        </div>

        <!--Recensioni-->
        <div class="container main-container">
            <!--Intestazione Recensioni-->
            <div class="container border-top border-bottom">
                <h3 class="mt-3">Recensioni</h3>
                <p>Numero di recensioni per questo ristorante: 0</p>
            </div>

            <!--Elenco Recensioni-->
            <div class="my-container">
                <div class="row align-items-center">
                    <div class="col-sm-2">
                        Autore:
                        <p>nome utente</p>
                    </div>
                    <div class="col-sm-9">
                        <h5>Titolo recensione</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt
                            ut labore et
                            dolore
                            magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit
                            laboriosam,
                            nisi ut aliquid ex ea commodi consequatur.</p>
                        <span class="date-left">gg.mm.aa</span>
                        <span class="date-right">11:02</span>
                    </div>
                    <div class="col-sm-1">
                        <!--Colonna vuota per allineamento-->
                    </div>
                </div>
            </div>

            <div class="my-container alt">
                <div class="row align-items-center">
                    <div class="col-sm-2 text-center">
                        Autore:
                        <p>nome utente</p>
                    </div>
                    <div class="col-sm-9">
                        <h5>Titolo recensione</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et
                            dolore
                            magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit
                            laboriosam,
                            nisi ut aliquid ex ea commodi consequatur.</p>
                        <span class="date-left"><i>gg.mm.aa</i></span>
                        <span class="date-right">11:02</span>
                    </div>
                    <div class="col-sm-1">
                        <!--Colonna vuota per allineamento-->
                    </div>
                </div>
            </div>

        </div>
*/
?>
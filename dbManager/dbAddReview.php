<?php 

    /* Codice per l'aggiunta di una nuova recensione nel database */

    include 'dbConnect.php';

    $title = str_replace("'", "''", $_POST['title']);
    $text = str_replace("'", "''", $_POST['text']);
    $rating = $_POST['rating'];
    $date = $_POST['date'];
    $id_ristorante = $_POST['id_ristorante'];
    $username = str_replace("'", "''", $_POST['username']);
    
    $query = "INSERT INTO recensioni (id_recensione, id_ristorante, username, titolo, data_recensione, valutazione, testo) VALUES (NULL, '$id_ristorante','$username','$title','$date','$rating','$text')";

    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
    //Codice per debugging che stampa nella console gli errori di connessione: 
    //$result = mysqli_query($conn, $query) or trigger_error(mysqli_error($conn))

    echo $result;

?>
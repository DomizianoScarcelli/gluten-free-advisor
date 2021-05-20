<?php 

    /* Codice per l'aggiunta di una nuova recensione nel database */

    include '../dbManager/dbConnect.php';
    
    $title = $_POST['title'];
    $text = $_POST['text'];

    $rating = $_POST['rating'];
    $date = $_POST['date'];

    $id_ristorante = $_POST['id_ristorante'];
    $username = $_POST['username'];
    
    echo "$id_ristorante";
    echo "$title";
    echo "$text";
    echo "$date";
    echo "$username";
    
    $query = "INSERT INTO recensioni (id_recensione, id_ristorante, username, titolo, data_recensione, valutazione, testo) VALUES (NULL, '$id_ristorante','$username','$title','$date','$rating','$text')";

    $result = mysqli_query($conn, $query) or trigger_error(mysqli_error($conn)); //Codice per debugging che stampa gli errori di connessione

    echo $result;

?>
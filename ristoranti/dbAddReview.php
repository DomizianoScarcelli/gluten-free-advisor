<?php 

    /* Codice per l'aggiunta di una nuova recensione nel database */

    include '../dbManager/dbConnect.php';

    
    $title = $_POST['title'];
    $text = $_POST['text'];
    $rating = $_POST['rating'];
    $date = $_POST['date'];
    $id_ristorante = $_POST['id_ristorante'];

    echo "$id_ristorante";
    echo "$title";
    echo "$text";
    echo "$date"; 


    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $username = $_POST['anonimo'];
    }

    //TODO: ora id_ristorante è definito ma comunque non funziona
    $query = "INSERT INTO recensioni (id_recensione, id_ristorante, username, titolo, data_recensione, valutazione, testo) VALUES (NULL, '$id_ristorante','$username','$title','$date','$rating','$text')";

    $result = mysqli_query($conn, $query); //or trigger_error(mysqli_error($conn)); Codice per DEBUG

    echo $result;

?>
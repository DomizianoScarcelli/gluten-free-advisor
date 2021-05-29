<?php
    
    /* Codice per l'aggiunta/modifica di informazioni relative al ristorante */

    include 'dbConnect.php';

    $id_ristorante = $_POST['id_ristorante'];

    //Seleziona la lista delle foto già presenti per il ristorante corrente
    $fotoquery = "SELECT listaFoto FROM dati_ristoranti WHERE id = '$id_ristorante'";
    $resultquery = mysqli_query($conn, $fotoquery);
    while ($row = mysqli_fetch_assoc($resultquery)) {
   
        /* Prende il valore corrispondente alla chiave 'listaFoto' nell'oggetto risultato della query
        *  e lo converte in un array associativo di php (necessario per poter fare il merge con l'array
        *  delle eventuali nuove foto aggiunte) */
        $fotoarray = json_decode($row['listaFoto']);

        if (empty($_FILES)) {

            /* Se l'utente non aggiunge nuove immagini viene eseguito questo ramo */

            if (isset($_POST['image'])) {
                $image = $_POST['image'];
            } else {
                $image = 0;
            }

            if (isset($_POST['description'])) {
                $description = str_replace("'", "''", $_POST['description']);
            } else {
                $description = 0;
            }

            if (isset($_POST['tags'])) {
                $tags = json_encode($_POST['tags']);
            } else {
                $tags = json_encode(['niente']);
            }

            $query2 = "UPDATE dati_ristoranti SET descrizione = '$description', tags = '$tags' WHERE id = '$id_ristorante'";
            
        }
        else {

            /* Se l'utente ha aggiunto nuove immagini viene eseguito questo ramo */

            //Loop per il corretto caricamento dei file delle immagini
            $total = count($_FILES['file']['name']);
            $fileArray = array();
            for ($i = 0; $i < $total; $i++) {
                $tmpFilePath = $_FILES['file']['tmp_name'][$i];
                if ($tmpFilePath != "") {
                    $newFilePath = "../img/upload/" . $_FILES['file']['name'][$i];
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        //...
                    }
                }
                array_push($fileArray, $_FILES['file']['name'][$i]);
            }

            //Merge che fa l'append dell'array delle nuove foto a quello delle foto già presenti
            $merge = array_merge($fotoarray, $fileArray);
            $encodedFileArray = json_encode($merge); 

            if (isset($_POST['image'])) {
                $image = $_POST['image'];
            } else {
                $image = 0;
            }

            if (isset($_POST['description'])) {
                $description = str_replace("'", "''", $_POST['description']);
            } else {
                $description = 0;
            }

            if (isset($_POST['tags'])) {
                $tags = json_encode($_POST['tags']);
            } else {
                $tags = json_encode(['niente']);
            }

            $query2 = "UPDATE dati_ristoranti SET descrizione = '$description', listaFoto = '$encodedFileArray', tags = '$tags' WHERE id = '$id_ristorante'";

            }
    }

    $result = mysqli_query($conn, $query2) or die (mysqli_error($conn));
            //or trigger_error(mysqli_error($conn))
    
    echo $result;

?>